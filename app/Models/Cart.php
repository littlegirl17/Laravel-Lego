<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getallcart($user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('id', 'desc')->get();
    }

    public function countCart($user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

    public function statisticalCarts()
    {
        return $this->join('products', 'carts.product_id', '=', 'products.id')
            ->selectRaw('carts.product_id,products.name as product_name, count(carts.product_id) as cart_count')
            ->groupBy('carts.product_id')
            ->orderBy('cart_count', 'desc')
            ->limit(8)
            ->get();
    }
}
