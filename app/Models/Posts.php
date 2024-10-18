<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Posts extends Model
{
/*     public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug; */

    use HasFactory, Notifiable;

/*     public function __construct($title, $excerpt, $date, $body, $slug) 
    {
        $this -> title = $title;
        $this -> excerpt = $excerpt;
        $this -> date = $date;
        $this -> body = $body;
        $this -> slug = $slug;
    }

    public static function find($slug)
    {   
        $post =  static::all() -> firstWhere('slug', $slug);

        if (! $post) {
            throw new ModelNotFoundException();
        }

        return $post;
    } */

/*     public static function all()
    {
        return collect(File::files(resource_path("posts")))
        ->map(fn($file) => YamlFrontMatter::parseFile($file))
        ->map(fn($document) => new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        ))
        ->sortByDesc('date');
    } */

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }
}