<?php

namespace strings;

class Strings implements StringsInterface
{
    /**
     * Transform text in snake case into camel case string
     *
     * @param string $input
     * @return string
     */
    public function snakeCaseToCamelCase(string $input): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }

    /**
     * Mirror each word individually without changing word order
     *
     * @param string $input multibyte text
     * @return string
     */
    public function mirrorMultibyteString(string $input): string
    {
        $words = explode(' ', $input);
        $mirrorWords = [];
        $j = 0;
        foreach ($words as $word) {
            $mirrorWords[$j] = '';
            for ($i = mb_strlen($word); $i >= 0; $i--) {
                $mirrorWords[$j] .= mb_substr($word, $i, 1);
            }
            $j++;
        }

        return implode(' ', $mirrorWords);
    }

    /**
     * Combine bands names from input nouns according to formulas:
     * when the first and the last letters of the input do not match:
     * 'The' + a noun with first letter capitalized
     * when a noun STARTS and ENDS with the same letter:
     * repeat the noun twice and connect them together with the first and last letter,
     * combined into one word (WITHOUT a 'The' in front)
     *
     * @param string $noun
     * @return string
     */
    public function getBrandName(string $noun): string
    {
        if ($noun[0] === $noun[(strlen($noun) - 1)]) {
            $noun = ucfirst($noun . substr($noun, 1));
        } else {
            $noun = "The " . ucfirst($noun);
        }

        return $noun;
    }
}

