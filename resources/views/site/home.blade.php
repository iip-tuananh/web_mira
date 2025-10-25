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
    <link rel="stylesheet" type="text/css" href="/site/assets/css/home-page.css">

@endsection

@section('content')

    <div ng-controller="homePage">


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

                            <div class="hero-overlay">
                                <div class="hero-content">
                                    <h2 class="hero-title">{{ $banner->title }}</h2>
                                    <a class="hero-btn"
                                       href="{{ $banner->link }}"
                                       title="{{ $banner->title }}">
                                        {{ 'Liên hệ' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <!-- ===== CATEGORY GRID ===== -->



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



            @php $sliderId = 'productSlider'.$loop->index; @endphp
            <section class="space">

                <section class="feature-split">
                    <div class="feature-split__inner">
                        <!-- Text block -->
                        <div class="feature-split__text">
{{--                            <p class="eyebrow">DON’T OVERTHINK IT.</p>--}}
                            <h2 class="title">{{ $cateSpecial->title_banner }}</h2>
                            <p class="desc">
                                {{ $cateSpecial->intro_banner }}
                            </p>
                            <a href="{{ route('front.getProductSpecial', $cateSpecial->slug) }}" class="cta">Khám phá</a>
                        </div>

                        <!-- Image block -->
                        <div class="feature-split__media">
                            <img src="{{ $cateSpecial->image->path ?? '' }}"
                                 alt="Assorted chocolates on a plate" loading="lazy">
                        </div>
                    </div>
                </section>
                <div class="container">




                    {{-- Hàng tiêu đề + nav (DESKTOP) --}}
                    <div class="row justify-content-lg-between justify-content-center align-items-end d-none d-lg-flex">
                        <div class="col-lg">
                            <div class="title-area text-center text-lg-start">
{{--                                <span class="sub-title"><img src="/site/assets/img/theme-img/title_icon.svg" alt="Icon">{{ $cateSpecial->name }}</span>--}}
                                <h2 class="sec-title">{{ $cateSpecial->intro }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <div class="sec-btn">
                                <div class="icon-box">
                                    <button data-slider-prev="#{{ $sliderId }}" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>
                                    <button data-slider-next="#{{ $sliderId }}" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Hàng tiêu đề + nav (MOBILE) --}}
                    <div class="row align-items-center gx-2 d-flex d-lg-none mb-2 cat-head-mobile">
                        <div class="col">
                            <div class="title-area mb-0 text-start">
{{--          <span class="sub-title d-inline-flex align-items-center gap-1">--}}
{{--            <img src="/site/assets/img/theme-img/title_icon.svg" alt="Icon">{{ $cateSpecial->name }}--}}
{{--          </span>--}}
                                <h2 class="sec-title mb-0">{{ $cateSpecial->intro }}</h2>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-box nav-mobile">
                                <button data-slider-prev="#{{ $sliderId }}" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>
                                <button data-slider-next="#{{ $sliderId }}" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    {{-- SLIDER --}}
                    <div class="swiper th-slider has-shadow" id="{{ $sliderId }}"
                         data-slider-options='{
           "spaceBetween": 16,
           "breakpoints": {
             "0":   { "slidesPerView": 2.1, "spaceBetween": 12, "slidesOffsetBefore": 8, "slidesOffsetAfter": 8 },
             "576": { "slidesPerView": 2.1, "spaceBetween": 12, "slidesOffsetBefore": 10, "slidesOffsetAfter": 10 },
             "768": { "slidesPerView": 2 },
             "992": { "slidesPerView": 3 },
             "1200":{ "slidesPerView": 4 }
           }
         }'>
                        <div class="swiper-wrapper">
                            @foreach($cateSpecial->products as $productSpec)
                                <div class="swiper-slide">
                                    @include('site.partials.product_item', ['product' => $productSpec])
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bỏ nav mobile ở dưới (đã chuyển lên cạnh title) --}}
                    {{-- <div class="d-block d-lg-none mt-40 text-center"> ... </div> --}}

                </div>
            </section>
        @endforeach




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

{{--        <section class="bg-smoke2 space">--}}
{{--            <div class="shape-mockup" data-top="0" data-left="0"><img src="/site/assets/img/shape/vector_shape_1.png"--}}
{{--                                                                      alt="shape">--}}
{{--            </div>--}}
{{--            <div class="shape-mockup" data-bottom="0" data-right="0"><img--}}
{{--                    src="/site/assets/img/shape/vector_shape_2.png"--}}
{{--                    alt="shape">--}}
{{--            </div>--}}
{{--            <div class="container">--}}
{{--                <div class="row justify-content-lg-between justify-content-center align-items-end">--}}
{{--                    <div class="col-lg">--}}
{{--                        <div class="title-area text-center text-lg-start"><span class="sub-title"><img--}}
{{--                                    src="/site/assets/img/theme-img/title_icon.svg" alt="Icon">Danh mục sản phẩm</span>--}}
{{--                            <h2 class="sec-title">Khám phá các sản phẩm của chúng tôi</h2></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-auto mt-n2 mt-lg-0">--}}
{{--                        <div class="sec-btn">--}}
{{--                            <div class="nav tab-menu1" role="tablist">--}}
{{--                                @foreach($categories as $keyCate => $cate)--}}
{{--                                    <button class="tab-btn {{ $keyCate == 0 ? 'active' : '' }}" id="nav-{{ $keyCate }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $keyCate }}"--}}
{{--                                            role="tab" aria-controls="nav-{{ $keyCate }}" aria-selected="{{ $keyCate == 0 ? 'true' : 'false' }} ">{{ $cate->name }}--}}
{{--                                    </button>--}}
{{--                                @endforeach--}}

{{--                                --}}{{--                            <button class="tab-btn" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two"--}}
{{--                                --}}{{--                                    role="tab" aria-controls="nav-two" aria-selected="false">Organic Vegetables--}}
{{--                                --}}{{--                            </button>--}}
{{--                                --}}{{--                            <button class="tab-btn" id="nav-three-tab" data-bs-toggle="tab" data-bs-target="#nav-three"--}}
{{--                                --}}{{--                                    role="tab" aria-controls="nav-three" aria-selected="false">Fruit Juice--}}
{{--                                --}}{{--                            </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="tab-content">--}}
{{--                    @foreach($categories as $keyCate => $cate)--}}
{{--                        <div class="tab-pane fade {{ $keyCate == 0 ? 'show active' : '' }} " id="nav-{{ $keyCate }}" role="tabpanel" aria-labelledby="nav-{{ $keyCate }}-tab">--}}
{{--                            <div class="slider-area">--}}
{{--                                <div class="swiper th-slider has-shadow productSlider1"--}}
{{--                                     data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'>--}}
{{--                                    <div class="swiper-wrapper">--}}

{{--                                        @foreach($cate->products as $product)--}}
{{--                                            <div class="swiper-slide">--}}
{{--                                                @include('site.partials.product_item', ['product' => $product])--}}
{{--                                            </div>--}}

{{--                                        @endforeach--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <button data-slider-prev=".productSlider1" class="slider-arrow slider-prev"><i--}}
{{--                                        class="far fa-arrow-left"></i></button>--}}
{{--                                <button data-slider-next=".productSlider1" class="slider-arrow slider-next"><i--}}
{{--                                        class="far fa-arrow-right"></i></button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}




        <section class="overflow-hidden" id="testi-sec" >
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
