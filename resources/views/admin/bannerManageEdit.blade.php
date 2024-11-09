 @extends('admin.layout.layout')
 @Section('title', 'Admin | Chỉnh sửa vị trí hình ảnh')
 @Section('content')

     <div class="container-fluid">

         <form action="{{ route('editBannerManage', $bannner->id) }}" method="post" class="formAdmin">
             @csrf
             @method('put')
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa vị trí hình ảnh
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
                     placeholder="Nhập tên vị trí" value="{{ $bannner->name }}">
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Vị trí hình ảnh</label>
                 <input type="number" class="form-control" name="position" aria-describedby="title"
                     placeholder="Nhập vị trí" value="{{ $bannner->position }}">
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select" aria-label="Default select example" name="status">
                     <option value="0" {{ $bannner->position == 0 ? 'selected' : '' }}>Vô hiệu hóa</option>
                     <option value="1" {{ $bannner->position == 1 ? 'selected' : '' }}>Kích hoạt</option>
                 </select>
             </div>
         </form>
     </div>

 @endsection
