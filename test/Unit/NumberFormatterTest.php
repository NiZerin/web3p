<?php

namespace Ethereum\Test\Unit;

use Ethereum\Test\TestCase;
use Ethereum\Web3\Formatters\NumberFormatter;

class NumberFormatterTest extends TestCase
{
    /**
     * formatter
     * 
     * @var \Ethereum\Web3\Formatters\NumberFormatter
     */
    protected $formatter;

    /**
     * setUp
     * 
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->formatter = new NumberFormatter;
    }

    /**
     * testFormat
     * 
     * @return void
     */
    public function testFormat()
    {
        $formatter = $this->formatter;

        $number= $formatter->format('123');
        $this->assertEquals($number, 123);
    }
}