@extends('layout.layout')
@section('title', 'LegoLoft | website lego')
@section('content')
    <!-- START BANNER -->
    <div class="">
        <div class="banner_home">
            @foreach ($banners as $item)
                @if ($item->position == 1 && $item->status == 1)
                    @foreach ($item->bannerImages as $image)
                        @if ($image->status == 1)
                            <div class="banner_home_image">
                                <img src="{{ asset('img/' . $image->image_desktop) }}" alt="" />
                            </div>
                            <div class="banner_home_text">
                                <h2 class="banner_home_text_h2">{{ $image->title }}</h2>
                                <span class="banner_home_text_span">{{ $image->description }}</span>
                                <a href="{{ $image->link_tab }}" class="banner_home_text_btn">{{ $image->content_button }} <i
                                        class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        @break

                        {{-- Dừng vòng lặp sau khi hiển thị 1 banner --}}
                    @endif
                @endforeach
            @endif
        @endforeach

    </div>
    <div class="banner_home_mobile">
        @foreach ($banners as $item)
            @if ($item->position == 1 && $item->status == 1)
                @foreach ($item->bannerImages as $image)
                    @if ($image->status == 1)
                        <div class="banner_home_mobile_image">
                            <img src="{{ asset('img/' . $image->image_mobile) }}" alt="" />
                        </div>
                        <div class="banner_home_mobile_text">
                            <h2 class="banner_home_mobile_text_h2">{{ $image->title }}</h2>
                            <span class="banner_home_mobile_text_span">{{ $image->description }}</span>
                            <a href="{{ $image->link_tab }}"
                                class="banner_home_mobile_text_btn">{{ $image->content_button }} <i
                                    class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                @break

                {{-- Dừng vòng lặp sau khi hiển thị 1 banner --}}
            @endforeach
        @endif
    @endforeach
</div>
</div>
<!-- END BANNER -->

<div class="background_home">
<!-- START CATEGORY -->
<div class="container">
    <div class="image_category">
        <h3 class="text-center pt-3">Mua sắm theo chủ đề</h3>
        <ul class="image_category_ul">
            @foreach ($categoryAll as $item)
                <li class="">
                    <a href="{{ route('categoryProduct', $item->id) }}" class="text-decoration-none">
                        <img src="{{ asset('img/' . $item->image) }}" alt="" />
                        <div class="image_category_span">
                            <span>{{ $item->name }}</span>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- END CATEGORY -->

<!-- START LỰA CHỌN -->
<section class="product">
    <div class="container">
        <div class="title_home">
            <h2>Những lựa chọn hàng đầu trong tuần này</h2>
        </div>
        <div class="row">
            @foreach ($categoryChoose as $item)
                <div class="col-md-4">
                    <div class="card_box">
                        <div class="card_box_img">
                            <img src="{{ asset('img/' . $item->image) }}" alt="" />
                        </div>
                        <div class="card_box_content">
                            <h3>{{ $item->name }}</h3>
                        </div>
                        <div class="card_box_btn">
                            <a href="{{ route('categoryProduct', $item->id) }}">Xem ngay</a>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- END LỰA CHỌN -->


<!-- START PRODUCT NỔI BẬT -->
<section class="product">
    <div class="container">
        <div class="title_home">
            <h2>Sản phẩm nổi bật</h2>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach ($productOutStanding as $item)
                @php
                    $priceDiscount = 0;
                    $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                    $productDiscountPrice = $item->productDiscount->where('user_group_id', $userGroupId)->first();

                    $price = $item->price ? $item->price : null;

                    if ($productDiscountPrice) {
                        $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
                    }

                    $percent = ceil((($item->price - $priceDiscount) / $item->price) * 100);
                    $productImageCollect = $item->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                    $isFavourite = false; // Mặc định là false
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
                            <div class="product_box_tag">Nổi bật </div>
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
<!-- END PRODUCT NỔI BẬT -->

