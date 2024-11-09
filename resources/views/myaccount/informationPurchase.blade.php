@extends('myaccount.layout.layout')
@section('title', 'Thông tin đơn hàng')
@section('content_myaccount')
    <div class="container pt_mobile">
        <div class="layout_member">
            <div class="layout_member_left">
                @include('myaccount.menuLeftAccount')
            </div>

            <div class="layout_member_right">
                <div class="container-account-right-item">
                    <a href="javascript:void(0);" onclick="window.history.back();" class="returnPurchaseMobile ">Trở lại</a>

                    <div class="account_purchase_header">

                        <div class="account_purchase_header_left">
                            <a href="javascript:void(0);" onclick="window.history.back();" class="returnPurchase ">Trở
                                lại</a>
                        </div>
                        <div class="account_purchase_header_right">
                            <a href="" class="text-decoration-none">
                                <p class="account_purchase_header_right_1">
                                    MÃ ĐƠN HÀNG: {{ $order->order_code }}
                                </p>
                            </a>
                            <p class="account_purchase_header_right_2">GIAO HÀNG THÀNH CÔNG</p>
                        </div>
                    </div>
                    <div class="checkout_header_left_one"></div>
                    <div class="infor_main">
                        <h4>Thông tin đặt hàng</h4>
                        <div class="infor_main_content">
                            <div class="px-4">
                                <p>Người đặt: {{ $order->name }}</p>
                                <p>Ngày đặt: {{ $order->created_at->format('d/m/y H:i:s') }}</p>
                                <p>SĐT: {{ $order->phone }}</p>
                                <p>Địa chỉ: {{ $order->province . ', ' . $order->district . ', ' . $order->ward }}</p>
                                <p>Phương thức thanh toán: {{ $order->definePayment()[$order->payment] }}</p>
                                <p>
                                    Tổng tiền:
                                    <strong>{{ number_format($order->total, 0, ',', '.') . 'đ' }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
