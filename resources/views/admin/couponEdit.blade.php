 @extends('admin.layout.layout')
 @Section('title', 'Admin | Sửa danh mục')
 @Section('content')

     <div class="container-fluid">


         <form action="{{ route('editCoupon', $coupon->id) }}" method="post" class="formAdmin">
             @csrf
             @method('PUT')
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa phiếu giảm giá
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tên phiếu giảm giá</label>
                 <input type="text" class="form-control" name="name_coupon" value="{{ $coupon->name_coupon }}">
                 @error('name_coupon')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Mã(code)</label>
                 <input type="number" class="form-control" name="code" value="{{ $coupon->code }}">
                 @error('code')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Loại(type)</label>
                 <select class="form-select mt-3" aria-label="Default select example" name="type">
                     <option value="0"{{ $coupon->type == 0 ? 'selected' : '' }}>Giảm theo %</option>
                     <option value="1"{{ $coupon->type == 1 ? 'selected' : '' }}>Số tiền cố định</option>
                 </select>
                 @error('type')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Giảm giá</label>
                 <input type="number" class="form-control" name="discount" value="{{ $coupon->discount }}">
                 @error('discount')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tổng cộng</label>
                 <input type="number" class="form-control" name="total" value="{{ $coupon->total }}">
                 @error('total')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Ngày bắt đầu</label>
                 <input type="date" class="form-control" name="date_start" value="{{ $coupon->date_start }}">
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Ngày kết thúc</label>
                 <input type="date" class="form-control" name="date_end" value="{{ $coupon->date_end }}">
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select" aria-label="Default select example" name="status">
                     <option value="0"{{ $coupon->status == 0 ? 'selected' : '' }}>Tắt</option>
                     <option value="1"{{ $coupon->status == 1 ? 'selected' : '' }}>Bật</option>
                 </select>
                 @error('status')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
         </form>
     </div>

 @endsection
