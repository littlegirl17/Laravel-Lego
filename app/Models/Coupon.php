<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_coupon',
        'code',
        'type',
        'total',
        'date_start',
        'date_end',
        'discount',
        'status'
    ];

    public function couponCheckCode($code)
    {
        return $this->where('code', $code)->where('status', 1)->first();
    }

    public function couponAll()
    {
        return $this->orderBy('id', 'desc')->paginate(8);
    }


    public function searchCoupon($filter_name, $filter_code, $filter_type, $filter_status)
    {
        $query = $this->query();

        if (!is_null($filter_code)) {
            $query->where('code', '=', (int)$filter_code);
        }

        if (!is_null($filter_name)) {
            $query->where('name_coupon', 'LIKE', "%{$filter_name}%");
        }

        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }

        if (!is_null($filter_type)) {
            $query->where('type', '=', (int)$filter_type);
        }

        return $query->paginate(10);
    }
}