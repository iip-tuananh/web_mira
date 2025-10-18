@extends('site.layouts.master')
@section('title')
    {{ $config->web_title }}
@endsection
@section('description')
    {{ strip_tags(html_entity_decode($config->introduction)) }}
@endsection
@section('image')
    {{@$config->image->path ?? ''}}
@endsection

@section('css')

@endsection

@section('content')

    <div ng-controller="homePage">
        <style>
            /* Full width (full-bleed) */
            .hero-fullbleed{ width:100vw; margin-left:50%; transform:translateX(-50%); }

            /* Đảm bảo có chiều cao để không “0px” */
            .hero-swiper{
                aspect-ratio: 21/9;      /* có thể đổi 21/9, 3/2… */
                /*min-height: 260px;       !* chống case màn quá hẹp *!*/
                max-height: 630px;       /* tuỳ giao diện của bạn */
                overflow: clip;
            }

            /*@media (max-width: 768px){ .hero-swiper{ aspect-ratio: 4/5; } }*/

            .hero-slide, .hero-slide > img{ width:100%; height:100%; display:block; }
            .hero-img{ object-fit: cover; object-position: center; display:block; }

            .swiper-button-prev, .swiper-button-next{ color:#fff; text-shadow:0 2px 16px rgba(0,0,0,.5); }
            @media (max-width: 575.98px){ .swiper-button-prev, .swiper-button-next{ display:none; } }
        </style>

        <div class="th-hero-wrapper" id="hero">

            <div class="swiper hero-swiper hero-fullbleed" id="heroSwiper" aria-label="Banner">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                        @php
                            $src = $banner->image->path ?? '';
                        @endphp
                        @if(empty($src))
                            @continue
                        @endif

                        <div class="swiper-slide hero-slide">
                            <img
                                class="hero-img swiper-lazy"
                                src="{{ $banner->image->path ?? '' }}"
                                data-src="{{ $src }}"
                                alt="{{ $banner->title ?? 'Banner' }}"
                            >
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <!-- ===== CATEGORY GRID ===== -->
        <style>
            /* ===== STYLES ===== */
            .cat-grid{
                display:grid;
                grid-template-columns: repeat(3, 1fr);  /* desktop 3 cột */
                gap: 16px;
            }
            @media (max-width: 991.98px){            /* mobile/tablet: 2 cột */
                .cat-grid{ grid-template-columns: repeat(2, 1fr); }
            }

            .cat-card{
                position: relative;
                display: grid;
                grid-template-columns: 1fr auto;       /* chữ trái / ảnh phải */
                align-items: center;
                padding: clamp(11px, 0.2vw, 10px) clamp(16px, 1.6vw, 27px);
                border-radius: 16px;
                background: #faefe2;                   /* nền be giống ảnh */
                min-height: clamp(120px, 18vw, 119px); /* chiều cao linh hoạt */
                text-decoration: none;
                overflow: hidden;
                box-shadow: 0 1px 0 rgba(0,0,0,.04) inset;
                transition: transform .2s ease, box-shadow .2s ease;
            }
            .cat-card:hover{
                transform: translateY(-2px);
                box-shadow: 0 6px 18px rgba(0,0,0,.06);
            }

            .cat-text{
                color:#1a1a1a;
                font-weight: 700;
                font-size: clamp(16px, 1.4vw, 20px);
                line-height: 1.25;
                padding-right: 8px;
            }

            .cat-figure{
                position: relative;
                width: min(69%, 220px);  /* vùng chứa ảnh bên phải */
                height: 100%;
                display:flex; align-items:center; justify-content:flex-end;
            }
            .cat-figure img{
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
                display:block;
                filter: drop-shadow(0 6px 10px rgba(0,0,0,.12));
                transform: translateX(6px); /* tràn nhẹ ra phải như ảnh mẫu */
            }

            /* bo góc mượt hơn khi ảnh sát cạnh */
            .cat-card::after{
                content:""; position:absolute; inset:0;
                border-radius:16px; pointer-events:none;
                box-shadow: 0 0 0 1px rgba(0,0,0,.06) inset;
            }

        </style>


        <section class="space-top">
            <div class="container">
                <div class="title-area text-center"><span class="sub-title"><img
                            src="/site/assets/img/theme-img/title_icon.svg"
                            alt="Icon">Danh Mục Sản Phẩm</span>
                </div>


                <div class="cat-grid">

                    <!-- ITEM DEMO -->
                    @foreach($categories as $cate)
                        <a class="cat-card" href="{{ route('front.getProductList', $cate->slug) }}">
                            <div class="cat-text">{{ $cate->name }}</div>
                            <div class="cat-figure">
                                <img loading="lazy" src="{{ $cate->image->path ?? '' }}" alt="">
                            </div>
                        </a>

                    @endforeach



                </div>

            </div>
        </section>



        @foreach($categoriesSpecial as $cateSpecial)
            <section class="space">
                <div class="container">
                    <div class="row justify-content-lg-between justify-content-center align-items-end">
                        <div class="col-lg">
                            <div class="title-area text-center text-lg-start"><span class="sub-title"><img
                                        src="/site/assets/img/theme-img/title_icon.svg" alt="Icon">{{ $cateSpecial->name }}</span>
                                <h2 class="sec-title">{{ $cateSpecial->intro }}</h2></div>
                        </div>
                        <div class="col-lg-auto d-none d-lg-block">
                            <div class="sec-btn">
                                <div class="icon-box">
                                    <button data-slider-prev="#productSlider1" class="slider-arrow default"><i
                                            class="far fa-arrow-left"></i></button>
                                    <button data-slider-next="#productSlider1" class="slider-arrow default"><i
                                            class="far fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper th-slider has-shadow" id="productSlider1"
                         data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'>
                        <div class="swiper-wrapper">
                            @foreach($cateSpecial->products as $productSpec)
                                <div class="swiper-slide">
                                    @include('site.partials.product_item', ['product' => $productSpec])
                                </div>

                            @endforeach
                        </div>
                    </div>
                    <div class="d-block d-lg-none mt-40 text-center">
                        <div class="icon-box">
                            <button data-slider-prev="#productSlider1" class="slider-arrow default"><i
                                    class="far fa-arrow-left"></i></button>
                            <button data-slider-next="#productSlider1" class="slider-arrow default"><i
                                    class="far fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>

        @endforeach


        <style>
            :root {
                --blue-deep: #073a6b;
                --scallop-h: 44px;
            }

            /* MEDIA: khung video full-width nhưng thấp theo --vid-h */
            .vid-wrap {
                position: relative !important;
                width: 100% !important;
                height: var(--vid-h, 320px) !important; /* chiều cao tuỳ chỉnh */
                background: #000 !important;
                overflow: hidden !important;
            }

            /* Video fill khung, không bị co; crop đẹp theo chiều cao nhỏ */
            .intro-video {
                position: absolute !important;
                inset: 0 !important;
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important; /* quan trọng để không bị letterbox */
                object-position: 50% 50% !important; /* canh tâm, có thể đổi 50% 30% */
                display: block !important;
                border: 0 !important;
            }

            /* Nút bật tiếng */
            .vid-unmute {
                position: absolute;
                right: 12px;
                bottom: 12px;
                z-index: 2;
                padding: 10px 14px;
                border: 0;
                border-radius: 999px;
                background: rgba(255, 255, 255, .9);
                font-weight: 600;
                cursor: pointer;
            }

            .vid-unmute:hover {
                background: #fff;
            }

            /* Khối text bên dưới (ví dụ) */
            .intro-text {
                background: var(--blue-deep) !important;
                color: #e7f2ff !important;
                padding: calc(var(--scallop-h) + 24px) 16px 48px !important;
            }

            .intro-text__inner {
                max-width: 1100px !important;
                margin: 0 auto !important;
                text-align: center !important;
            }

            .btn-cta {
                display: inline-block !important;
                margin-top: 10px !important;
                padding: 10px 16px !important;
                color: #fff !important;
                background: #0b5aa0 !important;
                border-radius: 999px !important;
                text-decoration: none !important;
            }

            /* Breakpoints: nếu có data-vid-height-md/lg sẽ set bằng JS; bổ sung fallback CSS nếu cần */
            @media (min-width: 992px) {
                :root {
                    --scallop-h: 1px;
                }
            }

        </style>

        <style>
            /* ===== Brand palette (theo logo) ===== */
            :root{
                --brand-g1: #41874b;  /* xanh đậm */
                --brand-g2: #7bb957;  /* xanh nhạt */
                --brand-dark: #0f2b19;/* xanh rừng đậm cho nền */
                --brand-dark2:#12361f;/* xanh đậm hơn để đổ gradient */
                --brand-amber:#f59e0b;/* cam nhấn */
                --brand-amber2:#f97316;/* cam nhạt hơn */
            }

            /* TEXT GRADIENT cho tiêu đề */
            .text-gradient{
                background: linear-gradient(35deg, var(--brand-g1) 0%, var(--brand-g2) 100%);
                -webkit-background-clip: text; background-clip: text;
                -webkit-text-fill-color: transparent; color: transparent;
            }

            /* ===== INTRO BLOCK ===== */
            .intro-text{
                /* fallback solid */
                background: var(--brand-dark) !important;

                /* nền chuyển sắc xanh lá đậm + lớp phủ nhẹ cho chiều sâu */
                background:
                    radial-gradient(120% 160% at 15% 0%, rgba(123,185,87,.18) 0%, rgba(17,43,30,0) 55%) ,
                    linear-gradient(135deg, var(--brand-dark) 0%, var(--brand-dark2) 100%) !important;

                color:#eaf7ed !important; /* chữ sáng, dịu mắt trên nền xanh */
                padding: calc(var(--scallop-h) + 24px) 16px 48px !important;
            }

            .intro-text__inner{
                max-width:1100px !important;
                margin:0 auto !important;
                text-align:center !important;
            }

            /* Tiêu đề + đoạn mô tả */
            .intro-text__inner h2{
                margin: 0 0 8px;
                font-weight: 800;
                letter-spacing: .2px;
            }
            .intro-text__inner h2 a,
            .intro-text__inner h2{ /* áp gradient vào tiêu đề */
                display:inline-block;
            }
            .intro-text__inner h2{ /* nếu muốn toàn bộ h2 gradient */
                /* thêm class text-gradient ở HTML sẽ đẹp nhất */
            }
            .intro-text__inner p{
                color:#d3ead6;            /* xanh nhạt hơn để phân cấp */
                margin:0 0 14px;
                line-height:1.7;
            }

            /* ===== CTA BUTTON ===== */
            .btn-cta{
                display:inline-block !important;
                margin-top:12px !important;
                padding:12px 18px !important;
                border-radius:999px !important;
                text-decoration:none !important;
                font-weight:700 !important;
                letter-spacing:.2px;

                color:#0f2b19 !important; /* chữ đậm trên nền cam */
                background: linear-gradient(35deg, var(--brand-amber) 0%, var(--brand-amber2) 100%) !important;
                box-shadow: 0 10px 18px rgba(245,158,11,.25);
                transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
            }
            .btn-cta:hover{
                transform: translateY(-1px);
                filter: saturate(1.05) contrast(1.03);
                box-shadow: 0 12px 22px rgba(249,115,22,.28);
            }
            .btn-cta:active{ transform: translateY(0); }

            /* Mobile fine-tune */
            @media (max-width: 575.98px){
                .intro-text{ padding: calc(var(--scallop-h) + 16px) 14px 36px !important; }
            }

        </style>


        <!-- SECTION: INTRO WITH SCALLOPED VIDEO -->
        <section class="intro-scallop">
            <div class="intro-media scalloped" data-top-bg="#ffffff" data-bottom-bg="#073a6b">

                <!-- TÙY CHỈNH CAO/THẤP Ở ĐÂY:
                     data-vid-height nhận px/vh/rem: "280px", "30vh", "22rem", ...
                     Có thể set theo breakpoint: data-vid-height-md, data-vid-height-lg -->
                <div class="vid-wrap"
                     data-vid-height="300px"
                     data-vid-height-md="320px"
                     data-vid-height-lg="390px">

                    <video id="introVideo"
                           class="intro-video"
                           preload="metadata"
                           autoplay
                           muted
                           playsinline
                           loop

                           aria-label="Video giới thiệu">
                        <!-- Thay bằng path lấy từ DB -->
                        <source src="{{ $about->video_path }}" type="video/mp4">
                        Trình duyệt của bạn không hỗ trợ video HTML5.
                    </video>

                    <!-- Nút bật tiếng -->
                    <button class="vid-unmute" type="button" aria-label="Bật tiếng">Bật tiếng</button>
                </div>
            </div>

            <!-- Khối text phía dưới (ví dụ) -->
            <div class="intro-text">
                <div class="intro-text__inner">
                    <h2 class="text-gradient">{{ $about->service_title }}</h2>
                    <p>{{ $about->intro }}</p>
                    <a class="btn-cta" href="{{ $about->title }}">Xem thêm</a>
                </div>
            </div>
        </section>


        <style>
            :root {
                --bg: #faebdb; /* nền khối */
                --text: #111; /* màu chữ */
                --gap: 56px; /* khoảng cách giữa item */
                --padY: 14px;
                --speed: 28s; /* nhỏ hơn = chạy nhanh hơn */
                --font: "Kalam", ui-rounded, system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            }

            .feature-slider {
                overflow: hidden;
                background: var(--bg);
                padding: var(--padY) 0;
                user-select: none;
            }

            .feature-row {
                display: flex;
                align-items: center;
                gap: var(--gap);
                width: max-content;
                padding-inline: var(--gap);
                margin: 0;
                list-style: none;
                white-space: nowrap;
                animation: marquee var(--speed) linear infinite;
            }

            @keyframes marquee {
                from {
                    transform: translateX(0);
                }
                to {
                    transform: translateX(-50%);
                }
                /* vì đã in 2 lần nội dung */
            }

            .feature-badge {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                margin: 0;
                padding: 0;
                background: none;
                border: 0; /* tránh xung đột Bootstrap */
                font: 700 clamp(.9rem, .75rem + .6vw, 1.125rem)/1 var(--font);
                letter-spacing: .02em;
                text-transform: uppercase;
                color: var(--text);
            }

            .feature-img {
                width: 24px;
                height: 24px;
                object-fit: contain;
                flex: 0 0 24px;
                display: inline-block;
                image-rendering: auto;
            }

            /* Hover để pause */
            .feature-slider:hover .feature-row {
                animation-play-state: paused;
            }

            /* Accessibility + responsive */
            @media (prefers-reduced-motion: reduce) {
                .feature-row {
                    animation: none;
                }
            }

            @media (max-width: 768px) {
                :root {
                    --gap: 36px;
                    --padY: 10px;
                }
            }
        </style>

        <section class="feature-slider">
            <ul class="feature-row">
                @foreach ($messages as $b)
                    <li class="feature-badge">
                        <img class="feature-img"
                             src="{{ $b->image->path ?? '' }}"
                             alt="{{ $b->name }}"
                             loading="lazy" decoding="async"
                             width="24" height="24">
                        <span class="txt">{{ Str::upper($b->name) }}</span>
                    </li>
                @endforeach

                @foreach ($messages as $b)
                    <li class="feature-badge" aria-hidden="true">
                        <img class="feature-img"
                             src="{{ $b->image->path ?? '' }}"
                             alt="{{ $b->name }}"
                             loading="lazy" decoding="async"
                             width="24" height="24">
                        <span class="txt">{{ Str::upper($b->name) }}</span>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="bg-smoke2 space">
            <div class="shape-mockup" data-top="0" data-left="0"><img src="/site/assets/img/shape/vector_shape_1.png"
                                                                      alt="shape">
            </div>
            <div class="shape-mockup" data-bottom="0" data-right="0"><img
                    src="/site/assets/img/shape/vector_shape_2.png"
                    alt="shape">
            </div>
            <div class="container">
                <div class="row justify-content-lg-between justify-content-center align-items-end">
                    <div class="col-lg">
                        <div class="title-area text-center text-lg-start"><span class="sub-title"><img
                                    src="/site/assets/img/theme-img/title_icon.svg" alt="Icon">Danh mục sản phẩm</span>
                            <h2 class="sec-title">Khám phá các sản phẩm của chúng tôi</h2></div>
                    </div>
                    <div class="col-auto mt-n2 mt-lg-0">
                        <div class="sec-btn">
                            <div class="nav tab-menu1" role="tablist">
                                @foreach($categories as $keyCate => $cate)
                                    <button class="tab-btn {{ $keyCate == 0 ? 'active' : '' }}" id="nav-{{ $keyCate }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $keyCate }}"
                                            role="tab" aria-controls="nav-{{ $keyCate }}" aria-selected="{{ $keyCate == 0 ? 'true' : 'false' }} ">{{ $cate->name }}
                                    </button>
                                @endforeach

                                {{--                            <button class="tab-btn" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two"--}}
                                {{--                                    role="tab" aria-controls="nav-two" aria-selected="false">Organic Vegetables--}}
                                {{--                            </button>--}}
                                {{--                            <button class="tab-btn" id="nav-three-tab" data-bs-toggle="tab" data-bs-target="#nav-three"--}}
                                {{--                                    role="tab" aria-controls="nav-three" aria-selected="false">Fruit Juice--}}
                                {{--                            </button>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    @foreach($categories as $keyCate => $cate)
                        <div class="tab-pane fade {{ $keyCate == 0 ? 'show active' : '' }} " id="nav-{{ $keyCate }}" role="tabpanel" aria-labelledby="nav-{{ $keyCate }}-tab">
                            <div class="slider-area">
                                <div class="swiper th-slider has-shadow productSlider1"
                                     data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'>
                                    <div class="swiper-wrapper">

                                        @foreach($cate->products as $product)
                                            <div class="swiper-slide">
                                                @include('site.partials.product_item', ['product' => $product])
                                            </div>

                                        @endforeach

                                    </div>
                                </div>
                                <button data-slider-prev=".productSlider1" class="slider-arrow slider-prev"><i
                                        class="far fa-arrow-left"></i></button>
                                <button data-slider-next=".productSlider1" class="slider-arrow slider-next"><i
                                        class="far fa-arrow-right"></i></button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>




        <section class="overflow-hidden" id="testi-sec">
            <div class="shape-mockup testi-shape1" data-top="0" data-left="0"><img
                    src="/site/assets/img/feedback.png"
                    alt="shape"></div>

            <div class="container">
                <div class="testi-card-area">
                    <div class="title-area"><span class="sub-title"><img src="/site/assets/img/theme-img/title_icon.svg"
                                                                         alt="Icon">Đánh giá</span>
                        <h2 class="sec-title">Cảm nhận từ khách hàng</h2></div>
                    <div class="testi-card-slide">
                        <div class="swiper th-slider" id="testiSlide1" data-slider-options='{"effect":"slide"}'>
                            <div class="swiper-wrapper">
                                @foreach($feedbacks as $feedback)
                                    <div class="swiper-slide">
                                        <div class="testi-card"><p class="testi-card_text">
                                                {{ $feedback->message }}
                                            </p>
                                            <div class="testi-card_profile">
                                                <div class="testi-card_avater"><img
                                                        src="{{ $feedback->image->path ?? '' }}"
                                                        alt="Avater"></div>
                                                <div class="testi-card_content"><h3 class="testi-card_name">{{ $feedback->name }}</h3>
                                                    <span class="testi-card_desig">{{ $feedback->position }}</span></div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                        <div class="icon-box">
                            <button data-slider-prev="#testiSlide1" class="slider-arrow default"><i
                                    class="far fa-arrow-left"></i></button>
                            <button data-slider-next="#testiSlide1" class="slider-arrow default"><i
                                    class="far fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="space" id="blog-sec">
            <div class="container">
                <div class="title-area text-center"><span class="sub-title"><img
                            src="/site/assets/img/theme-img/title_icon.svg"
                            alt="shape">Tin tức</span>
                    <h2 class="sec-title">Tin tức và hoạt động mới nhất</h2></div>
                <div class="slider-area">
                    <div class="swiper th-slider has-shadow" id="blogSlider1"
                         data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}'>
                        <div class="swiper-wrapper">
                            @foreach($blogs as $blog)
                                <div class="swiper-slide">
                                    <div class="blog-card">
                                        <div class="blog-img"><img src="{{ $blog->image->path ?? '' }}"
                                                                   alt="blog image">
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-meta"><a href="{{ route('front.blogDetail', $blog->slug) }}"><i class="far fa-user"></i>By Admin</a>
                                                <a
                                                    href="{{ route('front.blogDetail', $blog->slug) }}"><i class="far fa-calendar"></i>{{ \Illuminate\Support\Carbon::parse($blog->created_at)->format('d/m/Y') }}</a></div>
                                            <h3 class="box-title"><a href="{{ route('front.blogDetail', $blog->slug) }}">{{ $blog->name }}</a>
                                            </h3><a href="{{ route('front.blogDetail', $blog->slug) }}" class="th-btn btn-sm style4">Đọc thêm<i
                                                    class="fas fa-chevrons-right ms-2"></i></a></div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                    <button data-slider-prev="#blogSlider1" class="slider-arrow slider-prev"><i
                            class="far fa-arrow-left"></i>
                    </button>
                    <button data-slider-next="#blogSlider1" class="slider-arrow slider-next"><i
                            class="far fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>


   @endsection

        @push('scripts')
            <script>
                // Helper: áp chiều cao từ data-attribute vào CSS variable --vid-h
                function applyVideoHeights() {
                    document.querySelectorAll('.vid-wrap').forEach(wrap => {
                        const w = wrap;
                        const hBase = w.getAttribute('data-vid-height');
                        const hMd = w.getAttribute('data-vid-height-md');
                        const hLg = w.getAttribute('data-vid-height-lg');

                        // Base
                        if (hBase) w.style.setProperty('--vid-h', hBase);

                        // Theo breakpoint: dùng matchMedia để đổi khi resize
                        const mqMd = window.matchMedia('(min-width: 768px)');
                        const mqLg = window.matchMedia('(min-width: 1200px)');

                        function updateHeight() {
                            if (hLg && mqLg.matches) {
                                w.style.setProperty('--vid-h', hLg);
                            } else if (hMd && mqMd.matches) {
                                w.style.setProperty('--vid-h', hMd);
                            } else if (hBase) {
                                w.style.setProperty('--vid-h', hBase);
                            }
                        }

                        updateHeight();
                        mqMd.addEventListener('change', updateHeight);
                        mqLg.addEventListener('change', updateHeight);
                    });
                }

                // Autoplay policy: muted+playsinline đã set trong HTML, gọi play() để chắc ăn
                function ensureAutoplay() {
                    const v = document.getElementById('introVideo');
                    if (!v) return;
                    const tryPlay = () => v.play().catch(() => { /* bị chặn thì thôi, user sẽ bấm Unmute */
                    });
                    // Một số mobile cần chờ canplay
                    v.addEventListener('canplay', tryPlay, {once: true});
                    // fallback nếu canplay không fire sớm
                    setTimeout(tryPlay, 600);
                }

                // Nút bật tiếng
                function wireUnmute() {
                    const v = document.getElementById('introVideo');
                    const btn = document.querySelector('.vid-unmute');
                    if (!v || !btn) return;

                    btn.addEventListener('click', () => {
                        v.muted = false;
                        v.volume = 1;
                        v.play().catch(() => {
                        });
                        btn.textContent = 'Đang phát';
                        btn.disabled = true;
                        btn.style.opacity = .8;
                    });
                }

                document.addEventListener('DOMContentLoaded', () => {
                    applyVideoHeights();
                    ensureAutoplay();
                    wireUnmute();
                });

                // Tự pause khi tab ẩn để tiết kiệm, resume khi quay lại (tuỳ chọn)
                document.addEventListener('visibilitychange', () => {
                    const v = document.getElementById('introVideo');
                    if (!v) return;
                    if (document.hidden) v.pause(); else v.play().catch(() => {
                    });
                });
            </script>

            <script>
                (function(){
                    // Debug nhanh: log các ảnh không có data-src
                    document.querySelectorAll('#heroSwiper .swiper-slide img').forEach((img, i) => {
                        if(!img.dataset.src || img.dataset.src.trim() === ''){
                            console.warn('[Hero] Slide', i, 'thiếu data-src → sẽ không load.');
                        }
                    });

                    const heroSwiper = new Swiper('#heroSwiper', {
                        loop: true,
                        speed: 700,
                        autoplay: { delay: 4200, disableOnInteraction: false },

                        // Lazy load
                        preloadImages: false,
                        lazy: {
                            loadPrevNext: true,
                            loadPrevNextAmount: 1,
                            loadOnTransitionStart: true
                        },

                        // Khi lazy xong, gỡ spinner nếu còn
                        on: {
                            lazyImageReady(swiper, slideEl, imageEl){
                                const preloader = slideEl.querySelector('.swiper-lazy-preloader');
                                if(preloader) preloader.remove();
                            }
                        },

                        pagination: { el: '.swiper-pagination', clickable: true },
                        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                        allowTouchMove: true,

                        // nếu slider nằm trong tab/section ẩn -> bật observer
                        observer: true,
                        observeParents: true
                    });

                    // Pause on hover (desktop)
                    const root = document.getElementById('heroSwiper');
                    if(root){
                        root.addEventListener('mouseenter', () => heroSwiper.autoplay?.stop());
                        root.addEventListener('mouseleave', () => heroSwiper.autoplay?.start());
                    }
                })();
            </script>

            <script>
                app.controller('homePage', function ($rootScope, $scope, cartItemSync, $interval) {
                    $scope.cart = cartItemSync;


                    $scope.addToCart = function (productId, qty = null) {
                        url = "{{route('cart.add.item', ['productId' => 'productId'])}}";
                        url = url.replace('productId', productId);

                        if(! qty) {
                            var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                        } else {
                            var currentVal = parseInt(qty);
                        }

                        jQuery.ajax({
                            type: 'POST',
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': CSRF_TOKEN
                            },
                            data: {
                                'qty': currentVal
                            },
                            success: function (response) {
                                if (response.success) {
                                    $interval.cancel($rootScope.promise);
                                    $rootScope.promise = $interval(function () {
                                        cartItemSync.items = response.items;
                                        cartItemSync.total = response.total;
                                        cartItemSync.count = response.count;
                                    }, 1000);
                                }

                                toastr.success('Đã thêm sản phẩm vào giỏ hàng!');

                            },
                            error: function () {
                                toastr.error('Có lỗi xảy ra. Vui lòng thử lại.');
                            },
                            complete: function () {
                                $scope.$applyAsync();
                            }
                        });
                    }


                })

            </script>
    @endpush
