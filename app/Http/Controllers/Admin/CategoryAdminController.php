<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryEditRequest;
use App\Http\Requests\admin\CategoryRequest;

class CategoryAdminController extends Controller
{
    private $categoryModel;
    private $productModel;

    public function __construct()
    {
        $this->categoryModel = new Categories();
        $this->productModel = new Product();
    }

    public function category()
    {
        $categoriAdmin = Categories::with(['categories_children', 'categories_children.product'])
            ->whereNull('parent_id')
            ->paginate(8);
        // Khởi tạo các biến để tránh lỗi Undefined variable
        $filter_name = '';
        $filter_category_id = '';
        return view('admin.category', compact('categoriAdmin', 'filter_name', 'filter_category_id'));
    }

    public function categoryEdit($id)
    {
        $category = $this->categoryModel->findOrFail($id);
        $categoryNull = Categories::with(['categories_children', 'categories_children.product'])->whereNull('parent_id')->get();
        return view('admin.categoryEdit', compact('category', 'categoryNull'));
    }


    public function categoryUpdate(CategoryEditRequest $request, $id)
    {
        if ($request->isMethod('PUT')) {

            $category = $this->categoryModel->findOrFail($id);
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->sort_order = $request->sort_order;
            $category->status = $request->status;
            $category->parent_id = $request->parent_id;
            $category->description = $request->description;
            $category->choose = $request->choose;
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$category->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $category->image = $imageName;

                $category->save();
            }

            $category->save();

            return redirect()->route('category')->with('success', 'Cập nhật danh mục thành công.');
        }
        return view('admin.categoryEdit');
    }

    public function categoryAdd(CategoryRequest $request)
    {
        if ($request->isMethod('POST')) {
            $category = new Categories();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->sort_order = $request->sort_order;
            $category->status = $request->status;
            $category->parent_id = $request->parent_id;
            $category->description = $request->description;
            $category->choose = $request->choose ?: 0;
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$category->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $category->image = $imageName;

                $category->save();
            }

            $category->save();

            return redirect()->route('category')->with('success', 'Thêm danh mục thành công.');
        }
        $categoryNull = Categories::with(['categories_children', 'categories_children.product'])->whereNull('parent_id')->get();
        return view('admin.categoryAdd', compact('categoryNull'));
    }

    public function categoryUpdateStatus(Request $request, $id)
    {
        $category = $this->categoryModel->findOrFail($id);
        $category->status = $request->status;
        $category->save();
        return response()->json(['success' => true]);
    }

    public function categoryDeleteCheckbox(Request $request)
    {
        $category_id = $request->input('category_id');
        if ($category_id) {
            foreach ($category_id as $itemID) {
                $category = $this->categoryModel->findOrFail($itemID);
                $countProduct = $this->productModel->countProduct($itemID);
                if ($countProduct > 0) {
                    return redirect()->route('employee')->with('error', ' Cảnh báo: Danh mục này không thể xóa vì nó hiện được chỉ định cho ' . $countProduct . ' sản phẩm lắp ráp!');
                } else {
                    $category->delete();
                }
            }
            return redirect()->route('category')->with('success', 'Xóa danh mục thành công.');
        }
    }

    public function categorySearch(Request $request)
    {

        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');
        $filter_category_id = $request->input('filter_category_id');

        $filter_status = $request->input('filter_status');

        $categoriAdmin = $this->categoryModel->searchCategory($filter_name, $filter_category_id, $filter_status);

        return view('admin.category', compact('categoriAdmin', 'filter_name', 'filter_category_id'));
    }
}
