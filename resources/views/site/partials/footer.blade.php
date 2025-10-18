<footer class="footer-wrapper footer-layout3" >
    <div class="shape-mockup" data-top="0" data-left="0"><img src="/site/assets/img/shape/footer_shape_3.png" alt="shape">
    </div>
    <div class="shape-mockup" data-bottom="0" data-right="0"><img src="/site/assets/img/shape/footer_shape_4.png" alt="shape">
    </div>
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo"><a href="{{ route('front.home-page') }}"><img
                                        src="{{ $config->image->path ?? '' }}" alt="{{ $config->web_title }}" style="max-width: 41%"></a></div>
                            <p class="about-text">
                                {{ $config->introduction }}
                            </p>
                            <div class="th-social"><a href="{{ $config->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ $config->twitter }}"><i class="fab fa-twitter"></i></a>
                                <a href="{{ $config->instagram }}"><i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{ $config->youtube }}"><i class="fab fa-youtube"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget"><h3 class="widget_title"><img
                                src="/site/assets/img/theme-img/title_icon.svg" alt="Icon">Danh mục</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                                <li><a href="{{ route('front.abouts') }}">Giới thiệu</a></li>
                                <li><a href="{{ route('front.getProductList') }}">Sản phẩm</a></li>
                                <li><a href="{{ route('front.blogs') }}">Tin tức</a></li>
                                <li><a href="{{ route('front.contact') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget"><h3 class="widget_title"><img
                                src="/site/assets/img/theme-img/title_icon.svg" alt="Icon">Liên hệ</h3>
                        <div class="th-widget-contact">
                            <div class="info-box">
                                <div class="info-box_icon"><i class="fas fa-location-dot"></i></div>
                                <p class="info-box_text">{{ $config->address_company }}</p></div>
                            <div class="info-box">
                                <div class="info-box_icon"><i class="fas fa-phone"></i></div>
                                <p class="info-box_text"><a href="tel:{{ $config->hotline }}" class="info-box_link">{{ $config->hotline }}</a>
                                    <a href="tel:{{ $config->zalo }}" class="info-box_link">{{ $config->zalo }}</a></p></div>
                            <div class="info-box">
                                <div class="info-box_icon"><i class="fas fa-envelope"></i></div>
                                <p class="info-box_text"><a href="{{ $config->email }}" class="info-box_link">{{ $config->email }}</a>
                                </p></div>
                        </div>
                    </div>
                </div>
{{--                <div class="col-md-6 col-xl-auto">--}}
{{--                    <div class="widget footer-widget"><h3 class="widget_title"><img--}}
{{--                                src="/site/assets/img/theme-img/title_icon.svg" alt="Icon">Instagram</h3>--}}
{{--                        <div class="sidebar-gallery">--}}
{{--                            <div class="gallery-thumb"><img src="/site/assets/img/widget/gallery_1_1.jpg" alt="Gallery Image">--}}
{{--                                <a href="/site/assets/img/widget/gallery_1_1.jpg" class="gallery-btn popup-image"><i--}}
{{--                                        class="fab fa-instagram"></i></a></div>--}}
{{--                            <div class="gallery-thumb"><img src="/site/assets/img/widget/gallery_1_2.jpg" alt="Gallery Image">--}}
{{--                                <a href="/site/assets/img/widget/gallery_1_2.jpg" class="gallery-btn popup-image"><i--}}
{{--                                        class="fab fa-instagram"></i></a></div>--}}
{{--                            <div class="gallery-thumb"><img src="/site/assets/img/widget/gallery_1_3.jpg" alt="Gallery Image">--}}
{{--                                <a href="/site/assets/img/widget/gallery_1_3.jpg" class="gallery-btn popup-image"><i--}}
{{--                                        class="fab fa-instagram"></i></a></div>--}}
{{--                            <div class="gallery-thumb"><img src="/site/assets/img/widget/gallery_1_4.jpg" alt="Gallery Image">--}}
{{--                                <a href="/site/assets/img/widget/gallery_1_4.jpg" class="gallery-btn popup-image"><i--}}
{{--                                        class="fab fa-instagram"></i></a></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row gy-2 align-items-center">
                <div class="col-md-6"><p class="copyright-text">Copyright <i class="fal fa-copyright"></i> 2025 <a style="color:#f97316; font-weight: bold "
                            href="{{ route('front.home-page') }}">{{ $config->short_name_company }}</a>. All Rights Reserved.</p></div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="payment-img"><img src="/site/assets/img/normal/payment_methods.png" alt="Image"></div>
                </div>
            </div>
        </div>
    </div>
</footer>
