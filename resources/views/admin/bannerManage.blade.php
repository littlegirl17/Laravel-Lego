 @extends('admin.layout.layout')
 @Section('title', 'Admin | Quản lý hình ảnh')
 @Section('content')

     <div class="container-fluid">


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
                     <button class="btn btnF1">
                         <a href="{{ route('bannerManageAdd') }}" class="text-decoration-none text-light"><i
                                 class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Thêm vị trí</a>
                     </button>
                     <button class="btn btnF2" type="button"
                         onclick="submitForm('{{ route('deleteBannerManage') }}','post')"><i class="pe-2 fa-solid fa-trash"
                             style="color: #ffffff;"></i>Xóa
                         vị trí hình ảnh</button>

                 </div>
             </div>

             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách vị trí hình ảnh</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class=" py-2"></th>
                             <th class=" py-2">Tên vị trí hình ảnh</th>
                             <th class=" py-2">Vị trí</th>
                             <th class=" py-2">Trạng thái</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>
                     <tbody class="table-body">
                         @foreach ($banners as $item)
                             <tr class="">
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx_{{ $item->id }}" class="hidden-xs-up"
                                             name="banner_id[]" value="{{ $item->id }}">
                                         <label for="cbx_{{ $item->id }}" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td class="nameAdmin">
                                     <p>{{ $item->name }}</p>
                                 </td>
                                 <td>{{ $item->position }}</td>
                                 <td>
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
                                                 href="{{ route('editBannerManage', $item->id) }}"
                                                 class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                     style="color: #ffffff;"></i>Sửa
                                                 vị trí hình ảnh</a></button>
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


 @section('bannerManageAdminScript')

     <script>
         $(document).ready(function() {
             $('.form-check-input').on('click', function() {
                 // (this) tham chiếu đến phần tử html đó
                 var banner_id = $(this).data(
                     'id'); //lấy ra id danh mục thông qua data-id=" item->id "
                 var status = $(this).is(':checked') ? 1 : 0; //is() trả về true nếu phần tử khớp với bộ chọn
                 var label = $(this).siblings('label'); // Lấy label liền kề
                 updateBannerManageStatus(banner_id, status, label);
             });

         })

         function updateBannerManageStatus(banner_id, status, label) {
             $.ajax({
                 url: '{{ route('bannerManageUpdateStatus', ':id') }}'.replace(':id', banner_id),
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

     {{-- <script>
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
     </script> --}}
 @endsection
