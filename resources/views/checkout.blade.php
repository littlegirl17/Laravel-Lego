@extends('layout.layout')
@section('title', 'Thanh toán')
@section('content')
    <!-- START MAIN -->
    <div class="container_checkout">
        <form action="{{ route('checkoutForm') }}" method="post">
            @csrf
            <div class="container">
                <div class="checkout_main">
                    <div class="checkout_main_left">
                        <div class="checkout_header_left_one"></div>
                        <div class="checkout_main_left_one">
                            <div class="check_left_title">
                                <h2>Thông tin vận chuyển</h2>
                            </div>
                            <div class="checkout_main_left_one_item">
                                <div class="checkout_left_one_input">
                                    <label for="">Họ và tên</label>
                                    <input type="text" class="input_checkout" id="" placeholder="Nhập tên"
                                        name="name"
                                        value="{{ Session::has('user') ? Session::get('user')->fullname : '' }}" />
                                    @error('name')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="checkout_left_one_input">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" class="input_checkout" id=""
                                        placeholder="Nhập số điện thoại" name="phone"
                                        value="{{ Session::has('user') ? Session::get('user')->phone : '' }}"
                                        pattern="[0-9]*" maxlength="10" />
                                    @error('phone')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <div class="checkout_left_one_input">
                                    <label for="">Email</label>
                                    <input type="text" class="input_checkout" id="" placeholder="Nhập email"
                                        name="email"
                                        value="{{ Session::has('user') ? Session::get('user')->email : '' }}" />
                                    @error('email')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="checkout_main_left_one_item_2">
                                <div class="checkout_left_one_input">
                                    <label for="">Tỉnh</label>
                                    <select class="select_checkout" aria-label="Default select example" name="province"
                                        id="province">
                                        @if (Session::has('user'))
                                            <option selected value="{{ Session::get('user')->province }}">
                                                {{ Session::get('user')->province }}</option>
                                        @else
                                            <option selected disabled>Tỉnh/Thành phố</option>
                                        @endif
                                    </select>
                                    @error('province')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="checkout_left_one_input">
                                    <label for="">Quận/Huyện</label>
                                    <select class="select_checkout" aria-label="Default select example" name="district"
                                        id="district">
                                        @if (Session::has('user'))
                                            <option selected value="{{ Session::get('user')->district }}">
                                                {{ Session::get('user')->district }}</option>
                                        @else
                                            <option selected disabled>Quận/Huyện</option>
                                        @endif
                                    </select>
                                    @error('district')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="checkout_left_one_input">
                                    <label for="">Phường/Xã</label>
                                    <select class="select_checkout" aria-label="Default select example" name="ward"
                                        id="ward">
                                        @if (Session::has('user'))
                                            <option selected value="{{ Session::get('user')->ward }}">
                                                {{ Session::get('user')->ward }}</option>
                                        @else
                                            <option selected disabled>Phường/Xã</option>
                                        @endif
                                    </select>
                                    @error('ward')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="checkout_main_left_two">
                            <div class="">
                                <div class="checkout_left_one_input">
                                    <label for="">Lời nhắn</label>
                                    <input type="text" class="input_checkout" id=""
                                        placeholder="Lưu ý cho người bán" name="note" />
                                </div>
                            </div>
                        </div>

                        <div class="checkout_main_left_three">
                            <div class="">
                                <span>Phương thức thanh toán</span>
                            </div>
                            <div class="checkout_main_left_three_pttt">
                                <input type="radio" class="payment" id="momo" name="payment" value="3"
                                    style="display: none" />
                                <label for="momo">
                                    <div class="checkout_main_left_three_img">
                                        <img src="img/momo.svg" alt="" />
                                    </div>
                                    <p>Thanh toán MoMo</p>
                                </label>
                            </div>
                            <div class="checkout_main_left_three_pttt">
                                <input type="radio" class="payment"id="vnpay" name="payment" value="2"
                                    style="display: none" />
                                <label for="vnpay">
                                    <div class="checkout_main_left_three_img">
                                        <img src="img/vnpay_new.svg" alt="" />
                                    </div>
                                    <p>Thanh toán VNPAY</p>
                                </label>
                            </div>
                            <div class="checkout_main_left_three_pttt">
                                <input type="radio" class="payment" id="cash" name="payment" value="1"
                                    style="display: none" />
                                <label for="cash">
                                    <div class="checkout_main_left_three_img">
                                        <img src="img/other.svg" alt="" />
                                    </div>
                                    <p>Thanh toán bằng tiền mặt</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="checkout_main_right">
                        <div class="checkout_main_right_product">
                            @php
                                $total = 0;
                                $intoMoney = 0;
                                $amount = 0;
                            @endphp

                            @if (Session::has('buyNow'))
                                @php
                                    $buyNow = Session::get('buyNow');
                                    $amount = $buyNow['priceDiscount'] ? $buyNow['priceDiscount'] : $buyNow['price'];
                                    // thành tiền
                                    $intoMoney = $amount * $buyNow['quantity'];
                                    // tổng tiền
                                    $total += $intoMoney;
                                @endphp
                                <div class="row checkout_row_right">
                                    <input type="hidden" name="product_id" value="{{ $buyNow['id'] }}">
                                    <div class="col-md-3 col-sm-3 col-4">
                                        <div class="img_checkout_product">
                                            <img src="{{ asset('img/' . $buyNow['image']) }}" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-9 col-8">
                                        <h5>{{ $buyNow['name'] }}</h5>
                                        <p class="">Số lượng: {{ $buyNow['quantity'] }}</p>
                                        @if ($buyNow['priceDiscount'])
                                            <p class="pricecheckout_mobile">
                                                <span>{{ number_format($buyNow['price'], 0, ',', '.') . 'đ' }}</span>{{ number_format($buyNow['priceDiscount'], 0, ',', '.') . 'đ' }}
                                            </p>
                                        @else
                                            <p class="pricecheckout_mobile">
                                                <span></span>{{ number_format($buyNow['price'], 0, ',', '.') . 'đ' }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-12 checkout_right_price">
                                        @if ($buyNow['priceDiscount'])
                                            <p class="product_box_price">
                                                <span>{{ number_format($buyNow['price'], 0, ',', '.') . 'đ' }}</span>{{ number_format($buyNow['priceDiscount'], 0, ',', '.') . 'đ' }}
                                            </p>
                                        @else
                                            <p class="product_box_price">
                                                <span></span>{{ number_format($buyNow['price'], 0, ',', '.') . 'đ' }}
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            @elseif (Session::has('assemblyPackage'))
                                @php
                                    $assemblyPackage = Session::get('assemblyPackage');
                                    //dd($employee['employee_id']);

                                    $amount = $assemblyPackage['priceDiscount']
                                        ? $assemblyPackage['priceDiscount']
                                        : $assemblyPackage['price'];

                                    // tổng tiền
                                    $total = $assemblyPackage['totalFee'];
                                @endphp
                                <div class="row checkout_row_right">
                                    <input type="hidden" name="product_id"
                                        value="{{ $assemblyPackage['product_id'] }}">
                                    <div class="col-md-3 col-sm-3 col-4">
                                        <div class="img_checkout_product">
                                            <img src="{{ asset('img/' . $assemblyPackage['image']) }}" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-9 col-8">
                                        <h5>{{ $assemblyPackage['name'] }}</h5>
                                        <p class="">Số lượng: {{ $assemblyPackage['quantity'] }}</p>
                                        @if ($assemblyPackage['priceDiscount'])
                                            <p class="pricecheckout_mobile">
                                                <span>{{ number_format($assemblyPackage['price'], 0, ',', '.') . 'đ' }}</span>{{ number_format($assemblyPackage['priceDiscount'], 0, ',', '.') . 'đ' }}
                                            </p>
                                        @else
                                            <p class="pricecheckout_mobile">
                                                <span></span>{{ number_format($assemblyPackage['price'], 0, ',', '.') . 'đ' }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-12 checkout_right_price">
                                        @if ($assemblyPackage['priceDiscount'])
                                            <p class="product_box_price">
                                                <span>{{ number_format($assemblyPackage['price'], 0, ',', '.') . 'đ' }}</span>{{ number_format($assemblyPackage['priceDiscount'], 0, ',', '.') . 'đ' }}
                                            </p>
                                        @else
                                            <p class="product_box_price">
                                                <span></span>{{ number_format($assemblyPackage['price'], 0, ',', '.') . 'đ' }}
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            @elseif ($cart)
                                @foreach ($cart as $item)
                                    @php
                                        $product = $products->where('id', $item['product_id'])->first();
                                        $priceProductDiscount = $product->productDiscount
                                            ->where('user_group_id', Auth::check() ? Auth::user()->user_group_id : 1)
                                            ->first();
                                        // giá thường ko có giảm
                                        $amount = $product ? $product->price : 0;
                                        if ($priceProductDiscount) {
                                            // giá đã lọc theo nhóm khách hàng
                                            $amount = $priceProductDiscount ? $priceProductDiscount->price : 0;
                                        }

                                        // thành tiền
                                        $intoMoney = $amount * $item['quantity'];
                                        // tổng tiền
                                        $total += $intoMoney;
                                    @endphp
                                    <div class="row checkout_row_right">
                                        <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                        <div class="col-md-3 col-sm-3 col-4">
                                            <div class="img_checkout_product">
                                                <img src="{{ asset('img/' . $product->image) }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-9 col-8">
                                            <h5>{{ $product->name }}</h5>
                                            <p class="">Số lượng: {{ $item['quantity'] }}</p>
                                            @if (Auth::check())
                                                @if ($priceProductDiscount)
                                                    <p class="pricecheckout_mobile">
                                                        <span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($priceProductDiscount->price, 0, ',', '.') . 'đ' }}
                                                    </p>
                                                @else
                                                    <p class="pricecheckout_mobile">
                                                        <span></span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}
                                                    </p>
                                                @endif
                                            @else
                                            @endif

                                        </div>
                                        <div class="col-md-3 col-12 checkout_right_price">

                                            @if ($priceProductDiscount)
                                                <p class="product_box_price">
                                                    <span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($priceProductDiscount->price, 0, ',', '.') . 'đ' }}
                                                </p>
                                            @else
                                                <p class="product_box_price">
                                                    <span></span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                @endforeach

                            @endif

                        </div>
                        <div class="checkout_main_right_total">
                            <div class="check_item_total_one">
                                @if (Session::has('assemblyPackage'))
                                    @php
                                        $assemblyPackage = Session::get('assemblyPackage');
                                    @endphp
                                    <div class="checkout_item_total">
                                        <span>Phí lắp ráp</span>
                                        <span>{{ number_format($assemblyPackage['price_assembly'], 0, ',', '.') . 'đ' }}</span>
                                    </div>
                                    @if ($assemblyPackage['fee'] > 0)
                                        <div class="checkout_item_total">
                                            <span>Phí hộp quà tặng</span>
                                            <span>{{ number_format($assemblyPackage['fee'], 0, ',', '.') . 'đ' }}</span>
                                        </div>
                                    @endif
                                @endif
                                <div class="checkout_item_total">
                                    <span>Tạm tính</span>
                                    <span>{{ number_format($total, 0, ',', '.') . 'đ' }}</span>
                                </div>
                                <div class="checkout_item_total">
                                    <span>Giảm giá</span>
                                    @php
                                        $coupon_code = '';
                                        if (Session::has('coupon')) {
                                            foreach (Session::get('coupon') as $item) {
                                                $coupon_code = $item['code'];
                                                if ($item['type'] == 0) {
                                                    //  giảm theo percent
                                                    $percent = ($total * $item['discount']) / 100;
                                                    $total_coupon = $total - $percent;
                                                } else {
                                                    // giảm theo số tiền cụ thể
                                                    $total_coupon = $total - $item['discount'];
                                                }
                                            }
                                        } else {
                                            $total_coupon = 0;
                                        }
                                    @endphp

                                    @if (Session::has('coupon'))
                                        @foreach (Session::get('coupon') as $item)
                                            @if ($item['type'] == 0)
                                                <span>{{ $item['discount'] }}%</span>
                                            @else
                                                <span>{{ number_format($item['discount'], 0, ',', '.') . 'đ' }}</span>
                                            @endif
                                        @endforeach
                                    @endif

                                    <input type="hidden" name="coupon_code" value="{{ $coupon_code }}">
                                </div>
                            </div>
                            <div class="checkout_item_total_last">
                                <span>Tổng tiền</span>
                                @if (Session::has('coupon'))
                                    <h2>{{ number_format($total_coupon, 0, ',', '.') . 'đ' }}</h2>
                                    <input type="hidden" name="total" value="{{ $total_coupon }}">
                                @else
                                    <h2>{{ number_format($total, 0, ',', '.') . 'đ' }}</h2>
                                    <input type="hidden" name="total" value="{{ $total }}">
                                @endif
                            </div>
                        </div>
                        <div class="checkout_main_right_next">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="back_cart_checkout">
                                        <a href="" class="">Quay lại giỏ hàng</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn_checkout" onclick="return submitPayment();">Hoàn tất đơn
                                        hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- END MAIN -->

    <script>
        function submitPayment() {
            const payments = document.querySelectorAll('.payment');
            let isChecked = false;

            payments.forEach(payment => {
                if (payment.checked) {
                    isChecked = true;
                }
            });

            if (!isChecked) {
                alert('Vui lòng chọn phương thức thanh toán');
                return false;
            }

        }
    </script>
@endsection
