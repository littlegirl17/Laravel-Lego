<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'images'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productImages($product_id)
    {
        return $this->where('product_id', $product_id)->get();
    }
}
