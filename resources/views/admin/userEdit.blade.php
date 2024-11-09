@extends('admin.layout.layout')
@Section('title', 'Admin| Sửa khách hàng')
@Section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="">Quay lại</a>
        </div>
        <form class="formAdmin" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="buttonProductForm">
                <div class="">
                    <h3 class="title-page ">
                        Chỉnh sửa khách hàng
                    </h3>
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>
            <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Chung</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Bảo
                        mật</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mt-3">
                                <label for="name" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $user->phone) }}" maxlength="15">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Tỉnh/Thành phố</label>
                                <select class="form-select" aria-label="Default select example" name="province"
                                    id="province">
                                    @if ($user->province)
                                        <option selected value="{{ $user->province }}">{{ $user->province }}</option>
                                    @else
                                        <option selected disabled>Tỉnh/Thành phố</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Quận/Huyện</label>
                                <select class="form-select" aria-label="Default select example" name="district"
                                    id="district">
                                    @if ($user->district)
                                        <option selected value="{{ $user->district }}">{{ $user->district }}</option>
                                    @else
                                        <option selected disabled>Quận/Huyện</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Phường/Xã</label>
                                <select class="form-select" aria-label="Default select example" name="ward"
                                    id="ward">
                                    @if ($user->ward)
                                        <option selected value="{{ $user->ward }}">{{ $user->ward }}</option>
                                    @else
                                        <option selected disabled>Phường/Xã</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Ảnh tài khoản</label>
                                <div class="custom-file">
                                    <input type="file" name="image" id="HinhAnh" class="inputFile">
                                    <div id="preview" class="imageFile">
                                        <img src="{{ asset('img/' . $user->image) }}" alt="Ảnh xem trước" width="300" height="300" />
                                    </div>
                                </div>
                            </div>


                            <div class="form-group mt-3">
                                <label for="user_group_id" class="form-label">Hạng thành viên</label>
                                <select class="form-select" id="user_group_id" name="user_group_id" required>
                                    @foreach ($userGroups as $userGroup)
                                        <option value="{{ $userGroup->id }}"
                                            {{ old('user_group_id', $user->user_group_id) == $userGroup->id ? 'selected' : '' }}>
                                            {{ $userGroup->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_group_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Trạng thái</label>
                                <select class="form-select mt-3" aria-label="Default select example" name="status">
                                    <option value="0"{{ $user->status == 0 ? 'selected' : '' }}>Vô hiệu hóa</option>
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab">
                @if ($errors->any())
                    <div id="alert-message" class="alertDanger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <div class="form-group mt-3">
                    <label for="password" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group mt-3">
                    <label for="" class="form-label">Xác nhận lại mật khẩu mới</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

            </div>
        </form>
    </div>
@endsection
