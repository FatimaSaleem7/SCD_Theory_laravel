<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'reviewer_name',
        'content',
        'rating',
    ];

    // Relationship: review belongs to one medicine
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
