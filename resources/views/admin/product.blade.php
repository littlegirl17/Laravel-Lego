 @extends('admin.layout.layout')
 @Section('title', 'Admin | Sản phẩm')
 @Section('content')

     <div class="container-fluid">

         <div class="searchAdmin">
             <form id="filterFormProduct" action="{{ route('searchProduct') }}" method="POST">
                 @csrf
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc sản phẩm theo danh mục</label>
                             <select class="form-select  rounded-0" aria-label="Default select example" name="filter_iddm">
                                 <option value="">Tất cả</option>
                                 @foreach ($categories as $category)
                                     @foreach ($category->categories_children as $item)
                                         <option value="{{ $item->id }}"
                                             {{ !empty($filter_iddm) ? ($item->id == $filter_iddm ? 'selected' : '') : '' }}>
                                             {{ $item->name }}
                                         </option>
                                     @endforeach
                                 @endforeach

                             </select>
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Tên sản phẩm</label>
                             <input class="form-control rounded-0" name="filter_name" placeholder="Tên sản phẩm"
                                 type="text" value="{{ $filter_name ?? '' }}">
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Giá sản phẩm</label>
                             <input class="form-control rounded-0" name="filter_price" placeholder="Giá sản phẩm"
                                 type="number" value="{{ $filter_price ?? '' }}">
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Trạng thái</label>
                             <select class="form-select  rounded-0" aria-label="Default select example"
                                 name="filter_status">
                                 <option value="">Tất cả</option>
                                 <option value="1"
                                     {{ !empty($filter_status) ? ($filter_status == 1 ? 'selected' : '') : '' }}>Kích hoạt
                                 </option>
                                 <option value="0"
                                     {{ !empty($filter_status) ? ($filter_status == 0 ? 'selected' : '') : '' }}>Vô hiệu hóa
                                 </option>
                             </select>
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

         <form id="submitFormAdmin">
             @csrf
             <div class="buttonProductForm mt-3">
                 <div class="m-0 p-0">
                     @if (session('error'))
                         <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                     @endif
                     @if (session('success'))
                         <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                     @endif
                 </div>
                 <div class="m-0 p-0">
                     <button type="button" class="btn btnF1" onclick="window.location.href='{{ route('addProduct') }}'">
                         <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo mới sản phẩm
                     </button>
                     <button class="btn btnF3" type="button" onclick=""><i class="pe-2 fa-solid fa-copy"
                             style="color: #ffffff;"></i>Copy sản phẩm</button>
                     <button class="btn btnF2" type="button"
                         onclick="submitForm('{{ route('deleteProduct') }}','post')"><i class="pe-2 fa-solid fa-trash"
                             style="color: #ffffff;"></i>Xóa
                         sản phẩm</button>
                 </div>
             </div>
             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Sản Phẩm</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class=" py-2"></th>
                             <th class=" py-2">Hình ảnh</th>
                             <th class=" py-2">Sản phẩm</th>
                             <th class=" py-2">Giá</th>
                             <th class=" py-2">Danh mục</th>
                             <th class=" py-2">Nổi bật</th>
                             <th class=" py-2">Trạng thái</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>

                     <tbody class="table-body">
                         @foreach ($products as $item)
                             @php
                                 $checkProductDiscount = $productDiscount->where('product_id', $item->id)->first();
                             @endphp
                             <tr class="">
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx_{{ $item->id }}" class="hidden-xs-up"
                                             name="product_id[]" value="{{ $item->id }}">
                                         <label for="cbx_{{ $item->id }}" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td class="">
                                     <img src="{{ asset('img/' . $item->image) }}" alt=""
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                 </td>
                                 <td class="nameAdmin">
                                     <p>{{ $item->name }}</p>
                                     @if ($checkProductDiscount)
                                         <span style="color: #ff0000;font-weight:500;">(Sản phẩm có giá giảm)</span>
                                     @endif
                                 </td>
                                 <td>
                                     {{ number_format($item->price, 0, ',', '.') . 'đ' }}
                                 </td>
                                 <td class="">{{ $item->categories->name }}</td>
                                 <td>
                                     <div class="td_outstanding">
                                         <label class="switch_outstanding">
                                             <input type="checkbox" class="form-check-input-outstanding input_outstanding"
                                                 data-id="{{ $item->id }}"
                                                 {{ $item->outstanding == 1 ? 'checked' : 0 }}>
                                             <span class="slider_outstanding"></span>
                                         </label><span class="text_outstanding">Nổi bật</span>
                                     </div>
                                 </td>
                                 <td class="">
                                     <div class="form-check form-switch">
                                         <input class="form-check-input" type="checkbox" role="switch"
                                             data-id="{{ $item->id }}" id="flexSwitchCheckChecked"
                                             {{ $item->status == 1 ? 'checked' : 0 }}>
                                         <label class="form-check-label"
                                             for="flexSwitchCheckChecked">{{ $item->status == 1 ? 'Bật' : 'Tắt' }}</label>
                                     </div>
                                     <div class="product_date">
                                         <span>Ngày tạo:{{ $item->created_at->format('d/m/Y H:i:s') }}</span>
                                         <span>Ngày sửa:{{ $item->updated_at->format('d/m/Y H:i:s') }}</span>
                                     </div>
                                 </td>
                                 <td class="m-0 p-0">
                                     <div class="actionAdminProduct m-0 py-3">
                                         <button class="btnActionProductAdmin1"><a href=""
                                                 class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-eye"
                                                     style="color: #ffffff;"></i>
                                                 Xem SP trên web</a></button>
                                         <button type="button" class="btnActionProductAdmin2"
                                             onclick="window.location.href='{{ 'editProduct/' . $item->id }}'">
                                             <i class="pe-2 fa-solid fa-pen" style="color: #ffffff;"></i>Sửa lại
                                             sản phẩm</button>
                                     </div>

                                 </td>

                             </tr>
                         @endforeach
                     </tbody>

                 </table>
                 <nav class="navPhanTrang">
                     {{ $products->links() }}
                 </nav>

             </div>
         </form>


         <nav class="navPhanTrang">
             <ul class="pagination">
                 <li></li>
             </ul>
         </nav>
     </div>
 @endsection
 @section('productAdminScript')
     <script>
         $(document).ready(function() {
             $('.form-check-input').on('click', function() {
                 // (this) tham chiếu đến phần tử html đó
                 var product_id = $(this).data('id'); //lấy ra id danh mục thông qua data-id="item->id"
                 var status = $(this).is(':checked') ? 1 : 0; //is() trả về true nếu phần tử khớp với bộ chọn
                 var label = $(this).siblings('label'); // Lấy label liền kề
                 updateProductStatus(product_id, status, label);
             })
         })

         function updateProductStatus(product_id, status, label) {
             $.ajax({
                 url: '{{ route('productUpdateStatus', ':id') }}'.replace(':id', product_id),
                 type: 'PUT',
                 data: {
                     '_token': '{{ csrf_token() }}', //Việc gửi mã token này cùng với mỗi request giúp xác thực rằng request đó được gửi từ ứng dụng của bạn, chứ không phải từ một nguồn khác.
                     'status': status
                 },
                 success: function(response) {
                     if (response.success) {
                         label.text(status == 1 ? 'Bật' : 'Tắt');
                     }
                 },
                 error: function(error) {
                     console.error('Lỗi khi cập nhật trạng thái sản phẩm: ' + error);
                 }
             })
         }
     </script>
     <script>
         $(document).ready(function() {
             $('.form-check-input-outstanding').on('click', function() {
                 // (this) tham chiếu đến phần tử html đó
                 var product_id = $(this).data('id'); //lấy ra id danh mục thông qua data-id="item->id"
                 var outstanding = $(this).is(':checked') ? 1 :
                     0; //is() trả về true nếu phần tử khớp với bộ chọn

                 updateProductOutstanding(product_id, outstanding);
             })
         })

         function updateProductOutstanding(product_id, outstanding) {
             $.ajax({
                 url: '{{ route('productUpdateOutstanding', ':id') }}'.replace(':id', product_id),
                 type: 'PUT',
                 data: {
                     '_token': '{{ csrf_token() }}', //Việc gửi mã token này cùng với mỗi request giúp xác thực rằng request đó được gửi từ ứng dụng của bạn, chứ không phải từ một nguồn khác.
                     'outstanding': outstanding
                 },
                 success: function(response) {},
                 error: function(error) {
                     console.error('Lỗi khi cập nhật trạng thái sản phẩm: ' + error);
                 }
             })
         }
     </script>

     <script>
         $(document).ready(function() {
             $('.filterFormProduct').on('submit', function() {
                 var formData = $(this).serialize();
                 //$(this): tham chiếu đến biểu mẫu mà sự kiện submit đang được kích hoạt .serialize(): phương thức này sẽ chuyển đổi tất cả các trường đầu vào của biểu mẫu thành một chuỗi truy vấn URL (query string), bao gồm tên và giá trị của các trường.
                 $.ajax({
                     url: 'productSearch',
                     type: 'POST',
                     data: success: function(response) {
                         $('.table-body').html(response.html);
                     },
                     error: function(error) {
                         console.error('Lỗi khi lọc' + error);
                     }
                 })
             })
         })
     </script>
 @endsection
