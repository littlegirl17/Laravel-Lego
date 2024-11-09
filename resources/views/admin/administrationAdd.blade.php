@extends('admin.layout.layout')
@Section('title', 'Admin | Thêm thành viên')
@Section('content')


    <div class="container-fluid">

        <h3 class="title-page ">
            Thêm người dùng
        </h3>
        <div class="row " style="margin-left: 1100px;">

        </div>
        <form action="{{ route('addFormAdminstration') }}" method="post" class="formAdmin" enctype="multipart/form-data">
            @csrf
            <div class="buttonProductForm">
                <div class="">
                    @if (session('error'))
                        <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                    @endif
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="fullname" name="fullname">
                @error('fullname')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username">
                @error('username')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="description" class="form-label">Chọn nhóm người dùng</label>
                <select class="form-select " name="admin_group_id">
                    <option value="0">Mặc định</option>
                    @foreach ($administrationGroup as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('admin_group_id')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
                @error('email')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputFile" class="label_admin">Image</label>
                <div class="custom-file">
                    <input type="file" name="image" id="HinhAnh">
                    <div id="preview"></div>
                </div>

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
                <select class="form-select " name="status">
                    <option selected>Trang thái</option>
                    <option value="1">Kích hoạt</option>
                    <option value="0">Vô hiệu hóa</option>
                </select>
                @error('status')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
        </form>
    </div>


@endsection
