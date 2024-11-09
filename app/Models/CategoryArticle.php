<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description_short',
        'description',
        'status'
    ];
    public function articles()
    {
        return $this->hasMany(Article::class, 'categoryArticle_id');
    }
    public function categoryArticle()
    {
        return $this->belongsTo(CategoryArticle::class, 'categoryArticle_id');
    }

    public function categoryArticleAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function countCategoryArticleAll()
    {
        return $this->count();
    }
}
