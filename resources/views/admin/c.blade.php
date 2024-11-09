<!-- @extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Danh mục')
@Section('content') -->


<div class="container-fluid">
    <h3 class="title-page ">
        Thùng rác bài viết
    </h3>
    <form action="/search" method="GET">
        <input class="inputSearch_Admin" name="search" placeholder="Nhập từ khóa tìm kiếm" type="search">
        <button type="submit" class="btn-coupon">Tìm kiếm</button>
    </form>

    <button class="btnFormAdd mb-3">
        <a href="" class="text-decoration-none ">Thêm</a>
    </button>

    <div class="table pt-3">
        <div class="table-header">
            <div class="header__item py-2">Hình ảnh</div>
            <div class="header__item py-2">Tiêu đề</div>
            <div class="header__item py-2">Ngày đăng</div>
            <div class="header__item py-2">Trạng thái</div>
            <div class="header__item py-2">Hành động</div>
        </div>
        <div class="table-content">
            <div class="table-row">
                <div class="table-data"><img src="" alt="">
                </div>
                <div class="table-data"></div>
                <div class="table-data"></div>
                <div class="table-data">
                    <img src="https://img.icons8.com/material-rounded/24/FA5252/toggle-off.png" alt="toggle-off"
                        style="width:25px;height:25px; object-fit:cover;" />
                    <div class="">
                        <img src="https://img.icons8.com/ios-filled/50/40C057/toggle-on.png" alt="toggle-on"
                            style="width:25px;height:25px; object-fit:cover;" />
                    </div>
                </div>
                <div class="table-data">
                    <a href="" class="text-decoration-none px-2"><img
                            src="https://img.icons8.com/sf-black-filled/64/1f508d/create-new.png" alt="create-new"
                            style="width:35px;height:35px; object-fit:cover;" /></a>
                    <a href="" class="text-decoration-none "><i class="fa-solid fa-trash"
                            style="color: #ff0505; font-size: 25px;  "></i></a>
                </div>
            </div>

        </div>

    </div>
</div>


<!-- @endsection -->