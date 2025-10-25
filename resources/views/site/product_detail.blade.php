@extends('site.layouts.master')
@section('title'){{ $product->name }}- {{ $config->web_title }}@endsection
@section('description'){{ strip_tags(html_entity_decode($config->introduction)) }}@endsection
@section('image'){{@$config->image->path ?? ''}}@endsection

@section('css')


@endsection


@section('content')

    <style>
        /* Wrapper */
        .prd-figure {
            --radius: 16px;
            --gap: 12px;
            --border: 1px solid #ececec;
            --shadow: 0 6px 20px rgba(0,0,0,.06);
        }

        /* Ảnh lớn */
        .prd-figure__main {
            position: relative;
            border: var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            background: #fff;
            /* Giữ tỉ lệ vuông. Đổi 100% thành 75% nếu muốn 4:3 */
            aspect-ratio: 1/1;
            display: grid;
            place-items: center;
        }

        .prd-figure__main img {
            max-width: 100%;
            max-height: 100%;
            width: 100%;
            height: 100%;
            object-fit: cover; /* hoặc 'contain' nếu muốn fit toàn bộ */
            transition: opacity .25s ease;
        }

        /* Nút điều hướng (desktop + mobile) */
        .prd-figure__nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 40px;
            min-width: 40px;
            border: none;
            border-radius: 999px;
            background: rgba(255,255,255,.85);
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
            padding: 0 12px;
            cursor: pointer;
            font-size: 22px;
            line-height: 40px;
            display: grid;
            place-items: center;
            transition: background .2s;
        }
        .prd-figure__nav:hover { background: #fff; }
        .prd-figure__nav.prev { left: 10px; }
        .prd-figure__nav.next { right: 10px; }

        /* Thumbnails */
        .prd-figure__thumbs {
            margin-top: var(--gap);
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: var(--gap);
        }

        /* Mobile: scroll ngang + snap */
        @media (max-width: 767.98px) {
            .prd-figure__thumbs {
                display: grid;
                grid-auto-flow: column;
                grid-auto-columns: 22%;
                overflow-x: auto;
                gap: var(--gap);
                padding-bottom: 4px;
                scroll-snap-type: x mandatory;
            }
            .prd-figure__thumbs .thumb { scroll-snap-align: start; }
        }

        /* Thumb button */
        .prd-figure__thumbs .thumb {
            border: var(--border);
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            padding: 0;
            cursor: pointer;
            position: relative;
            aspect-ratio: 1/1;
            display: grid;
            place-items: center;
            transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
        }
        .prd-figure__thumbs .thumb:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,.06);
        }
        .prd-figure__thumbs .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .prd-figure__thumbs .thumb.is-active {
            outline: 1px solid #111;
            outline-offset: 2px;
        }

        /* Tối ưu grid số cột theo màn */
        @media (min-width: 768px) and (max-width: 1199.98px) {
            .prd-figure__thumbs { grid-template-columns: repeat(5, 1fr); }
        }
        @media (min-width: 1200px) {
            .prd-figure__thumbs { grid-template-columns: repeat(6, 1fr); }
        }

    </style>

    <style>
        /* ===== Base ===== */
        .variant-select{ margin-top:14px; }
        .variant-select__label{ font-weight:500; margin-bottom:21px; color:#111827; font-size: 1.3rem}

        /* Layout: desktop tự co nhiều cột, mobile bắt buộc 2 cột */
        .variant-select__list{
            display:grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap:10px;
        }
        @media (max-width:576px){
            .variant-select__list{
                grid-template-columns: repeat(2, 1fr); /* đúng 2 phân loại / dòng */
            }
        }

        /* Ẩn radio, vẫn truy cập được bàn phím qua label */
        .variant-radio{
            position:absolute;
            opacity:0;
            width:0; height:0;
        }

        /* Pill */
        .variant-pill{
            position:relative;
            display:flex; flex-direction:column; justify-content:center;
            min-height:70px;
            padding:12px 14px;
            border:1px solid #e5e7eb;
            border-radius:12px;
            background:#fff;
            cursor:pointer;
            transition:box-shadow .15s ease, border-color .15s ease, transform .02s ease;
            outline:0;
        }
        .variant-pill:hover{ box-shadow:0 3px 10px rgba(0,0,0,.06); }
        .variant-radio:focus-visible + .variant-pill{ outline:2px solid #111; outline-offset:2px; }

        /* Trạng thái chọn: viền đen đậm */
        .variant-radio:checked + .variant-pill{
            border:2px solid #111; box-shadow:0 2px 0 rgba(0,0,0,.06) inset;
        }

        /* Texts */
        .v-title{ font-weight:800; line-height:1.15; color:#0f172a; margin-bottom:4px; }
        .v-price{ font-weight:600; color:#334155; }
        .v-base{ color:#94a3b8; margin-left:6px; font-weight:500; font-size:.95em; }

        /* Badge */
        .v-badge{
            position:absolute; right:10px; top:10px;
            background:#f9d977; color:#111827;
            font-weight:800; font-size:12px;
            padding:4px 8px; border-radius:999px; line-height:1;
            box-shadow:0 1px 0 rgba(0,0,0,.05) inset;
        }

    </style>
    @php
        $banner = @$product->category->banner->path ?? 'assets/img/bg/breadcumb-bg.jpg';
    @endphp
    <div class="breadcumb-wrapper" data-bg-src="{{ $banner }}">
        <div class="container">
            <div class="breadcumb-content"><h1 class="breadcumb-title">{{ $product->name }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                    <li><a href="{{ route('front.getProductList', $product->category->slug ?? '') }}">{{  $product->category->name ?? '' }}</a></li>
                    <li>{{ $product->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="product-details space-top space-extra-bottom" ng-controller="productDetail">
        <div class="container">
            <div class="row gx-60">
                @php
                    $gallery = collect([$product->image->path ?? ''])
                   ->merge($product->galleries->pluck('image.path') ?? [])
                   ->filter()
                   ->values();


               if ($gallery->isEmpty()) {
                   $gallery = collect(['https://via.placeholder.com/1200x1200?text=No+Image']);
               }
                @endphp

                <div class="col-lg-6">
                    <div class="prd-figure">
                        <!-- ẢNH LỚN -->
                        <div class="prd-figure__main" id="prdMain">
                            <img
                                id="prdMainImg"
                                src="{{ $gallery[0] }}"
                                alt="{{ $product->name }}"
                                width="1200" height="1200"
                                decoding="async" fetchpriority="high"
                            >
                            <button class="prd-figure__nav prev" type="button" aria-label="Ảnh trước" data-dir="-1">‹</button>
                            <button class="prd-figure__nav next" type="button" aria-label="Ảnh sau"  data-dir="1">›</button>
                        </div>

                        <!-- THUMBNAILS -->
                        <div class="prd-figure__thumbs" id="prdThumbs" role="listbox" aria-label="Thư viện ảnh">
                            @foreach($gallery as $idx => $src)
                                <button
                                    class="thumb {{ $idx===0 ? 'is-active' : '' }}"
                                    type="button"
                                    data-idx="{{ $idx }}"
                                    data-src="{{ $src }}"
                                    aria-label="Ảnh {{ $idx+1 }}"
                                    aria-selected="{{ $idx===0 ? 'true':'false' }}"
                                    role="option"
                                >
                                    <img
                                        src="{{ $src }}"
                                        alt="Thumb {{ $idx+1 }}"
                                        loading="lazy"
                                        width="140" height="140"
                                        decoding="async"
                                    >
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 align-self-center">
                    <div class="product-about">
                        <h2 class="product-title">{{ $product->name }}</h2>

                        <div class="product-rating">
                            <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated <strong
                                        class="rating">5.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span>
                            </div>
                        </div>

                        @php
                            $types = $product->types ?? collect();
                            $hasTypes = $types->count() > 0;

                            if ($hasTypes) {
                                $first = $types->first();
                                $initPrice = (int) $first->price;
                                $initBase  = (int) $first->base_price;
                            } else {
                                $initPrice = (int) $product->price;
                                $initBase  = (int) $product->base_price;
                            }

                        @endphp


                        @if($initPrice > 0)
                            <p class="price" id="mainPrice">
                                <span id="mainPriceValue">{{ number_format($initPrice, 0, ',', '.') }}đ</span>
                                @if($initBase > $initPrice)
                                    <del id="mainBaseValue">{{ number_format($initBase, 0, ',', '.') }}đ</del>
                                @else
                                    <del id="mainBaseValue" style="display:none"></del>
                                @endif
                            </p>
                        @else
                            <p class="price" id="mainPrice"><span id="mainPriceValue">Liên hệ</span><del id="mainBaseValue" style="display:none"></del></p>
                        @endif



                        <p class="text">
                            {{ $product->intro }}
                        </p>

{{--                        <div class="mt-2 link-inherit"><p><strong class="text-title me-3">Tình trạng:</strong> <span--}}
{{--                                    class="stock in-stock"><i class="far fa-check-square me-2 ms-1"></i>Còn hàng</span></p>--}}
{{--                        </div>--}}

                        @if($hasTypes)
                            <fieldset id="variantSelect" class="variant-select">
                                <legend class="variant-select__label">Phân loại</legend>

                                <div class="variant-select__list" role="listbox" aria-label="Chọn phân loại">
                                    @foreach($types as $i => $t)
                                        @php
                                            $base = (int) ($t->base_price ?? 0);
                                            $price = (int) ($t->price ?? 0);
                                            $save = ($base > $price && $price > 0) ? max(0, round((1 - ($price/$base))*100)) : 0;
                                            $id = 'variant_'.$t->id ?? ('variant_'.$i);
                                        @endphp

                                        <input
                                            class="variant-radio"
                                            type="radio"
                                            name="selected_type"
                                            id="{{ $id }}"
                                            value="{{ $t->id ?? $i }}"
                                            data-title="{{ $t->title }}"
                                            data-price="{{ $price }}"
                                            data-base="{{ $base }}"
                                            {{ $i === 0 ? 'checked' : '' }}
                                        >
                                        <label class="variant-pill" for="{{ $id }}" role="option" aria-selected="{{ $i===0 ? 'true':'false' }}">
                                            @if($save > 0)
                                                <span class="v-badge">Sale {{ $save }}%</span>
                                            @endif
                                            <div class="v-title">{{ $t->title }}</div>
                                            <div>
                                                <span class="v-price">{{ number_format($price, 0, ',', '.') }}₫</span>
                                                @if($base > $price)
                                                    <del class="v-base">{{ number_format($base, 0, ',', '.') }}₫</del>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </fieldset>
                        @endif











                        <div class="actions">
                            <div class="quantity"><input type="number" class="qty-input" step="1" min="1" max="100"
                                                         name="quantity" value="1" title="Qty">
                                <button class="quantity-plus qty-btn"><i class="far fa-chevron-up"></i></button>
                                <button class="quantity-minus qty-btn"><i class="far fa-chevron-down"></i></button>
                            </div>
                            <button class="th-btn" ng-click="addToCart({{ $product->id }})">Thêm vào giỏ hàng</button>
                           </div>
                        <div class="product_meta">
                            <span class="posted_in">Danh mục: <a href="shop.html">{{ $product->category->name ?? '' }}</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav product-tab-style1" id="productTab" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link th-btn active" id="description-tab"
                                                            data-bs-toggle="tab" href="#description" role="tab"
                                                            aria-controls="description" aria-selected="true">
                        Thông tin sản phẩm
                    </a></li>

            </ul>
            <div class="tab-content " id="productTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    {!! $product->body !!}
                </div>
            </div>
            <div class="space-extra-top mb-30">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-auto"><h2 class="sec-title text-center">Sản phẩm liên quan</h2></div>
                    <div class="col-md d-none d-sm-block">
                        <hr class="title-line">
                    </div>
                    <div class="col-md-auto d-none d-md-block">
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
                        @foreach($productsLq as $productLq)
                            <div class="swiper-slide">
                                @include('site.partials.product_item', ['product' => $productLq])
                            </div>
                        @endforeach



                    </div>
                </div>
                <div class="d-block d-md-none mt-40 text-center">
                    <div class="icon-box">
                        <button data-slider-prev="#productSlider1" class="slider-arrow default"><i
                                class="far fa-arrow-left"></i></button>
                        <button data-slider-next="#productSlider1" class="slider-arrow default"><i
                                class="far fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        function getSelectedVariant(){
            const checked = document.querySelector('.variant-radio:checked');
            if(!checked) return null;

            let title = checked.getAttribute('data-title') || '';
            if(!title){
                const label = document.querySelector(`label[for="${checked.id}"] .v-title`);
                title = label ? (label.textContent || '').trim() : '';
            }

            return {
                id: checked.value,
                title: title,
                price: Number(checked.getAttribute('data-price') || 0),
                base_price: Number(checked.getAttribute('data-base') || 0),
            };
        }
    </script>

    <script>
        app.controller('productDetail', function ($rootScope, $scope, cartItemSync, $interval) {
            $scope.cart = cartItemSync;

            $scope.addToCart = function (productId, qty = null) {
                url = "{{route('cart.add.item', ['productId' => 'productId'])}}";
                url = url.replace('productId', productId);

                if(! qty) {
                    var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                } else {
                    var currentVal = parseInt(qty);
                }

                const hasVariantInputs = document.querySelectorAll('.variant-radio').length > 0;
                const selectedVariant = hasVariantInputs ? getSelectedVariant() : null;

                if (hasVariantInputs && !selectedVariant) {
                    toastr.error('Vui lòng chọn phân loại trước khi thêm giỏ hàng.');
                    return;
                }

                const payload = { qty: currentVal };

                // Nếu có phân loại, đính kèm thông tin type
                if (selectedVariant) {
                    payload.type_id = selectedVariant.id;
                    payload.type_title = selectedVariant.title;
                    payload.type_price = selectedVariant.price;
                    payload.type_base_price = selectedVariant.base_price;
                }


                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    data: payload,
                    success: function (response) {
                        if (response.success) {
                            $interval.cancel($rootScope.promise);
                            $rootScope.promise = $interval(function () {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);
                            toastr.success('Đã thêm sản phẩm vào giỏ hàng!');
                        }
                    },
                    error: function () {
                        toastr.error('Có lỗi xảy ra. Vui lòng thử lại.');

                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.buyNow = function (productId) {
                url = "{{route('cart.add.item', ['productId' => 'productId'])}}";
                url = url.replace('productId', productId);
                var currentVal = parseInt(jQuery('input[name="quantity"]').val());

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

                            window.location.href = "{{ route('cart.checkout') }}";

                        }
                    },
                    error: function () {
                        jQuery.toast('Thao tác thất bại !')
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.addToMyHeart = function (productId) {
                url = "{{route('love.add.item', ['productId' => 'productId'])}}";
                url = url.replace('productId', productId);
                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    data: {
                        'qty': 1
                    },
                    success: function (response) {
                        if (response.success) {
                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function () {
                                loveItemSync.items = response.wishlistItems;
                                loveItemSync.count = response.count;
                            }, 1000);
                            theme.alert.new('Thêm vào danh sách yêu thích', 'Sản phẩm của bạn đã thêm vào danh sách yêu thích thành công.', 3000, 'alert-success');
                        } else {
                            theme.alert.new('Thêm vào danh sách yêu thích', 'Sản phẩm của bạn đã thêm vào danh sách yêu thích thành công.', 3000, 'alert-success');
                        }
                    },
                    error: function () {
                        theme.alert.new('Lỗi hệ thống', 'Có lỗi xảy ra. Vui lòng thử lại sau', 3000, 'alert-warning');
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

        })

    </script>


    <script>
        (function(){
            const mainImg   = document.getElementById('prdMainImg');
            const thumbsBox = document.getElementById('prdThumbs');
            const mainBox   = document.getElementById('prdMain');
            const navPrev   = mainBox.querySelector('.prd-figure__nav.prev');
            const navNext   = mainBox.querySelector('.prd-figure__nav.next');

            if (!mainImg || !thumbsBox) return;

            let current = 0;
            const thumbs = Array.from(thumbsBox.querySelectorAll('.thumb'));
            const total  = thumbs.length;

            function setActive(idx, fromClick = false) {
                if (idx < 0) idx = total - 1;
                if (idx >= total) idx = 0;
                const btn = thumbs[idx];
                if (!btn) return;

                // preload ảnh mới trước khi hiển thị
                const src = btn.getAttribute('data-src');
                const temp = new Image();
                temp.onload = function() {
                    mainImg.style.opacity = 0.2;
                    requestAnimationFrame(() => {
                        mainImg.src = src;
                        mainImg.alt = 'Ảnh ' + (idx + 1);
                        mainImg.style.opacity = 1;
                    });
                };
                temp.src = src;

                // cập nhật trạng thái thumbnail
                thumbs.forEach((t,i) => {
                    t.classList.toggle('is-active', i === idx);
                    t.setAttribute('aria-selected', i === idx ? 'true' : 'false');
                });

                // auto-scroll thumbnail đang active vào giữa (mobile ngang)
                // if (fromClick && 'scrollIntoView' in btn) {
                //     btn.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                // }

                current = idx;
            }

            // Click vào thumbnail
            thumbs.forEach((btn, idx) => {
                btn.addEventListener('click', () => setActive(idx, true));
                // hỗ trợ keyboard focus/enter
                btn.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        setActive(idx, true);
                    }
                });
            });

            // Nút điều hướng
            if (navPrev) navPrev.addEventListener('click', () => setActive(current - 1, true));
            if (navNext) navNext.addEventListener('click', () => setActive(current + 1, true));

            // Phím mũi tên ← →
            mainBox.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft')  setActive(current - 1, true);
                if (e.key === 'ArrowRight') setActive(current + 1, true);
            });
            // Cho phép focus vùng ảnh lớn để dùng phím
            mainBox.tabIndex = 0;

            // Khởi tạo
            setActive(0);
        })();
    </script>

    <script>
        (function(){
            const radios = document.querySelectorAll('.variant-radio');
            if(!radios.length) return;

            const priceEl = document.getElementById('mainPriceValue');
            const baseEl  = document.getElementById('mainBaseValue');

            function formatVN(n){ return (n||0).toLocaleString('vi-VN'); }

            function apply(price, base){
                if(+price > 0){
                    priceEl.textContent = `${formatVN(+price)}đ`;
                    if(+base > +price){
                        baseEl.style.display = '';
                        baseEl.textContent = `${formatVN(+base)}đ`;
                    }else{
                        baseEl.style.display = 'none';
                        baseEl.textContent = '';
                    }
                }else{
                    priceEl.textContent = 'Liên hệ';
                    baseEl.style.display = 'none';
                    baseEl.textContent = '';
                }
                console.log(price)
            }

            // khởi tạo theo radio đang checked
            const init = document.querySelector('.variant-radio:checked');
            console.log(init.dataset.price)
            if(init){ apply(init.dataset.price, init.dataset.base); }

            // lắng nghe thay đổi
            radios.forEach(r => {
                r.addEventListener('change', () => {
                    apply(r.dataset.price, r.dataset.base);
                });
            });
        })();
    </script>

@endpush
