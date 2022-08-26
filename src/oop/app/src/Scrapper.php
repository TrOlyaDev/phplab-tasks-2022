<?php
/**
 * Create Class - Scrapper with method getMovie().
 * getMovie() - should return Movie Class object.
 *
 * Note: Use next namespace for Scrapper Class - "namespace src\oop\app\src;"
 * Note: Dont forget to create variables for TransportInterface and ParserInterface objects.
 * Note: Also you can add your methods if needed.
 */
namespace src\oop\app\src;

use src\oop\app\src\Models\Movie;
use src\oop\app\src\Parsers\ParserInterface;
use src\oop\app\src\Transporters\TransportInterface;

class Scrapper
{
    private $transporter;
    private $parser;
    private $movie;

    /**
     * @param TransportInterface $transporter
     * @param ParserInterface $parser
     * @param Movie $movie
     */
    public function __construct(TransportInterface $transporter, ParserInterface $parser, Movie $movie)
    {
       $this->transporter = $transporter;
       $this->parser = $parser;
       $this->movie = $movie;
    }

    /**
     * Get film title, poster and description from third-party site
     *
     * @param string $url The site URL
     * @return Movie Contains information about film title, poster and description
     */
    public function getMovie(string $url): Movie
    {
        $content = $this->transporter->getContent($url);
        $movieData = $this->parser->parseContent($content);
        $this->movie->setTitle($movieData['title']);
        $this->movie->setPoster($movieData['poster']);
        $this->movie->setDescription($movieData['description']);

        return $this->movie;
    }
}
