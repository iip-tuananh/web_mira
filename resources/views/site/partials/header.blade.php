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
    <div >

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


        </style>

        <div class="menu-area">
            <div class="container">

                <!-- ROW TRÊN: LOGO (trái) + HEADER BUTTON (phải) -->

                <div class="row align-items-center py-2 justify-content-center header-top-wrap " >
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

                    <!-- Thanh tìm kiếm ở giữa -->
                    <div class="col-12 col-lg-6 order-4 order-lg-2 mt-2 mt-lg-0 d-flex justify-content-center">
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
                            <a href="{{ route('front.getProductList') }}" class="th-btn style4">Shop Now<i class="fas fa-chevrons-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <!-- ROW DƯỚI: MENU căn giữa (desktop) -->
                <div class="row sticky-wrapper" >
                    <div class="col-12">
                        <nav class="main-menu d-none d-lg-block text-center">
                            <ul class="menu-center">
                                <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                                <li><a href="{{ route('front.abouts') }}">Về chúng tôi</a></li>
                                <li class="menu-item-has-children"><a href="#">Sản phẩm</a>
                                    <ul class="sub-menu">
                                        @foreach($categories as $cate)
                                            @if($cate->childs()->count() > 0)
                                                <li class="menu-item-has-children"><a href="{{ route('front.getProductList', $cate->slug) }}">{{ $cate->name }}</a>
                                                    <ul class="sub-menu">
                                                        @foreach($cate->childs as $child)
                                                            <li><a href="{{ route('front.getProductList', $child->slug) }}">{{ $child->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a href="{{ route('front.getProductList', $cate->slug) }}">{{ $cate->name }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>


                                <li class="menu-item-has-children"><a href="{{ route('front.blogs') }}">Blog</a>
                                    <ul class="sub-menu">
                                        @foreach($postsCategory as $pCate)
                                            <li><a href="{{ route('front.blogs', $pCate->slug) }}">{{ $pCate->name }}</a></li>
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
                                        src="<% item.attributes.image %>" alt="Cart Image"><% item.name %></a> <span
                                    class="quantity"><% item.quantity %> × <span class="woocommerce-Price-amount amount"><span
                                            class="woocommerce-Price-currencySymbol"></span>  <% (+item.price > 0) ? ((+item.price) | number) + '₫' : 'Liên hệ' %></span></span>
                            </li>


                        </ul>
                        <p class="woocommerce-mini-cart__total total"><strong>Tồng tiền:</strong> <span
                                class="woocommerce-Price-amount amount"><span
                                    class="woocommerce-Price-currencySymbol"></span><% cart.total| number %>₫</span>
                        </p>
                        <p class="woocommerce-mini-cart__buttons buttons"><a href="{{ route('cart.index') }}" class="th-btn wc-forward">Xem giỏ hàng</a>
                            <a href="{{ route('cart.checkout') }}" class="th-btn checkout wc-forward">Thanh toán</a></p>
                    </div>
                    <div class="widget_shopping_cart_content" ng-if="! cart.count">
                        Chưa có sản phẩm nào trong giỏ hàng
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo"><a href="{{ route('front.home-page') }}"><img src="{{ $config->image->path ?? '' }}" alt="{{ $config->web_title }}" style="max-width: 41%">
                </a></div>
            <div class="th-mobile-menu">
                <ul>
                    <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                    <li><a href="{{ route('front.abouts') }}">Về chúng tôi</a></li>
                    <li class="menu-item-has-children"><a href="#">Sản phẩm</a>
                        <ul class="sub-menu">
                            @foreach($categories as $cate)
                                @if($cate->childs()->count() > 0)
                                    <li class="menu-item-has-children"><a href="{{ route('front.getProductList', $cate->slug) }}">{{ $cate->name }}</a>
                                        <ul class="sub-menu">
                                            @foreach($cate->childs as $child)
                                                <li><a href="{{ route('front.getProductList', $child->slug) }}">{{ $child->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{ route('front.getProductList', $cate->slug) }}">{{ $cate->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>


                    <li class="menu-item-has-children"><a href="{{ route('front.blogs') }}">Blog</a>
                        <ul class="sub-menu">
                            @foreach($postsCategory as $pCate)
                                <li><a href="{{ route('front.blogs', $pCate->slug) }}">{{ $pCate->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('front.contact') }}">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>

</header>
