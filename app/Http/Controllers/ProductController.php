<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Assembly;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Models\CommentImages;
use App\Models\AssemblyPackages;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    private $productModel;
    private $commentModel;
    private $commentImageModel;
    private $favouriteModel;
    private $assemblyModel;
    private $assemblyPackagesModel;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->commentModel = new Comment();
        $this->commentImageModel = new CommentImages();

        $this->favouriteModel = new Favourite();
        $this->assemblyModel = new Assembly();
        $this->assemblyPackagesModel = new AssemblyPackages();
    }

    public function detail($slug)
    {

        $detail = $this->productModel->whereSlug($slug)->firstOrFail();
        $productRelated = $this->productModel->productRelated($detail);
        $productReview = $this->commentModel->productReview($detail);
        $productCountReview = $this->commentModel->productCountReview($detail);
        $assemblyPackages = $this->assemblyPackagesModel->assemblyPackageAll();

        return view('detail', compact('detail', 'productRelated', 'productReview', 'productCountReview', 'assemblyPackages'));
    }

    public function commentReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'content' => 'required|string|max:500',
            'rating' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $request->product_id;
        $comment->content = $request->content;
        $comment->rating = $request->rating;
        $comment->save();

        $commentImages = []; // Khởi tạo mảng để lưu hình ảnh

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            //dd($images);
            foreach ($images as $image) {
                if ($image->isValid()) {
                    $commentImage = new CommentImages();
                    $commentImage->comment_id = $comment->id;
                    $imageName = "{$comment->id}" . uniqid() . ".{$image->getClientOriginalExtension()}";
                    $image->move(public_path('img/'), $imageName);
                    $commentImage->images = $imageName;
                    $commentImage->save(); // Lưu hình ảnh
                    $commentImages[] = $commentImage; // Thêm vào mảng commentImages
                }
            }
            // dd($commentImages); // Kiểm tra mảng commentImages
        }


        return response()->json([
            'message' => 'Thêm bình luận thành công',
        ]);
    }

    public function viewFavourite()
    {
        $user_id = Auth::check() ? Auth::user()->id : 0;
        $products = $this->productModel;

        if (Auth::check() && $user_id > 0) {
            $favourite = $this->favouriteModel->favouriteGet($user_id);
        } else {
            $favourite = json_decode(request()->cookie('favourite'), true) ?? [];
        }


        return view('favourite', compact('favourite', 'products'));
    }

    public function favourite(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'status' => 'required',
        ]);

        $user = Auth::check() ? Auth::user()->id : 0;
        if ($user > 0) {
            $favouriteFist = $this->favouriteModel->favouriteFist(Auth::user()->id, $request->product_id);
            if (!$favouriteFist) {
                $favourite = new Favourite();
                $favourite->user_id = $user;
                $favourite->product_id = $request->product_id;
                $favourite->status = 1;
                $favourite->save();

                return response()->json([
                    'message' => 'Yêu thích thành công mỹ mãn',
                    'is_favourite' => true
                ]);
            }
            // Nếu trạng thái là 0, xóa yêu thích
            if ($favouriteFist) {
                $favouriteFist->delete();
                return response()->json(['message' => 'Đã xóa yêu thích!', 'is_favourite' => false]);
            }
        } else {
            $favourite = json_decode(request()->cookie('favourite'), true) ?? [];
            $product_id = $request->product_id;

            if (isset($favourite[$product_id])) {
                unset($favourite[$product_id]); // Xóa yêu thích
                return response()->json([
                    'message' => 'Đã xóa yêu thích!',
                    'is_favourite' => false
                ])->withCookie(cookie()->forever('favourite', json_encode($favourite)));
            } else {
                $favourite[$product_id] = [
                    'user_id' => $user,
                    'product_id' => $product_id,
                    'status' => 1,
                ];
                return response()->json([
                    'message' => 'Yêu thích thành công mỹ mãn',
                    'is_favourite' => true
                ])->withCookie(cookie()->forever('favourite', json_encode($favourite)));
            }
        }
    }

    public function favouriteDeleteItem(Request $request)
    {
        $product_id = $request->product_id; //product_id lay tu ajax gui len
        if (Auth::check()) {
            $favourite = $this->favouriteModel->favouriteById(Auth::id(), $product_id);
            if ($favourite) {
                $favourite->delete();
            }
            return response()->json(['success' => true]);
        } else {
            $favourite = json_decode(request()->cookie('favourite'), true) ?? [];
            if (isset($favourite[$product_id])) {
                unset($favourite[$product_id]);
            }
            return response()->json(['success' => true, 'message' => 'Xóa sản phẩm yêu thích thành công'])->withCookie(cookie()->forever('favourite', json_encode($favourite))); //withCookie :  cho phép bạn thêm một cookie vào phản hồi, Cookie này sẽ được gửi về trình duyệt của người dùng cùng với phản hồi, và trình duyệt sẽ lưu cookie này
        }
    }
}
