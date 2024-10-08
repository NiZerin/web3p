<?php

/**
 * This file is part of web3.php package.
 * 
 * (c) Kuan-Cheng,Lai <alk03073135@gmail.com>
 * 
 * @author Peter Lai <alk03073135@gmail.com>
 * @license MIT
 */

namespace Ethereum\Web3\Providers;

use InvalidArgumentException;
use Psr\Http\Message\StreamInterface;
use RuntimeException as RPCException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Ethereum\Web3\Providers\Provider;
use Ethereum\Web3\Providers\IProvider;

class HttpProvider extends Provider implements IProvider
{
    /**
     * methods
     * 
     * @var array
     */
    protected $methods = [];

    /**
     * client
     *
     * @var \GuzzleHttp
     */
    protected $client;

    /**
     * construct
     *
     * @param string $host
     * @param float $timeout
     * @return void
     */
    public function __construct($host, $timeout = 1)
    {
        parent::__construct($host, $timeout);
        $this->client = new Client;
    }

    /**
     * close
     * 
     * @return void
     */
    public function close() {}

    /**
     * send
     * 
     * @param \Ethereum\Web3\Methods\Method $method
     * @param callable $callback
     * @return void
     */
    public function send($method, $callback)
    {
        $payload = $method->toPayloadString();

        if (!$this->isBatch) {
            $proxy = function ($err, $res) use ($method, $callback) {
                if ($err !== null) {
                    return call_user_func($callback, $err, null);
                }
                if (!is_array($res)) {
                    $res = $method->transform([$res], $method->outputFormatters);
                    return call_user_func($callback, null, $res[0]);
                }
                $res = $method->transform($res, $method->outputFormatters);

                return call_user_func($callback, null, $res);
            };
            return $this->sendPayload($payload, $proxy);
        } else {
            $this->methods[] = $method;
            $this->batch[] = $payload;
        }
    }

    /**
     * batch
     * 
     * @param bool $status
     * @return void
     */
    public function batch($status)
    {
        $status = is_bool($status);

        $this->isBatch = $status;
    }

    /**
     * execute
     * 
     * @param callable $callback
     * @return void
     */
    public function execute($callback)
    {
        if (!$this->isBatch) {
            throw new \RuntimeException('Please batch json rpc first.');
        }
        $methods = $this->methods;
        $proxy = function ($err, $res) use ($methods, $callback) {
            if ($err !== null) {
                return call_user_func($callback, $err, null);
            }
            foreach ($methods as $key => $method) {
                if (isset($res[$key])) {
                    if (!is_array($res[$key])) {
                        $transformed = $method->transform([$res[$key]], $method->outputFormatters);
                        $res[$key] = $transformed[0];
                    } else {
                        $transformed = $method->transform($res[$key], $method->outputFormatters);
                        $res[$key] = $transformed;
                    }
                }
            }
            return call_user_func($callback, null, $res);
        };
        $r = $this->sendPayload('[' . implode(',', $this->batch) . ']', $proxy);
        $this->methods = [];
        $this->batch = [];
        return $r;
    }

    /**
     * sendPayload
     *
     * @param string $payload
     * @param callable $callback
     * @return void
     */
    public function sendPayload($payload, $callback)
    {
        if (!is_string($payload)) {
            throw new InvalidArgumentException('Payload must be string.');
        }

        try {
            $res = $this->client->post($this->host, [
                'headers' => [
                    'content-type' => 'application/json'
                ],
                'body' => $payload,
                'timeout' => $this->timeout,
                'connect_timeout' => $this->timeout
            ]);
            /**
             * @var StreamInterface $stream ;
             */
            $stream = $res->getBody();
            $json = json_decode($stream);
            $stream->close();

            if (JSON_ERROR_NONE !== json_last_error()) {
                call_user_func($callback, new InvalidArgumentException('json_decode error: ' . json_last_error_msg()), null);
            }
            if (is_array($json)) {
                // batch results
                $results = [];
                $errors = [];

                foreach ($json as $result) {
                    if (property_exists($result,'result')) {
                        $results[] = $result->result;
                    } else {
                        if (isset($json->error)) {
                            $error = $json->error;
                            $errors[] = new RPCException(mb_ereg_replace('Error: ', '', $error->message), $error->code);
                        } else {
                            $results[] = null;
                        }
                    }
                }
                if (count($errors) > 0) {
                    call_user_func($callback, $errors, $results);
                } else {
                    call_user_func($callback, null, $results);
                }
            } elseif (property_exists($json,'result')) {
                call_user_func($callback, null, $json->result);
            } else {
                if (isset($json->error)) {
                    $error = $json->error;

                    call_user_func($callback, new RPCException(mb_ereg_replace('Error: ', '', $error->message), $error->code), null);
                } else {
                    call_user_func($callback, new RPCException('Something wrong happened.'), null);
                }
            }
        } catch (RequestException $err) {
            call_user_func($callback, $err, null);
        }
    }
}