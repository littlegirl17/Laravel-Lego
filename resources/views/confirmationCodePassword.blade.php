@extends('layout.layout')
@section('title', 'Xác minh mã xác nhận')
@section('content')
    <!-- START MAIN -->
    <div class="bg_login">
        <div class="container">
            <div class="login_main">
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
                <form action="{{ route('confirmationPasswordForm') }}" method="post">
                    @csrf
                    <div class="login_content">
                        <div class="title">
                            <h2>Nhập mã xác nhận</h2>
                        </div>
                        <div class="login_item">
                            <label for="">Nhập mã code</label>
                            <input type="number" name="verification_code" placeholder="Nhập mã xác nhận" />
                            <input type="hidden" name="email" value="{{ session('email') }}">
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
