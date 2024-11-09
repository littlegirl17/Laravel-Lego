<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BuyNowController extends Controller
{
    private $productModel;


    public function __construct()
    {
        $this->productModel = new Product();
    }
}
