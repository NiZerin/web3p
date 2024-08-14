<?php

/**
 * This file is part of web3.php package.
 * 
 * (c) Kuan-Cheng,Lai <alk03073135@gmail.com>
 * 
 * @author Peter Lai <alk03073135@gmail.com>
 * @license MIT
 */

namespace Ethereum\Web3\Methods\Eth;

use InvalidArgumentException;
use Ethereum\Web3\Methods\EthMethod;
use Ethereum\Web3\Validators\QuantityValidator;
use Ethereum\Web3\Formatters\OptionalQuantityFormatter;
use Ethereum\Web3\Formatters\BigNumberFormatter;

class GetBlockTransactionCountByNumber extends EthMethod
{
    /**
     * validators
     * 
     * @var array
     */
    protected $validators = [
        QuantityValidator::class
    ];

    /**
     * inputFormatters
     * 
     * @var array
     */
    protected $inputFormatters = [
        OptionalQuantityFormatter::class
    ];

    /**
     * outputFormatters
     * 
     * @var array
     */
    protected $outputFormatters = [
        BigNumberFormatter::class
    ];

    /**
     * defaultValues
     * 
     * @var array
     */
    protected $defaultValues = [
        'latest'
    ];
}