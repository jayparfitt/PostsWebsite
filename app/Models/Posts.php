<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    // Enables the model to use factories, allowing for fake data
    use HasFactory;

    // Attributes to be mass assigned
    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * A relationship where Post belongs to User
     * Each post is created by one user
     * 
     * @return belongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Post can have many Comments
     * A post can hve many comments made by users
     * 
     * @return hasMany
     */
    public function comments(){
        return $this->hasMany(Comments::class, 'post_id');
    }

    /**
     * A post belongs to a module
     * Each post has one module
     * 
     * @return hasMany
     */
    public function module(){
        return $this->belongsTo(Module::class);
    }
}