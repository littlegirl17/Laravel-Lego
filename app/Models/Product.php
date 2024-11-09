<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'category_id',
        'price',
        'image',
        'status',
        'view',
        'outstanding'
    ];

    public function categories()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }

    public function productDiscount()
    {
        return $this->hasMany(ProductDiscount::class, 'product_id');
    }

    public function favourite()
    {
        return $this->hasMany(Favourite::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'product_id');
    }

    public function productImage()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function productAll()
    {
        return $this->orderBy('id', 'desc')->paginate(8); // Phân trang với 10 sản phẩm mỗi trang
    }

    public function productFavouriteAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function productByCategory($category_id, $filter_sort = 'default', $price_range)
    {
        $query = $this->where('category_id', $category_id);

        if (!empty($price_range)) {
            $query->where(function ($q) use ($price_range) { // where thêm điều kiện lọc, use ($priceRanges) cho phép hàm where truy cập đến biến $priceRanges bên ngoài phạm vi của nó, $q là biến đại diện cho truy vấn hiện tại
                foreach ($price_range as $range) { //Vòng lặp foreach này sẽ duyệt qua từng khoảng giá (ví dụ: "0-100000", "100000-200000",...) trong mảng $priceRanges.
                    [$min, $max] = explode('-', $range); // explode('-', $range) tách chuỗi khoảng giá (ví dụ: "0-100000") thành hai phần là giá trị nhỏ nhất (min) và giá trị lớn nhất (max) => Sau đó, hai giá trị này được lưu vào biến $min và $max
                    $q->orWhereBetween('price', [$min, $max]); //orWhereBetween('price', [$min, $max]) thêm điều kiện lọc cho truy vấn, để tìm các sản phẩm có giá (price) nằm giữa khoảng giá từ $min đến $max.
                }
            });
        }
        // xử lí chọn lọc
        switch ($filter_sort) {
            case 'filter_az':
                $query->orderBy('name', 'asc');
                break;
            case 'filter_za':
                $query->orderBy('name', 'desc');
                break;
            case 'filter_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'filter_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        return $query->paginate(9);
    }

    public function searchProduct($filter_iddm, $filter_name, $filter_price, $filter_status)
    {
        $query = $this->query();

        if (!is_null($filter_iddm)) {
            $query->where('category_id', $filter_iddm);
        }

        if (!is_null($filter_name)) {
            $query->where('name', "LIKE", "%{$filter_name}%");
        }

        if (!is_null($filter_price)) {
            $query->where('price', '=', (int)$filter_price);
        }

        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }

        return $query->paginate(10);
    }

    public function productOutStanding()
    {
        return $this->where('outstanding', 1)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->inRandomOrder() // Sử dụng inRandomOrder() để lấy sản phẩm ngẫu nhiên
            ->get();
    }

    public function productBestseller()
    {
        $quantityTotal = (new OrderProduct)->getQuantityProduct(); //trả về một tập hợp các bản ghi chứa product_id và tổng số lượng (total_quantity) của từng sản phẩm.
        return $this->whereIn('id', $quantityTotal->pluck('product_id'))->get(); //>whereIn('id':  lọc những sản phẩm từ bảng sản phẩm có id nằm trong danh sách các product_id này.  //pluck('product_id') sẽ lấy ra tất cả các product_id từ tập hợp kết quả đó, tạo thành một danh sách (mảng) các product_id.
    }

    public function productSoldOut()
    {
        return $this->where('status', '=', 0)->orderBy('id', 'desc')->get();
    }

    public function productRelated($detail)
    {
        return $this->where('category_id', $detail->category_id)->inRandomOrder()->get();
    }

    public function searchProductHome($name)
    {
        return $this->where('name', 'LIKE', "%{$name}%")->where('status', 1)->orderBy('id', 'desc')->paginate(12);
    }

    public function countProduct($category_id)
    {
        return $this->where('category_id', $category_id)->count();
    }

    public function countProductAll()
    {
        return $this->count();
    }
}
