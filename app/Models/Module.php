<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Module extends Model
{
    use HasFactory;

    // attributes to allow mass assignment
    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($module) {
            $module->slug = Str::slug($module->name);
        });
    }
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
