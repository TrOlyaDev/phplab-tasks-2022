<?php

namespace src\oop\app\src\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    /**
     * @inheritDoc
     */
    public function parseContent(string $siteContent)
    {
        $crawler = new Crawler($siteContent);
        $movie['title'] = $crawler->filter("h1")->text();
        $movie['poster'] = $crawler->filter("div.fposter > a")->attr('href');
        $movie['description'] = $crawler->filter("div#fdesc")->text();

        return $movie;
    }
}
