<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

$portfolioHandler = function () {

    $repos = Cache::remember('github_repos_sothpichpanha', now()->addMinutes(15), function () {
        try {
            $response = Http::timeout(8)->withHeaders([
                'Accept'     => 'application/vnd.github.v3+json',
                'User-Agent' => 'SothPichPanha-Portfolio/1.0',
            ])->get('https://api.github.com/users/SothPichPanha/repos', [
                'per_page' => 100,
                'sort'     => 'updated',
            ]);
        } catch (\Throwable $e) {
            return [];
        }

        if ($response->failed()) {
            return [];
        }

        return collect($response->json())
            ->filter(fn($repo) => !$repo['fork'])
            ->map(fn($repo) => [
                'name'        => $repo['name'],
                'description' => $repo['description'] ?? 'No description provided.',
                'language'    => $repo['language'] ?? 'Unknown',
                'stars'       => $repo['stargazers_count'] ?? 0,
                'forks'       => $repo['forks_count'] ?? 0,
                'url'         => $repo['html_url'],
                'updated_at'  => $repo['updated_at'],
                'topics'      => $repo['topics'] ?? [],
            ])
            ->sortByDesc('stars')
            ->values()
            ->toArray();
    });

    $languages = collect($repos)
        ->pluck('language')
        ->filter()
        ->unique()
        ->sort()
        ->values()
        ->toArray();

    return view('portfolio', compact('repos', 'languages'));
};

Route::get('/', $portfolioHandler);
Route::get('/me', $portfolioHandler);