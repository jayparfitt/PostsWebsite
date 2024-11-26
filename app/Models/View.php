<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'post_id', // Foreign key to the posts table
        'ip_address', // IP address of the viewer
    ];

    /**
     * Define the relationship between a View and a Post.
     */
    public function post()
    {
        return $this->belongsTo(Posts::class);
    }
}
