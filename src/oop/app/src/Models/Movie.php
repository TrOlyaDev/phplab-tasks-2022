<?php

namespace src\oop\app\src\Models;

class Movie implements MovieInterface
{
    private string $title;
    private string $poster;
    private string $description;

    /**
     * Getter for title property
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter for title property
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter for poster property
     *
     * @return string
     */
    public function getPoster(): string
    {
        return $this->poster;
    }

    /**
     * Setter for poster property
     *
     * @param string $poster
     * @return void
     */
    public function setPoster(string $poster): void
    {
        $this->poster = $poster;
    }

    /**
     * Getter for description property
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Setter for description property
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
