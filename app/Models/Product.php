<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'sub_category_id',
    ];

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class)
                    ->withPivot('value')
                    ->withTimestamps();
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class)->chaperone();
    }
}
