 @extends('admin.layout.layout')
 @Section('title', 'Admin | Nhóm người dùng')
 @Section('content')

     <div class="container-fluid">
         <form id="submitFormAdmin" onsubmit="event.preventDefault();">
             @csrf
             <div class="buttonProductForm">
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
                         onclick="window.location.href='{{ route('addAdminstrationGroup') }}'">
                         <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo Nhóm người dùng
                     </button>
                     <button class="btn btnF2" type="button"
                         onclick="submitForm('{{ route('deleteAdminstrationGroup') }}','post')">
                         <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa
                     </button>
                 </div>
             </div>

             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Nhóm người dùng</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class=" py-2"></th>
                             <th class=" py-2">Tên Nhóm người dùng</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>
                     <tbody class="">
                         @foreach ($administrationGroup as $item)
                             <tr class="">
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx_{{ $item->id }}" class="hidden-xs-up"
                                             name="administrationGroup_id[]" value="{{ $item->id }}">
                                         <label for="cbx_{{ $item->id }}" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td class="nameAdmin">
                                     <p>{{ $item->name }}</p>
                                 </td>
                                 <td class="m-0 p-0">
                                     <div class="actionAdminProduct m-0 py-3">
                                         <button type="button" class="btnActionProductAdmin2">
                                             <a href="{{ route('editAdminstrationGroup', $item->id) }}"
                                                 class="text-decoration-none text-light">
                                                 <i class="pe-2 fa-solid fa-pen" style="color: #ffffff;"></i>Sửa
                                                 nhóm người dùng</a>
                                         </button>
                                     </div>
                                 </td>
                             </tr>
                         @endforeach

                     </tbody>
                 </table>
                 <nav class="navPhanTrang">
                     {{ $administrationGroup->links() }}
                 </nav>
             </div>
         </form>

         <nav class="navPhanTrang">
             <ul class="pagination">
             </ul>
         </nav>
     </div>

     <script>
         document.addEventListener("DOMContentLoaded", function() {
             const alertBox = document.getElementById("alertAction");
             const progressBar = document.getElementById("progress-bar");

             // Bắt đầu thanh chạy
             progressBar.style.width = "100%"; // Di chuyển thanh từ 0% đến 100%

             // Sau 5 giây, ẩn alert
             setTimeout(() => {
                 alertBox.style.opacity = "0"; // Từ từ giảm độ mờ
                 setTimeout(() => {
                     alertBox.style.display = "none"; // Ẩn hoàn toàn
                 }, 500); // Thời gian giảm độ mờ
             }, 5000); // Thời gian thanh chạy
         });
     </script>
 @endsection
