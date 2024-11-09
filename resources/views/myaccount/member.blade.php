@extends('myaccount.layout.layout')
@section('title', 'Tài khoản của tôi')
@section('content_myaccount')
    <div class="container pt_mobile">
        <div class="layout_member">
            <div class="layout_member_left">
                @include('myaccount.menuLeftAccount')
            </div>
            <div class="layout_member_right">
                <form action="{{ route('memberForm', Session::get('user')->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="">
                        <div class="member_img_user">
                            <div class="member_image">
                                <img src="{{ asset('img/' . Session::get('user')->image) }}" alt="" />
                            </div>

                            <div class="member_image_inputfile">
                                <label for="file-upload" class="custom-file-upload">
                                    Chọn ảnh
                                </label>
                                <input type="file" id="file-upload" class="form-control" name="image" value="" />
                            </div>
                        </div>
                        <div class="row member_profile">
                            <div class="col-md-12 py-2">
                                <div class="form-group">
                                    <label for="">Họ và tên:</label>
                                    <input type="text" class="form-control-input" name="fullname"
                                        value="{{ Session::get('user')->fullname }}" />
                                    @error('fullname')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 py-2">
                                <div class="form-group">
                                    <label for="">Tên đăng nhập:</label>
                                    <input type="text" class="form-control-input" name="name"
                                        value="{{ Session::get('user')->name }}" />
                                    @error('name')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 py-2">
                                <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="email" class="form-control-input" name="email"
                                        value="{{ Session::get('user')->email }}" />
                                    @error('email')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 py-2">
                                <div class="form-group">
                                    <label for="">Số điện thoại:</label>
                                    <input type="text" class="form-control-input" name="phone"
                                        value="{{ Session::get('user')->phone }}" pattern="[0-9]*" maxlength="10" />
                                    @error('phone')
                                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="checkout_main_left_one_item_2 pb-3">
                                <div class="checkout_left_one_input">
                                    <label for="">Tỉnh</label>
                                    <select class="form-select" aria-label="Default select example" name="province"
                                        id="province">
                                        @if (Session::has('user'))
                                            <option value="{{ Session::get('user')->province }}">
                                                {{ Session::get('user')->province }}</option>
                                        @else
                                            <option selected disabled>Tỉnh/Thành phố</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="checkout_left_one_input">
                                    <label for="">Quận/Huyện</label>
                                    <select class="form-select" aria-label="Default select example" name="district"
                                        id="district">
                                        @if (Session::has('user'))
                                            <option selected value="{{ Session::get('user')->district }}">
                                                {{ Session::get('user')->district }}</option>
                                        @else
                                            <option selected disabled>Quận/Huyện</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="checkout_left_one_input">
                                    <label for="">Phường/Xã</label>
                                    <select class="form-select" aria-label="Default select example" name="ward"
                                        id="ward">
                                        @if (Session::has('user'))
                                            <option selected value="{{ Session::get('user')->ward }}">
                                                {{ Session::get('user')->ward }}</option>
                                        @else
                                            <option selected disabled>Phường/Xã</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-12 py-2">
                                <div class="d-flex">
                                    <label class="pe-3" for="">Giới tính:</label>
                                    <div class="form-check d-flex">
                                        <input class="form-check-input" type="radio" name="gender"
                                            id="flexRadioDefault1" />
                                        <p class="pe-3" for="">Nam</p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="" />
                                        <p class="pe-3">Nữ</p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="" />
                                        <p class="pe-3">Khác</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <button class="btn_checkout">Lưu</button>
                            </div>
                            <div class="col-md-8 col-sm-8"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