<!-- START PRODUCT GIẢM GIÁ -->
<section class="product">
    <div class="container">
        <div class="title_home">
            <h2>Sản phẩm giảm giá</h2>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach ($productDiscountSection as $item)
                @php
                    $percent = ceil((($item->products->price - $item->price) / $item->products->price) * 100);
                    $productImageCollect = $item->products->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                    $isFavourite = false;
                    if (Auth::check()) {
                        $isFavourite = $item->products->favourite
                            ->where('user_id', Auth::id())
                            ->contains('product_id', $item->product_id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                    } else {
                        $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                        // Lấy danh sách tất cả các product_id từ mảng $favourite
                        $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                        // Kiểm tra xem $item->id có nằm trong danh sách product_id không
                        $isFavourite = is_array($productIds) && in_array((string) $item->product_id, $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                    }
                @endphp
                <div class="item">
                    <div class="product_box">
                        <div class="product_box_effect">
                            <div class="product_box_tag_sale">{{ $percent }}%</div>
                            <div class="product_box_icon">
                                <button onclick="addFavourite('{{ $item->product_id }}')"
                                    class="outline-0 border-0" style="background-color: transparent">
                                    <i class="fa-solid fa-heart {{ $isFavourite ? 'red' : '' }}"
                                        data-product-id="favourite-{{ $item->product_id }}"></i>
                                </button>
                                <button class="outline-0 border-0 " style="background-color: transparent"
                                    onclick="showModalProduct(event,'{{ $item->product_id }}','{{ $item->products->image }}','{{ $item->products->name }}','{{ $item->products->price }}','{{ $item->price }}','{{ json_encode($productImageCollect) }}')">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                                {{-- truyền vào id sản phẩm và số lượng cần thêm,user_id server láy từ sesion --}}
                                <button type="button" onclick="addToCart('{{ $item->product_id }}', 1)"
                                    class="outline-0 border-0" style="background-color: transparent">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </button>
                            </div>

                            <div class="product_box_image">
                                <img src="{{ asset('img/' . $item->products->image) }}" alt="" />
                            </div>
                            <div class="product_box_content_out">
                                <div class="product_box_content">
                                    <h3> <a
                                            href="{{ route('detail', $item->products->slug) }}">{{ $item->products->name }}</a>
                                    </h3>

                                </div>
                                @if (Auth::check())
                                    <div class="product_box_price">
                                        <span>{{ number_format($item->products->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}
                                    </div>
                                @else
                                    <div class="product_box_price">
                                        <span>{{ number_format($item->products->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}
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
<!-- END PRODUCT GIẢM GIÁ  -->

<div class="banner_home_main">
    <div class="banner_home_theme">
        @foreach ($banners as $item)
            @if ($item->position == 5 && $item->status == 1)
                @foreach ($item->bannerImages as $image)
                    @if ($image->status == 1)
                        <div class="banner_home_theme_main">
                            <img src="{{ asset('img/' . $image->image_desktop) }}" alt="" />
                        </div>
                        <div class="banner_home_theme_content">
                            <h2>{{ $image->title }}</h2>
                            <span>{{ $image->description }}</span>
                            <a href="{{ $image->link_tab }}" class="">{{ $image->content_button }} <i
                                    class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    @break

                    {{-- Dừng vòng lặp sau khi hiển thị 1 banner --}}
                @endif
            @endforeach
        @endif
    @endforeach

</div>
<div class="banner_home_theme_mobile">
    @foreach ($banners as $item)
        @if ($item->position == 5 && $item->status == 1)
            @foreach ($item->bannerImages as $image)
                @if ($image->status == 1)
                    <div class="banner_home_theme_main_mobile">
                        <img src="{{ asset('img/' . $image->image_mobile) }}" alt="" />
                    </div>
                    <div class="banner_home_theme_content_mobile">
                        <h2>{{ $image->title }}</h2>
                        <span>{{ $image->description }}</span>
                        <a href="{{ $image->link_tab }}" class="">{{ $image->content_button }}<i
                                class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                @break

                {{-- Dừng vòng lặp sau khi hiển thị 1 banner --}}
            @endif
        @endforeach
    @endif
@endforeach

</div>
</div>
@foreach ($categories as $category)
@if ($category->status == 1)
@foreach ($category->categories_children as $item)
    @if ($item->status == 1)
        <section class="section_product_theme">
            <div class="container ">
                <div class="title_home">
                    <h2>{{ $item->name }}</h2>
                </div>
                <div class="owl-carousel owl-theme">
                    @if (isset($productByCategory[$item->id]))
                        @foreach ($productByCategory[$item->id] as $product)
                            @php
                                $priceDiscount = 0;
                                $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                                $productDiscountPrice = $product->productDiscount
                                    ->where('user_group_id', $userGroupId)
                                    ->first();

                                $price = $product->price ? $product->price : null;

                                if ($productDiscountPrice) {
                                    $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
                                }

                                $percent = ceil((($product->price - $priceDiscount) / $product->price) * 100);
                                $productImageCollect = $product->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                                $isFavourite = false;
                                if (Auth::check()) {
                                    $isFavourite = $product->favourite
                                        ->where('user_id', Auth::id())
                                        ->contains('product_id', $product->id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                                } else {
                                    $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                                    // Lấy danh sách tất cả các product_id từ mảng $favourite
                                    $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                                    // Kiểm tra xem $item->id có nằm trong danh sách product_id không
                                    $isFavourite =
                                        is_array($productIds) && in_array((string) $product->id, $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                                }
                            @endphp

                            <div class="item">
                                <div class="product_box">
                                    <div class="product_box_effect">
                                        @if (isset($productDiscountPrice))
                                            <div class="product_box_tag_sale">
                                                {{ $percent }}%</div>
                                        @endif
                                        <div class="product_box_icon">
                                            <button onclick="addFavourite('{{ $product->id }}')"
                                                class="outline-0 border-0"
                                                style="background-color: transparent">
                                                <i class="fa-solid fa-heart {{ $isFavourite ? 'red' : '' }}"
                                                    data-product-id="favourite-{{ $product->id }}"></i>
                                            </button> <button class="outline-0 border-0 "
                                                style="background-color: transparent"
                                                onclick="showModalProduct(event,'{{ $product->id }}','{{ $product->image }}','{{ $product->name }}','{{ $product->price }}','{{ $priceDiscount }}','{{ json_encode($productImageCollect) }}')">
                                                <i class="fa-regular fa-eye"></i>

                                            </button>
                                            {{-- truyền vào id sản phẩm và số lượng cần thêm,user_id server láy từ sesion --}}
                                            <button type="button"
                                                onclick="addToCart('{{ $product->id }}', 1)"
                                                class="outline-0 border-0 "
                                                style="background-color: transparent">
                                                <i class="fa-solid fa-bag-shopping"></i>
                                            </button>
                                        </div>
                                        <div class="product_box_image">
                                            <img src="{{ asset('img/' . $product->image) }}"
                                                alt="{{ $product->name }}" />
                                        </div>
                                        <div class="product_box_content_out">
                                            <div class="product_box_content">
                                                <h3><a
                                                        href="{{ route('detail', $product->slug) }}">{{ $product->name }}</a>
                                                </h3>

                                            </div>
                                            @if ($productDiscountPrice)
                                                <div class="product_box_price">
                                                    <span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',', '.') . 'đ' }}
                                                </div>
                                            @else
                                                <div class="product_box_price">
                                                    <span></span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    @endif
@endforeach
@endif
@endforeach

<!-- START PRODUCT BÁN CHẠY -->
<section class="product">
<div class="container">
<div class="title_home">
    <h2>Sản phẩm bán chạy</h2>
</div>
<div class="owl-carousel owl-theme">
    @foreach ($productBestseller as $item)
        @php
            $priceDiscount = 0;
            $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
            $productDiscountPrice = $item->productDiscount->where('user_group_id', $userGroupId)->first();

            $price = $item->price ? $item->price : null;

            if ($productDiscountPrice) {
                $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
            }

            $percent = ceil((($item->price - $priceDiscount) / $item->price) * 100);
            $productImageCollect = $item->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
            $isFavourite = false;
            if (Auth::check()) {
                $isFavourite = $item->favourite->where('user_id', Auth::id())->contains('product_id', $item->id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
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
                    <div class="product_box_tag_soldout">Hot</div>
                    @if (isset($productDiscountPrice))
                        <div class="product_box_tag_sale_outstanding">{{ $percent }}%</div>
                    @endif
                    <div class="product_box_icon">
                        <button onclick="addFavourite('{{ $item->id }}')" class="outline-0 border-0"
                            style="background-color: transparent">
                            <i class="fa-solid fa-heart {{ $isFavourite ? 'red' : '' }}"
                                data-product-id="favourite-{{ $item->id }}"></i>
                        </button>
                        <button class="outline-0 border-0" style="background-color: transparent"
                            onclick="showModalProduct(event,'{{ $item->id }}','{{ $item->image }}','{{ $item->name }}','{{ $item->price }}','{{ $priceDiscount }}','{{ json_encode($productImageCollect) }}')">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                        {{-- truyền vào id sản phẩm và số lượng cần thêm,user_id server láy từ sesion --}}
                        <button type="button" onclick="addToCart('{{ $item->id }}', 1)"
                            class="outline-0 border-0" style="background-color: transparent">
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
                        <div class="product_box_content_soldout">
                            <p>+{{ $item->orderProduct->sum('quantity') }} Lượt mua</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
</section>
<!-- END PRODUCT BÁN CHÁY-->

<!-- START BUILT -->
<section class="home_built">
<div class="container-fluid">
<div class="title_home_built">
    <h2>Được xây dựng bởi bạn</h2>
</div>
<div class="row">
    @foreach ($commentBuildImageById as $item)
        <div class="col-md-3 col-sm-4 col-12">
            <div class="built_box">
                <div class="built_box_effect">
                    <div class="built_box_image">
                        <img src="{{ asset('img/' . $item->images) }}" alt="" />

                    </div>
                    <div class="built_buyNow"> <a
                            href="{{ route('detail', $item->comment->product->slug) }}">Mua
                            ngay</a></div>

                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-md-12">
        <div class="div_btn_built">
            <a href="{{ route('inspiration') }}" class="built_home_text_btn">Khám phá <i
                    class="fa-solid fa-chevron-right"></i></a>
        </div>
    </div>
</div>
</div>
</section>
<!-- END BUILT -->

<!-- START PRODUCT HẾT HÀNG -->
@if ($productSoldOut && count($productSoldOut) > 0)
<section class="product">
<div class="container">
    <div class="title_home">
        <h2>Sản phẩm hết hàng</h2>
    </div>
    <div class="owl-carousel owl-theme">
        @foreach ($productSoldOut as $item)
            <div class="item">
                <div class="product_box">
                    <div class="product_box_effect">
                        <div class="product_box_tag_soldout">Hết hàng</div>
                        <div class="product_box_image_black">
                            <img src="{{ asset('img/' . $item->image) }}" alt="" />
                        </div>
                        <div class="product_box_content_out">
                            <div class="product_box_content">
                                <h3><a
                                        href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a>
                                </h3>
                            </div>
                            <div class="">
                                <span
                                    class="text-black">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</section>
@endif

<!-- END PRODUCT HẾT HÀNG -->

<!-- START BÀI VIẾT -->
<section>
<div class="container">
<div class="title_btn_blog">
    <div class="title_home_blog">
        <h2>Đọc tất cả về nó</h2>
    </div>
    <div class="btn_home_blog"><a href="{{ route('categoryArticleUser') }}">Xem tất cả bài viết</a>
    </div>
</div>
<div class="row">
    @foreach ($articles as $item)
        <div class="col-md-3 col-sm-4 col-12">
            <div class="blog_box">
                <div class="blog_box_effect">
                    <div class="blog_box_image">
                        <img src="{{ asset('img/' . $item->image) }}" alt="" />
                    </div>
                    <div class="blog_box_content_out">
                        <div class="blog_box_content">
                            <h3>
                                <a
                                    href="{{ route('articlesUser', $item->id) }}">{{ $item->title }}</a>
                            </h3>
                            <span> {!! $item->description_short !!}</span>
                            <a href="{{ route('articlesUser', $item->id) }}">Đọc thêm <i
                                    class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
</section>
<!-- END BÀI VIẾT -->
</div>



@endsection
