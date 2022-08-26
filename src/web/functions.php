<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param array $airports
 * @return array
 */
function getUniqueFirstLetters(array $airports): array
{
    $result = [];
    array_map(function ($elem) use (&$result) {
        $result[] = substr($elem['name'], 0, 1);
    }, $airports);
    $result = array_unique($result);
    sort($result);

    return $result;
}
