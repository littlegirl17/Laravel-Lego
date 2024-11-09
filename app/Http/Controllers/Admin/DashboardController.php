<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Article;
use App\Models\Product;
use App\Models\Favourite;
use App\Models\UserGroup;
use App\Models\Categories;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\CategoryArticle;
use App\Models\AdministrationGroup;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    private $productModel;
    private $categoryModel;
    private $articleModel;
    private $categoryArticleModel;
    private $userModel;
    private $userGroupModel;
    private $administrationModel;
    private $administrationGroupModel;
    private $orderModel;
    private $orderProductModel;
    private $favouriteModel;
    private $cartModel;
    private $bannerModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Categories();
        $this->userModel = new User();
        $this->articleModel = new Article();
        $this->categoryArticleModel = new CategoryArticle();
        $this->userModel = new User();
        $this->userGroupModel = new UserGroup();
        $this->administrationModel = new Administration();
        $this->administrationGroupModel = new AdministrationGroup();
        $this->orderModel = new Order();
        $this->orderProductModel = new OrderProduct();
        $this->favouriteModel = new Favourite();
        $this->cartModel = new Cart();
        $this->bannerModel = new Banner();
    }
    public function dashboard(Request $request)
    {
        $countProduct = $this->productModel->countProductAll();
        $countCategory = $this->categoryModel->countCategoryAll();
        $countUserGroup = $this->userGroupModel->countUserGroupAll();
        $countUser = $this->userModel->countUserAll();
        $countArticle = $this->articleModel->countArticleAll();
        $countCategoryArticle = $this->categoryArticleModel->countCategoryArticleAll();
        $countAdministration = $this->administrationModel->countAdministrationAll();
        $countAdministrationGroup = $this->administrationGroupModel->countAdministrationGroupAll();

        $reportOrderData = $this->orderModel->reportOrder();
        $favouriteStatistical = $this->favouriteModel->statisticalFavouriteProducts();
        $cartStatistical = $this->cartModel->statisticalCarts();

        $countProductSoldoutOrder = $this->orderProductModel->countProductSoldoutOrder();
        $countUserPotential = $this->orderModel->countUserPotential();


        $salesTotal = $this->orderModel->salesTotal();
        $salesTotalByDay = $this->orderModel->salesTotalByDay();
        $salesTotalByMonth = $this->orderModel->salesTotalByMonth();
        $salesTotalByYear = $this->orderModel->salesTotalByYear();
        $countOrderByStatus = $this->orderModel->countOrderByStatus();
        $statusOrder = $this->orderModel->statusOrder(); // Danh sách trạng thái
        $countOrderDash = $this->orderModel->countOrderDash(); // Danh sách trạng thái
        $nameStatus = [];
        $dataStatus = [];

        foreach ($countOrderByStatus as $status => $count) {
            $nameStatus[] = $statusOrder[$status];
            $dataStatus[] = $count;
        }

        $definePayment = $this->orderModel->definePayment(); // Danh sách trạng thái
        $countOrderByPayment = $this->orderModel->countOrderByPayment();
        $namePayment = [];
        $dataPayment = [];

        foreach ($countOrderByPayment as $payment => $count) {
            $namePayment[] =   $definePayment[$payment];
            $dataPayment[] = $count;
        }

        // lấy danh sách doanh thu cho từng tháng.
        $countOrderByTime = $this->orderModel->countOrderByTime();
        // Đoạn này tạo mảng $revenue để chứa doanh thu cho từng tháng trong năm, với mỗi phần tử đại diện cho doanh thu của một tháng (ban đầu là 0), sau đó sẽ được cập nhật trong vòng lặp nếu có dữ liệu doanh thu tương ứng cho tháng đó.
        $revenue = array_fill(0, 12, 0); // (mảng bắt đầu bằng số 0, mảng sẽ có 12 phần tử,khởi tạo với giá trị 0)

        foreach ($countOrderByTime as $item) {
            // Đặt giá trị doanh thu vào đúng tháng
            if ($item->month >= 1 && $item->month <= 12) { // $item->month : month lấy bên model nếu lấy ra 7 là tháng 7
                $revenue[$item->month - 1] = $item->total_order; // -1 vì mảng bắt đầu  = 0; giai thích: ví dụ $data->month là 7 (tháng 7) -> 7-1 = 6 -> giá trị này đặt vào vị trí thứu 6, tương ứng là tháng 7
            }
        }


        return view('admin.dashboard', compact(
            'countUserPotential',
            'countProductSoldoutOrder',
            'revenue',
            'salesTotal',
            'salesTotalByDay',
            'salesTotalByMonth',
            'salesTotalByYear',
            'nameStatus',
            'dataStatus',
            'namePayment',
            'dataPayment',
            'countProduct',
            'countCategory',
            'countUser',
            'countArticle',
            'countCategoryArticle',
            'countUserGroup',
            'countAdministration',
            'countAdministrationGroup',
            'reportOrderData',
            'favouriteStatistical',
            'cartStatistical',
            'countOrderDash'
        ));
    }
}
