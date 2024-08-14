<?php

namespace Ethereum\Test\Unit;

use InvalidArgumentException;
use Ethereum\Test\TestCase;
use Ethereum\Web3\Contracts\Types\Boolean;

class BooleanTypeTest extends TestCase
{
    /**
     * testTypes
     * 
     * @var array
     */
    protected $testTypes = [
        [
            'value' => 'bool',
            'result' => true
        ], [
            'value' => 'bool[]',
            'result' => true
        ], [
            'value' => 'bool[4]',
            'result' => true
        ], [
            'value' => 'bool[][]',
            'result' => true
        ], [
            'value' => 'bool[3][]',
            'result' => true
        ], [
            'value' => 'bool[][6][]',
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
        $this->solidityType = new Boolean;
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