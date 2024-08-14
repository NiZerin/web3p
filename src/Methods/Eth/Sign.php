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
use Ethereum\Web3\Validators\AddressValidator;
use Ethereum\Web3\Validators\HexValidator;
use Ethereum\Web3\Formatters\AddressFormatter;
use Ethereum\Web3\Formatters\HexFormatter;

class Sign extends EthMethod
{
    /**
     * validators
     * 
     * @var array
     */
    protected $validators = [
        AddressValidator::class, HexValidator::class
    ];

    /**
     * inputFormatters
     * 
     * @var array
     */
    protected $inputFormatters = [
        AddressFormatter::class, HexFormatter::class
    ];

    /**
     * outputFormatters
     * 
     * @var array
     */
    protected $outputFormatters = [];

    /**
     * defaultValues
     * 
     * @var array
     */
    protected $defaultValues = [];
}