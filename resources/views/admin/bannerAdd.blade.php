 @extends('admin.layout.layout')
 @Section('title', 'Admin | Thêm banner')
 @Section('content')

     <div class="container-fluid">
         <form action="{{ route('bannerAddForm') }}" method="post" class="formAdmin" enctype="multipart/form-data">
             @csrf
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Thêm hình ảnh
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>

             <div class="form-group mt-3">
                 <label for="position" class="form-label">Vị trí banner xuất hiện trên trang web</label>
                 <select class="form-select" name="banner_id">
                     @foreach ($bannerName as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}
                         </option>
                     @endforeach
                 </select>
             </div>
             <div class="row mt-5">
                 <h4 class="title-page ">
                     Thông tin chi tiết banner </h4>
             </div>

             <div class="row bannnerImagesEdit">
                 <div class="col-md-12 bannerImagePUT">
                     <div class="row banner_row p-3">
                         <div class="col-md-11">
                             <div class="row">
                                 <div class="col-md-6 col-sm-12 col-12 pe-3">
                                     <label for="exampleInputFile" class="form-label">Hình ảnh </label>

                                     <div class=" banner_file p-3 ">
                                         <div class="banner_file_img">
                                             <img src="{{ asset('img/lf.png') }}" alt="">
                                         </div>
                                         <div class="m-0 p-0 ps-3">
                                             <label for="" class="custom-file-upload">
                                                 Thêm hình ảnh
                                             </label>
                                             <input type="file" name="image_desktop[]" id="" class="inputFile"
                                                 style="display: none;" multiple>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-sm-12 col-12">
                                     <label for="example" class="form-label">Hình ảnh mobile</label>

                                     <div class=" banner_file p-3">
                                         <div class="banner_file_img">
                                             <img src="{{ asset('img/lf.png') }}" alt="">
                                         </div>
                                         <div class="m-0 p-0 ps-3">
                                             <label for="" class="custom-file-upload">
                                                 Thêm hình ảnh
                                             </label>
                                             <input type="file" name="image_mobile[]" id="" class="inputFile"
                                                 style="display: none;" multiple>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row pt-3">
                                 <div class="col-md-4 col-sm-12 col-12 pe-2 ">
                                     <label for="title" class="form-label">Tiêu đề</label>
                                     <input type="text" class="form-control" name="title[]" aria-describedby="title"
                                         placeholder="Nhập tiêu đề hình ảnh ">
                                 </div>
                                 <div class="col-md-4 col-sm-12 col-12 pe-2 ">
                                     <label for="link_tab" class="form-label">Liên kết tab</label>
                                     <input type="text" class="form-control" name="link_tab[]"
                                         aria-describedby="link_tab" placeholder="Nhập liên kết">
                                 </div>
                                 <div class="col-md-4 col-sm-12 col-12 pe-2">
                                     <label for="title" class="form-label">Nội dung button</label>
                                     <input type="text" class="form-control" name="content_button[]" id=""
                                         aria-describedby="" placeholder="Nhập nội dung button">
                                 </div>
                             </div>
                             <div class="row pt-3">
                                 <div class="col-md-6 col-sm-12 col-12 pe-2">
                                     <label for="title" class="form-label">Thứ tự xuất hiện</label>
                                     <input type="number" class="form-control" name="sort_order[]" id=""
                                         aria-describedby="" placeholder="Nhập thứ tự">
                                 </div>
                                 <div class="col-md-6 col-sm-12 col-12">
                                     <label for="title" class="form-label">Trạng thái</label>
                                     <select class="form-select" aria-label="Default select example" name="status[]">
                                         <option value="0">Vô hiệu hóa</option>
                                         <option value="1">Kích hoạt</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="row pt-3">
                                 <div class="col-md-12 col-sm-12 col-12">
                                     <label for="title" class="form-label">Mô tả</label>
                                     <input type="text" class="form-control" name="description[]"
                                         aria-describedby="description" placeholder="Nhập mô tả hình ảnh ">
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-1 p-4">
                             <button class=" remove_bannerImages_add">Xóa</button>
                         </div>
                     </div>
                 </div>

             </div>
             <div class="row m-0 p-3">
                 <button type="button" class="btn btn-primary  add-bannerImage">Thêm hình ảnh</button>
             </div>
         </form>
     </div>

 @endsection

 @section('addBannerAdminScript')
     <script>
         $(document).ready(function() {
             let imageBannerTemplate = `
                   <div class="row banner_row p-3">
                         <div class="col-md-11">
                             <div class="row">
                                 <div class="col-md-6 col-sm-12 col-12 pe-3">
                                     <label for="exampleInputFile" class="form-label">Hình ảnh </label>

                                     <div class=" banner_file p-3 ">
                                         <div class="banner_file_img">
                                             <img src="{{ asset('img/lf.png') }}" alt="">
                                         </div>
                                         <div class="m-0 p-0 ps-3">
                                             <label for="" class="custom-file-upload">
                                                 Thêm hình ảnh
                                             </label>
                                             <input type="file" name="image_desktop[]" id="" class="inputFile"
                                                 style="display: none;" multiple>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-sm-12 col-12">
                                     <label for="example" class="form-label">Hình ảnh mobile</label>

                                     <div class=" banner_file p-3">
                                         <div class="banner_file_img">
                                             <img src="{{ asset('img/lf.png') }}" alt="">
                                         </div>
                                         <div class="m-0 p-0 ps-3">
                                             <label for="" class="custom-file-upload">
                                                 Thêm hình ảnh
                                             </label>
                                             <input type="file" name="image_mobile[]" id="" class="inputFile"
                                                 style="display: none;" multiple>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row pt-3">
                                 <div class="col-md-4 col-sm-12 col-12 pe-2 ">
                                     <label for="title" class="form-label">Tiêu đề</label>
                                     <input type="text" class="form-control" name="title[]" aria-describedby="title"
                                         placeholder="Nhập tiêu đề hình ảnh ">
                                 </div>
                                 <div class="col-md-4 col-sm-12 col-12 pe-2 ">
                                     <label for="link_tab" class="form-label">Liên kết tab</label>
                                     <input type="text" class="form-control" name="link_tab[]"
                                         aria-describedby="link_tab" placeholder="Nhập liên kết">
                                 </div>
                                 <div class="col-md-4 col-sm-12 col-12 pe-2">
                                     <label for="title" class="form-label">Nội dung button</label>
                                     <input type="text" class="form-control" name="content_button[]" id=""
                                         aria-describedby="" placeholder="Nhập nội dung button">
                                 </div>
                             </div>
                             <div class="row pt-3">
                                 <div class="col-md-6 col-sm-12 col-12 pe-2">
                                     <label for="title" class="form-label">Thứ tự xuất hiện</label>
                                     <input type="number" class="form-control" name="sort_order[]" id=""
                                         aria-describedby="" placeholder="Nhập thứ tự">
                                 </div>
                                 <div class="col-md-6 col-sm-12 col-12">
                                     <label for="title" class="form-label">Trạng thái</label>
                                     <select class="form-select" aria-label="Default select example" name="status[]">
                                         <option value="0">Vô hiệu hóa</option>
                                         <option value="1">Kích hoạt</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="row pt-3">
                                 <div class="col-md-12 col-sm-12 col-12">
                                     <label for="title" class="form-label">Mô tả</label>
                                     <input type="text" class="form-control" name="description[]"
                                         aria-describedby="description" placeholder="Nhập mô tả hình ảnh ">
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-1 p-4">
                             <button class=" remove_bannerImages_add" href="">Xóa</button>
                         </div>
                     </div>

`;

             $('.add-bannerImage').click(function() {
                 $('.bannerImagePUT').append(imageBannerTemplate.trim());
             });

             $(document).on('click', '.remove_bannerImages_add', function() {
                 $(this).closest('.banner_row').remove();
             })

             $(document).on('click', '.custom-file-upload', function() {
                 $(this).next('.inputFile').click();
             })
         });
     </script>
 @endsection
