<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\UserGroup;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Models\ProductDiscount;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProductAdminRequest;
use App\Http\Requests\admin\ProductEditRequest;

class ProductAdminController extends Controller
{
    private $productModel;
    private $categoryModel;
    private $productImageModel;
    private $productDiscountModel;
    private $userGroupModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Categories();
        $this->productImageModel = new ProductImages();
        $this->productDiscountModel = new ProductDiscount();
        $this->userGroupModel = new UserGroup();
    }

    public function productSearch(Request $request)
    {
        $filter_iddm = $request->input('filter_iddm');
        $filter_name = $request->input('filter_name');
        $filter_price = $request->input('filter_price');
        $filter_status = $request->input('filter_status');

        $products = $this->productModel->searchProduct($filter_iddm, $filter_name, $filter_price, $filter_status);

        return view('admin.product', compact('products', 'filter_iddm', 'filter_name', 'filter_price', 'filter_status'));
    }

    public function product()
    {
        $products = $this->productModel->productAll();
        $productDiscount = $this->productDiscountModel;
        return view('admin.product', compact('products', 'productDiscount'));
    }

    public function productAdd(ProductAdminRequest $request)
    {

        if ($request->isMethod('post')) {
            $product = new Product();
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->view = $request->view;
            $product->outstanding = $request->outstanding;
            $product->save();

            if ($request->file('image')) {
                // lấy ảnh gửi lên
                $image = $request->file('image');
                // Đặt tên cho file bằng id của sản phẩm
                $imageName = "{$product->id}" . uniqid() . "{$image->getClientOriginalExtension()}";

                // Di chuyển ảnh vào thư mục IMG
                $image->move(public_path('img/'), $imageName);
                // gán biến cho thuộc tính $product để lưu vào DB
                $product->image = $imageName;
            }

            // Thêm nhiều ảnh con của sản phẩm
            if ($request->file('images')) {
                $images = $request->file('images');
                foreach ($images as $index => $image) {
                    $productImages = new ProductImages();
                    $imageName = "{$productImages->id}" . uniqid() . "{$image->getClientOriginalExtension()}";
                    $image->move(public_path('img/'), $imageName);
                    $productImages->images = $imageName;
                    $productImages->product_id = $product->id;
                    $productImages->save();
                }
            }
            $product->save();

            // Thêm và chỉnh sửa giá giảm của sản phẩm
            $this->productDiscount($request, $product);

            return redirect()->route('product')->with('success', 'Thêm sản phẩm thành công');
        }

        $categories = $this->categoryModel->categoryAll();
        $userGroups = $this->userGroupModel->userGroupAll();
        return view('admin.productAdd', compact('categories', 'userGroups'));
    }

    public function productEdit($id)
    {
        $product = $this->productModel->findOrFail($id);
        $productImages = $this->productImageModel->productImages($id);
        $productDiscount = $this->productDiscountModel->productDiscountById($id);
        $userGroups = $this->userGroupModel->userGroupAll();
        return view('admin.productEdit', compact('product', 'productImages', 'userGroups', 'productDiscount'));
    }

    public function productUpdate(ProductEditRequest $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->view = $request->view;
        $product->outstanding = $request->outstanding;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = "{$product->id}.{$image->getClientOriginalExtension()}";
            $image->move(public_path('img/'), $imageName);
            $product->image = $imageName;
        }

        // Thêm và chỉnh sửa nhiều ảnh con của sản phẩm
        if ($request->file('images')) {
            $images = $request->file('images');
            foreach ($images as $index => $image) {
                $productImages = new ProductImages();
                $imageName = "{$productImages->id}" . uniqid() . "{$image->getClientOriginalExtension()}";
                $image->move(public_path('img/'), $imageName);
                $productImages->images = $imageName;
                $productImages->product_id = $product->id;
                $productImages->save();
            }
        }
        // Thêm và chỉnh sửa giá giảm của sản phẩm
        $this->productDiscount($request, $product);

        $product->save();
        return redirect()->route('product')->with('success', 'Câp nhật sản phẩm thành công');
    }

    public function productDiscount($request, $product)
    {
        //  $product->productDiscount()->delete();
        if ($request->has('user_group_id')) {

            $userGroup = $request->user_group_id;
            $prices =  $request->priceUserGroup;
            foreach ($userGroup as $key => $userGroupId) {
                // Kiểm tra xem giảm giá cho nhóm người dùng đã tồn tại chưa
                $productDiscounts = $this->productDiscountModel->productDiscount($product->id, $userGroupId);
                if ($productDiscounts) {
                    // Nếu đã tồn tại, cập nhật giá
                    $productDiscounts->price = $prices[$key];
                    $productDiscounts->save();
                } else {
                    // Kiểm tra xem nhóm người dùng đã tồn tại trong cơ sở dữ liệu chưa
                    $existsUserGroup = $this->productDiscountModel->where('product_id', $product->id)->where('user_group_id', $userGroupId)->first();
                    if ($existsUserGroup) {
                        // Nếu đã tồn tại, thông báo lỗi và không tạo mới
                        return redirect()->back()->with('error', 'Đã tồn tại nhóm khách hạng này.');
                    } else {
                        // Tạo mới giảm giá cho nhóm người dùng
                        $productDiscount = new ProductDiscount();
                        $productDiscount->user_group_id = $userGroupId;
                        $productDiscount->product_id = $product->id;
                        $productDiscount->price = $prices[$key];
                        $productDiscount->save();
                    }
                }
            }
        }
    }


    public function productUpdateOutstanding(Request $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->outstanding = $request->outstanding;
        $product->save();
        return response()->json(['success' => true]);
    }

    public function productUpdateStatus(Request $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => true]);
    }

    public function productDeleteCheckbox(Request $request)
    {
        $product_id = $request->input('product_id');
        if ($product_id) {
            foreach ($product_id as $itemID) {
                $product = $this->productModel->findOrFail($itemID);
                $this->productDiscountModel->where('product_id', $itemID)->delete();
                $this->productImageModel->where('product_id', $itemID)->delete();
                $product->delete();
            }
            return redirect()->route('product')->with('success', 'Xóa sản phẩm thành công');
        }
    }

    public function productDeleteImages($id)
    {
        $productImages = $this->productImageModel->findOrFail($id);
        $productImages->delete();
        return redirect()->back()->with('success', 'Xóa ảnh thành công');
    }

    public function productDeleteDiscount($id)
    {
        $productDiscount = $this->productDiscountModel->findOrFail($id);
        $productDiscount->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
