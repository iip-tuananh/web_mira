@extends('site.layouts.master')
@section('title')
    Sản phẩm yêu thích - {{ $config->web_title }}
@endsection
@section('description')
    {{ strip_tags(html_entity_decode($config->introduction)) }}
@endsection
@section('image')
    {{@$config->image->path ?? ''}}
@endsection

@section('css')
    <link href="/site/assets/breadcrumb_style.scssd27c.css?1739018973665" rel="stylesheet" type="text/css" media="all"/>

    <link href="/site/assets/collection_style.scssd27c.css?1739018973665" rel="stylesheet" type="text/css" media="all"/>

@endsection


@section('content')
    <div class="bodywrap" ng-controller="productList">
        <div class="layout-collection">
            <section class="bread-crumb">
                <div class="container">
                    <ul class="breadcrumb">
                        <li class="home">
                            <a href="index.html" title="Trang chủ"><span>Trang chủ</span></a>
                            <span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                           data-icon="chevron-right" role="img"
                                                           xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                                           class="svg-inline--fa fa-chevron-right fa-w-10"><path
                                        fill="currentColor"
                                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"
                                        class=""></path></svg>&nbsp;</span>
                        </li>


                        <li><strong><span>Danh sách yêu thích</span></strong></li>


                    </ul>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-banner">
                    </div>
                    <div class="col-12">
                        <div class="col-title">
                            <h1>Danh sách yêu thích</h1>
                            <div class="title-separator">
                                <div class="separator-center"></div>
                            </div>
                        </div>


                    </div>

                    <div class="block-collection col-lg-12 col-12">
                        <div class="category-products products-view products-view-grid list_hover_pro">
                            <div class="products-view products-view-grid list_hover_pro">
                                <div class="row" ng-cloak>


                                    <div class="col-6 col-md-3" ng-repeat="p in wishlistItems.items">
                                            <div class="item_product_main">

                                                <form
                                                    class="variants product-action item-product-main duration-300"
                                                    data-cart-form data-id="product-actions-34619470"
                                                    enctype="multipart/form-data">

                                                    <div class="product-thumbnail">
                                                        <a class="image_thumb scale_hover"
                                                           href="hong-sam-lat-tam-mat-ong-daedong-han-quoc-hop-10-goi-x-20g.html"
                                                           title="<% p.name %>">
                                                            <img class="lazyload duration-300"
                                                                 src="<% p.attributes.image %>"
                                                                 data-src="<% p.attributes.image %>"
                                                                 alt="<% p.name %>">
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="name-price">
                                                            <h3 class="product-name line-clamp-2-new">
                                                                <a href="hong-sam-lat-tam-mat-ong-daedong-han-quoc-hop-10-goi-x-20g.html"
                                                                   title="Hồng Sâm Lát Tẩm Mật Ong Daedong Hàn Quốc Hộp 10 Gói x 20g"><% p.name %></a>
                                                            </h3>
                                                            <div class="product-price-cart">
                                                                <span class="price" ng-if="p.price > 1"><% p.price | number:0 %>₫</span>
                                                                <span class="price" ng-if="p.price <= 1">Liên hệ</span>
                                                            </div>
                                                        </div>

                                                        <div class="product-button">
                                                            <input type="hidden" name="variantId" value="110199762"/>
                                                            <button class="btn-cart btn-views add_to_cart btn btn-primary "
                                                                    title="Thêm vào giỏ hàng" ng-click="addToCart(p.id)">
                                                                <span>Thêm vào giỏ</span>
                                                                <svg enable-background="new 0 0 32 32" height="512"
                                                                     viewBox="0 0 32 32" width="512"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <g>
                                                                        <g>
                                                                            <path
                                                                                d="m23.8 30h-15.6c-3.3 0-6-2.7-6-6v-.2l.6-16c.1-3.3 2.8-5.8 6-5.8h14.4c3.2 0 5.9 2.5 6 5.8l.6 16c.1 1.6-.5 3.1-1.6 4.3s-2.6 1.9-4.2 1.9c0 0-.1 0-.2 0zm-15-26c-2.2 0-3.9 1.7-4 3.8l-.6 16.2c0 2.2 1.8 4 4 4h15.8c1.1 0 2.1-.5 2.8-1.3s1.1-1.8 1.1-2.9l-.6-16c-.1-2.2-1.8-3.8-4-3.8z"/>
                                                                        </g>
                                                                        <g>
                                                                            <path
                                                                                d="m16 14c-3.9 0-7-3.1-7-7 0-.6.4-1 1-1s1 .4 1 1c0 2.8 2.2 5 5 5s5-2.2 5-5c0-.6.4-1 1-1s1 .4 1 1c0 3.9-3.1 7-7 7z"/>
                                                                        </g>
                                                                    </g>
                                                                </svg>
                                                            </button>
                                                            <a href="javascript:void(0)"
                                                               class="setWishlist btn-views btn-circle"
                                                               data-wish="hong-sam-lat-tam-mat-ong-daedong-han-quoc-hop-10-goi-x-20g"
                                                               tabindex="0" title="Gỡ sản phẩm yêu thích" ng-click="removeItem(p.id)">
                                                                <img width="25" height="25"
                                                                     src="/site/assets/heartd27c.png?1739018973665"
                                                                     alt="Gỡ sản phẩm yêu thích"/>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                </div>
                            </div>
                            <div class="pagenav">

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var colName = "Cao hắc sâm";

            var colId = 3271511;

            var selectedViewData = "data";
        </script>
        <div id="js-global-alert" class="alert alert-success" role="alert">
            <button type="button" class="close"><span aria-hidden="true"><span aria-hidden="true">&times;</span></span>
            </button>
            <h5 class="alert-heading"></h5>
            <p class="alert-content"></p>
        </div>


        <style>
            /* Backdrop mờ toàn màn hình */
            .backdrop__body-backdrop___1rvky{
                position: fixed;
                inset: 0;                 /* top:0;right:0;bottom:0;left:0 */
                background: rgba(0,0,0,.45);
                z-index: 1000;            /* THẤP HƠN modal */
                opacity: 0;
                visibility: hidden;
                transition: opacity .2s;
            }

            /* Modal giỏ hàng */
            .popup-cart-mobile{
                position: fixed;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                z-index: 1001;            /* CAO HƠN backdrop */
                background: #fff;
                width: min(92vw, 480px);
                max-height: 80vh;
                overflow: auto;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,.2);

                opacity: 0;
                visibility: hidden;
                transition: opacity .2s;
            }

            /* Khi bật */
            .backdrop__body-backdrop___1rvky.active{ opacity:1; visibility:visible; }
            .popup-cart-mobile.active{ opacity:1; visibility:visible; }

            /* (tuỳ chọn) khoá scroll nền khi mở modal */
            body.modal-open{ overflow:hidden; }

        </style>
        @include('site.partials.popup_cart')
    </div>

