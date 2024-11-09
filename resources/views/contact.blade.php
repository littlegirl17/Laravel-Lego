@extends('layout.layout')
@section('title', 'Liên hệ')
@section('content')
    <!-- START MAIN -->
    <div class="background_home">
        <div class="banner_contact">
            <div class="banner_contact_img_one">
                <div class="banner_contact_img">
                    <img src="img/bannercontact.webp" alt="" />
                </div>
            </div>
            <div class="banner_contact_title">
                <h2>Xin chào! Chúng tôi có thể giúp gì cho bạn?</h2>
            </div>
            <div class=""></div>
        </div>
        <div class="container">
            <div class="row contact_main">
                <div class="col-md-6 col-12 pb-3">
                    <div class="contact_left">
                        <div class="contact_left_content">
                            <h2>Đồ chơi LEGO Việt Nam</h2>
                        </div>
                        <div class="contact_left_content">
                            <ul>
                                <li>
                                    <i class="fa-solid fa-location-dot"></i>Quận Gò Vấp, TP Hồ
                                    Chí Minh
                                </li>
                                <li>
                                    <i class="fa-solid fa-mobile-screen-button"></i>Điện thoại:
                                    0353123771
                                </li>
                                <li>
                                    <i class="fa-regular fa-envelope"></i>Email:
                                    legoloft@gmail.com
                                </li>
                            </ul>
                        </div>
                        <div class="contact_left_img">
                            <img src="img/contact.webp" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="contact_right">
                        <div class="contact_right_title">
                            <h2>Gửi liên hệ cho chúng tôi</h2>
                        </div>
                        <form action="">
                            <div class="input_form_contact">
                                <input type="text" class="contact_input" id="" placeholder="Họ và tên"
                                    name="name" value="" />
                                <input type="email" class="contact_input" id="" placeholder="Email"
                                    name="name" value="" />
                            </div>
                            <div class="row input_form_contact_2">
                                <input type="number" class="contact_input" id="" placeholder="Số điện thoại"
                                    name="name" value="" />
                            </div>
                            <div class="row input_form_contact_2">
                                <textarea placeholder="Nội dung" class="contact_textarea" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <button class="btn_checkout">Gửi liên hệ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15674.245855418822!2d106.6681982105001!3d10.844833529640418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175284d62a1b927%3A0xae050f1c00315b0!2zMTAyIFPhu5EgMzAsIFBoxrDhu51uZyA2LCBHw7IgVuG6pXAsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1725104533361!5m2!1svi!2s"
                class="map_contact" style="border: 0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!-- END MAIN -->
@endsection
