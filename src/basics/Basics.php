<?php

namespace basics;

class Basics implements BasicsInterface
{
    private BasicsValidator $validator;

    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    /**
     *Determination in which quarter of an hour the number of minutes falls.
     *
     * @param int $minute
     * @return string Return one of the values: "first", "second", "third" and "fourth".
     * @throws \InvalidArgumentException if $minute is negative or greater than 59
    */
    public function getMinuteQuarter(int $minute): string
    {
        $this->validator->isMinutesException($minute);

        $minuteQuarters = [
            [0, 15, 'first'],
            [15, 30, 'second'],
            [30, 45, 'third'],
            [45, 60, 'fourth']
        ];
        if ($minute == 0) {
            $minute = 60;
        }
        foreach ($minuteQuarters as $quarter) {
            if ($minute > $quarter[0] && $minute <= $quarter[1]) {
                return $quarter[2];
            }
        }

        return "0";
    }

    /**
     *Determine is it a leap year
     *
     * @param int $year
     * @return bool Return true if the year is leap or false otherwise.
     * @throws \InvalidArgumentException if $year is lower than 1900.
     */
    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);

        if ($year % 4 > 0) {
            return false;
        } elseif ($year % 100 > 0) {
            return true;
        } elseif ($year % 400 > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *Determine is it a leap year
     *
     * @param string $input a string of six digits
     * @return bool Return true if the sum of the first three digits is equal with the sum of last three ones
     * @throws \InvalidArgumentException if $input contains less or more than 6 digits
     */
    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);
        $sumFirst = $input[0] + $input[1] + $input[2];
        $sumLast = $input[3] + $input[4] + $input[5];

        if ($sumFirst == $sumLast) {
            return true;
        } else {
            return false;
        }
    }
}
