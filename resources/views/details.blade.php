@extends('layouts.app')

@section('content')
    <div class="movie-details">
        <h1>{{ $movieDetails->getTitle() }}</h1>

        @if ($movieDetails->getPosterUrl())
            <img src="{{ $movieDetails->getPosterUrl() }}" alt="Affiche de {{ $movieDetails->getTitle() }}">
        @else
            <p>Aucune affiche disponible</p>
        @endif

        <p><strong>Note :</strong> {{ $movieDetails->getRating() }}/10</p>
        <p><strong>Langue :</strong> {{ strtoupper($movieDetails->getLanguage()) }}</p>
        <p><strong>Date de sortie :</strong> {{ $movieDetails->getReleaseDate() }}</p>
        <p><strong>Synopsis :</strong> {{ $movieDetails->getOverview() }}</p>
        <p><strong>Durée :</strong> {{ $movieDetails->getRuntime() }} min</p>
        <p><strong>Genres :</strong> {{ implode(', ', $movieDetails->getGenre()) }}</p>
        <p><strong>Budget :</strong> {{ number_format($movieDetails->getBudget(), 0, ',', ' ') }} $</p>
        <p><strong>Recettes :</strong> {{ number_format($movieDetails->getRevenue(), 0, ',', ' ') }} $</p>

        <a href="{{ url('/movies') }}" class="back-button">⬅ Retour aux films</a>
    </div>
@endsection