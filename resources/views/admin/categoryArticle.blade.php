@extends('admin.layout.layout')
@Section('title', 'Admin | Danh mục bài viết')
@Section('content')

    <div class="container-fluid">

        <div class="searchAdmin">
            <form id="filterFormCategory" action="{{ route('categoryArticle') }}" method="GET">
                <div class="row d-flex flex-row justify-content-between align-items-center">
                    <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input class="form-control rounded-0" name="filter_name" placeholder="Tên danh mục"
                                type="text" value="{{ request('filter_name') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <label for="title" class="form-label">Trạng thái</label>
                            <select class="form-select rounded-0" aria-label="Default select example" name="filter_status">
                                <option value="">Tất cả</option>
                                <option value="1" {{ request('filter_status') == '1' ? 'selected' : '' }}>Kích hoạt
                                </option>
                                <option value="0" {{ request('filter_status') == '0' ? 'selected' : '' }}>Vô hiệu hóa
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-end">
                    <button type="submit" class="btn borrder-0 rounded-0 text-light my-3" style="background: #4099FF">
                        <i class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc danh mục
                    </button>
                </div>
            </form>

        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div id="submitFormAdmin">
            <div class="buttonProductForm mt-3">
                <div class="m-0 p-0">
                    @if (session('error'))
                        <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="">
                    <a href="{{ route('categoryArticleAdd') }}" class="btn btnF1 text-decoration-none text-light">
                        <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo danh mục
                    </a>
                    <button class="btn btnF2" type="button" onclick="document.getElementById('deleteForm').submit();">
                        <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa danh mục đã chọn
                    </button>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="border p-2">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Danh Mục Bài Viết</h4>

                <form id="deleteForm" action="{{ route('categoryArticleBulkDelete') }}" method="POST"
                    style="display:inline;">
                    @csrf
                    <table class="table table-bordered pt-3">
                        <thead class="table-header">
                            <tr>
                                <th class="py-2"></th>
                                <th class="py-2">Hình ảnh</th>
                                <th class="py-2">Tiêu đề</th>
                                <th class="py-2">Trạng thái</th>
                                <th class="py-2">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @foreach ($CA as $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="category_ids[]" value="{{ $item->id }}">
                                    </td>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ asset('img/' . $item->image) }}" alt=""
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('img/lf.png') }}"
                                                alt=""style="width: 80px; height: 80px; object-fit: cover;">
                                        @endif

                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                data-id="{{ $item->id }}" id="switch-{{ $item->id }}"
                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="switch-{{ $item->id }}">{{ $item->status == 1 ? 'Bật' : 'Tắt' }}</label>
                                        </div>
                                    </td>

                                    <td class="m-0 p-0">
                                        <div class="actionAdminProduct">
                                            <div class="buttonProductForm m-0 py-3">
                                                <button type="button" class="btnActionProductAdmin2"><a
                                                        href="{{ route('categoryArticleEdit', $item->id) }}"
                                                        class="text-decoration-none text-light"><i
                                                            class="pe-2 fa-solid fa-pen" style="color: #ffffff;"></i>Chỉnh
                                                        sửa</a></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        </table>
        <nav class="navPhanTrang">
            {{ $CA->links() }}
        </nav>

    </div>

@endsection

@section('categoryArticleAdminScript')
    <script>
        $(document).ready(function() {
            $('.form-check-input').on('click', function() {
                var category_id = $(this).data('id'); // Lấy ID danh mục
                var status = $(this).is(':checked') ? 1 : 0; // Xác định trạng thái
                var label = $(this).siblings('label'); // Lấy label liền kề
                updateStatusCategoryArticle(category_id, status, label);
            });
        });

        function updateStatusCategoryArticle(category_id, status, label) {
            $.ajax({
                url: '{{ route('categoryArticleUpdateStatus', ':id') }}'.replace(':id', category_id),
                type: 'PUT',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status
                },
                success: function(response) {
                    console.log('Cập nhật trạng thái danh mục thành công');
                    label.text(status == 1 ? 'Bật' : 'Tắt'); // Cập nhật label
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi cập nhật trạng thái danh mục: ' + error);
                    alert('Có lỗi xảy ra. Vui lòng thử lại!');
                }
            });
        }
    </script>

    {{-- <script>
   $(document).ready(function() {
       $('#filterFormCategory').on('submit', function() {
           var formData = $(this).serialize();
           //serialize: duyệt qua tất cả các phần tử đầu vào, chọn các phần tử input, select, và textarea trong biểu mẫu (form), và thu thập các giá trị của chúng.

           $.ajax({
               url: '{{ route('searchCategory') }}',
               type: 'GET',
               data: formData,
               success: function(response) {
                   // Cập nhật bảng danh mục với kết quả lọc
                   $('.table-body').html(response.html);
               },
               error: function(error) {
                   console.error('Lỗi khi lọc danh mục' + error);
               }
           })
       })
   })
</script> --}}
@endsection
