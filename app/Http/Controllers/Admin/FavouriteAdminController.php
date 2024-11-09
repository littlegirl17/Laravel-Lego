<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favourite;

class FavouriteAdminController extends Controller
{
    private $productModel;
    private $favouriteModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->favouriteModel = new Favourite();
    }

    public function favourite()
    {
        $favourites =  $this->favouriteModel->favouriteAll();
        $products = $this->productModel->productFavouriteAll();
        $filter_name = '';
        $filter_user = '';
        return view('admin.favourite', compact('favourites', 'products', 'filter_name', 'filter_user'));
    }

    public function favouriteUpdateStatus(Request $request, $id)
    {
        $favourite = $this->favouriteModel->findOrFail($id);
        $favourite->status = $request->status;
        $favourite->save();
        return response()->json(['success' => true]);
    }

    public function favouriteSearch(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');
        $filter_user = $request->input('filter_user');

        $filter_status = $request->input('filter_status');

        $favourites = $this->favouriteModel->searchFavourite($filter_name, $filter_user, $filter_status);
        $products = $this->productModel->productFavouriteAll();
        return view('admin.favourite', compact('products', 'favourites', 'filter_name', 'filter_user'));
    }
}
