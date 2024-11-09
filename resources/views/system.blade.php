@extends('layout.layout')
@section('title', 'Hệ thống cửa hàng')
@section('content')
    <div class="container">
        <div class="row py-5">
            <div class="col-md-6 col-12">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15674.245855418822!2d106.6681982105001!3d10.844833529640418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175284d62a1b927%3A0xae050f1c00315b0!2zMTAyIFPhu5EgMzAsIFBoxrDhu51uZyA2LCBHw7IgVuG6pXAsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1725104533361!5m2!1svi!2s"
                    class="map_system" style="border: 0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6 col-12 system_right">
                <div class="system_title">
                    <h2>Hệ thống đại lý của LegoLoft</h2>
                </div>
                <div class="system_content">
                    <p>- Địa chỉ: 102 đường 30, phường 6, Gò Vấp, tp Hồ Chí Minh</p>
                    <p>- SĐT: 0353123771</p>
                    <p>- Email: legoloft@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
@endsection
