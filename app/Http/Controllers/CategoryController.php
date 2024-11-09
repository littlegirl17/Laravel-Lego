<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;

class CategoryController extends Controller
{
    private $productModel;
    private $categoryModel;
    private $productDiscountModel;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Categories();
        $this->productDiscountModel = new ProductDiscount();
    }

    public function categoryAll()
    {
        $categoryAll = $this->categoryModel->categoryTotal();
        return view('totalCategory', compact('categoryAll'));
    }

    public function categoryProduct(Request $request, $id)
    {
        $categoryName = $this->categoryModel->findOrFail($id);
        $categoryAll = $this->categoryModel->categoryTotal();

        $filter_sort = $request->input('filter_sort', 'default');
        $price_range = $request->input('price_range', []);

        $productCategory = $this->productModel->productByCategory($id, $filter_sort, $price_range);
        $user = auth()->user();
        return view('categoryProduct', compact('categoryAll', 'productCategory', 'user', 'categoryName'));
    }
}
