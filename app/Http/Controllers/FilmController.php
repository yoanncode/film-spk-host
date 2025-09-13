<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FilmController extends Controller
{
    public function recommend(Request $request)
    {
        $apiKey   = env('TMDB_API_KEY');
        $baseUrl  = env('TMDB_BASE_URL');
        $imageUrl = env('TMDB_IMAGE_URL');

        // Ambil input dari form
        $genre    = $request->input('genre');
        $duration = $request->input('duration');
        $rating   = $request->input('rating');

        // Ambil daftar film (discover API, runtime TIDAK ada di sini)
        $response = Http::get("$baseUrl/discover/movie", [
            'api_key'        => $apiKey,
            'with_genres'    => $genre,
            'vote_average.gte' => $rating,
            'sort_by'        => 'popularity.desc',
        ]);

        $movies = $response->json()['results'] ?? [];

        // Batasi jumlah film untuk menghindari terlalu banyak request
        $movies = array_slice($movies, 0, 12);

        // Ambil detail tiap film supaya dapat runtime
        $movies = array_map(function ($movie) use ($apiKey, $baseUrl, $imageUrl) {
            // Cache runtime agar tidak request berulang ke TMDB
            $detail = Cache::remember("movie_detail_{$movie['id']}", 3600, function () use ($apiKey, $baseUrl, $movie) {
                $detailResponse = Http::get("$baseUrl/movie/{$movie['id']}", [
                    'api_key' => $apiKey,
                ]);

                return $detailResponse->successful() ? $detailResponse->json() : [];
            });

            // Tambahkan runtime & poster yang lengkap
            $movie['runtime'] = $detail['runtime'] ?? null;
            $movie['poster_path'] = $movie['poster_path']
                ? $imageUrl . '/w500' . $movie['poster_path']
                : null;

            return $movie;
        }, $movies);

        // Filter berdasarkan durasi (optional)
        if ($duration) {
            $movies = array_filter($movies, function ($movie) use ($duration) {
                // Kalau runtime null → tetap tampil
                if (!isset($movie['runtime']) || $movie['runtime'] === null) {
                    return true;
                }

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
        ]);
    }
}
