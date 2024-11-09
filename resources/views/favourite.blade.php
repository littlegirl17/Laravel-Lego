@extends('layout.layout')
@section('title', 'Sản phẩm yêu thích')
@section('content')
    <!-- START MAIN -->
    <section class="product pt_mobile background_home">
        <div class="container">
            <div class="title_favourite">
                <h2 class="favourite_title">Danh sách </h2>
                <h2 class="favourite_title">yêu thích của bạn</h2>
            </div>
            @if (count($favourite) > 0)
                <div class="row">
                    @foreach ($favourite as $item)
                        @php
                            $product = $products->where('id', $item['product_id'])->first();
                            $priceDiscount = 0;
                            $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                            $productDiscountPrice = $product->productDiscount
                                ->where('user_group_id', $userGroupId)
                                ->first();

                            $price = $product->price ? $product->price : null;

                            if ($productDiscountPrice) {
                                $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
                            }

                            $percent = ceil((($product->price - $priceDiscount) / $product->price) * 100);
                            $productImageCollect = $product->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                            if (Auth::check()) {
                                $isFavourite = $product->favourite
                                    ->where('user_id', Auth::id())
                                    ->contains('product_id', $item['product_id']); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                            } else {
                                $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                                // Lấy danh sách tất cả các product_id từ mảng $favourite
                                $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                                // Kiểm tra xem $id có nằm trong danh sách product_id không
                                $isFavourite =
                                    is_array($productIds) && in_array((string) $item['product_id'], $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                            }
                        @endphp


                        <div class="col-md-6 col-12 my-3" data-product_id="{{ $item['product_id'] }}">
                            <div class="favourite_box">
                                <div class="favourite_close">
                                    <a href="#" onclick="favouriteDeleteItem({{ $item['product_id'] }})"
                                        class="text-black"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                                <div class="favourite_main">
                                    <div class="favourite_left">
                                        <div class="favourite_left_name">
                                            <span>{{ $product->name }}</span>
                                        </div>
                                        @if ($productDiscountPrice)
                                            <div class="favourite_left_price">
                                                <span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',', '.') . 'đ' }}
                                            </div>
                                        @else
                                            <div class="favourite_left_price">
                                                <span></span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}
                                            </div>
                                        @endif

                                    </div>
                                    <div class="favourite_right">
                                        <div class="favourite_right_img">
                                            <img src="{{ asset('img/' . $product->image) }}" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="favourite_cart">
                                    <svg id="Bag" width="24" height="25" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M2.95996 22.6598L3.90996 7.02979H20.59L21.54 22.6598H2.95996Z"
                                            fill="#000000"></path>
                                        <path
                                            d="M10.1497 4.90967C10.7797 4.27967 11.6597 3.90967 12.5497 3.90967H12.5697C14.3497 3.90967 15.7897 5.28967 15.9397 7.02967H17.4397C17.2897 4.45967 15.1697 2.40967 12.5697 2.40967H12.5497C11.2597 2.40967 9.99969 2.92967 9.08969 3.83967C8.23969 4.68967 7.74969 5.83967 7.67969 7.02967H9.17969C9.24969 6.23967 9.57969 5.46967 10.1497 4.90967Z"
                                            fill="#000000"></path>
                                        <path d="M9.01978 12.3999H10.5598V10.8999H9.01978V12.3999Z" fill="#000000">
                                        </path>
                                        <path d="M14.6298 12.3999H16.1698V10.8999H14.6298V12.3999Z" fill="#000000">
                                        </path>
                                    </svg>
                                    <button class="btn_favourite" onclick="addToCart('{{ $item['product_id'] }}', 1)">Thêm
                                        vào giỏ
                                        hàng</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="div_favourite">
                    <div class="div_favourite_main">
                        <div class="div_favourite_img">
                            <img src="{{ asset('img/heartview.jpg') }}" alt="">
                        </div>
                        <div class="div_favourite_contain">
                            <span>Chưa có sản phẩm yêu thích</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if (Auth::check())
            <div class="div_nav_pagination mt-5">
                <nav class="nav_pagination">
                    <ul class="pagination">
                        <li>{{ $favourite->links() }}</li>
                    </ul>
                </nav>
            </div>
        @else
        @endif

    </section>
    <!-- END MAIN -->
    <script>
        function favouriteDeleteItem(product_id) {
            $.ajax({
                url: '{{ route('favouriteDeleteItem') }}',
                type: 'GET',
                data: {
                    product_id: product_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {

                        // Xóa sản phẩm khỏi danh sách yêu thích ngay lập tức
                        $(`[data-product_id="${product_id}"]`).closest('.col-md-6').remove();
                        // Hiển thị thông báo với SweetAlert
                        Swal.fire({
                            title: "Xóa sản phẩm!",
                            html: "Sản phẩm đang được xóa sau <b></b> mili giây.",
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                    timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log("Đã đóng thông báo sau khi đếm ngược");
                            }
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        }
    </script>
@endsection
