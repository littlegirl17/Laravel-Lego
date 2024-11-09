 @extends('admin.layout.layout')
 @Section('title', 'Admin | Sửa nhóm người dùng')
 @Section('content')

     <div class="container-fluid">

         <div class="d-flex justify-content-between my-3">
             <div class=""></div>
             <div>
                 <a class="text-decoration-none text-light bg-return py-2 px-2" href="">Quay lại</a>
             </div>

         </div>

         <form action="{{ route('editAdminstrationGroup', $administrationGroup->id) }}" method="post" class="formAdmin"
             enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa nhóm người dùng
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
                 <input type="text" class="form-control" name="name" value="{{ $administrationGroup->name }}">
                 @error('name')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="row">
                 <div class="col-md-6">
                     <div class="form-group mt-3">
                         <label for="title" class="form-label">Thiết lập quền hạn</label>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="banner" id=""
                                     {{ in_array('banner', $permissionGroupGet) ? 'checked' : '' }}><!-- Kiểm tra xem giá trị "banner" có trong mảng $permissionGroupGet hay không-->
                                 <span class="checkmark"></span>
                             </label>
                             <p>Banner</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="category" id=""
                                     {{ in_array('category', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Category</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="product" id=""
                                     {{ in_array('product', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Product</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="coupon" id=""
                                     {{ in_array('coupon', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Coupon</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="order" id=""
                                     {{ in_array('order', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Order</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="user" id=""
                                     {{ in_array('user', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>User</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="userGroup" id=""
                                     {{ in_array('userGroup', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>UserGroup</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="administration"
                                     id=""
                                     {{ in_array('administration', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Administration</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="administrationGroup"
                                     id=""
                                     {{ in_array('administrationGroup', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>AdministrationGroup</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="comment"
                                     id="" {{ in_array('comment', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Comment</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="categoryArticle"
                                     id=""
                                     {{ in_array('categoryArticle', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Category Article</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="article"
                                     id="" {{ in_array('article', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p> Article</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="assembly"
                                     id="" {{ in_array('assembly', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p> Assembly(Lắp ráp Lego)</p>
                         </div>

                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="favourite"
                                     id="" {{ in_array('favourite', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p> Favourite(Sản phẩm yêu thích)</p>
                         </div>
                         <div class="d-flex">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="contact"
                                     id="" {{ in_array('contact', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         id="" {{ in_array('bannerAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="bannerEdit"
                                         id=""
                                         {{ in_array('bannerEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="bannerCheckboxDelete" id=""
                                         {{ in_array('bannerCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         id=""
                                         {{ in_array('categoryAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="categoryEdit"
                                         id=""
                                         {{ in_array('categoryEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="categoryCheckboxDelete" id=""
                                         {{ in_array('categoryCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         id=""
                                         {{ in_array('productAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="productEdit"
                                         id=""
                                         {{ in_array('productEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="productCheckboxDelete" id=""
                                         {{ in_array('productCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         id="" {{ in_array('couponAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="couponEdit"
                                         id=""
                                         {{ in_array('couponEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="couponCheckboxDelete" id=""
                                         {{ in_array('couponCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value=""
                                         id="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value=""
                                         id="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="orderCheckboxDelete" id="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="userAdd"
                                         id="" {{ in_array('userAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="userEdit"
                                         id="" {{ in_array('userEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="userCheckboxDelete" id=""
                                         {{ in_array('userCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         id=""
                                         {{ in_array('userGroupAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="userGroupEdit"
                                         id=""
                                         {{ in_array('userGroupEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="userGroupCheckboxDelete" id=""
                                         {{ in_array('userGroupCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         id=""
                                         {{ in_array('adminstrationAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="adminstrationEdit"
                                         id=""
                                         {{ in_array('adminstrationEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="adminstrationCheckboxDelete" id=""
                                         {{ in_array('adminstrationCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         value="adminstrationGroupAdd" id=""
                                         {{ in_array('adminstrationGroupAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="adminstrationGroupEdit" id=""
                                         {{ in_array('adminstrationGroupEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="adminstrationGroupCheckboxDelete" id=""
                                         {{ in_array('adminstrationGroupCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         id=""
                                         {{ in_array('commentAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="commentEdit"
                                         id=""
                                         {{ in_array('commentEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="commentCheckboxDelete" id=""
                                         {{ in_array('commentCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         value="categoryArticleAdd" id=""
                                         {{ in_array('categoryArticleAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="categoryArticleEdit" id=""
                                         {{ in_array('categoryArticleEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="categoryArticleCheckboxDelete" id=""
                                         {{ in_array('categoryArticleCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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
                                         id=""
                                         {{ in_array('articleAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="articleEdit"
                                         id=""
                                         {{ in_array('articleEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="articleCheckboxDelete" id=""
                                         {{ in_array('articleCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
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

 @endsection
