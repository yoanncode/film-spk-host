<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class FilmController extends Controller
{
    public function recommend(Request $request)
    {
        try {
            $apiKey   = env('TMDB_API_KEY');
            $imageUrl = env('TMDB_IMAGE_URL');
            $genre    = $request->input('genre');
            $duration = $request->input('duration');
            $rating   = $request->input('rating');

            $response = Http::get("https://api.themoviedb.org/3/discover/movie", [
                'api_key'          => $apiKey,
                'with_genres'      => $genre,
                'vote_average.gte' => $rating,
                'sort_by'          => 'popularity.desc',
            ]);

            if ($response->failed()) {
                throw new Exception('TMDB API error: ' . $response->status());
            }

            $movies = $response->json()['results'] ?? [];

            $movies = array_map(function ($movie) use ($apiKey, $imageUrl) {
                $detail = Http::get("https://api.themoviedb.org/3/movie/{$movie['id']}", [
                    'api_key' => $apiKey,
                ]);

                $detailJson = $detail->json();

                $movie['runtime'] = $detailJson['runtime'] ?? null;
                $movie['poster_path'] = $movie['poster_path']
                    ? $imageUrl . '/w500' . $movie['poster_path']
                    : null;

                return $movie;
            }, $movies);

            if ($duration) {
                $movies = array_filter($movies, function ($movie) use ($duration) {
                    if (!isset($movie['runtime']) || $movie['runtime'] === null) return false;

                    return match ($duration) {
                        'short'  => $movie['runtime'] < 90,
                        'medium' => $movie['runtime'] >= 90 && $movie['runtime'] <= 120,
                        'long'   => $movie['runtime'] > 120,
                        default  => true,
                    };
                });
            }

            return view('spkrekom.index', [
                'movies' => $movies,
                'imageBaseUrl' => $imageUrl,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Something went wrong',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
