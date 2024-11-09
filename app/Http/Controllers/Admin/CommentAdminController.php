<?php

namespace App\Http\Controllers\admin;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Models\CommentImages;
use App\Http\Controllers\Controller;

class CommentAdminController extends Controller
{


    private $productModel;
    private $commentModel;
    private $commentImageModel;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->commentModel = new Comment();
        $this->commentImageModel = new CommentImages();
    }

    public function comment()
    {
        $comments =  $this->commentModel->commentAll();
        $products = $this->productModel->productFavouriteAll();
        $filter_name = '';
        $filter_rating = '';
        return view('admin.comment', compact('comments', 'products', 'filter_name', 'filter_rating'));
    }

    public function commentUpdateStatus(Request $request, $id)
    {
        $comment = $this->commentModel->findOrFail($id);
        $comment->status = $request->status;
        $comment->save();
        return response()->json(['success' => true]);
    }

    public function commentSearch(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');
        $filter_rating = $request->input('filter_rating');

        $filter_status = $request->input('filter_status');

        $comments = $this->commentModel->searchComment($filter_name, $filter_rating, $filter_status);
        $products = $this->productModel->productFavouriteAll();
        return view('admin.comment', compact('products', 'comments', 'filter_name', 'filter_rating'));
    }

    public function commentDetail($id)
    {
        $comment =  $this->commentModel->findOrFail($id);
        $commentImageAdmin = $this->commentImageModel->commentImageAdminId($comment->id);
        return view('admin.commentDetail', compact('comment', 'commentImageAdmin'));
    }
}
