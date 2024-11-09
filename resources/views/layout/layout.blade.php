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
            @include('layout.header')
        </header>

        <main>
            @yield('content')
            <div id="modal_home" class="modal_product_main">
            </div>
        </main>

        <footer>
            @include('layout.footer')
        </footer>
    </div>

    <!-- Jquery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/index.js') }} "></script>
    <script src="{{ asset('js/admin.js') }} "></script>
    <script src="{{ asset('js/api63.js') }} "></script>

    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 3,
                    },
                    1000: {
                        items: 4,
                    },
                },
            });
        });
    </script>
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

    <script>
        function addToCart(product_id, quantity) {
            $.ajax({
                url: '{{ route('cartForm') }}',
                type: 'POST',
                data: {
                    product_id: product_id,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'my-popup-zindex' // Thêm lớp tùy chỉnh
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Có lỗi xảy ra! Vui lòng thử lại sau",
                        showConfirmButton: true,
                        customClass: {
                            popup: 'my-popup-zindex' // Thêm lớp tùy chỉnh
                        }
                    });
                }
            })
        }


        // không cần phải gửi user_id từ phía client khi sử dụng AJAX, vì server có thể lấy nó từ session.
        // server sẽ lấy user_id từ session -> Mỗi lần người dùng gửi yêu cầu đến server, session này sẽ được gửi kèm theo yêu cầu đó.
    </script>
    <script>
        function addFavourite(id) {
            $.ajax({
                url: '{{ route('favouriteForm') }}',
                type: 'POST',
                data: {
                    product_id: id,
                    status: 1,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // console.log(response); // Kiểm tra phản hồi
                    const favouriteIcon = document.querySelector(`i[data-product-id="favourite-${id}"]`);
                    if (response.is_favourite) {
                        favouriteIcon.classList.add('red');
                        Swal.fire({
                            imageUrl: "{{ asset('img/tim.jpg') }}",
                            imageHeight: 150,
                            imageWidth: 150,
                            imageAlt: "A tall image",
                            showConfirmButton: false,
                            timer: 1000,
                            width: '300px',
                        });
                    } else {
                        favouriteIcon.classList.remove('red');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Có lỗi xảy ra! Vui lòng thử lại sau');
                }
            });
        }
    </script>
    <script>
        function showModalProduct(event, id, image, name, price, priceDiscount, productImages) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định

            const modalHome = document.getElementById("modal_home");
            modalHome.style.opacity = 1;
            modalHome.style.pointerEvents = "auto"; // Cho phép tương tác khi hiển thị

            var user_id = '{{ Auth::check() ? Auth::user()->id : 0 }}';
            var priceItem = 0;
            if (priceDiscount > 0) {
                priceItem = `
                <div class="product_box_price"><span>${new Intl.NumberFormat().format(price)}đ</span>${new Intl.NumberFormat().format(priceDiscount)}đ</div>
            `;
            } else {
                priceItem = `
                <div class="product_box_price"><span></span>${new Intl.NumberFormat().format(price)}đ</div>
            `;
            }

            //chuyển chuổi thành mảng
            var images = JSON.parse(productImages);
            var imagesList = images.map(img => `
            <li>
                <div class="modal_product_left_img">
                    <img src="{{ asset('img/${img}') }}" alt="" />
                </div>
            </li>
            `).join('');

            var template = `
            <div class="modal_product_content">
            <div id="close_modal" class="modal_product_content_one">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="modal_product_content_two">
                <div class="" style="max-width: 400px">
                    <div class="modal_product_content_two_img">
                        <img src="{{ asset('img/${image}') }}" alt="" />
                    </div>
                    <div class="modal_product_left_img">
                        <div class="modal_product_left_img_item_res">
                            <ul>
                               ${imagesList}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal_product_content_two_content">
                    <div class="">
                        <h2>${name}</h2>
                    </div>
                    ${priceItem}
                    <div class="detail_product_right_four py-3">
                        <div class="detail_product_right_four_item">
                            <button class="right_four_item_decrease" onclick="decreaseQuantity()">-</button>
                            <input type="text" class="right_four_item_number" id="inputQuantity" value="1" disabled />
                            <button class="right_four_item_increase" onclick="increaseQuantity()">+</button>
                        </div>
                        <div class="detail_product_right_four_span">

                        </div>
                    </div>
                    <div class="modal_btn">
                        <form action="{{ route('buyNow') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="${id}">
                            <input type="hidden" name="name" value="${name}">
                            <input type="hidden" name="price" value="${price}">
                            <input type="hidden" name="priceDiscount" value="${priceDiscount}">
                            <input type="hidden" name="image" value="${image}">
                            <input type="hidden" id="inputQuantityHidden" name="quantity" value="1">
                            <button type="submit" class="modal_btn_item">Mua ngay</button>
                        </form>
                        <button type="submit" onclick="addToCart(${id},document.getElementById('inputQuantity').value)" class="modal_btn_item">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
        `;
            // Hiển thị modal với nội dung template
            document.getElementById('modal_home').innerHTML = template;

            // đóng modal
            const closeModal = document.getElementById("close_modal");
            closeModal.onclick = function() {
                modalHome.style.opacity = 0;
            };

            //click vào ảnh con
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
        }

        window.addEventListener("click", function(event) {
            const modalHome = document.getElementById("modal_home");

            // Kiểm tra nếu modalHome tồn tại và sự kiện xảy ra ngoài modal (chính modalHome)
            if (event.target === modalHome) {
                modalHome.style.opacity = 0;
                modalHome.style.pointerEvents = "none"; // Ngăn tương tác khi ẩn
            }
        });

        function decreaseQuantity() {
            var inputQuantity = document.getElementById('inputQuantity');
            var inputQuantityHidden = document.getElementById('inputQuantityHidden');
            if (parseInt(inputQuantity.value) > 1) {
                //lớn hơn 1 thì mưới cho giảm số lượng, nghĩa là ko cho giảm quantity xuống 0
                inputQuantity.value = parseInt(inputQuantity.value) - 1;
                inputQuantityHidden.value = inputQuantity.value;
            }
        }

        function increaseQuantity() {
            var inputQuantity = document.getElementById('inputQuantity');
            var inputQuantityHidden = document.getElementById('inputQuantityHidden');

            inputQuantity.value = parseInt(inputQuantity.value) + 1;
            inputQuantityHidden.value = inputQuantity.value;
        }
    </script>
    <script>
        $(document).ready(function() { // khởi tạo sự kiện khi đã sẵn sàng
            $('.star').click(function(e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
                var rating = $(this).data('rating'); // giá trị rating sẽ được lấy từ data-rating
                $('#rating').val(rating); // Gán giá trị rating vào input ẩn

            });

            $('#commentReview').on('submit', function(e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
                var formData = new FormData(this); // Tạo đối tượng FormData và truyền vào form hiện tại

                $.ajax({
                    url: $(this).attr(
                        'action'
                    ), // $(this) đại diện cho đối tượng form hiện tại , attr phương thức lấy giá trị của thuộc tính action từ form
                    type: 'POST',
                    data: formData, //.serialize() lấy tất cả các trường input trong form (bao gồm các input ẩn, textarea, checkbox, radio, v.v.) và tạo ra một chuỗi có định dạng URL-encoded.
                    processData: false, // Ngăn jQuery xử lý dữ liệu (quan trọng để gửi file)
                    contentType: false, // Ngăn jQuery tự động đặt Content-Type
                    success: function(response) {
                        $('#commentReview')[0].reset(); // Reset form
                        $('.star').removeClass('active'); // Xóa trạng thái sao đã chọn
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra! Vui lòng kiểm tra lại.');
                    }
                });
            });
        });
    </script>

    <script>
        $('.stars a').on('click', function() {
            $('.stars .stars_span, .stars a').removeClass('active');

            $(this).addClass('active');
            $('.stars .stars_span').addClass('active');
            // alert($(this).text());
        });
    </script>
    <script>
        document.querySelectorAll('.fa-heart').forEach(function(heart) {
            heart.addEventListener('click', function() {
                this.classList.toggle('red');
            })
        });
    </script>
    <script>
        document.getElementById('assemblyPackageForm').addEventListener('submit', function(event) {
            const selectedAssemblyPackage = document.querySelector('input[name="assemblyPackage"]:checked');

            if (!selectedAssemblyPackage) {
                event.preventDefault();
                alert('Vui lòng chọn một gói lắp ráp.');
            } else {
                // Gán giá trị của gói lắp ráp đã chọn vào input ẩn
                const selectedPackageId = selectedAssemblyPackage.value;
                document.getElementById('selectedAssemblyPackageId').value = selectedPackageId;
                document.getElementById('selectedAssemblyPackageFee').value = document.getElementById(
                    'assemblyPackageFee-' + selectedPackageId).value;
                document.getElementById('selectedAssemblyPackagePrice').value = document.getElementById(
                    'assemblyPackagePrice-' + selectedPackageId).value;
            }
        });

        const span_assembly = document.querySelectorAll('.span_assembly');
        const detail_assembly = document.querySelectorAll('.detail_assembly');
        span_assembly.forEach((span, i) => {
            span.addEventListener('click', () => {
                detail_assembly.forEach(detail => detail.style.display = 'none');

                detail_assembly[i].style.display = "block";
            })
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.banner_image_li');
            const popup = document.getElementById('popup_image_review');
            const close = document.querySelector('.close_image');

            const popupImage = document.getElementById(
                'popup_image_review_img');
            images.forEach(item => {
                item.addEventListener('click', () => {
                    const imgSrc = item.getAttribute('data-image');

                    popupImage.innerHTML = `<img src="${imgSrc}" alt="">`;
                    popup.style.display = 'Block';
                })
            })

            close.addEventListener('click', function() {
                popup.style.display = 'none';
            })
            window.addEventListener('click', function(event) {
                if (event.target === popup) {
                    popup.style.display = 'none';
                }
            })
        })
    </script>

</body>

</html>
