<header class="th-header header-layout1" ng-controller="headerPartial">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                <div class="col-auto d-none d-lg-block"><p class="header-notice">{{ $config->web_title }}</p>
                </div>
                <div class="col-auto">
                    <div class="header-links">
                        <ul>
                            <li class="d-none d-sm-inline-block"><i class="fal fa-location-dot"></i><a
                                    href="#">{{ $config->address_company }}</a></li>
                            <li>
                                <div class="social-links"><a href="{{ $config->facebook }}"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="{{ $config->twitter }}"><i
                                            class="fab fa-twitter"></i></a>
                                    <a href="{{ $config->instagram }}"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="{{ $config->youtube }}"><i
                                            class="fab fa-youtube"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

        <style>
            /* Căn giữa menu theo chiều ngang ở desktop */
            .main-menu.text-center > ul.menu-center {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 28px; /* khoảng cách giữa các mục menu */
                margin: 0;
                /*padding: 10px 0;           !* chiều cao hàng menu *!*/
                list-style: none;
            }

            /* Đảm bảo sub-menu vẫn hoạt động nếu theme đang dùng flex/position */
            .main-menu .sub-menu {
                min-width: 220px;
            }

            /* Khoảng cách hàng trên/dưới cho gọn gàng */

            /* Ẩn nút burger ở desktop, hiển thị mobile — đã có class nhưng thêm chắc chắn */
            @media (min-width: 992px) {
                .th-menu-toggle {
                    display: none !important;
                }
            }

            @media (max-width: 991.98px) {
                .main-menu {
                    display: none !important;
                }

                /* menu trung tâm chỉ hiện ở desktop */
            }

        </style>
        <style>
            /* Thu gọn hàng trên để logo và buttons gần trọng tâm hơn */
            .menu-area .header-top-wrap {
                max-width: 1100px; /* kéo nội dung hàng trên vào gần giữa */
                margin-inline: auto;
            }

            /* Logo chiều cao hợp lý */
            .menu-area .header-logo img {
                max-height: 120px;
                height: auto;
            }

            /* ====== SEARCH PILL ====== */
            .hero-search {
                display: flex;
                align-items: center;
                width: 100%;
                max-width: 680px; /* bề rộng tối đa của thanh tìm kiếm */
                padding: 4px; /* tạo viền trong */
                border: 2px solid #2f2f2f; /* màu viền */
                border-radius: 999px; /* pill */
                background: #f7f4ef; /* nền nhạt giống ảnh mẫu */
                box-shadow: 0 0 0 1px rgba(0, 0, 0, .06) inset;
                gap: 8px;
            }

            .hero-search__input {
                flex: 1;
                min-width: 0;
                border: 0;
                outline: none;
                padding: 10px 14px;
                background: transparent;
                font-size: 15px;
            }

            .hero-search__input::placeholder {
                color: #9aa0a6;
            }

            .hero-search__btn {
                border: 0;
                outline: none;
                cursor: pointer;
                padding: 10px 16px;
                border-radius: 999px;
                font-weight: 700;
                background: #ffc52e; /* vàng */
                color: #1a1a1a;
                white-space: nowrap;
            }

            /* Mobile: search full-width, có khoảng cách với logo/burger */
            @media (max-width: 991.98px) {
                .hero-search {
                    max-width: none;
                }
            }

            /* Nếu theme đang có .container quá rộng, có thể thu menu-area lại một chút */
            /* .menu-area .container{ max-width: 1280px; } */

            /* === VARIANT: small === */
            .hero-search.hero-search--sm {
                padding: 2px;
                border-width: 1.5px;
            }

            .hero-search.hero-search--sm .hero-search__input {
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.2;
            }

            .hero-search.hero-search--sm .hero-search__btn {
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.2;
                min-height: auto;
            }

        </style>

        <style>
            @media (max-width: 991.98px) {

                .header-top-wrap {
                    padding-top: .5rem !important;
                    padding-bottom: .5rem !important;
                }
            }

        </style>


        <style>
            /* ===== MOBILE ONLY ===== */
            @media (max-width: 991.98px){
                /* Khung hàng trên làm khung định vị */
                .header-top-wrap{
                    position: relative;
                    min-height: 56px; /* đảm bảo đủ cao cho các nút */
                }

                /* Logo vào giữa tuyệt đối */
                .header-top-wrap .header-logo{
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                    top: 50%;
                    transform-origin: center;
                    transform: translate(-50%, -50%);
                    text-align: center;
                    width: auto;
                }
                .header-top-wrap .header-logo img{
                    max-height: 60px;
                    width: auto;
                }

                /* Cụm nút mobile: chứa cả burger & search để định vị trái/phải */
                .header-mobile-btns{
                    position: static;      /* giữ col, nhưng nút bên trong sẽ tuyệt đối */
                }

                /* Burger chuyển về trái */
                .th-menu-toggle{
                    position: absolute !important;
                    left: 12px;
                    top: 50%;
                    transform: translateY(-50%);
                    z-index: 5;
                }

                /* Nút search ở phải */
                .mobile-search-toggle{
                    position: absolute;
                    right: -3px;
                    top: 50%;
                    transform: translateY(-50%);
                    z-index: 5;
                    background: #f9d977;
                    border: 0;
                    width: 38px; height: 38px;
                    border-radius: 10px;
                    display: inline-flex; align-items: center; justify-content: center;
                    box-shadow: 0 1px 2px rgba(0,0,0,.06) inset;
                }
                .mobile-search-toggle i{ font-size: 16px; }

                .mobile-cart-toggle{
                    position: absolute;
                    right: 42px;
                    top: 50%;
                    transform: translateY(-50%);
                    z-index: 5;
                    background: #f9d977;
                    border: 0;
                    width: 38px; height: 38px;
                    border-radius: 10px;
                    display: inline-flex; align-items: center; justify-content: center;
                    box-shadow: 0 1px 2px rgba(0,0,0,.06) inset;
                }

                .badge-mobi {
                    top: -5px;
                    right: -5px;
                }

                /* Ẩn form search mặc định trên mobile và đặt hiệu ứng trượt */
                .hero-search{
                    overflow: hidden;
                    max-height: 0;
                    opacity: 0;
                    pointer-events: none;
                    transform: translateY(-6px);
                    transition: max-height .28s ease, opacity .2s ease, transform .28s ease, margin .28s ease;
                    margin-top: 0 !important;
                }
                /* Khi mở search */
                .menu-area.search-open .hero-search{
                    max-height: 80px;            /* đủ cho input + button */
                    opacity: 1;
                    pointer-events: auto;
                    transform: translateY(0);
                    margin-top: 10px !important; /* cách logo 1 chút */
                }

                /* Ẩn label/btn desktop nếu có xung đột */
                .header-button{ display: none !important; }
            }

        </style>

        <style>
            /* ===== Mobile only ===== */
            @media (max-width: 991.98px){
                .header-top-wrap{ position: relative; z-index: 2; }

                /* Panel mobile mặc định ẩn, không chiếm chỗ */
                .mobile-search-panel{
                    overflow: hidden;
                    max-height: 0;
                    opacity: 0;
                    transform: translateY(-6px);
                    transition: max-height .28s ease, opacity .2s ease, transform .28s ease, margin .28s ease;
                    margin-top: 0;
                    z-index: 1; /* nhỏ hơn header để luôn nằm dưới */
                }

                /* Khi mở tìm kiếm */
                .menu-area.search-open .mobile-search-panel{
                    max-height: 90px;            /* đủ cho input + nút */
                    opacity: 1;
                    transform: translateY(0);
                    margin-top: 8px;
                }

                /* Ẩn form desktop trên mobile */
                .hero-search.d-none{ display: none !important; } /* an toàn nếu theme ghi đè */

                /* Nếu trước đó bạn có CSS ẩn/hiện .hero-search trong cùng row, bỏ đi: */
                .hero-search{ max-height: none !important; opacity: 1 !important; transform: none !important; }

                .menu-area {
                    margin-bottom: 10px;
                }

                .th-menu-toggle {
                    width: 41px;
                    height: 41px;
                }
            }

        </style>



        <div class="menu-area" style="margin-top: 10px">
            <div class="container">

                <!-- ROW TRÊN: LOGO (trái) + HEADER BUTTON (phải) -->

                <div class="row align-items-center  justify-content-center header-top-wrap ">
                    <!-- Logo trái -->
                    <div class="col-6 col-lg-3 order-1 d-flex align-items-center">
                        <div class="header-logo">
                            <a href="{{ route('front.home-page') }}">
                                <img src="{{ $config->image->path ?? '' }}" alt="Frutin">
                            </a>
                        </div>
                    </div>

                    <!-- Nút burger mobile (phải) -->
                    <div class="col-6 d-flex justify-content-end align-items-center d-lg-none order-2">
                        <button type="button" class="th-menu-toggle" aria-label="Open menu">
                            <i class="far fa-bars"></i>
                        </button>
                    </div>

                    <!-- Nút burger + nút search (mobile) -->
                    <div class="col-6 d-flex justify-content-end align-items-center d-lg-none order-2 header-mobile-btns">
                        <button type="button" class="th-menu-toggle" aria-label="Open menu">
                            <i class="far fa-bars"></i>
                        </button>
                        <button type="button" class="mobile-search-toggle" aria-label="Open search">
                            <i class="far fa-search"></i>
                        </button>


                       <a href="{{ route('cart.index') }}">
                           <button type="button" class="mobile-cart-toggle" aria-label="Open cart">
                               <span class="badge badge-mobi" ng-cloak><% cart.count %></span>
                               <i class="fa-regular fa-cart-shopping"></i>
                           </button>
                       </a>
                    </div>


                    <!-- Thanh tìm kiếm ở giữa -->
                    <div class="col-12 col-lg-6 order-4 order-lg-2 mt-2 mt-lg-0 d-none d-lg-flex justify-content-center">
                        <form class="hero-search" role="search"
                              aria-label="Tìm kiếm sản phẩm">
                            <input class="hero-search__input" type="search" name="q" ng-model="keywords"
                                   placeholder="Nhập tên sản phẩm ..."/>
                            <button class="hero-search__btn" type="button" ng-click="search()">Tìm kiếm</button>
                        </form>
                    </div>

                    <!-- Header buttons phải (desktop) -->
                    <div class="col-lg-3 d-none d-xl-flex justify-content-end align-items-center order-lg-3">
                        <div class="header-button">
                            <button type="button" class="simple-icon searchBoxToggler" aria-label="Open quick search">
                            </button>
                            <button type="button" class="simple-icon sideMenuToggler" aria-label="Open cart">
                                <span class="badge" ng-cloak><% cart.count %></span>
                                <i class="fa-regular fa-cart-shopping"></i>
                            </button>
                            <a href="{{ route('front.getProductList') }}" class="th-btn style4">Shop Now<i
                                    class="fas fa-chevrons-right ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row d-lg-none">
                    <div class="col-12">
                        <div class="mobile-search-panel">
                            <form class="hero-search" role="search" aria-label="Tìm kiếm sản phẩm">
                                <input class="hero-search__input" type="search" name="q" ng-model="keywords"
                                       placeholder="Nhập tên sản phẩm ..." />
                                <button class="hero-search__btn" type="button" ng-click="search()">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>
                </div>





                <!-- ROW DƯỚI: MENU căn giữa (desktop) -->
                <div class="row sticky-wrapper">
                    <div class="col-12">
                        <nav class="main-menu d-none d-lg-block text-center">
                            <ul class="menu-center">
                                <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                                <li><a href="{{ route('front.abouts') }}">Về chúng tôi</a></li>
                                <li class="menu-item-has-children"><a href="#">Sản phẩm</a>
                                    <ul class="sub-menu">
                                        @foreach($categories as $cate)
                                            @if($cate->childs()->count() > 0)
                                                <li class="menu-item-has-children"><a
                                                        href="{{ route('front.getProductList', $cate->slug) }}">{{ $cate->name }}</a>
                                                    <ul class="sub-menu">
                                                        @foreach($cate->childs as $child)
                                                            <li>
                                                                <a href="{{ route('front.getProductList', $child->slug) }}">{{ $child->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('front.getProductList', $cate->slug) }}">{{ $cate->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>


                                <li class="menu-item-has-children"><a href="{{ route('front.blogs') }}">Blog</a>
                                    <ul class="sub-menu">
                                        @foreach($postsCategory as $pCate)
                                            <li>
                                                <a href="{{ route('front.blogs', $pCate->slug) }}">{{ $pCate->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('front.contact') }}">Liên hệ</a></li>
                            </ul>
                        </nav>


                    </div>
                </div>

            </div>
        </div>


        <div class="sidemenu-wrapper sidemenu-cart d-none d-lg-block">
            <div class="sidemenu-content">
                <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
                <div class="widget woocommerce widget_shopping_cart"><h3 class="widget_title">Giỏ hàng</h3>
                    <div class="widget_shopping_cart_content" ng-if="cart.count">
                        <ul class="woocommerce-mini-cart cart_list product_list_widget">


                            <li class="woocommerce-mini-cart-item mini_cart_item" ng-repeat="item in cart.items">
                                <a href="javascript:void(0)" class="remove remove_from_cart_button"><i
                                        class="far fa-times" ng-click="removeItem(item.id)"></i></a> <a href="#"><img
                                        ng-src="<% (item && item.attributes && item.attributes.image) ? item.attributes.image : '' %>"
                                        alt="Cart Image"><% item.name %></a>

                                <span ng-bind="(item.attributes && item.attributes.type && item.attributes.type.type_title) || ''"></span>
                                <br ng-if="item.attributes && item.attributes.type && item.attributes.type.type_title">

                                <span class="quantity"><% item.quantity %> × <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol"></span>
                                        <% (+item.price > 0) ? ((+item.price) | number) + '₫' : 'Liên hệ' %>
                                    </span>
                                </span>
                            </li>


                        </ul>
                        <p class="woocommerce-mini-cart__total total"><strong>Tồng tiền:</strong> <span
                                class="woocommerce-Price-amount amount"><span
                                    class="woocommerce-Price-currencySymbol"></span><% cart.total| number %>₫</span>
                        </p>
                        <p class="woocommerce-mini-cart__buttons buttons"><a href="{{ route('cart.index') }}"
                                                                             class="th-btn wc-forward">Xem giỏ hàng</a>
                            <a href="{{ route('cart.checkout') }}" class="th-btn checkout wc-forward">Thanh toán</a></p>
                    </div>
                    <div class="widget_shopping_cart_content" ng-if="! cart.count">
                        Chưa có sản phẩm nào trong giỏ hàng
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
    /* ===== Mobile slide panels ===== */
    @media (max-width: 991.98px){
        .mn{ position: relative; }
        .mn-viewport{
            overflow: hidden;
            width: 100%;
            border-radius: 12px;
            background: #fff;
        }
        .mn-track{
            display: flex;
            width: 100%;
            transition: transform .28s ease;
            will-change: transform;
        }
        .mn-panel{
            flex: 0 0 100%;
            width: 100%;
            min-height: 52vh;           /* cao vừa phải, tuỳ header/footer của bạn */
            display: flex;
            flex-direction: column;
            background: #fff;
        }

        /* Header của panel con */
        .mn-header{
            display: grid;
            grid-template-columns: 40px 1fr auto;
            align-items: center;
            gap: 8px;
            padding: 12px 12px 6px;
            border-bottom: 1px solid #f0f2f5;
            background: #fff;
            position: sticky; top: 0; z-index: 2;
        }
        .mn-back{
            width: 36px; height: 36px; border-radius: 10px; border:1px solid #e6e8ec; background:#fff;
            display:inline-flex; align-items:center; justify-content:center;
        }
        .mn-title{ font-weight: 800; font-size: 16px; }
        .mn-viewall{
            font-size: 13px; font-weight: 700; text-decoration: none; color: #2563eb;
            padding: 6px 10px; border-radius: 8px; background: #eef2ff;
        }

        /* List */
        .mn-list{ list-style: none; padding: 8px 8px 12px; margin: 0; }
        .mn-list > li{ border-bottom: 1px solid #f4f5f7; }
        .mn-link{
            width: 100%; text-align: left;
            display: flex; align-items: center; justify-content: space-between;
            gap: 10px; padding: 12px 10px; background: transparent; border: 0;
            font-size: 15px; color:#111827; text-decoration: none; border-radius: 8px;
        }
        .mn-link:hover{ background: #f7f8fa; }
        .mn .has-sub .mn-link i{ opacity: .8; }
    }


    /* Mobile only – đè lên CSS cũ */
    @media (max-width: 991.98px){
        .mn-link{
            position: relative;
            display: flex !important;
            align-items: center;
            padding-right: 36px !important;   /* chừa chỗ cho icon */
        }
        .mn-link i.fa-chevron-right{
            position: absolute;
            right: 12px;                      /* sát mép phải */
            top: 50%;
            transform: translateY(-50%);
            opacity: .75;
            pointer-events: none;             /* tránh chặn click */
        }
    }

</style>
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo"><a href="{{ route('front.home-page') }}"><img
                        src="{{ $config->image->path ?? '' }}" alt="{{ $config->web_title }}" style="max-width: 41%">
                </a></div>

            <div class="th-mobile-menu mn" aria-label="Mobile navigation">
                <div class="mn-viewport">
                    <div class="mn-track">

                        {{-- PANEL GỐC --}}
                        <div class="mn-panel" id="mn-root" data-title="Menu">
                            <ul class="mn-list">
                                @foreach($categories as $cate)
                                    @if($cate->childs()->count() > 0)
                                        <li class="has-sub" data-target="#mn-cate-{{ $cate->id }}" style="border: 0">
                                            <a class="mn-link to-sub"
                                               data-target="#mn-cate-{{ $cate->id }}">
                                                <span>{{ $cate->name }}</span>
                                                <i class="fa-regular fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li style="border: 0">
                                            <a class="mn-link" href="{{ route('front.getProductList', $cate->slug) }}">
                                                <span>{{ $cate->name }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                                <li style="border-top: 1px solid #adacac; border-bottom: 0" ><a href="{{ route('front.abouts') }}" >Về chúng tôi</a></li>
                                <li class="has-sub"  data-target="#mn-blog" style="border: 0">

                                        <a class="mn-link to-sub"
                                           data-target="#mn-blog">
                                            <span>Blog</span>
                                            <i class="fa-regular fa-chevron-right"></i>
                                        </a>
                                </li>
                                <li style="border: 0"><a class="mn-link" href="{{ route('front.contact') }}" ><span>Liên hệ</span></a></li>
                                <li style="border: 0"><a class="mn-link" href="{{ route('cart.index') }}" ><span>Giỏ hàng</span></a></li>
                            </ul>
                        </div>


                        {{-- CÁC PANEL CON THEO CATEGORY --}}
                        @foreach($categories as $cate)
                            @if($cate->childs()->count() > 0)
                                <div class="mn-panel" id="mn-cate-{{ $cate->id }}" data-title="{{ $cate->name }}"
                                     data-back="#mn-root" data-viewall="{{ route('front.getProductList', $cate->slug) }}">
                                    <div class="mn-header">
                                        <button type="button" class="mn-back"><i class="fa-regular fa-chevron-left"></i></button>
                                        <div class="mn-title">{{ $cate->name }}</div>
                                        <a class="mn-viewall" href="{{ route('front.getProductList', $cate->slug) }}">Xem tất cả</a>
                                    </div>
                                    <ul class="mn-list">
                                        @foreach($cate->childs as $child)
                                            <li>
                                                <a class="mn-link" href="{{ route('front.getProductList', $child->slug) }}">
                                                    <span>{{ $child->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach

                        {{-- PANEL BLOG --}}
                        <div class="mn-panel" id="mn-blog" data-title="Blog" data-back="#mn-root">
                            <div class="mn-header">
                                <button type="button" class="mn-back"><i class="fa-regular fa-chevron-left"></i></button>
                                <div class="mn-title">Blog</div>
                            </div>
                            <ul class="mn-list">
                                @foreach($postsCategory as $pCate)
                                    <li><a class="mn-link" href="{{ route('front.blogs', $pCate->slug) }}"><span>{{ $pCate->name }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>
    <script>
        (function(){
            const menuArea = document.querySelector('.menu-area');
            const toggleBtn = document.querySelector('.mobile-search-toggle');
            if(!menuArea || !toggleBtn) return;

            toggleBtn.addEventListener('click', function(){
                menuArea.classList.toggle('search-open');
            });

            // Đóng search khi resize lên desktop
            window.addEventListener('resize', function(){
                if(window.innerWidth >= 768){
                    menuArea.classList.remove('search-open');
                }
            }, { passive: true });
        })();
    </script>







</header>
