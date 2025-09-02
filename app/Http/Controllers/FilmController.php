<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{
    public function recommend(Request $request)
    {
        $genre    = $request->input('genre');
        $rating   = $request->input('rating');
        $year     = $request->input('year');
        $duration = $request->input('duration');
        $apiKey = env('TMDB_API_KEY');
        $url    = "https://api.themoviedb.org/3/discover/movie?api_key={$apiKey}&language=en-US";
        if ($genre)  $url .= "&with_genres={$genre}";
        if ($rating) $url .= "&vote_average.gte={$rating}";
        if ($year) {
            [$minYear, $maxYear] = explode('-', $year);
            $url .= "&primary_release_date.gte={$minYear}-01-01&primary_release_date.lte={$maxYear}-12-31";
        }

        $response = Http::get($url);
        $movies   = $response->json()['results'] ?? [];
        if ($duration) {
            $movies = array_filter($movies, function ($movie) use ($duration) {
                if (!isset($movie['runtime'])) return true;
                return match ($duration) {
                    'short'  => $movie['runtime'] < 90,
                    'medium' => $movie['runtime'] >= 90 && $movie['runtime'] <= 120,
                    'long'   => $movie['runtime'] > 120,
                    default  => true,
                };
            });
        }
        $imageBaseUrl = env('TMDB_IMAGE_URL');
        return view('spkrekom.index', compact('movies', 'imageBaseUrl'));
    }
}
