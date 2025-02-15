<?php

namespace App\Models;

class Movie
{
    private $title;
    private $rating;
    private $language;
    private $release_date;
    private $poster_path;
    

    public function __construct(
        string $title,
        float $rating,
        string $language,
        string $release_date,
        string $poster_path
        
    ) {
        $this->title = $title;
        $this->rating = $rating;
        $this->language = $language;
        $this->release_date = $release_date;
        $this->poster_path = $poster_path;
        
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getReleaseDate()
    {
        return $this->release_date;
    }

    public function getPosterUrl(): ?string
    {
        return $this->poster_path ? 'https://image.tmdb.org/t/p/w500' . $this->poster_path : null;
    }

}

class MovieDetails
{
    private int $id;
    private $title;
    private $rating;
    private $language;
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
        float $rating,
        string $language,
        string $release_date,
        ?string $overview,
        ?string $runtime,
        ?array $genres,
        ?int $budget,
        ?int $revenue,
        string $poster_path
    ) 
    {
        $this->id = $id;
        $this->title = $title;
        $this->rating = $rating;
        $this->language = $language;
        $this->release_date = $release_date;
        $this->overview = $overview ?? 'Indisponible';
        $this->runtime = (int) ($runtime ?? 0);
        $this->genres = $genres ?? [];
        $this->budget = (int) ($budget ?? 0);
        $this->revenue = (int) ($revenue ?? 0);
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
        return $this->rating;
    }

    public function getLanguage()
    {
        return $this->language;
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

    public function getPosterUrl(): ?string
    {
        return $this->poster_path ? 'https://image.tmdb.org/t/p/w500' . $this->poster_path : null;
    }
}

