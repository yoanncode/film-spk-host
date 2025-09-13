<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; // <-- WAJIB biar Cache bisa dipakai

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

        // Ambil daftar film dari API TMDB (runtime belum ada di sini)
        $response = Http::get("$baseUrl/discover/movie", [
            'api_key'        => $apiKey,
            'with_genres'    => $genre,
            'vote_average.gte' => $rating,
            'sort_by'        => 'popularity.desc',
        ]);

        $movies = $response->json()['results'] ?? [];

        // Batasi jumlah film agar tidak terlalu banyak request detail
        $movies = array_slice($movies, 0, 12);

        // Ambil detail runtime tiap film
        $movies = array_map(function ($movie) use ($apiKey, $baseUrl, $imageUrl) {
            $detail = Cache::remember("movie_detail_{$movie['id']}", 3600, function () use ($apiKey, $baseUrl, $movie) {
                $detailResponse = Http::get("$baseUrl/movie/{$movie['id']}", [
                    'api_key' => $apiKey,
                ]);

                return $detailResponse->successful() ? $detailResponse->json() : [];
            });

            // Tambahkan runtime & poster URL
            $movie['runtime'] = $detail['runtime'] ?? null;
            $movie['poster_path'] = $movie['poster_path']
                ? $imageUrl . '/w500' . $movie['poster_path']
                : null;

            return $movie;
        }, $movies);

        // Filter berdasarkan durasi
        if ($duration) {
            $movies = array_filter($movies, function ($movie) use ($duration) {
                // Kalau runtime kosong/null → tetap tampil
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
