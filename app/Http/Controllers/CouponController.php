<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    private $couponModel;
    private $cartModel;
    private $productModel;

    public function __construct()
    {
        $this->couponModel = new Coupon();
        $this->cartModel = new Cart();
        $this->productModel = new Product();
    }

    public function couponApply(Request $request)
    {
        $code = $request->input('code');
        $couponCheck = $this->couponModel->couponCheckCode($code);

        if ($couponCheck) {


            $currentDate = now(); // time hiện tại
            // lt và gt: phương thức so sánh ngày có sẵn trong Carbon
            if ($currentDate->lt($couponCheck->date_start) || $currentDate->gt($couponCheck->date_end)) { // lt (less than): Kiểm tra xem thời gian hiện tại có nhỏ hơn thời gian bắt đầu hay không. // gt (greater than): Kiểm tra xem thời gian hiện tại có lớn hơn thời gian kết thúc hay không.
                return redirect()->back()->with('error', 'Mã giảm giá không còn hiệu lực!');
            }

            // kiểm tra giỏ hàng có sản phẩm để áp mã coupon hay không
            $cart = [];
            if (Auth::check()) {
                $user = Auth::check() ? Auth::user()->id : 0;
                $cart = $this->cartModel->getallcart($user);
            } else {
                $cart = json_decode(request()->cookie('cart'), true) ?? [];
            }

            if (empty($cart) && count($cart) == 0) {
                return redirect()->back()->with('error', 'Không có sản phẩm để áp dụng mã giảm giá!');
            }

            // Tính tổng tiền của giỏ hàng xem có đủ điều kiện để áp mã coupon hay không
            $total = 0;
            $intoMoney = 0;
            $price = 0;
            foreach ($cart as $item) {
                $product = $this->productModel->where('id', $item['product_id'])->first();
                $price = $product->price;
                $user = auth()->user();
                if ($user && Auth::check()) {
                    $userGroupId = $user->user_group_id;
                    $userGroupDiscount = $product->productDiscount->where('user_group_id', $userGroupId)->first();
                    if ($userGroupDiscount) {
                        $price = $userGroupDiscount->price;
                    }
                } else {
                    $userGroupDefaultDiscount = $product->productDiscount->where('user_group_id', 1)->first();
                    if ($userGroupDefaultDiscount) {
                        $price = $userGroupDefaultDiscount->price;
                    }
                }
                $intoMoney = $price * $item['quantity'];
                $total += $intoMoney;
            }

            if ($total >= $couponCheck->total) {
                $coupon[] = array(
                    'code' => $couponCheck->code,
                    'type' => $couponCheck->type,
                    'total' => $couponCheck->total,
                    'discount' => $couponCheck->discount,
                );
                Session::put('coupon', $coupon);
                return redirect()->back()->with('success', 'Thêm mã giảm giá thành công');
            } else {
                return redirect()->back()->with('error', 'Tổng giá trị đơn hàng không đủ để áp dụng mã giảm giá này!');
            }

            // Kiểm tra mã giảm giá nhập vào có hợp lệ hay không
            if ($total >= $couponCheck->total) {
                $coupon[] = array(
                    'code' => $couponCheck->code,
                    'type' => $couponCheck->type,
                    'total' => $couponCheck->total,
                    'discount' => $couponCheck->discount,
                );
                Session::put('coupon', $coupon);
                return redirect()->back()->with('success', 'Thêm mã giảm giá thành công');
            } else {
                return redirect()->back()->with('error', 'Tổng giá trị đơn hàng không đủ để áp dụng mã giảm giá này!');
            }
        } else {
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại!');
        }
    }

    public function couponDelete()
    {

        $coupon = Session::get('coupon');
        if ($coupon) {
            session()->forget('coupon');
            return redirect()->back()->with('success', 'Xóa mã giảm giá thành công');
        }
    }
}
