<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'seasons',
        'description',
        'image',
    ];

    protected $casts = [
        'seasons' => 'array',
    ];
}
