<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('uploads/HK.png') }}" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div>
        <header>
            @include('myaccount.layout.header')
        </header>

        <main>
            @yield('content_myaccount')
        </main>

        <footer>
            @include('myaccount.layout.footer')
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/index.js') }} "></script>
    <script src="{{ asset('js/api63.js') }} "></script>
    <script src="{{ asset('js/admin.js') }} "></script>



    <script>
        // ------------------------- CLICK HEADER USER -----------------------

        const userImg = document.querySelector(".header_user_img");
        const userContent = document.querySelector(".header_user_content");
        const headerUserClick = document.querySelector(".header_user_click");
        userImg.addEventListener("click", function() {
            userContent.style.display = 'block';
        });

        window.addEventListener("click", function(event) {
            if (!headerUserClick.contains(event.target)) {
                //Hàm này kiểm tra xem phần tử được nhấp chuột có nằm trong header_user_click hay không. Nếu không, tức là bạn đã nhấp ra ngoài, và userContent sẽ được ẩn đi.
                userContent.style.display = 'none';
            }
        });
    </script>
    <script>
        function showModalProduct() {
            const modalHome = document.getElementById("modal_home");
            modalHome.style.opacity = 1;
            modalHome.style.pointerEvents = "auto"; // Cho phép tương tác khi hiển thị

            const closeModal = document.getElementById("close_modal");
            closeModal.onclick = function() {
                modalHome.style.opacity = 0;
            };
        }

        window.addEventListener("click", function(event) {
            const modalHome = document.getElementById("modal_home");

            // Kiểm tra nếu modalHome tồn tại và sự kiện xảy ra ngoài modal (chính modalHome)
            if (event.target === modalHome) {
                modalHome.style.opacity = 0;
                modalHome.style.pointerEvents = "none"; // Ngăn tương tác khi ẩn
            }
        });
    </script>
    <script>
        const largeImgHome = document.querySelector(
            ".modal_product_content_two_img img"
        );
        const smallImgHome = document.querySelectorAll(
            ".modal_product_left_img_item_res ul li img"
        );

        function updateLargeImageHome(i) {
            largeImgHome.style.opacity = 0; // ẩn ảnh lớn

            setTimeout(() => {
                largeImgHome.src = smallImgHome[i].src; // Thay đổi hình ảnh lớn
                largeImgHome.style.opacity = 1; // hiện ảnh lớn
            }, 100);
        }

        // Sự kiện click vào hình ảnh nhỏ
        smallImgHome.forEach((smallImg, i) => {
            smallImg.addEventListener("click", function() {
                updateLargeImageHome(i);
            });
        });
    </script>
    <script>
        window.onscroll = function() {
            const navbar = document.querySelector(".nav_box");
            const navbarItem = document.querySelector(".nav_box_item");
            const navImgLogo = document.querySelector(".nav_img_logo");
            const searchMobile = document.querySelector(
                ".nav_box_menu_right_mobile"
            );

            if (
                document.body.scrollTop > 50 ||
                document.documentElement.scrollTop > 50
            ) {
                navbar.classList.add("shrink");
                navbarItem.classList.add("shrink");
                navImgLogo.classList.add("shrink");
                searchMobile.classList.add("shrink");
            } else {
                navbar.classList.remove("shrink");
                navbar.classList.remove("shrink");
                navbarItem.classList.remove("shrink");
                navImgLogo.classList.remove("shrink");
                searchMobile.classList.remove("shrink");
            }
        };
    </script>
</body>

</html>
