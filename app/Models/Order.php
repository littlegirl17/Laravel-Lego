<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderProduct; // Đảm bảo đường dẫn đúng
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'province',
        'district',
        'ward',
        'total',
        'payment',
        'status',
        'coupon_code',
        'note',
        'order_code'
    ];

    public function orderUser($user_id, $status = null)
    {
        $query = $this->where('user_id', $user_id);
        if (!is_null($status)) {
            $query = $query->where('status', $status);
        }
        return $query->get();
    }


    public function definePayment()
    {
        return [
            1 => 'Thanh toán bằng tiền mặt',
            2 => 'Thanh toán VNPAY',
            3 => 'Thanh toán MoMo',
        ];
    }
    public function statusOrder()
    {
        return [
            1 => 'Chờ xác nhận',
            2 => 'Đã xác nhận',
            3 => 'Đang vận chuyển',
            4 => 'Hoàn thành',
            5 => 'Đã hủy',
        ];
    }
    public function viewOrderUser($id_order)
    {
        return $this->where('id', $id_order->id)->first();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Mối quan hệ One-to-One với Assembly
    public function assembly()
    {
        return $this->hasOne(Assembly::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id'); // 'order_id' là khóa ngoại trong OrderProduct
    }

    public function countOrder($user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

    public function totalUserOrder($user_id)
    {
        return $this->where('user_id', $user_id)->sum('total');
    }

    // gọi orderProducts() trên một đơn hàng,
    // nó sẽ trả về tất cả các sản phẩm liên quan đến đơn hàng đó. Điều này giúp bạn dễ dàng lấy thông tin sản phẩm cho từng đơn hàng.
    // Mô hình Order: Đây là mô hình đại diện cho bảng đơn hàng.
    // hasMany(OrderProduct::class, 'order_id'):
    // hasMany: Nghĩa là một đơn hàng có thể có nhiều sản phẩm.
    // OrderProduct::class: Chỉ đến mô hình sản phẩm liên quan.
    // 'order_id': Là khóa ngoại trong bảng order_products, kết nối sản phẩm với đơn hàng.


    public function reportOrder() {}

    public function salesTotal()
    {
        return $this->where('status', 4)->sum('total');
    }

    public function salesTotalByDay()
    {
        return $this->where('status', 4)
            ->whereDate('created_at', Carbon::today())
            ->sum('total');
    }

    public function salesTotalByMonth()
    {
        return $this->where('status', 4)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total');
    }

    public function salesTotalByYear()
    {
        return $this->where('status', 4)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');
    }

    public function countOrderByStatus()
    {
        return $this->selectRaw('status, count(*) as countStatus')
            ->groupBy('status')
            ->pluck('countStatus', 'status');
    }

    public function countOrderByPayment()
    {
        return $this->selectRaw('payment, count(*) as countPayment')
            ->groupBy('payment')
            ->orderBy('countPayment', 'desc')
            ->pluck('countPayment', 'payment');
    }

    public function countOrderDash()
    {
        return $this->count();
    }


    public function countOrderByTime()
    {
        return $this->selectRaw('MONTH(created_at) as month, SUM(total) as total_order') // Lấy tháng từ cột created_at và đặt tên cột này là month, SUM(total) as total_order: Tính tổng doanh thu (total) cho các đơn đặt hàng trong từng tháng
            ->whereYear('created_at', Carbon::now()->year) // Lọc dữ liệu chỉ bao gồm các đơn đặt hàng trong năm hiện tại (Carbon::now()->year).
            ->groupBy(DB::raw('MONTH(created_at)')) //Nhóm các kết quả theo tháng (MONTH(created_at)) để tính tổng doanh thu cho từng tháng.
            ->orderBy('month')
            ->get();
    }

    public function countUserPotential()
    {
        return
            $this->join('users', 'orders.user_id', '=', 'users.id') // Kết nối bảng orders với bảng users thông qua user_id
            ->selectRaw('orders.user_id, COUNT(orders.user_id) as count_user, users.fullname as name_user')
            ->groupBy('orders.user_id')
            ->orderBy('count_user', 'desc')
            ->having('count_user', '>', 5)
            ->get();
    }
}
