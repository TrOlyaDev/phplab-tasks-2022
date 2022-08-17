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

class Scrapper
{
    private $transporter;
    private $parser;

    public function __construct($transporter, $parser)
    {
       $this->transporter = $transporter;
       $this->parser = $parser;
    }

    /**
     * Get film title, poster and description from third-party site
     *
     * @param string $url The site URL
     * @return Movie Contains information about film title, poster and description
     */
    public function getMovie(string $url): Movie
    {
        $movie = new Movie();
        $content = $this->transporter->getContent($url);
        $movieData = $this->parser->parseContent($content);
        $movie->setTitle($movieData['title']);
        $movie->setPoster($movieData['poster']);
        $movie->setDescription($movieData['description']);

        return $movie;
    }
}
