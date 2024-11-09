@extends('admin.layout.layout')
@Section('title', 'Admin | Sửa danh mục')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('admin.order') }}">Quay lại</a>
        </div>

        <form class="formAdmin" action="{{ route('admin.orderUpdate', $order->id) }}" method="post" class="mt-5"
            enctype="multipart/form-data">
            @csrf
            <div class="buttonProductForm">
                <div class="">
                    <h2 class="title-page ">
                        Chỉnh sửa đơn hàng
                    </h2>
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="row orderAdminTable">
                        <h4>Thông tin khách hàng</h4>
                        <div class="col-md-6 ">
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" name="name" value="{{ $order->name }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $order->email }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{ $order->phone }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="province" class="form-label">Tỉnh/Thành phố</label>
                                <input type="text" class="form-control" name="province" value="{{ $order->province }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="district" class="form-label">Quận/Huyện</label>
                                <input type="text" class="form-control" name="district" value="{{ $order->district }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="ward" class="form-label">Phường/Xã</label>
                                <input type="text" class="form-control" name="ward" value="{{ $order->ward }}"
                                    readonly>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="col-md-2">

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 orderAdminTable">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hình</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderProducts as $index => $product)
                                <tr class="trProduct">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="d-flex justify-content-center border-0">
                                        <img src="{{ asset('img/' . $product->product->image) }}" alt=""
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td class="unit-price">{{ number_format($product->price, 0, ',', '.') }} đ</td>
                                    <td>
                                        <input type="number" class="form-control quantity"
                                            name="productByOrderEdit[{{ $index }}][newQuantity]"
                                            value="{{ $product->quantity }}" min="1" readonly>
                                    </td>
                                    <td class="thanh-tien">
                                        {{ number_format($product->price * $product->quantity, 0, ',', '.') }} đ</td>
                                    <td class="total-orderProduct">
                                        {{ number_format($product->price * $product->quantity, 0, ',', '.') }} đ</td>
                                    <input type="hidden"
                                        name="productByOrderEdit[{{ $index }}][newTotalOrderProduct]"
                                        value="{{ $product->price * $product->quantity }}">
                                </tr>
                            @endforeach

                            <tr class="trOrder">
                                <td colspan="4">
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Phương thức thanh toán</label>
                                        <input type="text" class="form-control" name="payment"
                                            value="{{ $order->definePayment()[$order->payment] }}" readonly>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Trạng thái đơn hàng</label>
                                        <select class="form-select" aria-label="Default select example" name="status"
                                            id="" selected>
                                            @foreach ($orderStatus as $key => $item)
                                                <option value="{{ $key }}"
                                                    {{ $order->status == $key ? 'selected' : '' }}>{{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td colspan="1"></td>
                                <td colspan="2" class="m-0 p-0">
                                    <div class="total-order">
                                        @if ($order->assembly ? $order->assembly->fee : null)
                                            <div class="form-group mt-3">
                                                <label for="title" class="form-label">Phí lắp ráp: </label>
                                                <p id="displayedTotalOrder">
                                                    {{ number_format($order->assembly->fee, 0, ',', '.') }} đ</p>
                                            </div>
                                        @endif

                                        <div class="form-group mt-3 ">
                                            <label for="title" class="form-label">Tổng tiền: </label>
                                            <p id="displayedTotalOrder">{{ number_format($order->total, 0, ',', '.') }} đ
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </form>
    </div>



@endsection
