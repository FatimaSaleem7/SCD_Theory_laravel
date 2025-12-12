<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'image',
    ];

    // One medicine has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
