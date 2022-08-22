<?php

namespace src\oop\app\src\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    private $crawler;

    public function __construct()
    {
        $this->crawler = new Crawler();
    }

    /**
     * @inheritDoc
     */
    public function parseContent(string $siteContent)
    {
        $this->crawler->addHtmlContent($siteContent);
        $movie['title'] = $this->crawler->filter("h1")->text();
        $movie['poster'] = $this->crawler->filter("div.fposter > a")->attr('href');
        $movie['description'] = $this->crawler->filter("div#fdesc")->text();

        return $movie;
    }
}
