@extends('layout.layout')
@section('title', 'Đăng ký')
@section('content')
    <!-- START MAIN -->
    <div class="bg_register">
        <div class="container">
            <div class="login_main">
                <div class="login_content">
                    <div class="title">
                        <h2>Đăng ký</h2>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="login_item">
                            <label for="name">Tên</label>
                            <input type="text" name="name" placeholder="Nhập tên của bạn" value="{{ old('name') }}"
                                required />
                            @error('name')
                                <div class="text-danger" id="alert-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="login_item">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Nhập email" value="{{ old('email') }}"
                                required />
                            @error('email')
                                <div class="text-danger"id="alert-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="login_item">
                            <label for="phone">Số điện thoại</label>
                            <input type="number" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}"
                                required />
                            @error('phone')
                                <div class="text-danger"id="alert-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="login_item">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" placeholder="Nhập mật khẩu" required />
                            @error('password')
                                <div class="text-danger" id="alert-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="login_item">
                            <label for="password_confirmation">Nhập lại mật khẩu</label>
                            <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required />
                            @error('password_confirmation')
                                <div class="text-danger" id="alert-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn_login">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
@endsection
