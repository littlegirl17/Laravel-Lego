 @extends('admin.layout.layout')
 @Section('title', 'Admin| Sửa người dùng')
 @Section('content')

     <div class="container-fluid">

         <h3 class="title-page ">
             Chỉnh sửa người dùng
         </h3>
         <form action="{{ route('editAdminstration', $administration->id) }}" method="post" class="formAdmin"
             enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="buttonProductForm">
                 <div class=""></div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>

             <div class="row">
                 <div class="form-group mt-3">
                     <label for="title" class="form-label">Họ và tên</label>
                     <input type="text" class="form-control" id="fullname" name="fullname"
                         value="{{ $administration->fullname }}">
                     @error('fullname')
                         <div class="text-danger" id="alert-message">{{ $message }}</div>
                     @enderror
                 </div>
                 <div class="form-group mt-3">
                     <label for="title" class="form-label">Tên đăng nhập</label>
                     <input type="text" class="form-control" id="" name="username"
                         value="{{ $administration->username }}">
                     @error('username')
                         <div class="text-danger" id="alert-message">{{ $message }}</div>
                     @enderror
                 </div>
                 <div class="form-group mt-3">
                     <label for="description" class="form-label">Nhóm người dùng</label>
                     <select class="form-select " name="admin_group_id">
                         @foreach ($administrationGroup as $item)
                             <option value="{{ $item->id }}"
                                 {{ $item->id == $administration->admin_group_id ? 'selected' : '' }}>{{ $item->name }}
                             </option>
                         @endforeach
                     </select>
                     @error('admin_group_id')
                         <div class="text-danger" id="alert-message">{{ $message }}</div>
                     @enderror
                 </div>

                 <div class="form-group mt-3">
                     <label for="title" class="form-label">Email</label>
                     <input type="email" class="form-control" id="email" name="email"
                         value="{{ $administration->email }}">
                     @error('email')
                         <div class="text-danger" id="alert-message">{{ $message }}</div>
                     @enderror
                 </div>
                 <div class="form-group mt-3">
                     <label for="title" class="form-label">Image</label>
                     <div class="custom-file">
                         <input type="file" name="image" id="HinhAnh">
                         @if ($administration->image)
                             <img src="{{ asset('img/' . $administration->image) }}" alt=""
                                 style="width:80px; height:80px; object-fit:cover;">
                         @endif
                     </div>
                     @error('image')
                         <div class="text-danger" id="alert-message">{{ $message }}</div>
                     @enderror
                 </div>

                 <div class="form-group mt-3">
                     <label for="title" class="form-label">Mật khẩu</label>
                     <input type="password" class="form-control" id="password" name="password">
                     @error('password')
                         <div class="text-danger" id="alert-message">{{ $message }}</div>
                     @enderror
                 </div>
                 <div class="form-group mt-3">
                     <label for="" class="form-label">Xác nhận mật khẩu </label>
                     <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                     @error('password')
                         <div class="text-danger" id="alert-message">{{ $message }}</div>
                     @enderror
                 </div>

                 <div class="form-group mt-3">
                     <label for="title" class="form-label">Trạng thái</label>
                     <select class="form-select " name="status">
                         <option value="0" {{ $administration->status == 0 ? 'selected' : '' }}>Vô hiệu hóa</option>
                         <option value="1" {{ $administration->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                     </select>
                     @error('status')
                         <div class="text-danger" id="alert-message">{{ $message }}</div>
                     @enderror
                 </div>
             </div>
         </form>
     </div>

 @endsection
