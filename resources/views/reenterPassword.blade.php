@extends('layout.layout')
@section('title', 'Đặt lại mật khẩu')
@section('content')
    <!-- START MAIN -->
    <div class="bg_login">
        <div class="container">
            <div class="login_main">
                <form action="{{ route('resetPassword') }}" method="post">
                    @csrf
                    <div class="form_admin_alrt">
                        @if ($errors->any())
                            <div class="errors">
                                @foreach ($errors->all() as $error)
                                    <div id="alert-message" class="alertErrors">
                                        {{ $error }} </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="login_content">
                        <div class="title">
                            <h2>Nhập mật khẩu mới</h2>
                        </div>
                        <div class="login_item">
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" placeholder="Nhập mật khẩu mới" />
                        </div>
                        <div class="login_item">
                            <label for="">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" placeholder="Nhập mật khẩu" />
                        </div>
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <div>
                            <button class="btn_login">Đặt lại mật khẩu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
@endsection
