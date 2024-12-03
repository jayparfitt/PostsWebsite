<?php

namespace App\Http\Controllers;

use App\Services\OpenLibraryService;
use Illuminate\Http\Request;

class OpenLibraryController extends Controller
{
protected $openLibraryService;

public function __construct(OpenLibraryService $openLibraryService)
{
$this->openLibraryService = $openLibraryService;
}

/**
* Display books based on a search query.
*
* @param Request $request
* @return \Illuminate\View\View
*/
public function search(Request $request)
{
$query = $request->input('query', 'Search here'); 
$books = [];

try {
$response = $this->openLibraryService->searchBooks($query);
$books = $response['docs'] ?? [];
} catch (\Exception $e) {
return back()->withErrors('Error fetching books: ' . $e->getMessage());
}

return view('openlibrary.search', compact('books', 'query'));
}
}