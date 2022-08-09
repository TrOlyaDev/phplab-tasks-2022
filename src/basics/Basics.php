<?php

namespace basics;

class Basics implements BasicsInterface
{
    private BasicsValidator $validator;

    public function __construct($validator)
    {
        $this->validator = $validator;
    }

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
            if ($minute > $quarter[0]) {
                if ($minute <= $quarter[1]) {
                    return $quarter[2];
                }
            }
        }
        return "0";
    }

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