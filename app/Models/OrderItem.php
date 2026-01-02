<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'medicine_id',
        'price',
        'quantity'
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
