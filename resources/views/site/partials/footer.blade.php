<footer class="footer-wrapper footer-layout3" ng-controller="footerBlock">
{{--    <div class="shape-mockup" data-top="0" data-left="0"><img src="/site/assets/img/shape/footer_shape_3.png" alt="shape">--}}
{{--    </div>--}}
{{--    <div class="shape-mockup" data-bottom="0" data-right="0"><img src="/site/assets/img/shape/footer_shape_4.png" alt="shape">--}}
{{--    </div>--}}

    <style>
        /* ===== Subscribe card ===== */
        .subscribe-card{
            --accent: #f9c542;             /* vàng nút */
            --text:   #fff;                 /* chữ chính */
            --muted:  #090f18;              /* placeholder */
            max-width: 420px;               /* không quá rộng */
            color: var(--text);
        }

        .subscribe-title{
            color: #fff;
            font-weight: 800;
            font-size: clamp(14px, 2.6vw, 16px);
            line-height: 1.5;
            margin: 0 0 12px;
        }

        /* Form */
        .subscribe-form{
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-bottom: 14px;
        }

        .subscribe-input{
            height: 46px;
            width: 100%;
            background: #111;                          /* hợp nền footer tối */
            border: 1px solid #2a2a2a;
            border-radius: 4px;
            color: #111;
            padding: 0 14px;
            transition: border-color .2s ease, box-shadow .2s ease;
        }
        .subscribe-input::placeholder{ color: var(--muted); }
        .subscribe-input:focus{
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,.25);
        }

        .subscribe-btn{
            height: 48px;
            width: 100%;
            border: none;
            border-radius: 999px;                      /* bo tròn nhẹ như ảnh */
            background: var(--accent);
            color: #1f2937;
            font-weight: 800;
            letter-spacing: .2px;
            cursor: pointer;
            box-shadow: 0 2px 0 rgba(0,0,0,.05) inset, 0 6px 18px rgba(0,0,0,.12);
            transition: transform .06s ease, box-shadow .18s ease, opacity .18s ease;
        }
        .subscribe-btn:hover{ box-shadow: 0 10px 26px rgba(0,0,0,.18); opacity: .95; }
        .subscribe-btn:active{ transform: translateY(1px) scale(.99); }

        /* Social icons row */
        .subscribe-social{
            display: flex; align-items: center; gap: 10px;
        }
        .soc{
            width: 34px; height: 34px;
            display: inline-flex; align-items: center; justify-content: center;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            color: var(--text);
            text-decoration: none;
            transition: border-color .2s ease, background .2s ease, color .2s ease;
        }
        .soc:hover{ border-color: #666; background: #171717; }

        /* Accessibility helper */
        .visually-hidden{
            position:absolute !important; height:1px; width:1px;
            overflow:hidden; clip:rect(1px,1px,1px,1px); white-space:nowrap;
        }

    </style>
    <div class="widget-area">
        <div class="container" style="max-width: 1320px">
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

                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="subscribe-card">
                            <h4 class="subscribe-title">
                                Hãy là người đầu tiên biết về các sản phẩm mới, khuyến mãi và ưu đãi độc quyền
                            </h4>

                            <form class="subscribe-form" id="form-contact-footer" ng-cloak>
                                <label for="footerEmail" class="visually-hidden">Your Email</label>
                                <input id="footerEmail"
                                       type="text"
                                       name="email"
                                       class="subscribe-input"
                                       placeholder="Email của bạn"
                                       required>
                                <div class="invalid-feedback d-block" ng-if="errors['email']"><% errors['email'][0] %></div>

                                <button type="button" class="subscribe-btn" ng-click="submitContactRegister()">Đăng ký</button>
                            </form>

                        </div>
                    </div>
                </div>

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
