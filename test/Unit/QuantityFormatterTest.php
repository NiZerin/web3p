<?php

namespace Ethereum\Test\Unit;

use Ethereum\Test\TestCase;
use Ethereum\Web3\Formatters\QuantityFormatter;

class QuantityFormatterTest extends TestCase
{
    /**
     * formatter
     * 
     * @var \Ethereum\Web3\Formatters\QuantityFormatter
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
        $this->formatter = new QuantityFormatter;
    }

    /**
     * testFormat
     * 
     * @return void
     */
    public function testFormat()
    {
        $formatter = $this->formatter;

        $this->assertEquals('0x927c0', $formatter->format(0x0927c0));
        $this->assertEquals('0x927c0', $formatter->format('0x0927c0'));
        $this->assertEquals('0x927c0', $formatter->format('0x927c0'));
        $this->assertEquals('0x927c0', $formatter->format('600000'));
        $this->assertEquals('0x927c0', $formatter->format(600000));
        
        $this->assertEquals('0xea60', $formatter->format('0x0ea60'));
        $this->assertEquals('0xea60', $formatter->format('0xea60'));
        $this->assertEquals('0xea60', $formatter->format(0x0ea60));
        $this->assertEquals('0xea60', $formatter->format('60000'));
        $this->assertEquals('0xea60', $formatter->format(60000));

        $this->assertEquals('0x0', $formatter->format(0x00));
        $this->assertEquals('0x0', $formatter->format('0x00'));
        $this->assertEquals('0x0', $formatter->format('0x0'));
        $this->assertEquals('0x0', $formatter->format('0'));
        $this->assertEquals('0x0', $formatter->format(0));
    }
}