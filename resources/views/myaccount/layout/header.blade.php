<!-- START NAV -->
<header class="header_top">
    <div class="container">
        <div class="header_top_main">
            <div class="header_top_item">
                <div class="header_top_item_child">
                    <span class="header_top_item_span"><i class="fa-regular fa-clock pe-1" style="color: #ffffff"></i>7:00
                        - 22:00</span>
                    <span class="ps-2"><i class="fa-solid fa-phone pe-1" style="color: #ffffff"></i>0353123771</span>
                </div>
            </div>

            <div class="header_top_item">
                <a href="{{ route('system') }}" class="text-light text-decoration-none"><span><i
                            class="fa-solid fa-location-dot pe-1" style="color: #ffffff"></i>Hệ thông cửa
                        hàng</span></a>
            </div>
        </div>
    </div>
</header>
<nav class="nav_box">
    <div class="container">
        <div class="nav_box_item">
            <div class="nav-brand">
                <a href="#" class="toggle-menu">
                    <i class="fas fa-bars"></i>
                </a>
                <div class="nav_img_logo">
                    @foreach ($banners as $item)
                        @if ($item->position == 2 && $item->status == 1)
                            @foreach ($item->bannerImages as $image)
                                @if ($image->status == 1)
                                    <a href="/">
                                        <img src="{{ asset('img/' . $image->image_desktop) }}" alt="" />
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                </div>
            </div>
            <div class="nav_box_menu">
                <ul class="nav_box_menu_item show-menu">
                    <li>
                        <a href="/" class="">Trang chủ </a>
                    </li>
                    <li class="parent-menu">
                        <a href="category.html" class="toggle-submenu">Bộ theo chủ đề</a>
                    </li>
                    <li><a href="{{ route('policy') }}">Chính sách</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    <li><a href="article.html">Bài viết </a></li>
                </ul>
            </div>
            <div class="nav_box_menu_right">
                <form action="{{ route('search') }}" method="get">
                    @csrf
                    <div class="">
                        <div class="containerInput">
                            <input checked="" class="checkbox" type="checkbox" />
                            <div class="mainbox">
                                <div class="iconContainer">
                                    <svg viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg"
                                        class="search_icon">
                                        <path
                                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z">
                                        </path>
                                    </svg>
                                </div>
                                <input class="search_input" name="name" placeholder="Tìm kiếm..." type="text" />
                            </div>
                        </div>
                    </div>
                </form>
                <div class="header_user_click">
                    <div class="header_user_img">
                        <img src="{{ asset('img/user.svg') }}" alt="" />
                    </div>
                    <div class="header_user_content">
                        <div class="header_user_content_moc_item">
                            <img src="{{ asset('img/legomini.svg') }}" alt="" />
                        </div>
                        <div class="m-0 p-0">
                            @auth
                                <div class="btn_contain">
                                    <button class="btn-register" onclick="window.location.href='{{ route('member') }}'">Tài
                                        khoản của tôi</button>
                                </div>
                                <div class="btn_contain">
                                    <button class="btn-login" onclick="window.location.href='{{ route('logout') }}'">Đăng
                                        xuất</button>
                                </div>
                            @else
                                <div class="btn_contain">
                                    <button class="btn-login" onclick="window.location.href='{{ route('login') }}'">Đăng
                                        nhập</button>
                                </div>
                                <div class="btn_contain">
                                    <button class="btn-register"
                                        onclick="window.location.href='{{ route('register') }}'">Đăng ký</button>
                                </div>
                            @endauth

                        </div>
                    </div>
                </div>

                <div class="icon_shoppingbag">
                    <a href="{{ route('cart') }}"> <img src="{{ asset('img/shoppingbag.png') }}" alt="" /></a>
                </div>
                <div class="">
                    <a href="{{ route('viewFavourite') }}"><!--?xml version="1.0" encoding="UTF-8"?-->
                        <svg id="Heart" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>Iconly/Light-Outline/Heart</title>
                            <g id="Iconly/Light-Outline/Heart" stroke="none" stroke-width="1.5" fill="none"
                                fill-rule="evenodd">
                                <g id="Heart" transform="translate(2.000000, 3.000000)" fill="#000000">
                                    <path
                                        d="M10.2347,1.039 C11.8607,0.011 14.0207,-0.273 15.8867,0.325 C19.9457,1.634 21.2057,6.059 20.0787,9.58 C18.3397,15.11 10.9127,19.235 10.5977,19.408 C10.4857,19.47 10.3617,19.501 10.2377,19.501 C10.1137,19.501 9.9907,19.471 9.8787,19.41 C9.5657,19.239 2.1927,15.175 0.3957,9.581 C0.3947,9.581 0.3947,9.58 0.3947,9.58 C-0.7333,6.058 0.5227,1.632 4.5777,0.325 C6.4817,-0.291 8.5567,-0.02 10.2347,1.039 Z M5.0377,1.753 C1.7567,2.811 0.9327,6.34 1.8237,9.123 C3.2257,13.485 8.7647,17.012 10.2367,17.885 C11.7137,17.003 17.2927,13.437 18.6497,9.127 C19.5407,6.341 18.7137,2.812 15.4277,1.753 C13.8357,1.242 11.9787,1.553 10.6967,2.545 C10.4287,2.751 10.0567,2.755 9.7867,2.551 C8.4287,1.53 6.6547,1.231 5.0377,1.753 Z M14.4677,3.7389 C15.8307,4.1799 16.7857,5.3869 16.9027,6.8139 C16.9357,7.2269 16.6287,7.5889 16.2157,7.6219 C16.1947,7.6239 16.1747,7.6249 16.1537,7.6249 C15.7667,7.6249 15.4387,7.3279 15.4067,6.9359 C15.3407,6.1139 14.7907,5.4199 14.0077,5.1669 C13.6127,5.0389 13.3967,4.6159 13.5237,4.2229 C13.6527,3.8289 14.0717,3.6149 14.4677,3.7389 Z"
                                        id="Combined-Shape"></path>
                                </g>
                            </g>
                        </svg></a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('search') }}" method="get">
        @csrf
        <div class="nav_box_menu_right_mobile">
            <input type="text" name="name" placeholder="Tìm kiếm tại đây..." />
        </div>
    </form>
    <div class="main_bar_menu_bg">
        <div class="main_bar_menu submenu">
            <div class="button_close_back">
                <div class="">
                    <p class="back-button">Back</p>
                </div>
                <div class="submenu_close">
                    <p class="close-button">X</p>
                </div>
            </div>
            <ul class="main_bar_menu_title">
                <li><a href="#">Trang chủ</a></li>
                <li class="d-flex justify-content-between align-items-center">
                    <a href="#" class="main_bar_menu_title_item">Bộ theo chủ đề</a>
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li><a href="{{ route('policy') }}">Chính sách</a></li>
                <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                <li><a href="#">Bài viết </a></li>
            </ul>
            <ul class="main_bar_menu_list">
                <li><a href="category.html">Xem tất cả chủ đề</a></li>
                @foreach ($categories as $category)
                    <li class="main_bar_menu_list_item">
                        <a href="#" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
            <ul class="main_bar_submenu_list">
                @foreach ($categories as $category)
                    <div class="submenu-category" style="display: none" data-category-id="{{ $category->id }}">
                        @foreach ($category->categories_children as $item)
                            <li><a href="{{ route('categoryProduct', $item->id) }}">{{ $item->name }}</a></li>
                        @endforeach
                    </div>
                @endforeach

            </ul>
        </div>
    </div>
</nav>
<!-- END NAV -->
