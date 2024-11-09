@extends('layout.layout')
@section('title', 'Quên mật khẩu')
@section('content')
    <!-- START MAIN -->
    <div class="bg_login">
        <div class="container">
            <div class="login_main">
                <form action="{{ route('forgetPasswordForm') }}" method="post">
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
                            <h2>Đặt lại mật khẩu</h2>
                        </div>
                        <div class="login_item">
                            <label for="">Email</label>
                            <input type="email" name="email" placeholder="Nhập email" value="{{ old('email') }}" />
                        </div>
                        <div>
                            <button class="btn_login">Tiếp tục</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
@endsection
