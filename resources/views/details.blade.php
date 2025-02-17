<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movieDetails->getTitle() }} - Détails du film</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <h1>{{ $movieDetails->getTitle() }}</h1>
    
    <div class="align-details">
        <img src="{{ $movieDetails->getPosterUrl() }}" class="movie-poster">


        <div class="movie-details-container">
        <div class="flex-details">
            <div>
                <p><strong>Date de sortie :</strong> {{ $movieDetails->getReleaseDate() }}</p>
                <p><strong>Langue :</strong> {{ strtoupper($movieDetails->getLanguage()) }}</p>
                <p><strong>Durée :</strong> {{ $movieDetails->getRuntime() }} min</p>
                <p><strong>Genres :</strong> {{ implode(', ', $movieDetails->getGenre()) }}</p>

            </div>
            <div>
                <p><strong>Note : ⭐</strong> {{ number_format($movieDetails->getRating(), 1 )}}/10</p>
                <p><strong>Budget :</strong> {{ number_format($movieDetails->getBudget(), 0, ',', ' ') }} $</p>
                <p><strong>Recettes :</strong> {{ number_format($movieDetails->getRevenue(), 0, ',', ' ') }} $</p> 

            </div>
        </div>
       

       
        <p style="text-align:justify"><strong>Synopsis :</strong> {{ $movieDetails->getOverview() }}</p>
    </div>
    </div>
   

    <a href="{{ url('/movies/') }}" class="back-button">⬅ Retour aux films</a>

</body>
</html>