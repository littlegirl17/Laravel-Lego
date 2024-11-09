@extends('layout.layout')
@section('title', 'Giỏ hàng')
@section('content')
    <!-- START MAIN -->
    <div class="container cart_container">
        <div class="cart_title">
            <h2>Giỏ hàng</h2>
        </div>

        <div class="cart_box">
            <div class="">
                @if (session('error_decreaseQuantity'))
                    <div id="alert-message" class="alertDanger">{{ session('error_decreaseQuantity') }}</div>
                @endif
                @php
                    $total = 0;
                    $intoMoney = 0;
                    $amount = 0;
                @endphp
                @if (!empty($cart) && count($cart) > 0)
                    {{-- SHOW CART COOKIE VÀ DATABASE --}}
                    @foreach ($cart as $item)
                        @php

                            // dùng để truy xuất vao bảng product thông qua product_id  để show thông tin của 1 san phẩm trong cart
                            $product = $products->where('id', $item['product_id'])->first();
                            // ta tiếp tục dùng $product để truy xuất vào  quan hệ   productDiscount để tìm giá giảm tương ứng với nhóm người dùng hiện tại. //  lọc theo user_group_id của người dùng hiện tại. Nếu người dùng chưa đăng nhập, mặc định nhóm người dùng là 1.
                            $productDiscountPrice = $product->productDiscount
                                ->where('user_group_id', Auth::check() ? Auth::user()->user_group_id : 1)
                                ->first();

                            // giá tiền không có giá giảm
                            $amount = $product ? $product->price : 0;

                            if ($productDiscountPrice) {
                                // giá giảm được lọc theo nhóm người dùng
                                $amount = $productDiscountPrice ? $productDiscountPrice->price : 0;
                            }
                            // thành tiền
                            $intoMoney = $amount * $item['quantity'];
                            // tổng tiền
                            $total += $intoMoney;
                        @endphp
                        <div class="cart_item">
                            <div class="cart_item_img">
                                <img src="{{ asset('img/' . $product->image) }}" alt="" />
                            </div>
                            <div class="cart_item_content">
                                <div class="cart_item_content_name">
                                    <h2>{{ $product->name }}</h2>
                                </div>
                                @if ($productDiscountPrice)
                                    <div class="cart_item_content_price">
                                        <span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',', '.') . 'đ' }}
                                    </div>
                                @else
                                    <div class="cart_item_content_price">
                                        <span></span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}
                                    </div>
                                @endif

                                <div class="cart_item_content_quantity">
                                    <button class="cart_quantity_decrease"><a
                                            href="{{ route('decreaseQuantity', $item['product_id']) }}">-</a></button>
                                    <input type="text" value="{{ $item['quantity'] }}" class="cart_quantity_number"
                                        data-product-id="{{ $item['product_id'] }}" disabled />
                                    <!-- data-product-id: thuộc tính tùy chỉnh trong HTML-->
                                    <button class="cart_quantity_increase"><a
                                            href="{{ route('increaseQuantity', $item['product_id']) }}">+</a></button>
                                </div>
                            </div>
                            <div class="cart_item_close">
                                <a onclick="deleteItemCart('{{ route('deleteItemCart', $item['product_id']) }}')">
                                    <i class="fa-solid fa-xmark text-black"></i></a>
                            </div>

                        </div>
                    @endforeach
                    {{-- ----------------------------------------------------------- --}}
                @else
                    {{-- Thông báo khi giỏ hàng trống --}}
                    <div class="div_Empty_main_cart">
                        <div class="Empty_main_cart">
                            <div class="cartEmpty_main">
                                <div class="cartEmpty">
                                    <img src="{{ asset('img/cart.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="cartEmptyText">
                                <span> Bạn chưa có sản phẩm nào trong giỏ hàng!
                                </span>
                                <div class=""> <a href="/" class="btn_empty_cart">Tiến hành mua hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($cart) && count($cart) > 0)
                    <div class="btn_two_cart">
                        <a href="/" class="btn_goon_cart">Tiếp tục mua sắm</a>

                        <a onclick="deleteAllCart('{{ route('deleteAllCart') }}')" class="btn_remove_cart">Xóa hết giỏ
                            hàng</a>
                    </div>
                @endif
            </div>

            <div class="cart_item_right">
                <div class="cart_right_coupon">
                    <div class="coupon_title">
                        <h3>Nhập mã giảm giá</h3>
                    </div>
                    <form action="{{ route('couponForm') }}" method="post">
                        @csrf
                        <div class="d-flex">
                            <input type="text" class="cart_right_coupon_input" name="code"
                                placeholder="Nhập mã giảm giá" />
                            @if (Session::get('coupon'))
                                @if (!empty($cart) && count($cart) > 0)
                                    <button type="button" class="detail_btn_coupon"><a href="{{ route('couponDelete') }}"
                                            class="text-decoration-none text-light">Xóa mã</a></button>
                                @else
                                    @php
                                        session()->forget('coupon');
                                    @endphp
                                    <button type="submit" class="detail_btn_cart">Áp mã</button>
                                @endif
                            @else
                                <button type="submit" class="detail_btn_cart">Áp mã</button>
                            @endif
                        </div>
                        <div class="pt-2">
                            @if (session('error'))
                                <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                            @endif
                            @if (session('success'))
                                <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                            @endif
                        </div>

                    </form>
                </div>
                <div class="cart_right_total">
                    <div class="cart_right_total_item">
                        <span>Thành tiền</span>
                        <span>{{ number_format($total, 0, ',', '.') . 'đ' }}</span>
                    </div>
                    <div class="cart_right_total_item">
                        <span>Mã giảm</span>

                        @if (Session::has('coupon'))
                            @foreach (Session::get('coupon') as $item)
                                @if (isset($item['type']))
                                    @if ($item['type'] == 0)
                                        {{-- giảm theo phần trăm --}}
                                        @php
                                            // Tổng số tiền giảm giá phần trăm
                                            $total_coupon = ($total * $item['discount']) / 100;
                                        @endphp
                                        <span>{{ number_format($total - $total_coupon, 0, ',', '.') . 'đ' }}
                                            ({{ $item['discount'] }}%)
                                        </span>
                                    @else
                                        {{-- giảm theo số tiền --}}
                                        @if (!empty($cart) && count($cart) > 0)
                                            @php
                                                $total_coupon = $total * $item['discount'];
                                            @endphp
                                            <span> {{ number_format($item['discount'], 0, ',', '.') . 'đ' }}
                                            </span>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="cart_right_total_item">
                        <h5>Tổng tiền</h5>
                        @if (Session::has('coupon'))
                            @php
                                if ($item['type'] == 0) {
                                    // nếu giảm theo %, thì lấu tổng tiền trừ đi cho số tiền giảm % đã tính ở trên
                                    $totalFinalCoupon = $total - $total_coupon;
                                } else {
                                    // nếu giảm theo số tiền thì lấy tổng tiền trừ cho số tiền giảm
                                    $totalFinalCoupon = $total - $item['discount'];
                                }
                            @endphp
                            @if (!empty($cart) && count($cart) > 0)
                                @php
                                    $total_coupon = $total * $item['discount'];
                                @endphp
                                <span>{{ number_format($totalFinalCoupon, 0, ',', '.') . 'đ' }}</span>
                            @endif
                        @else
                            <span>{{ number_format($total, 0, ',', '.') . 'đ' }}</span>
                        @endif
                    </div>
                    <div class="row_btn_checkout">
                        <a href="{{ route('checkout') }}" class="btn_checkout">Tiến hành thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
    <script>
        function increaseCart(product_id) {

            $.ajax({
                url: '{{ route('increaseQuantity', '') }}/' + product_id,
                type: 'POST',
                data: {
                    product_id: product_id,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.success) {
                        let quantityInput = $('.cart_quantity_number[data-product-id="' + product_id +
                            '"]'
                        ); // Lấy phần tử bằng jQuery // [data-product-id="' + product_id + '"] chỉ định rằng bạn chỉ muốn các phần tử có thuộc tính data-product-id bằng với giá trị của product_id.
                        let currentQuantity = parseInt(quantityInput.val()); //Lấy giá trị hiện tại của ô input
                        quantityInput.val(currentQuantity + 1); // Tăng số lượng lên 1
                    }
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại!');
                }
            })
        }

        function decreaseCart(product_id) {
            $.ajax({
                url: '{{ route('decreaseQuantity', '') }}/' + product_id,
                type: 'POST',
                data: {
                    product_id: product_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        let quantityInput = $('.cart_quantity_number[data-product-id="' + product_id + '"]');
                        let currentQuantity = parseInt(quantityInput.val());
                        quantityInput.val(currentQuantity - 1);
                    } else if (response.error) {
                        alert(response.error_decreaseQuantity);
                    }
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại!');

                }
            })
        }
    </script>
    <script>
        function deleteItemCart(url) {
            let timerInterval;
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
                    window.location.href = url;
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        }

        function deleteAllCart(url) {
            Swal.fire({
                title: "Bạn có muốn xóa hết giỏ hàng không?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Có, xóa hết!",
                cancelButtonText: "không!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Xóa thành công!",
                        text: "Giỏ hàng của bạn đã được xóa.",
                        icon: "success"
                    });
                    window.location.href = url;
                }
            });
        }
    </script>
@endsection
