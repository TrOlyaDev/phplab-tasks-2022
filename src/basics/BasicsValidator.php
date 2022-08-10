<?php

namespace basics;

use http\Exception\InvalidArgumentException;

class BasicsValidator implements BasicsValidatorInterface
{
    public function isMinutesException(int $minute): void
    {
        if ($minute < 0 || $minute > 59) {
            throw new \InvalidArgumentException("The minute value must be from 0 to 59.");
        }
    }

    public function isYearException(int $year): void
    {
        if ($year < 1900) {
            throw new \InvalidArgumentException("The year value can't be lower then 1900.");
        }
    }

    public function isValidStringException(string $input): void
    {
        if (iconv_strlen($input) != 6) {
            throw new \InvalidArgumentException("The string must contain 6 digits.");
        }
    }
}
