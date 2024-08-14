<?php

namespace Ethereum\Test\Unit;

use InvalidArgumentException;
use Ethereum\Test\TestCase;
use Ethereum\Web3\Contracts\Types\Address;

class AddressTypeTest extends TestCase
{
    /**
     * testTypes
     * 
     * @var array
     */
    protected $testTypes = [
        [
            'value' => 'address',
            'result' => true
        ], [
            'value' => 'address[]',
            'result' => true
        ], [
            'value' => 'address[4]',
            'result' => true
        ], [
            'value' => 'address[][]',
            'result' => true
        ], [
            'value' => 'address[3][]',
            'result' => true
        ], [
            'value' => 'address[][6][]',
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
        $this->solidityType = new Address;
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