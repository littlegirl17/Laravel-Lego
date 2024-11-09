@extends('layout.layout')
@section('title', 'Chi tiết')
@section('content')

    <div class="pt_mobile">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="detail_product_left">
                        <div class="detail_product_left_img_item">
                            <ul>
                                @foreach ($detail->productImage as $item)
                                    <li><img src="{{ asset('img/' . $item->images) }}" alt="" /></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="detail_product_left_img">
                            <img src="{{ asset('img/' . $detail->image) }}" alt="" />
                            <div class="detail_prev_next">
                                <button class="prev_detail_img" id="prevBtn">
                                    < </button>
                                        <button class="next_detail_img" id="nextBtn">></button>
                            </div>
                            <div class="detail_product_left_img_item_res">
                                <ul>
                                    @foreach ($detail->productImage as $item)
                                        <li><img src="{{ asset('img/' . $item->images) }}" alt="" /></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $priceDiscount = 0;
                    $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                    $productDiscountPrice = $detail->productDiscount->where('user_group_id', $userGroupId)->first();

                    $price = $detail->price ? $detail->price : null;

                    if ($productDiscountPrice) {
                        $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
                    }
                    $percent = ceil((($detail->price - $priceDiscount) / $detail->price) * 100);

                    $isFavourite = false; // Mặc định là false
                    if (Auth::check()) {
                        $isFavourite = $detail->favourite
                            ->where('user_id', Auth::id())
                            ->contains('product_id', $detail->id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                    } else {
                        $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                        // Lấy danh sách tất cả các product_id từ mảng $favourite
                        $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                        // Kiểm tra xem $item->id có nằm trong danh sách product_id không
                        $isFavourite = is_array($productIds) && in_array((string) $detail->id, $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                    }
                @endphp
                <div class="col-md-4 col-12">
                    <div class="detail_product_right">
                        <div class="detail_product_right_one">
                            @if ($detail->status >= 1)
                                <span class="inStock">Còn hàng</span>
                            @else
                                <span class="outStock">Hết hàng</span>
                            @endif

                            @if (isset($productDiscountPrice))
                                <span class="outStock">Giảm giá {{ $percent }}%</span>
                            @endif
                        </div>
                        <div class="detail_product_right_two">
                            <h1>{{ $detail->name }}</h1>
                        </div>
                        <div class="detail_product_right_three">
                            @if ($productDiscountPrice)
                                <span>{{ number_format($detail->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',', '.') . 'đ' }}
                            @else
                                <span></span>{{ number_format($detail->price, 0, ',', '.') . 'đ' }}
                            @endif
                        </div>
                        <div class="detail_product_right_four">
                            <div class="detail_product_right_four_item">
                                <button class="right_four_item_decrease" onclick="decreaseQuantity()">-</button>
                                <input type="number" class="right_four_item_number" id="inputQuantity" value="1" />
                                <button class="right_four_item_increase" onclick="increaseQuantity()">+</button>
                            </div>
                            <div class="detail_product_right_four_span">
                                <span>
                                    <button onclick="addFavourite('{{ $detail->id }}')" class="outline-0 border-0"
                                        style="background-color: transparent">
                                        <i class="fa-solid fa-heart {{ $isFavourite ? 'red' : '' }} favouriteSize"
                                            data-product-id="favourite-{{ $detail->id }}"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="detail_product_right_five">
                            <div class="right_five_bnt">
                                <form action="{{ route('buyNow') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $detail->id }}">
                                    <input type="hidden" name="name" value="{{ $detail->name }}">
                                    <input type="hidden" name="price" value="{{ $detail->price }}">
                                    <input type="hidden" name="priceDiscount"
                                        value="{{ $productDiscountPrice ? $productDiscountPrice->price : null }}">
                                    <input type="hidden" name="image" value="{{ $detail->image }}">
                                    <input type="hidden" id="inputQuantityHidden" name="quantity" value="1">
                                    <button type="submit" class="detail_btn">Mua ngay</button>
                                </form>
                                <button type="button"
                                    onclick="addToCart('{{ $detail->id }}',document.getElementById('inputQuantity').value)"
                                    class="detail_btn">
                                    Thêm vào giỏ hàng
                                </button>
                            </div>

                        </div>
                        <div class="">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn_checkout mt-2" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Dịch vụ lắp ráp Lego
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class=" modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Chọn nhân viên lắp ráp
                                                lego</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('assemblyPackage') }}" method="post"
                                            id="assemblyPackageForm">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="lego_assembly">
                                                    @if (count($assemblyPackages) > 0)
                                                        <ul>
                                                            @foreach ($assemblyPackages as $item)
                                                                <li class="span_assembly">
                                                                    <input type="radio"
                                                                        id="assemblyPackage-{{ $item->id }}"
                                                                        name="assemblyPackage"
                                                                        value="{{ $item->id }}" hidden>
                                                                    <label for="assemblyPackage-{{ $item->id }}">
                                                                        <div class="lego_assembly_img">
                                                                            <img src="{{ asset('img/' . $item->image) }}"
                                                                                alt="">
                                                                        </div>
                                                                        <span>{{ $item->name }}</span>
                                                                    </label>
                                                                    <input type="hidden"
                                                                        id="assemblyPackageFee-{{ $item->id }}"
                                                                        name="assemblyPackageFee"
                                                                        value="{{ $item->fee }}">
                                                                    <input type="hidden"
                                                                        id="assemblyPackagePrice-{{ $item->id }}"
                                                                        name="assemblyPackagePrice"
                                                                        value="{{ $item->price_assembly }}">
                                                            @endforeach
                                                        </ul>
                                                        @foreach ($assemblyPackages as $item)
                                                            <div class="detail_assembly">
                                                                <span
                                                                    class="detail_assembly_name">{{ $item->name }}</span><br>
                                                                <span class="">Phí công lắp:
                                                                    <span
                                                                        class="detail_assembly_price">{{ number_format($item->price_assembly, 0, ',', '.') . 'đ' }}</span>
                                                                </span><br>
                                                                @if ($item->fee > 0)
                                                                    <span class="">Tiền gói hộp quà:
                                                                        <span
                                                                            class="detail_assembly_fee">{{ number_format($item->fee, 0, ',', '.') . 'đ' }}</span>
                                                                    </span><br>
                                                                @endif
                                                                <span class="pt-1">Mô tả:</span><br>
                                                                <span>{{ $item->description }}</span>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <p>Hiện chưa có gói nào để bạn book!</p>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="assembly_package_id"
                                                    id="selectedAssemblyPackageId">
                                                <input type="hidden" name="fee" id="selectedAssemblyPackageFee">
                                                <input type="hidden" name="price_assembly"
                                                    id="selectedAssemblyPackagePrice">
                                                <input type="hidden" name="product_id" value="{{ $detail->id }}">
                                                <input type="hidden" name="name" value="{{ $detail->name }}">
                                                <input type="hidden" name="price" value="{{ $detail->price }}">
                                                <input type="hidden" name="priceDiscount"
                                                    value="{{ $productDiscountPrice ? $productDiscountPrice->price : null }}">
                                                <input type="hidden" name="image" value="{{ $detail->image }}">
                                                <input type="hidden" id="inputQuantityHidden" name="quantity"
                                                    value="1">

                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary"
                                                    {{ count($assemblyPackages) > 0 ? '' : 'disabled' }}>Tiếp tục</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5 accordion-section">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Thông số kỹ thuật
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-9 col-sm-8 col-12">

                                    @php
                                        $description = $detail->description;
                                        // Tách theo dấu chấm để lấy từng câu
                                        $sentences = preg_split('/(?<=[.?!])\s+/', $description);
                                        $paragraphs = [];
                                        $temp = '';

                                        foreach ($sentences as $index => $sentence) {
                                            $temp .= trim($sentence) . ' ';

                                            // Khi đã có 3 câu, thêm vào mảng đoạn
                                            if (($index + 1) % 3 == 0) {
                                                $paragraphs[] = trim($temp);
                                                $temp = ''; // Reset cho đoạn tiếp theo
                                            }
                                        }

                                        // Nếu còn câu thừa, thêm vào đoạn cuối
                                        if (!empty($temp)) {
                                            $paragraphs[] = trim($temp);
                                        }
                                    @endphp
                                    @foreach ($paragraphs as $paragraph)
                                        @if (trim($paragraph))
                                            <!-- Kiểm tra không rỗng -->
                                            <p>{{ $paragraph }}</p>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-md-3 col-sm-4 col-12">
                                    <div class="detail_accordion_img">
                                        <img src="{{ asset('img/' . $detail->image) }}" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Phản hồi khách hàng ({{ $productCountReview }}) đánh giá
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="product_review">
                                <ul>
                                    @foreach ($productReview as $item)
                                        <li>
                                            <div class="box_review">
                                                <div class="img_review">
                                                    <img src="{{ asset('img/' . $item->user->image) }}" alt=""
                                                        style="width:45px;height:45px;">
                                                </div>
                                                <div class="">
                                                    <span class="product_review_name">{{ $item->user->name }}</span>
                                                    <p class="starsget">
                                                        <span class="starsget_span">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <a class="starsget {{ $item->rating >= $i ? 'active' : '' }}"
                                                                    data-rating="{{ $i }}"
                                                                    href="javascript:void(0);">{{ $i }}</a>
                                                                {{-- $item->rating >= $i : ví dụ: ratinng productA là 3 sao thì => 3 >= 1 → true → thêm lớp 'active',  3 >= 2 → true → thêm lớp 'active', 3 >= 3 → true → thêm lớp 'active',3 >= 4 → false → không thêm lớp 'active' --}}
                                                            @endfor
                                                        </span>
                                                    </p>
                                                    <p class="product_review_p">
                                                        {{ $item->created_at->format('d/m/Y H:i:s') }}
                                                    </p>
                                                    <span class="product_review_content">{{ $item->content }}</span>
                                                    <div class="comment_images">
                                                        <ul class="m-0 ">
                                                            @foreach ($item->commentImages as $image)
                                                                <li class="banner_image_li"
                                                                    data-image="{{ asset('img/' . $image->images) }}">
                                                                    <img src="{{ asset('img/' . $image->images) }}"
                                                                        alt="">
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="div_nav_pagination">
                                <nav class="nav_pagination">
                                    <ul class="pagination">
                                        <li>{{ $productReview->links() }}</li>
                                    </ul>
                                </nav>
                            </div>
                            @if (Auth::check())
                                <div class="row">
                                    <div class="col-sm-3">
                                        <button type="button" class="btn_checkout mt-2 " data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop2">
                                            Đánh giá sản phẩm
                                        </button>
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2"
                                    aria-hidden="true">
                                    <div class=" modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel2">Đánh giá sản phẩm
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="product_review p-4">
                                                <form id="commentReview" action="{{ route('commentReview') }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <input type="hidden" name="product_id" value="{{ $detail->id }}">
                                                    <div class="product_review_content">
                                                        <span class="text-black">Chất lượng sản phẩm
                                                        </span>
                                                        <p class="stars">
                                                            <span class="stars_span">
                                                                <a class="star" data-rating="1"
                                                                    href="javascript:void(0);">1</a>
                                                                <a class="star" data-rating="2"
                                                                    href="javascript:void(0);">2</a>
                                                                <a class="star" data-rating="3"
                                                                    href="javascript:void(0);">3</a>
                                                                <a class="star" data-rating="4"
                                                                    href="javascript:void(0);">4</a>
                                                                <a class="star" data-rating="5"
                                                                    href="javascript:void(0);">5</a>
                                                            </span>
                                                        </p>
                                                        <input type="hidden" name="rating" id="rating"
                                                            value="">
                                                    </div>
                                                    <div class="product_review_content">
                                                        <span class="text-black">Nội dung đánh giá</span>
                                                        <textarea class="form_control_review" name="content" id="" cols="5" rows="10"></textarea>
                                                    </div><input type="hidden" name="comment_id"
                                                        value="{{ $detail->id }}">
                                                    <div class="file-upload">
                                                        <label for="file-input">
                                                            <i class="fas fa-camera"></i> Thêm hình ảnh
                                                        </label>
                                                        <input type="file" id="file-input" name="images[]" multiple>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="detail_btn_cart">Gửi đánh
                                                            giá</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="detail_product_section">
            <div class="container">
                <div class="title_home">
                    <h2 class="">Đề xuất cho bạn</h2>
                </div>
                <div class="owl-carousel owl-theme">
                    @foreach ($productRelated as $item)
                        @php
                            $priceDiscount = 0;
                            $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                            $productDiscountPrice = $item->productDiscount
                                ->where('user_group_id', $userGroupId)
                                ->first();

                            $price = $item->price ? $item->price : null;

                            if ($productDiscountPrice) {
                                $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
                            }

                            $percent = ceil((($item->price - $priceDiscount) / $item->price) * 100);
                            $productImageCollect = $item->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                            $isFavourite = false;
                            if (Auth::check()) {
                                $isFavourite = $item->favourite
                                    ->where('user_id', Auth::id())
                                    ->contains('product_id', $item->id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                            } else {
                                $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                                // Lấy danh sách tất cả các product_id từ mảng $favourite
                                $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                                // Kiểm tra xem $item->id có nằm trong danh sách product_id không
                                $isFavourite = is_array($productIds) && in_array((string) $item->id, $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                            }
                        @endphp

                        <div class="item">
                            <div class="product_box">
                                <div class="product_box_effect">
                                    @if ($item->outstanding == 1)
                                        <div class="product_box_tag">Nổi bật </div>
                                    @endif
                                    @if (isset($productDiscountPrice))
                                        <div class="product_box_tag_sale_outstanding">{{ $percent }}%</div>
                                    @endif
                                    <div class="product_box_icon">
                                        <button onclick="addFavourite('{{ $item->id }}')" class="outline-0 border-0"
                                            style="background-color: transparent">
                                            <i class="fa-solid fa-heart {{ $isFavourite ? 'red' : '' }}"
                                                data-product-id="favourite-{{ $item->id }}"></i>
                                        </button>
                                        <button type="button" class="outline-0 border-0 "
                                            style="background-color: transparent"
                                            onclick="showModalProduct(event,'{{ $item->id }}','{{ $item->image }}','{{ $item->name }}','{{ $item->price }}','{{ $priceDiscount }}','{{ json_encode($productImageCollect) }}')">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        {{-- truyền vào id sản phẩm và số lượng cần thêm,user_id server láy từ sesion --}}
                                        <button type="button" onclick="addToCart('{{ $item->id }}', 1)"
                                            class="outline-0 border-0 " style="background-color: transparent">
                                            <i class="fa-solid fa-bag-shopping"></i>
                                        </button>
                                    </div>
                                    <div class="product_box_image">
                                        <img src="{{ asset('img/' . $item->image) }}" alt="" />
                                    </div>
                                    <div class="product_box_content_out">
                                        <div class="product_box_content">
                                            <h3><a href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a>
                                            </h3>
                                        </div>
                                        @if ($productDiscountPrice)
                                            <div class="product_box_price">
                                                <span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',', '.') . 'đ' }}
                                            </div>
                                        @else
                                            <div class="product_box_price">
                                                <span></span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <div id="modal_review" class="modal_review">
            <div class="modal_review_box">
                <span class="close my-0">&times;</span>
                <div id="modal_review_box_img"></div>
            </div>
        </div>

        <div id="popup_image_review" class="popup_image_review" style="display: none;">
            <div class="popup_image_review_box">
                <span class="close_image my-0">&times;</span>
                <div id="popup_image_review_img"></div>
            </div>
        </div>
    </div>




@endsection
