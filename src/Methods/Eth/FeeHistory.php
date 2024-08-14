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
use Ethereum\Web3\Validators\TagValidator;
use Ethereum\Web3\Validators\QuantityValidator;
use Ethereum\Web3\Validators\ArrayNumberValidator;
use Ethereum\Web3\Formatters\QuantityFormatter;
use Ethereum\Web3\Formatters\OptionalQuantityFormatter;
use Ethereum\Web3\Formatters\FeeHistoryFormatter;

class FeeHistory extends EthMethod
{
    /**
     * validators
     * 
     * @var array
     */
    protected $validators = [
        QuantityValidator::class, [
            TagValidator::class, QuantityValidator::class
        ], ArrayNumberValidator::class
    ];

    /**
     * inputFormatters
     * 
     * @var array
     */
    protected $inputFormatters = [
        QuantityFormatter::class, OptionalQuantityFormatter::class
    ];

    /**
     * outputFormatters
     * 
     * @var array
     */
    protected $outputFormatters = [
        FeeHistoryFormatter::class
    ];

    /**
     * defaultValues
     * 
     * @var array
     */
    protected $defaultValues = [];
}