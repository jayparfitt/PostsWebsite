<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    // attributes to allow mass assignment
    protected $fillable = ['name', 'slug'];

    /**
     * A module can have many posts
     * 
     * @return hasMany
     */
    public function posts()
    {
        return $this->hasMany(Posts::class);
    }
}
