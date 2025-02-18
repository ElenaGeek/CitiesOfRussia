<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'image_id',
        'description',
    ];
}
