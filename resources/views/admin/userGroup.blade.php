@extends('admin.layout.layout')
@section('title', 'Admin | Nhóm khách hàng')
@section('content')

    <div class="container-fluid">


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <form id="submitFormAdmin" action="{{ route('userGroupCheckboxDelete') }}" method="POST">
            @csrf
            <div class="buttonProductForm">
                <div class="m-0 p-0">
                    @if (session('error'))
                        <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="m-0 p-0">
                    <a href="{{ route('userGroupAdd') }}" class="btn btnF1 text-decoration-none text-light">
                        <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i> Tạo Nhóm khách hàng
                    </a>
                    <button class="btn btnF2" type="submit">
                        <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa
                    </button>
                </div>

            </div>

            <div class="border p-2">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Nhóm khách hàng</h4>
                <table class="table table-bordered pt-3">
                    <thead class="table-header">
                        <tr>
                            <th class="py-2"><input type="checkbox" id="selectAll"></th>
                            <th class="py-2">Tên Nhóm khách hàng</th>
                            <th class="py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userGroups as $group)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="userGroup_id[]" value="{{ $group->id }}">
                                </td>
                                <td class="nameAdmin">
                                    <p>{{ $group->name }}</p>
                                </td>
                                <td class="m-0 p-0">
                                    <div class="actionAdminProduct m-0 py-3">
                                        <button class="btnActionProductAdmin2">
                                            <a href="{{ route('userGroupEdit', $group->id) }}"
                                                class="btn btnF1 text-decoration-none text-light">
                                                <i class="pe-2 fa-solid fa-pencil-alt" style="color: #ffffff;"></i> Sửa nhóm
                                                khách hàng
                                            </a>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        <nav class="navPhanTrang">
            <ul class="pagination">
                <li></li>
            </ul>
        </nav>
    </div>

    <script>
        document.getElementById('selectAll').onclick = function() {
            let checkboxes = document.querySelectorAll('input[name="userGroup_id[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        };
    </script>

@endsection
