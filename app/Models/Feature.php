<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    
protected $fillable = [
        'value',
        'option_id',
        'description'

    ];

    //Relacion uno a muchos inversa
    public function option(){
    return $this->belongsTo(Option::class);
    }
    //Relacion muhcos a muchos 
    public function variants(){
        return $this->belongsToMany(Variant::class)
                    ->withTimestamps();
    }
}
