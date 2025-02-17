<?php

namespace App\Models;


class MovieDetails
{
    private $id;
    private $title;
    private $vote_average;
    private $original_language;
    private $release_date;
    private $overview;
    private $runtime;
    private $genres;
    private $budget;
    private $revenue;
    private $poster_path;

    public function __construct(
        int $id,
        string $title,
        float $vote_average,
        string $original_language,
        string $release_date,
        string $overview,
        string $runtime,
        array $genres,
        int $budget,
        int $revenue,
        string $poster_path
    ) 
    {
        $this->id = $id;
        $this->title = $title;
        $this->vote_average = $vote_average;
        $this->original_language = $original_language;
        $this->release_date = $release_date;
        $this->overview = $overview;
        $this->runtime = $runtime;
        $this->genres = $genres;
        $this->budget = $budget;
        $this->revenue = $revenue;
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

    public function getOverview()
    {
        return $this->overview;
    }

    public function getRuntime()
    {
        return $this->runtime;
    }

    public function getGenre()
    {
        return $this->genres;
    }

    public function getBudget()
    {
        return $this->budget;
    }

    public function getRevenue()
    {
        return $this->revenue;
    }

    public function getPosterUrl()
    {
        return $this->poster_path ? 'https://image.tmdb.org/t/p/w500' . $this->poster_path : null;
    }
}
