<?php

namespace Ethereum\Test\Unit;

use Ethereum\Test\TestCase;
use Ethereum\Web3\Providers\Provider;
use Ethereum\Web3\Providers\HttpProvider;

class ProviderTest extends TestCase
{
    /**
     * testNewProvider
     * 
     * @return void
     */
    public function testNewProvider()
    {
        $provider = new HttpProvider('http://localhost:8545');

        $this->assertEquals($provider->host, 'http://localhost:8545');
    }
}