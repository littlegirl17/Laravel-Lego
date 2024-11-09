@extends('admin.layout.layout')
@Section('title', 'Admin | Thêm nhóm người dùng')
@Section('content')

    <div class="container-fluid">


        <form action="{{ route('addFormAdminstrationGroup') }}" method="post" class="formAdmin">
            @csrf
            <div class="buttonProductForm">
                <div class="">
                    <h3 class="title-page ">
                        Thêm nhóm người dùng
                    </h3>
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên nhóm người dùng</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên nhóm người dùng">
                @error('name')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-3">
                        <label for="title" class="form-label">Thiết lập quền hạn </label>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input id="banner" type="checkbox" name="permission[]" value="banner">
                                <span class="checkmark"></span>
                            </label>
                            <p>Banner</p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="category" id="category">
                                <span class="checkmark"></span>
                            </label>
                            <p>Category </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="product" id="product">
                                <span class="checkmark"></span>
                            </label>
                            <p>Product </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="comment" id="comment">
                                <span class="checkmark"></span>
                            </label>
                            <p>Comment </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="coupon" id="coupon">
                                <span class="checkmark"></span>
                            </label>
                            <p>Coupon </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="order" id="order">
                                <span class="checkmark"></span>
                            </label>
                            <p>Order </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="user" id="user">
                                <span class="checkmark"></span>
                            </label>
                            <p>User </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="userGroup" id="userGroup">
                                <span class="checkmark"></span>
                            </label>
                            <p>UserGroup </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="administration"
                                    id="administration">
                                <span class="checkmark"></span>
                            </label>
                            <p>Administration </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="administrationGroup"
                                    id="administrationGroup">
                                <span class="checkmark"></span>
                            </label>
                            <p>AdministrationGroup </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="categoryArticle"
                                    id="categoryArticle">
                                <span class="checkmark"></span>
                            </label>
                            <p>Category Article </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="article"
                                    id="article">
                                <span class="checkmark"></span>
                            </label>
                            <p>Article </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="assembly"
                                    id="assembly">
                                <span class="checkmark"></span>
                            </label>
                            <p> Assembly(Lắp ráp Lego)</p>
                        </div>


                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="favourite"
                                    id="favourite">
                                <span class="checkmark"></span>
                            </label>
                            <p> Favourite(Sản phẩm yêu thích)</p>
                        </div>

                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="contact"
                                    id="contact">
                                <span class="checkmark"></span>
                            </label>
                            <p> Contact(Liên hệ)</p>
                        </div>
                    </div>
                    @error('permission')
                        <div class="text-danger" id="alert-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-3">
                        <label for="title" class="form-label">Thiết lập quền hạn thêm sửa xóa</label>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="bannerAdd"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="bannerEdit"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="bannerCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="categoryAdd"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="categoryEdit"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="categoryCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="productAdd"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="productEdit"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="productCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="commentAdd"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="commentEdit"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="commentCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="couponAdd"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="couponEdit"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="couponCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="orderAdd" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="orderEdit"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="orderCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="userAdd" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userEdit" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userCheckboxDelete"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="userGroupAdd"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userGroupEdit"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="userGroupCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="adminstrationAdd"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="adminstrationEdit"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]"
                                        value="adminstrationGroupAdd" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationGroupEdit" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationGroupCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="categoryArticleAdd"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="categoryArticleEdit" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="categoryArticleCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="articleAdd"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="articleEdit"
                                        disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="articleCheckboxDelete" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const permissionGroups = {
                'banner': ['bannerAdd', 'bannerEdit', 'bannerCheckboxDelete'],
                'category': ['categoryAdd', 'categoryEdit', 'categoryCheckboxDelete'],
                'product': ['productAdd', 'productEdit', 'productCheckboxDelete'],
                'comment': ['commentAdd', 'commentEdit', 'commentCheckboxDelete'],
                'coupon': ['couponAdd', 'couponEdit', 'couponCheckboxDelete'],
                'order': ['orderAdd', 'orderEdit', 'orderCheckboxDelete'],
                'user': ['userAdd', 'userEdit', 'userCheckboxDelete'],
                'userGroup': ['userGroupAdd', 'userGroupEdit', 'userGroupCheckboxDelete'],
                'administration': ['administrationAdd', 'administrationEdit', 'administrationCheckboxDelete'],
                'administrationGroup': ['administrationGroupAdd', 'administrationGroupEdit',
                    'administrationGroupCheckboxDelete'
                ],
                'categoryArticle': ['categoryArticleAdd', 'categoryArticleEdit',
                    'categoryArticleCheckboxDelete'
                ],
                'article': ['articleAdd', 'articleEdit',
                    'articleCheckboxDelete'
                ],
            };

            // Hàm để kích hoạt hoặc vô hiệu hóa các checkbox quyền
            function togglePermisionCheckboxs(mainCheckBoxId) {
                // lấy checkbox đucợ chọn từ người dùng
                const mainCheckBox = document.getElementById(mainCheckBoxId);

                // lấy danh sách các checkbox quyền liên quan dến 1 checkbox chính
                const permissionGroupCheckboxs = permissionGroups[mainCheckBoxId];

                // kiểm tra sự tôn tại
                if (permissionGroupCheckboxs) {
                    //Lặp qua từng giá trị trong mảng
                    permissionGroupCheckboxs.forEach(value => {
                        // lọc tất cả và lấy checkbox có giá trị tương ứng với value trong vòng lặp
                        const checkbox = document.querySelector(
                            `input[name="permission[]"][value="${value}"]`);

                        // nếu tìm thấy value đó
                        if (checkbox) {
                            // thiết lập disabled cho crud dựa trên trạng thái của checbox chính
                            checkbox.disabled = !mainCheckBox
                                .checked; //  nếu vế 2 đucợ chọn và là !true và đảo ngược lên sẽ thành false(được chọn), checkbox.disabled = false => đucợ kích hoạt crud

                            // Nếu mainCheckBox.checked là false (tức là checkbox chính không được chọn), thì !mainCheckBox.checked sẽ trở thành true, và điều kiện trong khối if sẽ được thực thi.
                            if (!mainCheckBox.checked) {
                                checkbox.checked = false; //
                                //Điều này có nghĩa là nếu checkbox chính không được chọn, các checkbox quyền đã đucợ chọn trước đó  sẽ tự động bị bỏ chọn.
                            }
                        }
                    });
                }
            }

            //Kích hoạt hoặc vô hiệu hóa các checkbox con:
            // Object.keys Lấy tất cả các khóa (tên nhóm quyền) từ đối tượng permissionGroups. Mỗi khóa tương ứng với một checkbox chính.
            Object.keys(permissionGroups).forEach(group => { //Duyệt qua từng khóa (tên nhóm quyền) trong mảng.
                const mainCheckbox = document.getElementById(group);
                if (mainCheckbox) {
                    mainCheckbox.addEventListener('change', function() {
                        togglePermisionCheckboxs(group);
                    });
                }
            });
        });
    </script>
@endsection
