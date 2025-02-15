<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Films Populaires</title>
</head>
<body>

    <h1>🎬 Films Populaires</h1>

    <div class="movies-container">
        @foreach ($movies as $movie)
            <div class="movie-card">
                <h2>{{ $movie->getTitle() }}</h2>
                
                @if ($movie->getPosterUrl())
                    <img src="{{ $movie->getPosterUrl() }}" alt="Affiche de {{ $movie->getTitle() }}">
                @else
                    <p>Aucune affiche disponible</p>
                @endif
                
                <p><strong>Note :</strong> ⭐ {{ $movie->getRating() }}/10</p>
                <p><strong>Langue :</strong> {{ strtoupper($movie->getLanguage()) }}</p>
                <p><strong>Date de sortie :</strong> {{ $movie->getReleaseDate() }}</p>

                <!-- Bouton pour voir les détails -->
                <a href="{{ url('/movie/' . $movie->getTitle()) }}" class="details-button">Voir les détails</a>
            </div>
        @endforeach
    </div>

</body>
</html>
