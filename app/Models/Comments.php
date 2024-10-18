<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory, Notifiable;

    public function post()
    {
        return $this->belongsTo(Posts::class); 
    }
    
    public function user()
    {
        return $this->belongsTo(User::class); 
    }
}
