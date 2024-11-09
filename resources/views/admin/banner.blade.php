 @extends('admin.layout.layout')
 @Section('title', 'Admin | banner')
 @Section('content')

     <div class="container-fluid">
         <div class="searchAdmin">
             <form id="filterFormBanner" action="{{ route('searchBanner') }}" method="POST">
                 @csrf
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Vị trí banner</label>
                             <select class="form-select  rounded-0" aria-label="Default select example" name="filter_name">
                                 <option value="">Tất cả</option>
                                 @foreach ($bannerName as $item)
                                     <option value="{{ $item->id }}" {{ $filter_name == $item->id ? 'selected' : '' }}>
                                         {{ $item->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Trạng thái</label>
                             <select class="form-select  rounded-0" aria-label="Default select example"
                                 name="filter_status">
                                 <option value="">Tất cả</option>
                                 <option value="1">Kích hoạt
                                 </option>
                                 <option value="0">Vô hiệu hóa
                                 </option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc banner hình ảnh
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
                 <div class="">
                     <button type="button" class="btn btnF1">
                         <a href="{{ route('bannerAdd') }}" class="text-decoration-none text-light"><i
                                 class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Thêm hình ảnh</a>
                     </button>
                     <button class="btn btnF2" type="button"
                         onclick="submitForm('{{ route('deleteBannerAdmin') }}','post')"><i class="pe-2 fa-solid fa-trash"
                             style="color: #ffffff;"></i>Xóa
                         hình ảnh</button>

                 </div>
             </div>

             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách hình ảnh</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class=" py-2"></th>
                             <th class=" py-2">Tên banner</th>
                             <th class=" py-2">Ảnh desktop</th>
                             <th class=" py-2">Ảnh mobile</th>
                             <th class=" py-2">Trạng thái</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>
                     <tbody class="table-body">
                         @foreach ($bannerImages as $item)
                             <tr class="">
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx_{{ $item->id }}" class="hidden-xs-up"
                                             name="banner_id[]" value="{{ $item->id }}">
                                         <label for="cbx_{{ $item->id }}" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td>
                                     <p>{{ $item->banner->name }}</p>
                                 </td>

                                 <td style="width:20%;">
                                     @if (!empty($item->image_desktop))
                                         <img src="{{ asset('img/' . $item->image_desktop) }}" alt=""
                                             style="width:45%;height:45%; object-fit: cover;">
                                     @else
                                         <img src="{{ asset('img/lf.png') }}" alt=""
                                             style="width:45%;height:45%; object-fit: cover;">
                                     @endif
                                 </td>
                                 <td style="width:20%;">
                                     @if (!empty($item->image_mobile))
                                         <img src="{{ asset('img/' . $item->image_mobile) }}" alt=""
                                             style="width:45%;height:45%; object-fit: cover;">
                                     @else
                                         <img src="{{ asset('img/lf.png') }}" alt=""
                                             style="width:45%;height:45%; object-fit: cover;">
                                     @endif
                                 </td>
                                 <td class="">
                                     <div class="form-check form-switch">
                                         <input class="form-check-input" type="checkbox" role="switch"
                                             data-id="{{ $item->id }}" id="flexSwitchCheckChecked"
                                             {{ $item->status == 1 ? 'checked' : 0 }}>
                                         <label class="form-check-label"
                                             for="flexSwitchCheckChecked">{{ $item->status == 1 ? 'Kích hoạt' : 'Vô hiệu hóa' }}</label>
                                     </div>
                                 </td>
                                 <td class="m-0 p-0">
                                     <div class="actionAdminProduct m-0 py-3">
                                         <button class="btnActionProductAdmin2"><a
                                                 href="{{ route('editBanner', $item->id) }}"
                                                 class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                     style="color: #ffffff;"></i>Sửa
                                                 banner hình ảnh</a></button>
                                     </div>
                                 </td>
                             </tr>
                         @endforeach

                     </tbody>
                 </table>
             </div>
         </form>

         <nav class="navPhanTrang">
             <ul class="pagination">
                 <li></li>
             </ul>
         </nav>
     </div>


 @endsection

 @section('bannerAdminScript')

     <script>
         $(document).ready(function() {
             $('.form-check-input').on('click', function() {
                 // (this) tham chiếu đến phần tử html đó
                 var banner_id = $(this).data(
                     'id'); //lấy ra id danh mục thông qua data-id=" item->id "
                 var status = $(this).is(':checked') ? 1 : 0; //is() trả về true nếu phần tử khớp với bộ chọn
                 var label = $(this).siblings('label'); // Lấy label liền kề
                 updateBannerStatus(banner_id, status, label);
             });

         })

         function updateBannerStatus(banner_id, status, label) {
             $.ajax({
                 url: '{{ route('bannerUpdateStatus', ':id') }}'.replace(':id', banner_id),
                 type: 'PUT',
                 data: {
                     '_token': '{{ csrf_token() }}', //Việc gửi mã token này cùng với mỗi request giúp xác thực rằng request đó được gửi từ ứng dụng của bạn, chứ không phải từ một nguồn khác.
                     'status': status
                 },
                 success: function(response) {
                     console.log('Cập nhật trạng thái thành công');

                     if (status == 1) {
                         label.text('Kích hoạt');
                     } else {
                         label.text('Vô hiệu hóa');
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Lỗi khi cập nhật trạng thái sản phẩm: ' + error);
                 }
             })
         }
     </script>
     <script>
         $(document).ready(function() {
             $('#filterFormBanner').on('submit', function() {
                 var formData = $(this).serialize();

                 $.ajax({
                     url: '{{ route('searchBanner') }}',
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
 @endsection
