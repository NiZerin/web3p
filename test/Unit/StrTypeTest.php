<?php

namespace Ethereum\Test\Unit;

use InvalidArgumentException;
use Ethereum\Test\TestCase;
use Ethereum\Web3\Contracts\Types\Str;

class StrTypeTest extends TestCase
{
    /**
     * testTypes
     * 
     * @var array
     */
    protected $testTypes = [
        [
            'value' => 'string',
            'result' => true
        ], [
            'value' => 'string[]',
            'result' => true
        ], [
            'value' => 'string[4]',
            'result' => true
        ], [
            'value' => 'string[][]',
            'result' => true
        ], [
            'value' => 'string[3][]',
            'result' => true
        ], [
            'value' => 'string[][6][]',
            'result' => true
        ],
    ];

    /**
     * solidityType
     * 
     * @var \Ethereum\Web3\Contracts\SolidityType
     */
    protected $solidityType;

    /**
     * setUp
     * 
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->solidityType = new Str;
    }

    /**
     * testIsType
     * 
     * @return void
     */
    public function testIsType()
    {
        $solidityType = $this->solidityType;

        foreach ($this->testTypes as $type) {
            $this->assertEquals($solidityType->isType($type['value']), $type['result']);
        }
    }
}