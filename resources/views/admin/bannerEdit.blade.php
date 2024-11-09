 @extends('admin.layout.layout')
 @Section('title', 'Admin | Sửa banner')
 @Section('content')

     <div class="container-fluid">

         <div class="d-flex justify-content-between align-items-center  my-3">
             <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="">Quay lại</a>
         </div>

         <form action="{{ route('editBanner', $bannerImage->id) }}" method="post" class="formAdmin"
             enctype="multipart/form-data">
             @csrf
             @method('put')
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa hình ảnh
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
                         <option value="{{ $item->id }}" {{ $item->id == $bannerImage->banner_id ? 'selected' : '' }}>
                             {{ $item->name }}
                         </option>
                     @endforeach
                 </select>
             </div>
             <div class="row mt-5">
                 <h4 class="title-page ">
                     Thông tin chi tiết banner </h4>
             </div>


             <div class="row bannnerImagesEdit bannerImagePUT">
                 <div class="row banner_row p-3">
                     <div class="col-md-12">
                         <div class="row">
                             <div class="col-md-6 col-sm-12 col-12 pe-3">
                                 <label for="exampleInputFile" class="form-label">Hình ảnh </label>

                                 <div class=" banner_file p-3 ">
                                     <div class="banner_file_img">
                                         @if (!empty($bannerImage->image_desktop))
                                             <img src="{{ asset('img/' . $bannerImage->image_desktop) }}" alt="">
                                         @else
                                             <img src="{{ asset('img/lf.png') }}" alt="">
                                         @endif
                                     </div>
                                     <div class="m-0 p-0 ps-3">
                                         <label for="image_desk" class="custom-file-upload">
                                             Thay đổi hình ảnh
                                         </label>
                                         <input type="file" name="image_desktop" id="image_desk" class="inputFile"
                                             style="display: none;">
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6 col-sm-12 col-12">
                                 <label for="example" class="form-label">Hình ảnh mobile</label>

                                 <div class=" banner_file p-3">
                                     <div class="banner_file_img">
                                         @if (!empty($bannerImage->image_mobile))
                                             <img src="{{ asset('img/' . $bannerImage->image_mobile) }}" alt="">
                                         @else
                                             <img src="{{ asset('img/lf.png') }}" alt="">
                                         @endif
                                     </div>
                                     <div class="m-0 p-0 ps-3">
                                         <label for="image_mobile" class="custom-file-upload">
                                             Thay đổi hình ảnh
                                         </label>
                                         <input type="file" name="image_mobile" id="image_mobile" class="inputFile"
                                             style="display: none;">
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row pt-3">
                             <div class="col-md-4 col-sm-12 col-12 pe-2 ">
                                 <label for="title" class="form-label">Tiêu đề</label>
                                 <input type="text" class="form-control" name="title" aria-describedby="title"
                                     value="{{ $bannerImage->title }}">
                             </div>
                             <div class="col-md-4 col-sm-12 col-12 pe-2 ">
                                 <label for="link_tab" class="form-label">Liên kết tab</label>
                                 <input type="text" class="form-control" name="link_tab"
                                     value="{{ $bannerImage->link_tab }}">
                             </div>
                             <div class="col-md-4 col-sm-12 col-12 pe-2">
                                 <label for="title" class="form-label">Nội dung button</label>
                                 <input type="text" class="form-control" name="content_button" id=""
                                     value="{{ $bannerImage->content_button }}">
                             </div>
                         </div>
                         <div class="row pt-3">
                             <div class="col-md-6 col-sm-12 col-12 pe-2">
                                 <label for="title" class="form-label">Thứ tự xuất hiện</label>
                                 <input type="number" class="form-control" name="sort_order" id=""
                                     aria-describedby=""value="{{ $bannerImage->sort_order }}">
                             </div>
                             <div class="col-md-6 col-sm-12 col-12">
                                 <label for="title" class="form-label">Trạng thái</label>
                                 <select class="form-select" aria-label="Default select example" name="status">
                                     <option value="0" {{ $bannerImage->status == 0 ? 'selected' : '' }}>Vô hiệu hóa
                                     </option>
                                     <option value="1"{{ $bannerImage->status == 1 ? 'selected' : '' }}>Kích hoạt
                                     </option>
                                 </select>
                             </div>
                         </div>
                         <div class="row pt-3">
                             <div class="col-md-12 col-sm-12 col-12">
                                 <label for="title" class="form-label">Mô tả</label>
                                 <input type="text" class="form-control" name="description"
                                     value="{{ $bannerImage->description }}">
                             </div>
                         </div>
                     </div>
                 </div>
             </div>


         </form>
     </div>

 @endsection
