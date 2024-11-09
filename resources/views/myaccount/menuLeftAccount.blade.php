<aside class="layout_member_left_aside">
    <nav class="layout_member_left_nav">
        <ul>
            <li class="layout_member_left_nav_li accordion-item" onclick="setActiveAccount(this)">
                <svg id="Category" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.60693 10.3931H9.60693V3.39307H2.60693V10.3931Z"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                    <path opacity="0.4" d="M2.60693 14.3936V21.3936H9.60693V14.3936H2.60693Z" stroke="#000000"
                        stroke-width="1.5" stroke-linecap="square"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6069 21.3931H20.6069V14.3931H13.6069V21.3931Z"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                    <path opacity="0.4"
                        d="M14.6321 2.60645L12.8203 9.36793L19.5818 11.1797L21.3936 4.41818L14.6321 2.60645Z"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                </svg>
                <a href="{{ route('member') }}" class="layout_member_left_nav_li_a">Tổng quan về tài khoản</a>
            </li>
            <li class="accordion-item">
                <div class="d-flex justify-content-between align-items-center">

                    <a href="#" onclick="memberSubmenu(this)">
                        <svg id="Buy" width="24" height="25" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M14.625 10.9637H17.2967" stroke="#000000" stroke-width="1.5"
                                stroke-linecap="square"></path>
                            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.90889 20.0273C8.19889 20.0273 8.43302 20.2624 8.43302 20.5515C8.43302 20.8415 8.19889 21.0766 7.90889 21.0766C7.61889 21.0766 7.38477 20.8415 7.38477 20.5515C7.38477 20.2624 7.61889 20.0273 7.90889 20.0273Z"
                                fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.7761 20.0273C19.0661 20.0273 19.3012 20.2624 19.3012 20.5515C19.3012 20.8415 19.0661 21.0766 18.7761 21.0766C18.4861 21.0766 18.252 20.8415 18.252 20.5515C18.252 20.2624 18.4861 20.0273 18.7761 20.0273Z"
                                fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                            <path d="M5.87516 7.05288H21.5L20.2306 16.6875H6.74355L5.46652 3.99268H3" stroke="#000000"
                                stroke-width="1.5" stroke-linecap="square"></path>
                        </svg><span class="ps-1">Đơn hàng của tôi</span>
                    </a>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <ul class="layout_member_left_submenu show">

                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('pendingPurchase') }}"><i class="fa fa-solid fa-plus"></i>Chờ xác nhận</a>
                    </li>
                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('waitConfirmation') }}"><i class="fa fa-solid fa-plus"></i>Đã xác nhận</a>
                    </li>
                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('shipping') }}"><i class="fa fa-solid fa-plus"></i>Đang vận chuyển</a>
                    </li>
                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('purchase') }}"><i class="fa fa-solid fa-plus"></i>Hoàn thành</a>
                    </li>
                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('cancel') }}"><i class="fa fa-solid fa-plus"></i>Đã hủy</a>
                    </li>
                </ul>
            </li>
            <li class="accordion-item" onclick="setActiveAccount(this)">
                <svg id="Password" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.6889 12.0001C10.6889 13.0231 9.85986 13.8521 8.83686 13.8521C7.81386 13.8521 6.98486 13.0231 6.98486 12.0001C6.98486 10.9771 7.81386 10.1481 8.83686 10.1481H8.83986C9.86186 10.1491 10.6889 10.9781 10.6889 12.0001Z"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.6919 12.0001H17.0099V13.8521" stroke="#000000" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M14.1821 13.8521V12.0001" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.75 12.0001C2.75 5.06312 5.063 2.75012 12 2.75012C18.937 2.75012 21.25 5.06312 21.25 12.0001C21.25 18.9371 18.937 21.2501 12 21.2501C5.063 21.2501 2.75 18.9371 2.75 12.0001Z"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <a href="{{ route('forgetPasswordAccount') }}">Thay đôi mật khẩu</a>
            </li>
            <li class="accordion-item" onclick="setActiveAccount(this)">
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg id="Logout" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>Iconly/Two-tone/Logout</title>
                    <g id="Iconly/Two-tone/Logout" stroke="none" stroke-width="1.5" fill="none"
                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                        <g id="Logout" transform="translate(2.000000, 2.000000)" stroke="#000000"
                            stroke-width="1.5">
                            <path
                                d="M13.016,5.3895 L13.016,4.4565 C13.016,2.4215 11.366,0.7715 9.331,0.7715 L4.456,0.7715 C2.422,0.7715 0.772,2.4215 0.772,4.4565 L0.772,15.5865 C0.772,17.6215 2.422,19.2715 4.456,19.2715 L9.341,19.2715 C11.37,19.2715 13.016,17.6265 13.016,15.5975 L13.016,14.6545"
                                id="Stroke-1" opacity="0.400000006"></path>
                            <line x1="19.8095" y1="10.0214" x2="7.7685" y2="10.0214" id="Stroke-3">
                            </line>
                            <polyline id="Stroke-5" points="16.8812 7.1063 19.8092 10.0213 16.8812 12.9373">
                            </polyline>
                        </g>
                    </g>
                </svg>
                <a href="javascript:void(0);" onclick="window.location.href='{{ route('logout') }}'">Đăng xuất</a>
            </li>
        </ul>
    </nav>
</aside>

