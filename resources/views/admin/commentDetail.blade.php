 @extends('admin.layout.layout')
 @Section('title', 'Admin | Chi tiết bình luận')
 @Section('content')

     <div class="container-fluid">

         <div class="container-fluid">

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Nội dung đánh giá sản phẩm</label>
                 <textarea class="form-control " id="description" name="description" cols="10" rows="10">{{ $comment->content }}</textarea>
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Hình ảnh sản phẩm của khách hàng</label>
                 <div class="owl-carousel owl-theme">
                     @foreach ($commentImageAdmin as $item)
                         <div class="item">
                             <div class="comment_iamge">
                                 <img src="{{ asset('img/' . $item->images) }}" alt="">
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>

     </div>


 @endsection
