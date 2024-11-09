 @extends('admin.layout.layout')
 @Section('title', 'Admin | Sửa sản phẩm')
 @Section('content')

     <div class="container-fluid">



         <form action="{{ route('editProduct', $product->id) }}" method="post" class="formAdmin" enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa sản phẩm
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>


             <ul class="nav nav-tabs" id="myTab" role="tablist">
                 <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                         type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Chung</button>
                 </li>
                 <li class="nav-item" role="presentation">
                     <button class="nav-link" id="discount-tab" data-bs-toggle="tab" data-bs-target="#discount-tab-pane"
                         type="button" role="tab" aria-controls="discount-tab-pane" aria-selected="false">Giảm
                         giá</button>
                 </li>
                 <li class="nav-item" role="presentation">
                     <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                         type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Hình
                         ảnh</button>
                 </li>
             </ul>

             <div class="tab-content" id="myTabContent">
                 <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                     tabindex="0">
                     <div class="form-group mt-3">
                         <label for="name" class="form-label">Tên sản phẩm</label>
                         <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="name"
                             value="{{ $product->name }}">
                         @error('name')
                             <div class="text-danger" id="alert-message">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="form-group mt-3">
                         <div class="d-flex">
                             <label for="slug" class="form-label pe-2">Slug</label>
                             <label class="containerSlug">
                                 <input type="checkbox"id="off_slug" onclick="toggleSlug()">Tắt tự động
                                 <div class="checkmarkSlug"></div>
                             </label>
                         </div>
                         <input type="text" class="form-control" id="convert_slug" name="slug"
                             value="{{ $product->slug }}">
                         @error('slug')
                             <div class="text-danger" id="alert-message">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="form-group mt-3">
                         <label for="description" class="form-label">Nội dung chi tiết sản phẩm</label>
                         <textarea class="form-control" id="editor1" name="description" rows="3">{{ $product->description }}
                    </textarea>
                         @error('description')
                             <div class="text-danger" id="alert-message">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="form-group mt-3">
                         <label for="description" class="form-label">Chọn danh mục của sản phẩm</label>
                         <select class="form-select " name="category_id">
                             @foreach ($categories as $category)
                                 @foreach ($category->categories_children as $item)
                                     <option value="{{ $item->id }}" {{ $product->id == $item->id ? 'selected' : 0 }}>
                                         {{ $item->name }}
                                     </option>
                                 @endforeach
                             @endforeach

                         </select>
                         @error('category_id')
                             <div class="text-danger" id="alert-message">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="form-group mt-3">
                         <label for="price" class="form-label">Giá sản phẩm</label>
                         <input type="number" class="form-control" id="price" name="price"
                             value="{{ $product->price }}">
                         @error('price')
                             <div class="text-danger" id="alert-message">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="form-group mt-3">
                         <label for="price" class="form-label">Lượt xem</label>
                         <input type="number" class="form-control" id="view" name="view"
                             value="{{ $product->view }}">
                         @error('view')
                             <div class="text-danger" id="alert-message">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="form-group mt-3">
                         <label for="">Nổi bật</label>
                         <select class="form-select mt-3" aria-label="Default select example" name="outstanding">
                             <option value="0" {{ $product->outstanding == 0 ? 'selected' : '' }}>Tắt</option>
                             <option value="1" {{ $product->outstanding == 1 ? 'selected' : '' }}>Bật</option>
                         </select>
                         @error('outstanding')
                             <div class="text-danger" id="alert-message">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="form-group mt-3">
                         <label for="">Trạng thái</label>
                         <select class="form-select mt-3" aria-label="Default select example" name="status">
                             <option value="0"{{ $product->status == 0 ? 'selected' : '' }}>Tắt</option>
                             <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Bật</option>
                         </select>
                         @error('status')
                             <div class="text-danger" id="alert-message">{{ $message }}</div>
                         @enderror
                     </div>
                 </div>
                 <div class="tab-pane fade" id="discount-tab-pane" role="tabpanel" aria-labelledby="discount-tab"
                     tabindex="0">
                     <table class="table table-bordered mt-3 pt-3">
                         <thead>
                             <tr>
                                 <th>Nhóm khách hàng</th>
                                 <th>Giá giảm sản phẩm</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody class="discount-product">
                             @foreach ($productDiscount as $key => $item)
                                 <tr>
                                     <td>
                                         <select class="form-select" aria-label="Default select example"
                                             name="user_group_id[]">
                                             @foreach ($userGroups as $userGroup)
                                                 <option value="{{ $userGroup->id }}"
                                                     {{ $userGroup->id == $item->user_group_id ? 'selected' : '' }}>
                                                     {{ $userGroup->name }}</option>
                                             @endforeach
                                         </select>
                                     </td>
                                     <td><input class="form-control" type="number"
                                             name="priceUserGroup[{{ $key }}]" value="{{ $item->price }}">
                                     </td>
                                     <td>
                                         {{-- <a href="{{ route('productDeleteDiscount', $item->id) }}">X</a> --}}
                                         <button type="button" class="remove_bannerImages_add "
                                             onclick="window.location.href='{{ route('productDeleteDiscount', $item->id) }}'">Xóa</button>
                                     </td>
                                 </tr>
                             @endforeach

                         </tbody>
                     </table>
                     <div class="row mb-3">
                         <div class="col-md-12">
                             <button type="button" class="btn btn-primary add-discount-btn">Thêm mức giảm
                                 giá</button>
                         </div>
                     </div>
                 </div>
                 <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                     tabindex="0">
                     <div class="form-group  mt-3">
                         <h4 class="label_admin">Ảnh sản phẩm</h4>
                         <div class="custom-file imageAdd p-3 ">
                             <div class="imageFile">
                                 <img src="{{ asset('img/' . $product->image) }}" alt="">
                             </div>
                             <div class="">
                                 <input type="file" name="image" id="HinhAnh" class="inputFile">
                             </div>
                         </div>
                     </div>
                     <div class="form-group mt-3">
                         <h4>Hình ảnh bổ sung</h4>
                         @if (count($productImages))
                             <div class="row bannnerImagesEdit">
                                 <div class="col-md-12 productImagePut">
                                     @foreach ($productImages as $key => $item)
                                         <div class="row_product my-3">
                                             <div class="custom-file imageAdd p-3">
                                                 <div class="imageFile">
                                                     <img src="{{ asset('img/' . $item->images) }}" alt="">
                                                 </div>
                                                 <div class="d-flex flex-column">
                                                     <div class="">
                                                         <input type="file" name="images[{{ $key }}]"
                                                             id="HinhAnh" class="inputFile">
                                                     </div>
                                                     <div class="mt-3">
                                                         <button class="remove_bannerImages_add remove_productImages"
                                                             onclick="window.location.href='{{ route('productDeleteImages', $item->id) }}'">Xóa</button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     @endforeach
                                 </div>
                             </div>
                             <div class="row mt-3  p-0">
                                 <div class="col-md-3 col-12 px-2">
                                     <button type="button" class="btn-ProductImagesAdd">Thêm
                                         hình
                                         ảnh</button>
                                 </div>
                                 <div class="col-md-9  col-12"></div>
                             </div>
                         @else
                             <div class="row bannnerImagesEdit">
                                 <div class="col-md-12 productImagePut">
                                     <div class="row_product my-3">
                                         <div class="custom-file imageAdd p-3">
                                             <div class="imageFile">
                                                 <div class="previewImages"><img src="{{ asset('img/lf.png') }}"
                                                         alt="">
                                                 </div>
                                             </div>
                                             <div class="d-flex flex-column">
                                                 <div class="">
                                                     <input type="file" name="images[]"
                                                         class="inputFile imageInputJS">
                                                 </div>
                                                 <div class="mt-3">
                                                     <button
                                                         class="remove_bannerImages_add remove_productImages">Xóa</button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                             </div>
                             <div class="row mt-3  p-0">
                                 <div class="col-md-3 col-12">
                                     <button type="button" class="btn-ProductImagesAdd">Thêm
                                         hình
                                         ảnh</button>
                                 </div>
                                 <div class="col-md-9  col-12"></div>
                             </div>
                         @endif

                     </div>
                 </div>
             </div>

         </form>
     </div>
 @endsection

 @section('productEditAdminScript')
     <script>
         $(document).ready(function() {
             let productImages = `
         <div class="col-md-12 productImagePut">
           <div class="row_product my-3">
                <div class="custom-file imageAdd p-3">
                    <div class="imageFile">
                        <div class="previewImages"><img src="{{ asset('img/lf.png') }}" alt=""></div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="">
                            <input type="file" name="images[]"
                                class="inputFile imageInputJS">
                        </div>
                        <div class="mt-3">
                            <button
                                class="remove_bannerImages_add remove_productImages">Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
             $('.btn-ProductImagesAdd').click(function() {
                 $('.productImagePut').append(productImages.trim());
             });
             //append  sử dụng để thêm nội dung vào cuối của một phần tử đã chọn // trim dùng để loại bỏ khoảng trắng ở đầu và cuối chuỗi // closest tìm phần tử cha gần nhất (ancestor) khớp với bộ chọn được cung cấp
             $(document).on('click', '.remove_productImages', function() {
                 $(this).closest('.row_product').remove();
             })
         })
     </script>
     <script>
         $(document).ready(function() {
             let discountRowTemplate = `
                <tr class="discount-row">
                    <td>
                        <select class="form-select" aria-label="Default select example" name="user_group_id[]">
                            @foreach ($userGroups as $userGroup)
                                <option value="{{ $userGroup->id }}">{{ $userGroup->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="number" name="priceUserGroup[]" >
                    </td>
                    <td>
                        <button type="button" class="remove_bannerImages_add remove-discount-btn">Xóa</button>
                    </td>
                </tr>
            `;

             $('.add-discount-btn').click(function() {
                 $('.discount-product').append(discountRowTemplate.trim());
             });

             $(document).on('click', '.remove-discount-btn', function() {
                 $(this).closest('.discount-row').remove();
             });
         });
     </script>
 @endsection