<div class="accordion_member">
    <div class="accordion-header_member d-flex justify-content-between align-items-center">
        <p class="m-0 p-0"><strong>Tất cả chủ đề</strong></p>
        <i class="fa-solid fa-plus"></i>
    </div>
    <div class="accordion-content_member">
        <ul>
            <li class=" accordion-item" onclick="setActiveAccount(this)">
                <svg id="Category" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.60693 10.3931H9.60693V3.39307H2.60693V10.3931Z" stroke="#000000" stroke-width="1.5"
                        stroke-linecap="square"></path>
                    <path opacity="0.4" d="M2.60693 14.3936V21.3936H9.60693V14.3936H2.60693Z" stroke="#000000"
                        stroke-width="1.5" stroke-linecap="square"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M13.6069 21.3931H20.6069V14.3931H13.6069V21.3931Z" stroke="#000000" stroke-width="1.5"
                        stroke-linecap="square"></path>
                    <path opacity="0.4"
                        d="M14.6321 2.60645L12.8203 9.36793L19.5818 11.1797L21.3936 4.41818L14.6321 2.60645Z"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                </svg>
                <a href="{{ route('member') }}" class="layout_member_left_nav_li_a">Tổng quan về tài khoản</a>
            </li>
            <li class="accordion-item">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" onclick="memberSubmenu(this)">
                        <svg id="Buy" width="24" height="25" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M14.625 10.9637H17.2967" stroke="#000000" stroke-width="1.5"
                                stroke-linecap="square"></path>
                            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.90889 20.0273C8.19889 20.0273 8.43302 20.2624 8.43302 20.5515C8.43302 20.8415 8.19889 21.0766 7.90889 21.0766C7.61889 21.0766 7.38477 20.8415 7.38477 20.5515C7.38477 20.2624 7.61889 20.0273 7.90889 20.0273Z"
                                fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.7761 20.0273C19.0661 20.0273 19.3012 20.2624 19.3012 20.5515C19.3012 20.8415 19.0661 21.0766 18.7761 21.0766C18.4861 21.0766 18.252 20.8415 18.252 20.5515C18.252 20.2624 18.4861 20.0273 18.7761 20.0273Z"
                                fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                            <path d="M5.87516 7.05288H21.5L20.2306 16.6875H6.74355L5.46652 3.99268H3" stroke="#000000"
                                stroke-width="1.5" stroke-linecap="square"></path>
                        </svg>
                        <span class="ps-1">Đơn hàng của tôi</span>
                    </a>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <ul class="layout_member_left_submenu show">

                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('pendingPurchase') }}"><i class="fa fa-solid fa-plus"></i>Chờ xác nhận</a>
                    </li>
                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('waitConfirmation') }}"><i class="fa fa-solid fa-plus"></i>Đã xác nhận</a>
                    </li>
                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('shipping') }}"><i class="fa fa-solid fa-plus"></i>Đang vận chuyển</a>
                    </li>
                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('purchase') }}"><i class="fa fa-solid fa-plus"></i>Hoàn thành</a>
                    </li>
                    <li class="accordion-item layout_member_left_submenu_li" onclick="setActiveAccount(this)">
                        <a href="{{ route('cancel') }}"><i class="fa fa-solid fa-plus"></i>Đã hủy</a>
                    </li>
                </ul>
            </li>
            <li class="accordion-item" onclick="setActiveAccount(this)">
                <svg id="Password" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.6889 12.0001C10.6889 13.0231 9.85986 13.8521 8.83686 13.8521C7.81386 13.8521 6.98486 13.0231 6.98486 12.0001C6.98486 10.9771 7.81386 10.1481 8.83686 10.1481H8.83986C9.86186 10.1491 10.6889 10.9781 10.6889 12.0001Z"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.6919 12.0001H17.0099V13.8521" stroke="#000000" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M14.1821 13.8521V12.0001" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.75 12.0001C2.75 5.06312 5.063 2.75012 12 2.75012C18.937 2.75012 21.25 5.06312 21.25 12.0001C21.25 18.9371 18.937 21.2501 12 21.2501C5.063 21.2501 2.75 18.9371 2.75 12.0001Z"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <a href="{{ route('forgetPasswordAccount') }}">Thay đôi mật khẩu</a>
            </li>
            <li class="accordion-item" onclick="setActiveAccount(this)">
                <svg id="Logout" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>Iconly/Two-tone/Logout</title>
                    <g id="Iconly/Two-tone/Logout" stroke="none" stroke-width="1.5" fill="none"
                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                        <g id="Logout" transform="translate(2.000000, 2.000000)" stroke="#000000"
                            stroke-width="1.5">
                            <path
                                d="M13.016,5.3895 L13.016,4.4565 C13.016,2.4215 11.366,0.7715 9.331,0.7715 L4.456,0.7715 C2.422,0.7715 0.772,2.4215 0.772,4.4565 L0.772,15.5865 C0.772,17.6215 2.422,19.2715 4.456,19.2715 L9.341,19.2715 C11.37,19.2715 13.016,17.6265 13.016,15.5975 L13.016,14.6545"
                                id="Stroke-1" opacity="0.400000006"></path>
                            <line x1="19.8095" y1="10.0214" x2="7.7685" y2="10.0214" id="Stroke-3">
                            </line>
                            <polyline id="Stroke-5" points="16.8812 7.1063 19.8092 10.0213 16.8812 12.9373">
                            </polyline>
                        </g>
                    </g>
                </svg>
                <a href="javascript:void(0);" onclick="window.location.href='{{ route('logout') }}'">Đăng xuất</a>
            </li>
        </ul>
    </div>
</div>
<script>
    const headers = document.querySelectorAll(".accordion-header_member");
    headers.forEach((header) => {
        header.addEventListener("click", () => {
            const content = header.nextElementSibling;
            content.style.display =
                content.style.display === "block" ? "none" : "block";
        });
    });
</script>
