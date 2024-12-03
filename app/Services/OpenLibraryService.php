<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenLibraryService
{
    protected $baseUrl = 'https://openlibrary.org/search.json';

    /**
     * Gets books by title or author from OpenLibrary API.
     *
     * @param string $query Search query (title or author)
     * @param array $filters Additional filters like author, year, etc.
     * @return array Parsed response from the API
     */
    public function searchBooks($query, $filters = [])
    {
        $params = array_merge(['q' => $query], $filters);

        $response = Http::get($this->baseUrl, $params);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to fetch data from OpenLibrary API: ' . $response->body());
    }
}
