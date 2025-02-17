<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieDetails;
use Carbon\Carbon;

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
        $objMovies = json_decode($res);
        echo "<script>console.log(" . json_encode($objMovies) . ")</script>";
        $movies = [];
        foreach ($objMovies->results as $movie) {
            // Convertir la date de sortie en français
            $frdDate = Carbon::parse($movie->release_date)->locale('fr')->translatedFormat('d F Y');
            $movies[] = new Movie(
                $movie->id,
                $movie->title,
                $movie->vote_average,
                $movie->original_language,
                $frdDate,
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
        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/' . $id . '?language=en-US',  [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZDcxNGUzN2JlMjJjNjBkZTcyYWZiYThmMDI3ZjNhMyIsIm5iZiI6MTczODIzMzM1Ny45MzI5OTk4LCJzdWIiOiI2NzliNTYwZDA5MDJiNjllYzdmYmNhNjMiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.EATlSFwZB_ceRRxjcrUX2LL_Np_tSgcrRKV5PPLlIig',
                'accept' => 'application/json',
            ],
        ]);

        $res = $response->getBody();
        $objMovieDetails= json_decode($res);
        echo "<script>console.log(" . json_encode($objMovieDetails) . ")</script>";

        // Récupérer le synopsis, les genres et convertir la date en français 
        $responseFr = $client->request('GET', 'https://api.themoviedb.org/3/movie/' . $id . '?language=fr-FR', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZDcxNGUzN2JlMjJjNjBkZTcyYWZiYThmMDI3ZjNhMyIsIm5iZiI6MTczODIzMzM1Ny45MzI5OTk4LCJzdWIiOiI2NzliNTYwZDA5MDJiNjllYzdmYmNhNjMiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.EATlSFwZB_ceRRxjcrUX2LL_Np_tSgcrRKV5PPLlIig',
                'accept' => 'application/json',
            ],
        ]);
        $resFr = $responseFr->getBody();
        $objMovieDetailsFr = json_decode($resFr);
        echo "<script>console.log(" . json_encode($objMovieDetailsFr) . ")</script>";
        
        // Récupérer le synopsis en français
        $objFrenchOverview = $objMovieDetailsFr->overview;
        if (isset($objMovieDetails->translations->translations)) 
        {
                foreach ($objMovieDetails->translations->translations as $translation) 
                {
                    if ($translation->iso_639_1 === 'fr' && !empty($translation->data->overview)) 
                    {
                        $objFrenchOverview = $translation->data->overview;
                        break;
                    }
                }
        }

        // Récupérer les genres en français 
        $objFrenchGenres = array_map(fn($g) => $g->name, $objMovieDetailsFr->genres);

        // Convertir la date de sortie en français
        $objFrDate = Carbon::parse($objMovieDetailsFr->release_date)->locale('fr')->translatedFormat('d F Y');

        $movieDetails = new MovieDetails(
            $objMovieDetails->id,
            $objMovieDetails->title,
            $objMovieDetails->vote_average,
            $objMovieDetails->original_language,
           $objFrDate,
            $objFrenchOverview,
            $objMovieDetails->runtime,
            $objFrenchGenres,
            $objMovieDetails->budget,
            $objMovieDetails->revenue,
            $objMovieDetails->poster_path
        
        );

        
        return view('details', [
            'movieDetails' => $movieDetails,
        ]);
    }
}