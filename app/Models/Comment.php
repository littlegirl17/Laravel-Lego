<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'content',
        'rating',
    ];

    public function commentImages()
    {
        return $this->hasMany(CommentImages::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productReview($detail)
    {
        return $this->where('product_id', $detail->id)->paginate(4);
    }



    public function productCountReview($detail)
    {
        return $this->where('product_id', $detail->id)->count();
    }

    public function commentAll()
    {
        return $this->orderBy('id', 'desc')->paginate(8);
    }

    public function searchComment($filter_name, $filter_rating, $filter_status)
    {
        $query = $this->query();
        if (!is_null($filter_name)) {
            $query->where('product_id', '=', (int)$filter_name);
        }

        if (!is_null($filter_rating)) {
            $query->where('rating', '=', (int)$filter_rating);
        }

        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }

        return $query->paginate(10);
    }

    public function commentBuildImage()
    {
        return $this->orderBy('id', 'desc')->inRandomOrder()->limit(4)->get();
    }

    public function inspirationBuildImage()
    {
        return $this->orderBy('id', 'desc')->inRandomOrder()->get();
    }
}
