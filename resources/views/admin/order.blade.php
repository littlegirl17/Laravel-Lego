 @extends('admin.layout.layout')
 @Section('title', 'Admin | Đơn hàng')
 @Section('content')

     <div class="container-fluid">
         @if (session('error'))
             <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
         @endif
         <div class="searchAdmin">
             <form id="filterFormOrder" action="" method="GET">
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc theo id đơn hàng</label>
                             <input type="text" class="form-control rounded-0" name="filter_iddh"
                                 placeholder="Nhập id đơn hàng" value="">
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc theo tên khách hàng</label>
                             <input class="form-control rounded-0" name="filter_userName" placeholder="Nhập tên khách hàng"
                                 type="text" value="">
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Tình trạng đơn hàng</label>
                             <select class="form-select rounded-0" aria-label="Default select example" name="filter_status">
                                 <option value="">Tất cả</option>
                                 <option value="1">Chờ xác nhận</option>
                                 <option value="2">Đã xác nhận</option>
                                 <option value="3">Đang vận chuyển</option>
                                 <option value="4">Hoàn thành</option>
                                 <option value="5">Đã hủy</option>
                             </select>
                         </div>
                     </div>

                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc tổng tiền</label>
                             <input class="form-control rounded-0" name="filter_total" placeholder="Nhập tổng tiền"
                                 type="text">
                         </div>
                     </div>

                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc sản phẩm
                     </button>
                 </div>
             </form>
         </div>
         <div class="row">
             <div class="col-sm-12 btnOrderAdmin">
                 @foreach ($statuses as $status_id => $status)
                     <a href="{{ route('admin.order', ['filter_status' => $status_id]) }}"
                         class="btn btn-success rounded-0  border-0"
                         style="background-color: {{ $status['color'] }}">{{ $status['label'] }}
                         ({{ $orderCounts[$status_id] }})
                     </a>
                 @endforeach

             </div>
         </div>

         <div class="table-responsive">
             <table class="table table-bordered pt-3 mt-3">
                 <thead class="table-header">
                     <tr class="">
                         <th class="py-2">IDDH</th>
                         <th class="py-2">Khách hàng</th>
                         <th class="py-2">Chi tiết sản phẩm</th>
                         <th class="py-2">Tổng cộng</th>
                         <th class="py-2">Hành động</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($orders as $order)
                         <!-- Chú ý: sử dụng 'orders' thay vì 'order' -->
                         <tr class="orderAdminTr" style="background: #fff">
                             <td class="">{{ $order->id }}</td>
                             <td class="d-flex flex-column px-2 m-0">
                                 <div class="text-start m-0">
                                     <p class="m-0 p-0">Điện thoại: <strong>{{ $order->phone }}</strong></p>
                                     <p class="m-0 p-0">Tên KH: <strong>{{ $order->name }}</strong></p>
                                 </div>
                                 <div class="m-0 p-0 text-start">
                                     <p class="m-0 p-0">Địa chỉ: <strong>{{ $order->province }}, {{ $order->district }},
                                             {{ $order->ward }}</strong></p>
                                 </div>
                             </td>
                             <td class="">
                                 <div class="table-responsive">
                                     <table class="table table-bordered">
                                         <thead>
                                             <tr>
                                                 <th>Hình</th>
                                                 <th>SP</th>
                                                 <th>Giá</th>
                                                 <th>SL</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($order->orderProducts as $product)
                                                 <!-- Lặp qua các sản phẩm của đơn hàng -->
                                                 <tr class="">
                                                     <td>
                                                         <img src="{{ asset('img/' . $product->product->image) }}"
                                                             alt=""
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                     </td>
                                                     <td class="nameAdmin">
                                                         <p>{{ $product->name }}</p>
                                                     </td>
                                                     <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                                                     <!-- Hiển thị giá -->
                                                     <td>{{ $product->quantity }}</td> <!-- Hiển thị số lượng -->
                                                 </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             </td>
                             <td class="">
                                 <h6 style="color: #FF0000">{{ number_format($order->total, 0, ',', '.') }} đ</h6>
                                 <!-- Tổng cộng -->
                             </td>

                             <td class="m-0 p-0">
                                 <div class="actionAdminProduct m-0 py-3">
                                     <button type="button" class="btnActionProductAdmin2"><a
                                             href="{{ route('admin.orderEdit', $order->id) }}"
                                             class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                 style="color: #ffffff;"></i>Chỉnh sửa đơn hàng</a></button>
                                 </div>
                             </td>
                         </tr>
                     @endforeach

             </table>
             <nav class="navPhanTrang">
                 {{ $orders->links() }}
             </nav>
         </div>
     </div>

 @endsection
 {{--
@section('scriptOrder')
    <script>
        $(document).ready(function() {
            $('#filterFormOrder').on('submit', function() {
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('searchOrder') }}',
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        $('.table-body').html(response.html);
                    },
                    error: function(error) {
                        console.error('Lỗi khi lọc' + error);
                    }
                })
            })
        })
    </script>
@endsection  --}}
