@extends('layout.layout')
@section('title', 'Đăng nhập')
@section('content')
    <!-- START MAIN -->
    <div class="bg_login">
        <div class="container">
            <div class="login_main">
                <form action="{{ route('loginForm') }}" method="post">
                    @csrf
                    <div class="form_admin_alrt">
                        @if (session('error'))
                            <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                        @endif

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
                            <h2>Đăng nhập</h2>
                        </div>
                        <div class="login_item">
                            <label for="">Email</label>
                            <input type="email" name="email" placeholder="Nhập email" />
                        </div>
                        <div class="login_item">
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" placeholder="Nhập mật khẩu" />
                            <label for="" class="login_forgetpw"><a href="{{ route('forgetPassword') }}"
                                    class="">Quên mật
                                    khẩu</a></label>
                        </div>
                        <div>
                            <button class="btn_login">Đăng nhập</button>
                        </div>
                        <div class="border-container-login">
                            <hr class="border-left" />
                            <span>Hoặc</span>
                            <hr class="border-right" />
                        </div>
                        <div class="login_regis">
                            <span>Bạn chưa có tài khoản?</span>
                            <a href="{{ route('register') }}">
                                <span>Đăng ký thành viên<i class="fa-solid fa-arrow-right ps-1"></i></span></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MAIN -->

@endsection
