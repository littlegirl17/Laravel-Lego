<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_id',
        'title',
        'image_desktop',
        'image_mobile',
        'sort_order',
        'link_tab',
        'content_button',
        'description',
        'status',
    ];

    public function bannerImageAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function banner()
    {
        return $this->belongsTo(Banner::class, 'banner_id');
    }

    public function countBannerImages($banner_id)
    {
        return $this->where('banner_id', $banner_id)->count();
    }

    public function searchBanner($filter_name, $filter_status)
    {
        $query = $this->query();
        if (!is_null($filter_name)) {
            $query->where('banner_id', $filter_name);
        }
        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }
        return $query->get();
    }
}
