<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'video'
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
