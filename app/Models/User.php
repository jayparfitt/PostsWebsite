<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Enables the model to use factories, allowing for fake data
    use HasFactory;

    /**
     * A relationship where a User can have many Posts
     * 
     * @return hasMany
     */
    public function posts(){
        return $this->hasMany(Posts::class);
    }

    /**
     * A relationship where a User can have many Comments
     * 
     * @return hasMany
     */
    public function comments(){
        return $this->hasMany(Comments::class);
    }
}
