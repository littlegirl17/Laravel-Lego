 @extends('admin.layout.layout')
 @Section('title', 'Admin | Thành viên')
 @Section('content')
     <div class="container-fluid">

         <div class="searchAdmin">
             <form id="filterFormAdministration" action="{{ route('searchAdminstration') }}" method="post">
                 @csrf
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc theo tên đăng nhập</label>
                             <input class="form-control rounded-0" name="filter_name" placeholder="Tên đăng nhập"
                                 type="text" value="{{ $filter_name ?? '' }}">
                         </div>
                     </div>

                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc theo nhóm người dùng</label>
                             <select class="form-select rounded-0" aria-label="Default select example"
                                 name="filter_adminGroup">
                                 <option value="">Tất cả</option>
                                 @foreach ($administrationGroup as $item)
                                     <option value="{{ $item->id }}">{{ $item->name }} </option>
                                 @endforeach

                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc người dùng
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
                     <button type="button" class="btn btnF1"
                         onclick="window.location.href='{{ route('addAdminstration') }}'">
                         <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo mới người dùng
                     </button>
                     <button class="btn btnF2" type="button"
                         onclick="submitForm('{{ route('deleteAdminstration') }}','post')"><i class="pe-2 fa-solid fa-trash"
                             style="color: #ffffff;"></i>Xóa
                         người dùng</button>
                 </div>
             </div>
             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách người dùng</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class="py-2"></th>
                             <th class="py-2">Tên đăng nhập</th>
                             <th class="py-2">Trạng thái</th>
                             <th class="py-2">Nhóm người dùng</th>
                             <th class="py-2">Hành động</th>

                         </tr>
                     </thead>
                     <tbody class="table-body">
                         @foreach ($administration as $item)
                             <tr class="">
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx_{{ $item->id }}" class="hidden-xs-up"
                                             name="administration_id[]" value="{{ $item->id }}">
                                         <label for="cbx_{{ $item->id }}" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td>{{ $item->username }}</td>
                                 <td class="">
                                     <div class="form-check form-switch">
                                         <input class="form-check-input" type="checkbox" role="switch"
                                             data-id="{{ $item->id }}" id="flexSwitchCheckChecked"
                                             {{ $item->status == 1 ? 'checked' : '' }}>
                                         <label class="form-check-label" for="flexSwitchCheckChecked">
                                             {{ $item->status == 1 ? 'Bật' : 'Tắt' }}</label>
                                     </div>
                                 </td>
                                 <td>{{ $item->administrationGroup->name }}</td>
                                 <td class="m-0 p-0">
                                     <div class="actionAdminProduct m-0 py-3">
                                         <button type="button" class="btnActionProductAdmin2"><a
                                                 href="{{ route('editAdminstration', $item->id) }}"
                                                 class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                     style="color: #ffffff;"></i>Chỉnh sửa người dùng</a></button>
                                     </div>
                                 </td>
                             </tr>
                         @endforeach

                     </tbody>
                 </table>
                 <nav class="navPhanTrang">
                     {{ $administration->links() }}
                 </nav>
             </div>
         </form>
     </div>


 @endsection

 @section('administrationScript')
     <script>
         $(document).ready(function() {
             $('.form-check-input').on('click',
                 function() { // thiết lập sự kiện click -> Khi một checkbox được nhấp, hàm bên trong sẽ được gọi.
                     var administration_id = $(this).data(
                         'id'
                     ); //Lấy giá trị của thuộc tính data-id từ checkbox được nhấp và lưu vào biến administration_id
                     var status = $(this).is(':checked') ? 1 : 0;
                     var label = $(this).siblings('label');
                     updateStatusAdministration(administration_id, status, label);
                 })
         })

         function updateStatusAdministration(administration_id, status, label) {
             $.ajax({
                 url: '{{ route('adminstrationUpdateStatus', ':id') }}'.replace(':id', administration_id),
                 type: 'PUT',
                 data: {
                     '_token': '{{ csrf_token() }}',
                     'status': status //biến này chứa giá trị mà bạn mún gửi lên serve
                 },
                 success: function(response) {
                     if (response.success) {
                         label.text(status == 1 ? 'Bật' : 'Tắt');
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
             $('#filterFormAdministration').on('submit', function() {
                 var formData = $(this)
                     .serialize(); //.serialize(): Phương thức này sẽ lấy tất cả các trường trong form (các input, select, v.v.) và chuyển đổi chúng thành một chuỗi URL-encoded.
                 $.ajax({
                     url: '{{ route('searchAdminstration') }}',
                     type: 'post',
                     data: formData,
                     success: function(response) {
                         $('.table-body').html(response
                             .html
                         ); //.html() sẽ thay thế nội dung HTML hiện tại của phần tử được chọn bằng nội dung mới  // response.html là dữ liệu mà server trả về sau khi thực hiện yêu cầu AJAX.
                     }
                     error: function(error) {
                         console.error('Lỗi khi lọc' + error);
                     }
                 })
             })
         })
     </script>
 @endsection
