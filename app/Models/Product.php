<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price',
        'category_id',  'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function images()
    {
        return $this->hasOne(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
