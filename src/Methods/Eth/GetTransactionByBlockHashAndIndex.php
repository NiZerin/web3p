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
use Ethereum\Web3\Validators\BlockHashValidator;
use Ethereum\Web3\Validators\QuantityValidator;
use Ethereum\Web3\Formatters\HexFormatter;
use Ethereum\Web3\Formatters\QuantityFormatter;

class GetTransactionByBlockHashAndIndex extends EthMethod
{
    /**
     * validators
     * 
     * @var array
     */
    protected $validators = [
        BlockHashValidator::class, QuantityValidator::class
    ];

    /**
     * inputFormatters
     * 
     * @var array
     */
    protected $inputFormatters = [
        HexFormatter::class, QuantityFormatter::class
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