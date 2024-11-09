@extends('admin.layout.layout')
@Section('title', 'Admin | Phản hồi liên hệ')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="">Quay lại</a>
        </div>

        <form action="" class="formAdmin" method="post" class="mt-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="buttonProductForm">
                <div class="">
                    <h2 class="title-page ">
                        Chỉnh sửa sản phẩm lắp ráp </h2>
                </div>
                <div class="">

                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group mt-3">
                    <label for="title" class="form-label">Email khách:</label>
                    <input type="Email" class="form-control" name="" placeholder="">
                </div>
                <div class="form-group mt-3">
                    <label for="title" class="form-label">Họ tên:</label>
                    <input type="Email" class="form-control" name="" placeholder="">
                </div>
                <div class="form-group mt-3">
                    <label for="title" class="form-label">Số điện thoại:</label>
                    <input type="Email" class="form-control" name="" placeholder="">
                </div>
                <div class="form-group mt-3">
                    <label for="email" class="form-label">Nội dung khách gửi</label>
                    <textarea class="form-control" id="" name="" rows="5">
                    </textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="email" class="form-label">Ngày gửi</label>

                </div>
            </div>
        </form>
    </div>

@endsection
