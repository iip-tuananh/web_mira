@extends('site.layouts.master')
@section('title'){{ $category ? $category->name : "Sản phẩm" }} - {{ $config->web_title }}@endsection
@section('description'){{ strip_tags(html_entity_decode($config->introduction)) }}@endsection
@section('image'){{@$config->image->path ?? ''}}@endsection

@section('css')

@endsection


@section('content')

    <div class="breadcumb-wrapper" data-bg-src="{{ @$category->image->path ?? '' }}">
        <div class="container">
            <div class="breadcumb-content"><h1 class="breadcumb-title">{{ @$category->name ?? 'Sản phẩm' }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                    <li>{{ @$category->name ?? 'Sản phẩm' }}</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="space-top space-extra-bottom" ng-controller="productList">
        <div class="container">
            <div class="th-sort-bar">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md">
                        <p class="woocommerce-result-count">
                            @if($products->total() > 0)
                                Hiển thị {{ number_format($products->firstItem()) }}–{{ number_format($products->lastItem()) }}
                                trên tổng {{ number_format($products->total()) }}
                                sản phẩm
                            @else
                                0 sản phẩm
                            @endif
                        </p>
                    </div>
                    <div class="col-md-auto">
                        @php
                            $currentSort = request('sort', 'date_desc');
                        @endphp

                        <form class="woocommerce-ordering" method="get">
                            <select name="sort" class="orderby" aria-label="Shop order" onchange="this.form.submit()">
                                <option value="date_desc" {{ $currentSort === 'date_desc' ? 'selected' : '' }}>Mặc định</option>
                                <option value="name_asc"  {{ $currentSort === 'name_asc'  ? 'selected' : '' }}>Tên A–Z</option>
                                <option value="name_desc" {{ $currentSort === 'name_desc' ? 'selected' : '' }}>Tên Z–A</option>
                                <option value="price_asc" {{ $currentSort === 'price_asc' ? 'selected' : '' }}>Giá thấp đến cao</option>
                                <option value="price_desc"{{ $currentSort === 'price_desc'? 'selected' : '' }}>Giá cao xuống thấp</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row gy-40">
                @foreach($products as $product)
                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                        @include('site.partials.product_item', ['product' => $product])
                    </div>

                @endforeach

            </div>

            {{ $products->links('site.pagination.paginate2') }}


        </div>
    </section>

@endsection

@push('scripts')
    <script>
        app.controller('productList', function ($rootScope, $scope, cartItemSync, $interval) {
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
