@extends('myaccount.layout.layout')
@section('title', 'Quên mật khẩu')
@section('content_myaccount')
    <div class="container pt_mobile">
        <div class="layout_member">
            <div class="layout_member_left">
                @include('myaccount.menuLeftAccount')
            </div>
            <div class="layout_member_right">
                <form action="{{ route('forgetPasswordAccountForm') }}" method="POST">
                    @csrf
                    <div class="">
                        @if (session('success'))
                            <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                        @endif
                        <div class="layout_member_right_title">
                            <h2>Thay đổi mật khẩu</h2>
                            <div class="form-group">
                                <label for="">Mật khẩu</label>
                                <input type="password" class="form-control-input-pw" name="password_old" value="" />
                                @if (session('error'))
                                    <div class="text-danger"id="alert-message">{{ session('error') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu</label>
                                <input type="password" class="form-control-input-pw" name="password" value="" />
                            </div>
                            <div class="form-group pt-3">
                                <label for="">Xác nhận lại mật khẩu</label>
                                <input type="password" class="form-control-input-pw" name="password_confirmation"
                                    value="" />
                                @if (session('errorConfirmation'))
                                    <div class="text-danger"id="alert-message">{{ session('errorConfirmation') }}</div>
                                @endif
                            </div>
                            <div class="btn_row">
                                <button type="submit" class="btn_checkout">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="account_password_img">
                    <img src="{{ asset('img/changePass.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
