@extends('admin.layout.layout')
@Section('title', 'Admin | Sửa nhóm khách hàng')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <h3 class="title-page ">
                Chỉnh sửa nhóm khách hàng
            </h3>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="">Quay lại</a>
        </div>

        <form action="{{ route('updateUserGroup', $userGroup->id) }}" method="post" class="formAdmin"
            enctype="multipart/form-data">
            @csrf
            <div class="buttonProductForm ">
                <button type="submit" class="btn btnF3">Lưu</button>
            </div>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên nhóm khách hàng</label>
                <input type="text" class="form-control" name="name" value="{{ $userGroup->name }}">
            </div>
        </form>
    </div>
@endsection
