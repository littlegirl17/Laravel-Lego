@extends('admin.layout.layout')
@Section('title', 'Admin | Thêm mã giảm giá')
@Section('content')

    <div class="container-fluid">


        <form action="{{ route('couponAddForm') }}" method="post" class="formAdmin" enctype="multipart/form-data">
            @csrf
            <div class="buttonProductForm">
                <div class="">
                    <h3 class="title-page ">
                        Thêm mã giảm giá
                    </h3>
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên phiếu giảm giá</label>
                <input type="text" class="form-control" name="name_coupon" placeholder="Nhập tên phiếu giảm giá">
                @error('name_coupon')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Mã(code)</label>
                <input type="text" class="form-control" name="code" placeholder="Nhập code">
                @error('code')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Loại(type)</label>
                <select class="form-select mt-3" aria-label="Default select example" name="type">
                    <option value="0">Giảm Giá theo %</option>
                    <option value="1">Số tiền cố định</option>
                </select>
                @error('type')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Giảm giá</label>
                <input type="text" class="form-control" name="discount" placeholder="Nhập giá giảm">
                @error('discount')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Tổng cộng</label>
                <input type="text" class="form-control" name="total" placeholder="Tổng cộng">
                @error('total')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" name="date_start" placeholder="Ngày bắt đầu">

            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" name="date_end" placeholder="Ngày kết thúc">

            </div>
            <select class="form-select mt-3" aria-label="Default select example" name="status">
                <option selected>Trang thái</option>
                <option value="1">Kích hoạt</option>
                <option value="0">Vô hiệu hóa</option>
            </select>
            @error('status')
                <div class="text-danger" id="alert-message">{{ $message }}</div>
            @enderror
        </form>
    </div>


@endsection
