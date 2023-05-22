<?php

namespace Helper;

use PHPUnit\Framework\TestCase;

class untilTest extends TestCase
{
    public function testConvertTimeWithValidInput()
    {
        $expected = '10th October 2022 10:30 PM';
        $actual = convertTime('10/10/2022 22:30:00', 'jS F Y h:i A');
        $this->assertEquals($expected, $actual);
    }

    public function testGetItemByKeyValueWithValidInput()
    {
        $array = [
            [
                'id' => 1,
                'name' => 'John',
            ],
            [
                'id' => 2,
                'name' => 'Jane',
            ],
            [
                'id' => 3,
                'name' => 'Bob',
            ],
        ];
        $expected = [
            'id' => 2,
            'name' => 'Jane',
        ];
        $actual = getItemByKeyValue($array, 'id', 2);
        $this->assertEquals($expected, $actual);
    }

    public function testGetItemByKeyValueWithNonexistentKey()
    {
        $array = [
            [
                'id' => 1,
                'name' => 'John',
            ],
            [
                'id' => 2,
                'name' => 'Jane',
            ],
            [
                'id' => 3,
                'name' => 'Bob',
            ],
        ];
        $expected = null;
        $actual = getItemByKeyValue($array, 'age', 30);
        $this->assertEquals($expected, $actual);
    }

    public function testGetItemByKeyValueWithNonexistentValue()
    {
        $array = [
            [
                'id' => 1,
                'name' => 'John',
            ],
            [
                'id' => 2,
                'name' => 'Jane',
            ],
            [
                'id' => 3,
                'name' => 'Bob',
            ],
        ];
        $expected = null;
        $actual = getItemByKeyValue($array, 'id', 4);
        $this->assertEquals($expected, $actual);
    }
}
