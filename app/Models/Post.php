<?php

namespace App\Models;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug) 
    {
        $this -> title = $title;
        $this -> excerpt = $excerpt;
        $this -> date = $date;
        $this -> body = $body;
        $this -> slug = $slug;
    }

    public static function find($slug)
{
    if (! file_exists($path = resource_path("posts/{$slug}.html"))) {
        throw new ModelNotFoundException();
    }

    $document = YamlFrontMatter::parseFile($path);

    return new Post(
        $document->title,
        $document->excerpt,
        $document->date,
        $document->body(),
        $slug 
    );
}


    public static function all()
    {
        $files =  File::files(resource_path("posts/"));

        return array_map(function ($files) {
            return $files->getContents();
        }, $files);
    }
}