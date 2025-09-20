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
            $rating   = $request->input('rating');
            $year     = $request->input('year');
            $language = $request->input('language'); 

            $queryParams = [
                'api_key'          => $apiKey,
                'with_genres'      => $genre,
                'vote_average.gte' => $rating,
                'sort_by'          => 'popularity.desc',
            ];

            if ($year) {
                $yearRange = explode('-', $year);
                if (count($yearRange) == 2) {
                    $queryParams['primary_release_date.gte'] = $yearRange[0] . "-01-01";
                    $queryParams['primary_release_date.lte'] = $yearRange[1] . "-12-31";
                }
            }

            if ($language) {
                $queryParams['with_original_language'] = $language;
            }

            $response = Http::get("https://api.themoviedb.org/3/discover/movie", $queryParams);

            if ($response->failed()) {
                throw new Exception('TMDB API error: ' . $response->status());
            }

            $movies = $response->json()['results'] ?? [];

            $movies = array_map(function ($movie) use ($apiKey, $imageUrl) {
                $detail = Http::get("https://api.themoviedb.org/3/movie/{$movie['id']}", [
                    'api_key' => $apiKey,
                ]);

                $detailJson = $detail->json();

                $movie['poster_path'] = $movie['poster_path']
                    ? $imageUrl . '/w500' . $movie['poster_path']
                    : null;

                return $movie;
            }, $movies);

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
