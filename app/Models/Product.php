<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'product_detail',
        'category_id',
        'subcategory_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    protected static function boot()
    {
        parent::boot();

        // Listen for the "deleting" event and delete the associated image
        static::deleting(function ($product) {
            // Check if the product has an image
            if (!is_null($product->image)) {
                // Delete the image file
                \Storage::disk('product_images')->delete($product->image);
            }
        });
    }
}
