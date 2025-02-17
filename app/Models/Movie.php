<?php

namespace App\Models;

class Movie
{
    private $title;
    public $id;
    private $vote_average;
    private $original_language;
    private $release_date;
    private $poster_path;
    

    public function __construct(
        int $id,
        string $title,
        string $vote_average,
        string $original_language,
        string $release_date,
        string $poster_path
        
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->vote_average = $vote_average;
        $this->original_language = $original_language;
        $this->release_date = $release_date;
        $this->poster_path = $poster_path;
        
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function getRating()
    {
        return $this->vote_average;
    }

    public function getLanguage()
    {
        return $this->original_language;
    }

    public function getReleaseDate()
    {
        return $this->release_date;
    }

    public function getPosterUrl()
    {
        return $this->poster_path ? 'https://image.tmdb.org/t/p/w500' . $this->poster_path : null;
    }

}


