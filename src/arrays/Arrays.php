<?php

namespace arrays;

class Arrays implements ArraysInterface
{
    /**
     * Return an array which will contain the same digits as an input but repetitive by its value
     * without changing the order.
     *
     * @param array $input array of digits
     * @return array
     */
    public function repeatArrayValues(array $input): array
    {
        $result = array();
        foreach ($input as $elem) {
            for ($i = 0; $i < $elem; $i++) {
                $result[] = $elem;
            }
        }

        return $result;
    }

    /**
     * Return the lowest unique value or 0 if there is no unique values or array is empty.
     *
     * @param array $input array of digits
     * @return int
     */
    public function getUniqueValue(array $input): int
    {
        $result = array();
        $countValues = array_count_values($input);
        foreach ($countValues as $key => $value) {
            if ($value == 1) {
                $result[] = $key;
            }
        }

        return count($result) ? min($result) : 0;
    }

    /**
     * Return the list of names grouped by tags
     *
     * @param array $input Array of arrays. Each sub array has keys: name (contains strings), tags (contains array of strings)
     * @return array The 'names' must be sorted ascending
     */
    public function groupByTag(array $input): array
    {
        foreach ($input as $elem) {
            foreach ($elem['tags'] as $tag) {
                $result[$tag][] = $elem['name'];
            }

        }
        ksort($result);
        foreach ($result as $key => &$value) {
            sort($value);
        }

        return $result;
    }
}
