<?php

namespace Ethereum\Test\Unit;

use Ethereum\Test\TestCase;
use Ethereum\Web3\Formatters\StringFormatter;

class StringFormatterTest extends TestCase
{
    /**
     * formatter
     * 
     * @var \Ethereum\Web3\Formatters\StringFormatter
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
        $this->formatter = new StringFormatter;
    }

    /**
     * testFormat
     * 
     * @return void
     */
    public function testFormat()
    {
        $formatter = $this->formatter;

        $str = $formatter->format(123456);
        $this->assertEquals($str, '123456');
    }
}