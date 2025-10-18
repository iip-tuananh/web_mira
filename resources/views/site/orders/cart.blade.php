@extends('site.layouts.master')
@section('title')
    Giỏ hàng
@endsection

@section('css')



@endsection

@section('content')
    <div class="breadcumb-wrapper" >
        <div class="container">
            <div class="breadcumb-content"><h1 class="breadcumb-title">Giỏ hàng</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                    <li>Giỏ hàng</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="th-cart-wrapper space-top space-extra-bottom" ng-controller="CartController">
        <div class="container">
{{--            <div class="woocommerce-notices-wrapper">--}}
{{--                <div class="woocommerce-message">Shipping costs updated.</div>--}}
{{--            </div>--}}
            <form class="woocommerce-cart-form">
                <table class="cart_table">
                    <thead>
                    <tr>
                        <th class="cart-col-image">Hình ảnh</th>
                        <th class="cart-col-productname">Sản phẩm</th>
                        <th class="cart-col-price">Đơn giá</th>
                        <th class="cart-col-quantity">Số lượng</th>
                        <th class="cart-col-total">Thành tiền</th>
                        <th class="cart-col-remove">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="cart_item" ng-repeat="item in items">
                        <td data-title="Product"><a class="cart-productimage" href="shop-detailis.html">
                                <img width="91"
                                     height="91"

                                     ng-src="<% (item && item.attributes && item.attributes.image) ? item.attributes.image : '' %>"
                                     alt="Image"
                                ></a>
                        </td>

                        <td data-title="Name"><a class="cart-productname" href="shop-detailis.html"><% item.name %></a>
                        </td>

                        <td data-title="Price"><span class="amount"><bdi><span></span>
                                    <% (+item.price > 0) ? ((+item.price) | number) + '₫' : 'Liên hệ' %>
                                </bdi></span></td>
                        <td data-title="Quantity">
                            <div class="quantity">
                                <button class="quantity-minus qty-btn"
                                        ng-click="decrementQuantity(item); changeQty(item.quantity, item.id)"><i
                                        class="far fa-minus"></i></button>
                                <input type="number" class="qty-input" value="<%item.quantity%>" min="1" max="99"
                                       ng-model="item.quantity" ng-change="changeQty(item.quantity, item.id)">
                                <button class="quantity-plus qty-btn"
                                        ng-click="incrementQuantity(item); changeQty(item.quantity, item.id)"><i
                                        class="far fa-plus"></i></button>
                            </div>
                        </td>
                        <td data-title="Total"><span class="amount"><bdi><span></span>
                                    <% (+item.price > 0)
                                    ? (((+item.price) * (+item.quantity || 1)) | number) + '₫'
                                    : 'Liên hệ' %>
                                </bdi></span>
                        </td>
                        <td data-title="Remove"><a href="javascript:void(0)" class="remove" ng-click="removeItem(item.id)"><i class="fal fa-trash-alt"></i></a></td>
                    </tr>

                    <tr>
                        <td colspan="6" class="actions">
                            <a href="{{ route('front.home-page') }}" class="th-btn">Tiếp tục mua sắm</a></td>
                    </tr>
                    </tbody>
                </table>
            </form>
            <div class="row justify-content-end">
                <div class="col-md-8 col-lg-7 col-xl-6"><h2 class="h4 summary-title">Thanh toán</h2>
                    <table class="cart_totals">
                        <tfoot>
                        <tr class="order-total">
                            <td>Tổng tiền</td>
                            <td data-title="Total"><strong><span class="amount"><bdi><span></span><% total | number%>₫</bdi></span></strong>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="wc-proceed-to-checkout mb-30"><a href="{{ route('cart.checkout') }}" class="th-btn">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.cart-item').forEach(item => {
            item.addEventListener('click', e => {
                if (e.target.classList.contains('qty-btn')) {
                    const input = item.querySelector('.qty-input');
                    console.log(input.value)
                    let val = parseInt(input.value, 10) || 1;
                    if (e.target.classList.contains('minus')) val = Math.max(1, val - 1);
                    else val++;
                    input.value = val;
                    // updateCart();
                }
            });
            // khi gõ số trực tiếp
            item.querySelector('.qty-input').addEventListener('change', e => {
                if (e.target.value < 1) e.target.value = 1;
                // updateCart();
            });
        });
    </script>

    <script>
        app.controller('CartController', function ($scope, cartItemSync, $interval, $rootScope) {
            $scope.items = @json($cartCollection);
            console.log( $scope.items)
            $scope.total_qty = "{{ $total_qty }}";
            $scope.total = "{{$total_price}}";

            $scope.countItem = Object.keys($scope.items).length;

            $scope.changeQty = function (qty, product_id) {
                updateCart(qty, product_id)
            }

            $scope.incrementQuantity = function (product) {
                product.quantity = Math.min(product.quantity + 1, 9999);
            };

            $scope.decrementQuantity = function (product) {
                product.quantity = Math.max(product.quantity - 1, 0);
            };

            function updateCart(qty, product_id) {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{ route('cart.update.item') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        product_id: product_id,
                        qty: qty
                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;
                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function () {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.$applyAsync();
                        }
                    },
                    error: function (e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.removeItem = function (product_id) {
                jQuery.ajax({
                    type: 'GET',
                    url: "{{ route('cart.remove.item') }}",
                    data: {
                        product_id: product_id
                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function () {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.countItem = Object.keys($scope.items).length;

                            $scope.$applyAsync();
                        }
                    },
                    error: function (e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script>
@endpush
