<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\UserGroup;
use App\Models\Categories;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Models\ProductDiscount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MyAccountController extends Controller
{
    private $productModel;
    private $categoryModel;
    private $productImageModel;
    private $productDiscountModel;
    private $userModel;
    private $userGroupModel;
    private $orderModel;
    private $orderProductModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Categories();
        $this->productImageModel = new ProductImages();
        $this->productDiscountModel = new ProductDiscount();
        $this->userModel = new User();
        $this->userGroupModel = new UserGroup();
        $this->orderModel = new Order();
        $this->orderProductModel = new OrderProduct();
    }

    public function member()
    {

        return view('myaccount.member');
    }

    public function memberForm(MemberRequest $request, $id)
    {
        // Fetch data from API
        $response = Http::get('https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json');
        $dataFetch = $response->json();
        $provinceName = '';
        $districtName = '';
        $wardName = '';

        //Lặp qua dữ liệu để lấy tên tỉnh
        foreach ($dataFetch as $data) {

            if ($data['Id'] == $request->province) {

                $provinceName = $data['Name'];

                // Lặp qua các huyện trong tỉnh để lấy tên huyện
                foreach ($data['Districts'] as $district) {

                    if ($district['Id'] == $request->district) {
                        $districtName = $district['Name'];

                        // Đi qua các phường của quận để lấy tên phường
                        foreach ($district['Wards'] as $ward) {

                            if ($ward['Id'] == $request->ward) {
                                $wardName = $ward['Name'];
                                break;
                            }
                        }
                        break;
                    }
                }
                break;
            }
        }


        $user = $this->userModel->findOrFail($id);
        // Truyền đối tượng người dùng vào request
        $user->fullname = $request->fullname;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->province = $provinceName ?: $request->province; // toán tử elvis kiểm tra xem  (không rỗng, không phải null, không phải false)
        $user->district =  $districtName ?: $request->district;
        $user->ward = $wardName ?: $request->ward;
        $user->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = "{$user->id}.{$image->getClientOriginalExtension()}";
            $image->move(public_path('img/'), $imageName);
            $user->image = $imageName;
            $user->save();
        }
        session()->put('user', $user);

        return redirect()->route('member');
    }

    public function purchase()
    {
        return $this->getProductOrder(4);
    }

    // đơn hàng đang chờ xác nhận
    public function pendingPurchase()
    {
        return $this->getProductOrder(1);
    }

    // đơn hàng đã xác nhận
    public function waitConfirmation()
    {
        return $this->getProductOrder(2);
    }

    // đơn hàng đang được vận chuyển
    public function shipping()
    {
        return $this->getProductOrder(3);
    }

    // đơn hàng đã hủy
    public function cancel()
    {
        return $this->getProductOrder(5);
    }

    public function cancelConfirmation(Request $request, $id)
    {
        $order =  $this->orderModel->findOrFail($id);
        $order->status = 5;
        $order->save();
        return redirect()->back();
    }

    public function getProductOrder($status)
    {
        $user_id = Auth::user()->id;
        $orderUser = $this->orderModel->orderUser($user_id, $status);
        $orderProductUser = [];
        // foreach ra
        if ($orderUser) {
            foreach ($orderUser as $item) {
                // lấy id của bảng order
                $orderProductUser[$item->id] = $this->orderProductModel->orderProductUser($item->id)->load('product'); //Eager Loading để giảm số lượng truy vấn đến cơ sở dữ liệu, tải sẵn các sản phẩm liên quan đến đơn hàng.
            }
        }

        $view = $this->viewMyaacountStatus($status);
        return view($view, compact('orderUser', 'orderProductUser'));
    }

    public function viewMyaacountStatus($status)
    {
        switch ($status) {
            case '1':
                return 'myaccount.pendingPurchase';
                break;
            case '2':
                return 'myaccount.waitConfirmation';
                break;
            case '3':
                return 'myaccount.shipping';
                break;
            case '4':
                return 'myaccount.purchase';
                break;
            case '5':
                return 'myaccount.cancel';
                break;

            default:
                # code...
                break;
        }
    }

    // thông tin chi tiết của 1 đơn hàng
    public function inforPurchase($id)
    {
        $order = $this->orderModel->findOrFail($id);
        return view('myaccount.informationPurchase', compact('order'));
    }

    public function forgetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $passwordOld = $request->input('password_old');
            $newPassword = $request->input('password');
            $confirmPassword = $request->input('password_confirmation');
            $checkPassword = $this->userModel->checkPassword($passwordOld);
            $user = auth()->user();
            if ($user && $checkPassword) {
                if ($newPassword === $confirmPassword) {
                    $user->password = bcrypt($newPassword);
                    $user->save();
                    return redirect()->back()->with('success', 'Thay đổi mật khẩu thành công.');
                } else {
                    return redirect()->back()->with('errorConfirmation', 'Xác nhận mật khẩu không khớp!');
                }
            } else {
                return redirect()->back()->with('error', 'Mật khẩu không chính xác!');
            }
        }


        return view('myaccount.password');
    }
}