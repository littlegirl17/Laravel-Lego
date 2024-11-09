<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar ">
        <!-- Sidebar scroll-->
        <div>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer d-flex justify-content-end"
                id="sidebarCollapse">
                <img width="40" height="40" src="https://img.icons8.com/ios/50/FFFFFF/close-window--v1.png"
                    alt="close-window--v1" />
            </div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="{{ route('dashboard') }}" class="text-nowrap logo-img mt-4">
                    @foreach ($banners as $item)
                        @if ($item->position == 3 && $item->status == 1)
                            @foreach ($item->bannerImages as $image)
                                @if ($image->status == 1)
                                    <img src="{{ asset('img/' . $image->image_desktop) }}" width="180"
                                        alt="" />
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </a>

            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti fa-solid fa-gauge-high ico-side" style="color: #FFFFFF;"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    @if (in_array('banner', $permission))
                        <li class="sidebar-item">
                            <a class="sidebar-link  d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="fa-solid fa-image ico-side"
                                            style="color: #FFFFFF;font-size:20px;"></i> </span>
                                    <span class="hide-menu  ps-2">Quản lý hình ảnh</span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                {{-- vế 1 giá trị bạn muốn kiểm tra, vế 2 là mảng chứa các quyền --}}
                                <li class="">
                                    <a class="sidebar-link" href="{{ route('bannerManage') }}" aria-expanded="false">
                                        <span style="width:20px">
                                            <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                        </span>
                                        <span class="hide-menu">Vị trí hình ảnh</span>
                                    </a>
                                </li>
                                @if (in_array('banner', $permission))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('banner') }}" aria-expanded="false">
                                            <span style="width:20px"> <i class="fa-solid fa-angles-right"
                                                    style="color: #ffffff;"></i>

                                            </span>
                                            <span class="hide-menu">Banner-Hình</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (in_array('category', $permission) || in_array('product', $permission) || in_array('comment', $permission))
                        <li class="sidebar-item">
                            <a class="sidebar-link d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="fa-solid fa-tag" style="color: #ffffff; font-size:20px;"></i>
                                    </span>
                                    <span class="hide-menu ps-2">Quản lý sản phẩm
                                    </span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                @if (in_array('category', $permission))
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('category') }}" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Danh mục</span>
                                        </a>
                                    </li>
                                @endif
                                @if (in_array('product', $permission))
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('product') }}" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Sản phẩm</span>
                                        </a>
                                    </li>
                                @endif
                                @if (in_array('favourite', $permission))
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('favourite') }}" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Sản phẩm yêu thích</span>
                                        </a>
                                    </li>
                                @endif
                                @if (in_array('comment', $permission))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route('comment') }}" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Bình luận</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (in_array('coupon', $permission))
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('coupon') }}" aria-expanded="false">
                                <span style="width:20px">
                                    <i class="fa-solid fa-ticket" style="color: #ffffff;font-size:20px;"></i>
                                </span>
                                <span class="hide-menu">Mã giảm giá</span>
                            </a>
                        </li>
                    @endif

                    @if (in_array('order', $permission))
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.order') }}" aria-expanded="false">
                                <span style="width:20px">
                                    <img width="20" height="20"
                                        src="https://img.icons8.com/ios/20/FFFFFF/purchase-order.png"
                                        alt="purchase-order" />
                                </span>
                                <span class="hide-menu">Đơn hàng</span>
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-item">
                        <a class="sidebar-link" aria-expanded="false">
                            <span style="width:20px">
                                <i class="fa-solid fa-arrows-to-dot" style="color: #ffffff;font-size:20px;"></i>
                            </span>
                            <span class="hide-menu">Dịch vụ Lego</span>
                        </a>
                        <ul class="submenu">
                            <li class="">
                                <a class="sidebar-link" href="{{ route('assembly') }}" aria-expanded="false">
                                    <span style="width:20px">
                                        <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                    </span>
                                    <span class="hide-menu">Dịch vụ lắp ráp</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @if (in_array('user', $permission) || in_array('userGroup', $permission) || in_array('contact', $permission))
                        <li class="sidebar-item">
                            <a class="sidebar-link  d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="ti fa-solid fa-user ico-side"
                                            style="color: #ffffff; font-size:20px;"></i>
                                    </span>
                                    <span class="hide-menu  ps-2">Khách hàng</span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                @if (in_array('contact', $permission))
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('contactAdmin') }}"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-regular fa-address-book" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Liên hệ</span>
                                        </a>
                                    </li>
                                @endif
                                @if (in_array('user', $permission))
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('userAdmin') }}"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Khách hàng</span>
                                        </a>
                                    </li>
                                @endif
                                @if (in_array('userGroup', $permission))
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('userGroup') }}"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Nhóm khách hàng</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (in_array('administration', $permission) || in_array('administrationGroup', $permission))
                        <li class="sidebar-item">
                            <a class="sidebar-link  d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="fa-solid fa-users" style="color: #ffffff;"></i>
                                    </span>
                                    <span class="hide-menu  ps-2">Người dùng</span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                @if (in_array('administration', $permission))
                                    {{-- vế 1 giá trị bạn muốn kiểm tra, vế 2 là mảng chứa các quyền --}}
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('adminstration') }}"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Người dùng</span>
                                        </a>
                                    </li>
                                @endif
                                @if (in_array('administrationGroup', $permission))
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('adminstrationGroup') }}"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Nhóm Người dùng</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (in_array('article', $permission) || in_array('categoryArticle', $permission))
                        <li class="sidebar-item">
                            <a class="sidebar-link  d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="fa-solid fa-newspaper" style="color: #ffffff; font-size:20px;"></i>
                                    </span>
                                    <span class="hide-menu  ps-2">Bài viết - blog</span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                @if (in_array('categoryArticle', $permission))
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('categoryArticle') }}"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Danh mục bài viết</span>
                                        </a>
                                    </li>
                                @endif
                                @if (in_array('article', $permission))
                                    <li class="">
                                        <a class="sidebar-link" href="{{ route('article') }}" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Bài viết</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <li class="sidebar-item" style="border-top: 1px solid #7e7b7b">
                        <a class="sidebar-link" href="{{ route('adminLogout') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti fa-solid fa-right-from-bracket ico-side" style="color: #ffffff;"></i>
                            </span>
                            <span class="hide-menu">Đăng xuất</span>
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                            <img width="50" height="50"
                                src="https://img.icons8.com/ios/50/FFFFFF/menu-squared-2.png" alt="menu-squared-2" />
                        </a>
                    </li>

                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                data-bs-toggle="dropdown" aria-expanded="false">

                                @if (Auth::guard('admin')->check())
                                    <img src="{{ asset('img/' . Session::get('admin')->image) }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                @endif

                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">My Profile</p>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-mail fs-6"></i>
                                        <p class="mb-0 fs-3">My Account</p>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-list-check fs-6"></i>
                                        <p class="mb-0 fs-3">My Task</p>
                                    </a>
                                    <a href="./authentication-login.html"
                                        class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
