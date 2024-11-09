 @extends('admin.layout.layout')
 @Section('title', 'Admin | Thêm vị trí hình ảnh')
 @Section('content')

     <div class="container-fluid">

         <form action="{{ route('bannerManageAddForm') }}" method="post" class="formAdmin">
             @csrf
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Thêm vị trí hình ảnh
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tên vị trí hình ảnh</label>
                 <input type="text" class="form-control" name="name" aria-describedby="title"
                     placeholder="Nhập tên vị trí">
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Vị trí hình ảnh</label>
                 <input type="number" class="form-control" name="position" aria-describedby="title"
                     placeholder="Nhập vị trí">
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select" aria-label="Default select example" name="status">
                     <option value="0">Vô hiệu hóa</option>
                     <option value="1">Kích hoạt</option>
                 </select>
             </div>
         </form>
     </div>

 @endsection
