<?php

namespace src\oop\app\src\Parsers;

class FilmixParserStrategy implements ParserInterface
{
    /**
     * @inheritDoc
     */
    public function parseContent(string $siteContent)
    {
        $siteContent = iconv('CP1251', mb_detect_encoding($siteContent), $siteContent);
        preg_match('#<h1[^>]+?class\s*?=\s*?(["\'])name\1[^>]*?>(.+?)</h1>#su', $siteContent, $matchesTitle);
        preg_match('#<meta[^>]+?property\s*?=\s*?(["\'])og:image\1\w*?\s*?content\s*?=\s*?(["\'])(.+?)\2[^>]*?>#su', $siteContent, $matchesPoster);
        preg_match('#<div[^>]+?class\s*?=\s*?(["\'])full-story\1[^>]*?>(.+?)</div>#su', $siteContent, $matchesDesciption);
        $movie['title'] = $matchesTitle[2];
        $movie['poster'] = $matchesPoster[3];
        $movie['description'] = $matchesDesciption[2];

        return $movie;
    }
}
