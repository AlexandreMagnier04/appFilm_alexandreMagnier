<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieDetails;

class MovieController
{
    public function index()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/now_playing?language=en-US&page=1', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZDcxNGUzN2JlMjJjNjBkZTcyYWZiYThmMDI3ZjNhMyIsIm5iZiI6MTczODIzMzM1Ny45MzI5OTk4LCJzdWIiOiI2NzliNTYwZDA5MDJiNjllYzdmYmNhNjMiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.EATlSFwZB_ceRRxjcrUX2LL_Np_tSgcrRKV5PPLlIig',
                'accept' => 'application/json',
            ]
        ]);

        $res = $response->getBody();
        $obj = json_decode($res);
        echo "<script>console.log(" . json_encode($obj) . ")</script>";
        $movies = [];
        foreach ($obj->results as $movie) {
            $movies[] = new Movie(
                $movie->title,
                $movie->vote_average,
                $movie->original_language,
                $movie->release_date,
                $movie->poster_path
        
            );
        }

        return view('movies', [
            'movies' => $movies,
        ]);
    }


    public function movieDetails($id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/' . $id . '?language=en-US', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZDcxNGUzN2JlMjJjNjBkZTcyYWZiYThmMDI3ZjNhMyIsIm5iZiI6MTczODIzMzM1Ny45MzI5OTk4LCJzdWIiOiI2NzliNTYwZDA5MDJiNjllYzdmYmNhNjMiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.EATlSFwZB_ceRRxjcrUX2LL_Np_tSgcrRKV5PPLlIig',
                'accept' => 'application/json',
            ],
        ]);

        echo "<script>console.log(".$response->getBody().")</script>";
        return $response->getBody();

        $moviesDetails = new MovieDetails(
            $movie->id,
            $movie->title,
            $movie->rating,
            $movie->language,
            $movie->release_date,
            $movie->overview,
            $movie->runtime,
            $movie->genres,
            $movie->budget,
            $movie->revenue,
            $movie->poster_path
        );
        
        return view('details', [
            'moviesDetails' => $moviesDetails,
        ]);
    }

    

}
