<?php

/**
 * This file is part of web3.php package.
 * 
 * (c) Kuan-Cheng,Lai <alk03073135@gmail.com>
 * 
 * @author Peter Lai <alk03073135@gmail.com>
 * @license MIT
 */

namespace Ethereum\Web3\Formatters;

use InvalidArgumentException;
use Ethereum\Web3\Utils;
use Ethereum\Web3\Formatters\IFormatter;

class BigNumberFormatter implements IFormatter
{
    /**
     * format
     * 
     * @param mixed $value
     * @return string
     */
    public static function format($value)
    {
        $value = Utils::toString($value);
        $bn = Utils::toBn($value);

        return $bn;
    }
}