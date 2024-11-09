@extends('admin.layout.layout')
@section('title', 'Admin | Thêm nhóm khách hàng')
@section('content')
    <div class="container-fluid">

        <div class="formAdminAlert">
            @if(session('success'))
                <div class="alert alert-success py-2">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger py-2">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <form action="{{ route('createUserGroup') }}" method="post" class="formAdmin">
            @csrf
            <div class="buttonProductForm">
                <div class="">
                    <h3 class="title-page">
                        Thêm nhóm khách hàng
                    </h3>
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="name" class="form-label">Tên nhóm khách hàng</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên nhóm khách hàng" required>
            </div>
        </form>
    </div>
@endsection
