<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Films populaires</title>



</head>
<body>

    <h1>🎬 Films du moment</h1>

    <div class="movies-container">
        @foreach ($movies as $movie)
            <div class="movie-card">
               <a href="{{ url('/movies/'. $movie->id) }}">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie->getPosterUrl() }}">
                </a>
                <div class="movie-info">
                    <h3>{{ $movie->getTitle()}}</h3>
                    <p>⭐ Note : {{ number_format($movie->getRating(), 1)}}/10</p>
                    <p>🗓️ Sortie : {{ $movie->getReleaseDate() }}</p>
                    <p>🌍 Langue : {{strtoupper($movie->getLanguage())}}</p>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
