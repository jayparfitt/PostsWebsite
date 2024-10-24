<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    // Enables the model to use factories, allowing for fake data
    use HasFactory;
    
    /**
     * A relationship where a Comment belongs to a post
     * 
     * @return belongsTo
     */
    public function post()
    {
        // Each comment is linked to one post through 'post_id'
        return $this->belongsTo(Posts::class, 'post_id'); 
    }
    
    /**
     * A relationship where a comment belongs to a user
     * 
     * @return belongsTo
     */
    public function user()
    {
        // Each comment linked to the user who made it
        return $this->belongsTo(User::class); 
    }
}
