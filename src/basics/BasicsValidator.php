<?php

namespace basics;

use http\Exception\InvalidArgumentException;

class BasicsValidator implements BasicsValidatorInterface{

    public function isMinutesException(int $minute): void
    {
        $minuteFrom = 0;
        $minuteTo = 60;
        if ($minute < $minuteFrom || $minute > $minuteTo){
            throw new \InvalidArgumentException("The minute value must be from 0 to 59.");
        }
    }

    public function isYearException(int $year): void
    {
        $minYear = 1900;
        if ($year < $minYear){
            throw new \InvalidArgumentException("The year value can't be lower then 1900.");
        }
    }

    public function isValidStringException(string $input): void
    {
        $numOfDigits = 6;
        if (iconv_strlen($input) != $numOfDigits){
            throw new \InvalidArgumentException("The string must contain 6 digits.");
        }
    }
}