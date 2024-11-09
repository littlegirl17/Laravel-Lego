 @extends('admin.layout.layout')
 @Section('title', 'Admin|Thêm thành viên')
 @Section('content')

     <div class="container-fluid">

         <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Thêm khách hàng mới
                     </h3>
                     @if ($errors->any())
                         @foreach ($errors->all() as $error)
                             <div id="alert-message" class="alertDanger">{{ $error }}</div>
                         @endforeach
                     @endif
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>
             <div class="form-group mt-3">
                 <label for="name" class="form-label">Tên người dùng</label>
                 <input type="text" class="form-control" id="name" name="name" required>
                 @error('name')
                     <div class="text-danger">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="email" class="form-label">Email</label>
                 <input type="email" class="form-control" id="email" name="email" required>
                 @error('email')
                     <div class="text-danger">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="phone" class="form-label">Số điện thoại</label>
                 <input type="text" class="form-control" id="phone" name="phone" maxlength="15">
                 @error('phone')
                     <div class="text-danger">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="password" class="form-label">Mật khẩu </label>
                 <input type="password" class="form-control" id="password" name="password">
                 @error('password')
                     <div class="text-danger">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="" class="form-label">Xác nhận lại mật khẩu </label>
                 <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tỉnh thành</label>
                 <select class="form-select selectForm " name="province" id="province">
                     <option selected disabled>Tỉnh/Thành phố</option>
                 </select>
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Quận huyện</label>
                 <select class="form-select selectForm " name="district" id="district">
                     <option selected disabled>Quận/Huyện</option>
                 </select>
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Phường xã</label>
                 <select class="form-select selectForm " name="ward" id="ward">
                     <option selected disabled>Phường/Xã</option>
                 </select>
             </div>
             <div class="form-group mt-3">
                 <label for="exampleInputFile" class="label_admin">Ảnh sản phẩm</label>
                 <div class="custom-file imageAdd p-3 ">
                     <div class="imageFile">
                         <div id="preview"><img src="{{ asset('img/lf.png') }}" alt=""></div>
                     </div>
                     <div class="">
                         <input type="file" class="form-control" id="image" name="image" accept="image/*">
                     </div>
                 </div>
                 @error('image')
                     <div class="text-danger">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="description" class="form-label">Chọn nhóm khách hàng</label>
                 <select class="form-select " name="user_group_id">
                     @foreach ($userGroups as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                     @endforeach
                 </select>
             </div>
             <div class="form-group mt-3">
                 <select class="form-select " name="status">
                     <option selected>Trang thái</option>
                     <option value="1">Kích hoạt</option>
                     <option value="0">Vô hiệu hóa</option>
                 </select>
             </div>
         </form>
     </div>

 @endsection
