<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryArticleEditRequest;
use App\Http\Requests\admin\CategoryArticleRequest;
use App\Models\CategoryArticle;
use App\Models\Article;
use Illuminate\Http\Request;
use Schema;
// use App\Models\CategoryArticle;
class CategoryArticleAdminController extends Controller
{
    private $categoryArticleModel;

    public function __construct()
    {
        $this->categoryArticleModel = new CategoryArticle();
    }

    public function categoryArticle(Request $request)
    {
        $query = CategoryArticle::query(); // Khởi tạo query


        // Lọc theo tên
        if ($request->has('filter_name') && $request->filter_name !== '') {
            $query->where('title', 'like', '%' . $request->filter_name . '%');
        }

        // Lọc theo trạng thái
        if ($request->has('filter_status') && $request->filter_status !== '') {
            $query->where('status', $request->filter_status);
        }
        // Lấy danh sách danh mục
        $CA = $query->orderBy('id', 'desc')->paginate(8);

        return view('admin.categoryArticle', compact('CA'));
    }
    public function categoryArticleAdd(CategoryArticleRequest $request)
    {
        if ($request->isMethod('post')) {

            // Thêm mới bài viết
            $categoryArticle = new CategoryArticle();
            $categoryArticle->title = $request->title;
            $categoryArticle->description_short = $request->description_short;
            $categoryArticle->description = $request->description;
            $categoryArticle->status = $request->status;

            // Kiểm tra xem có file ảnh hay không
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$categoryArticle->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $categoryArticle->image = $imageName;

                $categoryArticle->save();
            }

            // Lưu bài viết
            $categoryArticle->save();

            return redirect()->route('categoryArticle')->with('success', 'Bài viết đã được thêm thành công!');
        }

        // Hiển thị form khi là GET request
        return view('admin.categoryArticleAdd');
    }


    public function categoryArticleEdit(CategoryArticleEditRequest $request, $id)
    {
        // Tìm danh mục theo ID
        $categoryArticle = CategoryArticle::findOrFail($id);

        if ($request->isMethod('put')) {
            $categoryArticle->title = $request->title;
            $categoryArticle->description_short = $request->description_short;
            $categoryArticle->description = $request->description;
            $categoryArticle->status = $request->status;

            // Xử lý hình ảnh nếu có
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$categoryArticle->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $categoryArticle->image = $imageName;

                $categoryArticle->save();
            }
            // Cập nhật danh mục
            $categoryArticle->save();

            return redirect()->route('categoryArticle')->with('success', 'Cập nhật thành công!');
        }

        // Trả về view với biến đã được định nghĩa
        return view('admin.categoryArticleEdit', ['categoryArticle' => $categoryArticle]);
    }



    public function bulkDelete(Request $request)
    {
        $request->validate([
            'category_ids' => 'required|array',
        ]);

        // Kiểm tra từng danh mục trong mảng category_ids
        foreach ($request->category_ids as $id) {
            $articleCount = Article::where('categoryArticle_id', $id)->count();
            if ($articleCount > 0) {
                return redirect()->route('categoryArticle')->with('error', 'Không thể xóa danh mục có ID ' . $id . ' vì còn bài viết liên quan.');
            }
        }

        // Nếu không có bài viết liên quan, tiến hành xóa
        CategoryArticle::destroy($request->category_ids);

        return redirect()->route('categoryArticle')->with('success', 'Danh mục đã được xóa thành công!');
    }

    public function updateStatus(Request $request, $id)
    {
        $category = CategoryArticle::findOrFail($id);
        $category->status = $request->status;
        $category->save();

        return response()->json(['success' => true]);
    }





    public function categoryArticleUpdate() {}
}
