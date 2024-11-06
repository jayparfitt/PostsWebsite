<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Enables the model to use factories, allowing for fake data
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
    

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
