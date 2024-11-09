@extends('layout.layout')
@section('title', 'Đơn hàng')
@section('content')
    <!-- START MAIN -->
    <div class="container_order">
        <div class="order_main">
            <div class="row px-3">
                <div class="" style="border-bottom: 0.5px solid #e8e8e8">
                    <h3>Order ID: #{{ $orderUser->order_code }}</h3>
                    <p>Order date: {{ $orderUser->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
            <div class="row mt-3 px-3">
                <h4>Thông tin đặt hàng</h4>
                <div class="" style="border-bottom: 0.5px solid #e8e8e8">
                    <div class="px-4">
                        <p>Người đặt: {{ $orderUser->name }}</p>
                        <p>SĐT: {{ $orderUser->phone }}</p>
                        <p>Địa chỉ: {{ $orderUser->province . ', ' . $orderUser->district . ', ' . $orderUser->ward }}</p>
                        <p>Phương thức thanh toán: {{ $orderUser->definePayment()[$orderUser->payment] }}</p>
                        <p>
                            Tổng tiền:
                            <strong>{{ number_format($orderUser->total, 0, ',', '.') . 'đ' }}</strong>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mt-3 m-0">
                <h4>Sản phẩm đã đặt</h4>
                <div class="" style="border-bottom: 0.5px solid #e8e8e8">
                    <table class="table table_order_product">
                        <tbody>
                            @foreach ($orderProductUser as $item)
                                <tr class="">
                                    <td class="m-0 td_order_name" style="border-style: unset">
                                        <div class="d-flex">
                                            <div class="table_order_product_img">
                                                <img src="{{ asset('img/' . $item->product->image) }}" class=""
                                                    alt="" />
                                            </div>
                                            <p class="name_order_desktop">{{ $item->name }}</p>

                                            <div class="order_content_product_mobile">
                                                <p class="">Lego Thành Phố</p>
                                                <div class="product_box_price">
                                                    {{ $item->price }}
                                                </div>
                                                <p class="quantity_order_mobile">số lượng: {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="right_order_price px-4 m-0" style="border-style: unset">
                                        <div class="product_box_price">
                                            {{ number_format($item->price, 0, ',', '.') . 'đ' }}
                                        </div>
                                        <p>số lượng: {{ $item->quantity }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-8"></div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="/" class="btn_checkout">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
@endsection
