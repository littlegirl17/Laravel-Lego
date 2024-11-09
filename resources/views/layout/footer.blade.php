<footer class="footer_home">
    <div class="footer_home_main">
        <div class="footer_main_column">
            <div class="footer_main_column_item">
                <div class="footer_main_column_item_img">
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
                <div class="footer_main_column_item_content">
                    <a href="index.html">Trang chủ</a>
                    <a href="category.html">Sản phẩm</a>
                    <a href="article.html">Tin tức</a>
                    <a href="contact.html">Liên hệ</a>
                </div>
            </div>
        </div>
        <div class="footer_main_column">
            <div class="footer_main_column_item">
                <div class="footer_main_column_item_title">
                    <h3>Chính sách công ty</h3>
                </div>
                <div class="footer_main_column_item_content">
                    <a href="">Chính sách thanh toán</a>
                    <a href="">Chính sách vận chuyện</a>
                    <a href="">Chính sách đổi trả</a>
                    <a href="">Chính sách bảo hành</a>
                </div>
            </div>
        </div>
        <div class="footer_main_column">
            <div class="footer_main_column_item">
                <div class="footer_main_column_item_title">
                    <h3>Hỗ trợ khách hàng</h3>
                </div>
                <div class="footer_main_column_item_content">
                    <a href="">Đăng ký thành viên</a>
                    <a href="">Hướng dẫn mua hàng</a>
                    <a href="">Giao nhận và thanh toán</a>
                    <a href="">Đổi trả và bảo hành</a>
                </div>
            </div>
        </div>
        <div class="footer_main_column">
            <div class="footer_main_column_item">
                <div class="footer_main_column_item_title">
                    <h3>Thêm từ chúng tôi</h3>
                </div>
                <div class="footer_main_column_item_content">
                    <a href="">Danh mục LegoLoft</a>
                    <a href="">Giáo dục LegoLoft</a>
                    <a href="">Ý tưởng LegoLoft</a>
                    <a href="">Nền tưởng LegoLoft</a>
                </div>
            </div>
        </div>
    </div>
</footer>
