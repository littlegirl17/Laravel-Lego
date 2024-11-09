@extends('admin.layout.layout')
@Section('title', 'Admin | Chỉnh sửa thông tin')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="">Quay lại</a>
        </div>

        <form action="{{ route('editAssembly', $assembly->id) }}" class="formAdmin" method="post" class="mt-5"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="buttonProductForm">
                <div class="">
                    <h2 class="title-page ">
                        Chỉnh sửa sản phẩm lắp ráp </h2>
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 ">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Phí (lắp ráp + gói quà)</th>
                                <th>Gói lắp ráp</th>
                                <th>Người đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="trProduct">
                                <td class="d-flex justify-content-center ">
                                    <img src="{{ asset('img/' . $assembly->product->image) }}" alt=""
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>{{ $assembly->product->name }}</td>
                                <td>
                                    <span class="">{{ $assembly->quantity }}</span>
                                </td>
                                <td>
                                    {{ number_format($assembly->assemblyPackage->price_assembly, 0, ',', '.') . 'đ' }} +
                                    {{ number_format($assembly->assemblyPackage->fee, 0, ',', '.') . 'đ' }}
                                </td>
                                <td>
                                    {{ $assembly->assemblyPackage->name }} <br>
                                    <img src="{{ asset('img/' . $assembly->assemblyPackage->image) }}" alt=""
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="nameAdmin">
                                    <p>{{ $assembly->user->name }}</p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nhân viên lắp ráp</th>
                                <th>Trạng thái lắp ráp sản phẩm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group ">
                                        <select class="form-select" aria-label="Default select example" name="admin_id"
                                            id="" selected>
                                            @foreach ($administrationAssembly as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $assembly->admin_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->fullname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group ">
                                        <select class="form-select" aria-label="Default select example" name="status"
                                            id="" selected>
                                            @foreach ($statusAssembly as $key => $item)
                                                <option value="{{ $key }}"
                                                    {{ $assembly->status == $key ? 'selected' : '' }}>{{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </form>
    </div>

@endsection
