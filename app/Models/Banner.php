<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'position',
        'status'
    ];
    public function bannerImages()
    {
        return $this->hasMany(BannerImages::class);
    }

    public function banners()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function bannerName()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function bannerShow()
    {
        return $this->orderBy('id', 'desc')->with('bannerImages')->get();
    }
}