@endsection

@push('scripts')
    <link rel="preload" as="script" href="/site/assets/cold27c.js?1739018973665" />
    <script src="/site/assets/cold27c.js?1739018973665" type="text/javascript"></script>

    <script>
        app.controller('productList', function ($rootScope, $scope, cartItemSync, loveItemSync, $interval) {
            $scope.cart = cartItemSync;

            $scope.wishlistItems = loveItemSync;

            $scope.addToCart = function (productId) {
                url = "{{route('cart.add.item', ['productId' => 'productId'])}}";
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
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $('.popup-cart-mobile, .backdrop__body-backdrop___1rvky').addClass('active');
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

            $scope.removeItem = function (productId) {
                jQuery.ajax({
                    type: 'GET',
                    url: "{{route('love.remove.item')}}",
                    data: {
                        productId: productId
                    },
                    success: function (response) {
                        if (response.success) {

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function () {
                                loveItemSync.items = response.wishlistItems;
                                loveItemSync.count = response.count;
                            }, 1000);

                            $scope.wishlistItems.items = response.wishlistItems;
                            theme.alert.new('Gỡ sản phẩm yêu thích', 'Sản phẩm của bạn đã được xóa khỏi danh sách yêu thích.', 13000, 'alert-success');

                            $scope.$applyAsync();
                        } else {
                            theme.alert.new('Lỗi hệ thống', 'Có lỗi xảy ra. Vui lòng thử lại sau', 3000, 'alert-warning');

                        }
                    },
                    error: function (e) {
                        theme.alert.new('Lỗi hệ thống', 'Có lỗi xảy ra. Vui lòng thử lại sau', 3000, 'alert-warning');

                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }


        })

    </script>

@endpush
