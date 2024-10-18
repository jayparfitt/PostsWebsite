<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;

    public function posts(){
        return $this->hasMany(Posts::class);
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }
}
