<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLetterTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [
                [
                    ['name' => 'Charlotte Douglas International Airport'],
                    ['name' => 'Albuquerque Sunport International Airport'],
                    ['name' => 'Atlanta Hartsfield International Airport'],
                    ['name' => 'Denver International'],
                    ['name' => 'Charleston International Airport']
                ],
                ['A', 'C', 'D']
            ],
            [
                [
                    ['name' => 'Miami International Airport'],
                    ['name' => 'Kansas City International Airport'],
                    ['name' => 'Ontario International Airport'],
                    ['name' => 'Milwaukee Mitchell International Airport'],
                    ['name' => 'Baltimore Washington Airport']
                ],
                ['B', 'K', 'M', 'O']
            ],
            [
                [
                    ['name' => 'Newark Liberty International Airport'],
                    ['name' => 'Houston Intercontinental Airport'],
                    ['name' => 'St. George Regional Airport'],
                    ['name' => 'Ogden-Hinckley Airport'],
                    ['name' => 'Jackson Hole Airport']
                ],
                ['H', 'J', 'N', 'O', 'S']
            ]
        ];
    }
}
