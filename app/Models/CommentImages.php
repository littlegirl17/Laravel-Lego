<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_id',
        'images',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function commentImageAdminId($detail)
    {
        return $this->where('comment_id', $detail)->get();
    }
}
