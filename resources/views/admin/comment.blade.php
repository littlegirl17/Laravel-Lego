 @extends('admin.layout.layout')
 @Section('title', 'Admin | Bình luận')
 @Section('content')

     <div class="container-fluid">

         <div class="searchAdmin">
             <form id="filterFormComment"action="{{ route('searchComment') }}" method="POST">
                 @csrf
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-md-4">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc bình luận theo số sao</label>
                             <select class="form-select  rounded-0" aria-label="Default select example" name="filter_rating">
                                 <option value="">Tất cả</option>
                                 <option value="5"> 5 sao</option>
                                 <option value="4"> 4 sao</option>
                                 <option value="3"> 3 sao</option>
                                 <option value="2"> 2 sao</option>
                                 <option value="1"> 1 sao</option>

                             </select>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc sản phẩm</label>
                             <select class="form-select  rounded-0" aria-label="Default select example" name="filter_name">
                                 <option value="">Tất cả</option>
                                 @foreach ($products as $item)
                                     <option value="{{ $item->id }}" {{ $item->id == $filter_name ? 'selected' : '' }}>
                                         {{ $item->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Trạng thái</label>
                             <select class="form-select  rounded-0" aria-label="Default select example"
                                 name="filter_status">
                                 <option value="">Tất cả</option>
                                 <option value="1">Bật
                                 </option>
                                 <option value="0">Tắt
                                 </option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc bình luận</button>
                 </div>
             </form>
         </div>

         <form id="submitFormAdmin">
             <div class="buttonProductForm mt-3">
                 <div class=""></div>
                 <div class=""> </div>
             </div>

             <div class="border p-2 mt-3">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Bình luận</h4>
                 <table class="table table-bordered  pt-3">
                     <thead class="table-header">
                         <tr class="">
                             <th class=" py-2">Người bình luận</th>
                             <th class=" py-2">Sản phẩm</th>
                             <th class=" py-2">Rating</th>
                             <th class=" py-2">Trạng thái</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>

                     <tbody class="table-body">
                         @foreach ($comments as $item)
                             <tr class="">
                                 <td class="">{{ $item->user->fullname }}</td>
                                 <td>{{ $item->rating }}<i class="fa-solid fa-star ps-1" style="color: #FFD43B;"></i></td>
                                 <td class="nameAdmin">
                                     <p>{{ $item->product->name }}</p>
                                 </td>
                                 <td class="">
                                     <div class="form-check form-switch">
                                         <input class="form-check-input" type="checkbox" role="switch"
                                             data-id="{{ $item->id }}" id="flexSwitchCheckChecked"
                                             {{ $item->status == 1 ? 'checked' : 0 }}>
                                         <label class="form-check-label"
                                             for="flexSwitchCheckChecked">{{ $item->status == 1 ? 'Bật' : 'Tắt' }}</label>
                                     </div>
                                 </td>
                                 <td>
                                     <div class="actionAdminProduct m-0 py-3">
                                         <button class="btnActionProductAdmin2"><a
                                                 href="{{ route('commentDetail', $item->id) }}"
                                                 class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                     style="color: #ffffff;"></i>Chi tiết</a></button>
                                     </div>
                                 </td>
                             </tr>
                         @endforeach

                     </tbody>
                 </table>
                 <nav class="navPhanTrang">
                     {{ $comments->links() }}
                 </nav>
             </div>
         </form>

     </div>


 @endsection

 @section('commentAdminScript')
     <script>
         $(document).ready(function() {
             $('.form-check-input').on('click', function() {
                 // (this) tham chiếu đến phần tử html đó
                 var comment_id = $(this).data(
                     'id'); //lấy ra id danh mục thông qua data-id="item->id"
                 var status = $(this).is(':checked') ? 1 : 0; //is() trả về true nếu phần tử khớp với bộ chọn
                 var label = $(this).siblings('label'); // Lấy label liền kề
                 updateCommentStatus(comment_id, status, label);
             });

         })

         function updateCommentStatus(comment_id, status, label) {
             $.ajax({
                 url: '{{ route('commentUpdateStatus', ':id') }}'.replace(':id', comment_id),
                 type: 'PUT',
                 data: {
                     '_token': '{{ csrf_token() }}', //Việc gửi mã token này cùng với mỗi request giúp xác thực rằng request đó được gửi từ ứng dụng của bạn, chứ không phải từ một nguồn khác.
                     'status': status
                 },
                 success: function(response) {
                     console.log('Cập nhật trạng thái thành công');

                     if (status == 1) {
                         label.text('Bật');
                     } else {
                         label.text('Tắt');
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Lỗi khi cập nhật trạng thái bình luận: ' + error);
                 }
             })
         }
     </script>

     <script>
         $(document).ready(function() {
             $('#filterFormComment').on('submit', function() {
                 var formData = $(this).serialize();

                 $.ajax({
                     url: '{{ route('searchComment') }}',
                     type: 'POST',
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
