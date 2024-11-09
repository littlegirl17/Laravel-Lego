<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assembly extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'admin_id',
        'assembly_package_id',
        'quantity',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function administration()
    {
        return $this->belongsTo(Administration::class, 'admin_id');
    }

    public function assemblyPackage()
    {
        return $this->belongsTo(AssemblyPackages::class, 'assembly_package_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function assemblyAll()
    {
        return $this->orderBy('id', 'desc')->paginate(8);
    }

    public function assmblyOrderId($order_id)
    {
        return $this->where('order_id', $order_id)->first();
    }

    public function statusAssembly()
    {
        return [
            1 => 'Đơn lắp mới',
            2 => 'Đang trong quá trình lắp ráp',
            3 => 'Hoàn thành lắp ráp',
        ];
    }

    public function countAssembly($employee_id)
    {
        return $this->where('employee_id', $employee_id)->count();
    }
}
