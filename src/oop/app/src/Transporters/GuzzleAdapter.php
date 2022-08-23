<?php

namespace src\oop\app\src\Transporters;

use GuzzleHttp\Client;

class GuzzleAdapter implements TransportInterface
{
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function getContent(string $url): string
    {
        $response = $this->client->get($url);
        if ($response->getStatusCode() == 200){
            $content = $response->getBody();
        } else {
            throw new \Exception("Failed to get site content: ".$response->getMessage(), $response->getStatusCode());
        }

        return $content;
    }
}
