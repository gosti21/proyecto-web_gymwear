<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Variant extends Model
{   

    use HasFactory;

    protected $fillable = [
        'sku',
        'image_path',
        'product_id'
    ];

    //Relacion de uno a muchos inversa
     public function products(){
        return $this->belongsTo(Product::class);
    }

    //Relacion de muchos a muchos
    public function features(){
        return $this->belongsToMany(Feature::class)
                    ->withPivot('value')
                    ->withTimestamps();
    }
}
