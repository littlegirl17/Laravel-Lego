@extends('layout.layout')
@section('title', 'Danh mục bài viết')
@section('content')
    <!-- START MAIN -->
    <div class="background_article">
        <div class="container m-0 p-0">
            <div class="article_main">
                <div class="article_main_one">
                    <div class="article_main_one_desktop">
                        <div class="article_main_one_img">
                            <img src="img/article_banner.webp" alt="" />
                        </div>
                        <div class="article_main_one_content">
                            <h2>Tin tức mới nhất về LEGOLOFT®</h2>
                            <p>
                                Chào mừng đến với trang chủ chính thức của LEGOLOFT® News and
                                Gifting Inspiration. Cho dù bạn đang duyệt cho chính mình, một
                                đứa trẻ hay một người thân yêu, bạn sẽ tìm thấy nhiều bài viết
                                truyền cảm hứng tại đây.
                            </p>
                        </div>
                    </div>
                    <div class="article_main_one_mobile">
                        <div class="article_main_one_img_mobile">
                            <img src="img/article_banner_mobile.webp" alt="" />
                        </div>
                        <div class="article_main_one_content_mobile">
                            <h2>Tin tức mới nhất về LEGOLOFT®</h2>
                            <p>
                                Chào mừng đến với trang chủ chính thức của LEGOLOFT® News and
                                Gifting Inspiration. Cho dù bạn đang duyệt cho chính mình, một
                                đứa trẻ hay một người thân yêu, bạn sẽ tìm thấy nhiều bài viết
                                truyền cảm hứng tại đây.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="article_main_two"></div>
            </div>
        </div>
        <!-- START BÀI VIẾT -->
        <section>
            @foreach ($categoryArticles as $category)
                <div class="container py-5">
                    <div class="title_btn_blog">
                        <div class="title_home_blog">
                            <h2 class="text-light">
                                {{ $category->title }}
                            </h2>
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($category->articles as $item)
                            <div class="item">
                                <div class="blog_box">
                                    <div class="blog_box_effect">
                                        <div class="blog_box_image">
                                            <img src="{{ asset('img/' . $item->image) }}" alt="" />
                                        </div>
                                        <div class="blog_box_content_out">
                                            <div class="blog_box_content">
                                                <h3>
                                                    <a href="" class="text-light">{{ $item->title }}</a>
                                                </h3>
                                                <span class="text-light">{!! $item->description_short !!}</span>
                                                <a href="{{ route('articlesUser', $item->id) }}" class=" text-light ">Đọc
                                                    thêm <i class="fa-solid fa-chevron-right ps-2 text-light"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach


        </section>
        <!-- END BÀI VIẾT -->
    </div>
    <!-- END MAIN -->
@endsection
