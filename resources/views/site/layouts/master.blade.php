<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    @include('site.partials.head')
    @yield('css')

    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2282309942215854');
        fbq('track', 'PageView');
    </script>

    <!-- End Meta Pixel Code -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8C0M33482V"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-8C0M33482V');
    </script>

</head>

<body ng-app="App">

<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=2282309942215854&ev=PageView&noscript=1"
    /></noscript>

{{--    <div class="preloader">--}}
{{--        <div class="preloader-inner">--}}
{{--            <div class="loader"><span></span> <span></span> <span></span> <span></span> <span></span> <span></span></div>--}}
{{--        </div>--}}
{{--    </div>--}}



    <div class="popup-search-box d-none d-lg-block">
        <button class="searchClose"><i class="fal fa-times"></i></button>
        <form action="#"><input type="text" placeholder="What are you looking for?">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div>

    @include('site.partials.header')

    @yield('content')


    @include('site.partials.footer')
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                  style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>

    <script src="/site/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="/site/assets/js/app.min.js"></script>
    <script src="/site/assets/js/main.js"></script>

    @include('site.partials.angular_mix')



    <script>
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script>

    <script>
        app.controller('headerPartial', function ($rootScope, $scope, cartItemSync, $interval, $window) {
            $scope.cart = cartItemSync;

            $scope.incrementQuantity = function (product) {
                product.quantity = Math.min(product.quantity + 1, 9999);
            };

            $scope.decrementQuantity = function (product) {
                product.quantity = Math.max(product.quantity - 1, 0);
            };

            $scope.changeQty = function (qty, item) {
                updateCart(qty, item)
            }

            function updateCart(qty, item) {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{route('cart.update.item')}}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        product_id: item.id,
                        variant_id: item.attributes.variant_id,
                        qty: qty
                    },
                    beforeSend: function() {
                        jQuery('.loading-spin').show();
                        // showOverlay();
                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.countItem = response.count;

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function(){
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
                        jQuery('.loading-spin').hide();
                        // hideOverlay();
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.removeItem = function (product_id) {
                jQuery.ajax({
                    type: 'GET',
                    url: "{{route('cart.remove.item')}}",
                    data: {
                        product_id: product_id
                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function(){
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.countItem = response.count;

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



            $scope.search = function () {
                if (!$scope.keywords || !$scope.keywords.trim()) {
                    alert('Vui lòng nhập từ khóa tìm kiếm!');
                    return;
                }

                // Xây URL cơ bản
                var url = '/tim-kiem?keywords=' + encodeURIComponent($scope.keywords.trim());

                // Điều hướng
                $window.location.href = url;
            };

        });


        app.factory('cartItemSync', function ($interval) {
            var cart = {items: null, total: null};

            cart.items = @json($cartItems);
            cart.count = {{$cartItems->sum('quantity')}};
            cart.total = {{$totalPriceCart}};

            return cart;
        });

    </script>

    <script>
    app.controller('footerBlock', function ($rootScope, $scope, $sce, $interval) {
        $scope.errors = [];
        $scope.submitContactRegister = function () {
            var url = "{{route('front.postContactFooter')}}";
            var data = jQuery('#form-contact-footer').serialize();
            $scope.loading = true;
            jQuery.ajax({
                type: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: data,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        jQuery('#form-contact-footer')[0].reset();
                        $scope.errors = [];
                        $scope.$apply();
                    } else {
                        $scope.errors = response.errors;
                        toastr.warning(response.message);
                    }
                },
                error: function () {
                    toastr.error('Đã có lỗi xảy ra');
                },
                complete: function () {
                    $scope.loading = false;
                    $scope.$apply();
                }
            });
        }
    })

</script>

    @stack('scripts')
    <script>
        (function () {
            // Hủy handler gán trực tiếp
            ['onkeydown','onkeyup','onkeypress','oncontextmenu','onselectstart','oncopy','oncut']
                .forEach(k => { document[k] = null; window[k] = null; });

            // Chặn các listener đã đăng ký bằng addEventListener (bằng cách chặn lan truyền)
            const events = ['keydown','keyup','keypress','contextmenu','selectstart','copy','cut','paste','mousedown','mouseup'];
            for (const evt of events) {
                window.addEventListener(evt, function(e){
                    // cho phép bạn dùng lại phím/chuột phải
                    e.stopImmediatePropagation();
                    // cho các case đã gọi preventDefault trước đó
                    try { e.returnValue = true; } catch(_) {}
                }, {capture:true});
            }
        })();
    </script>




    <script defer>
    document.addEventListener('DOMContentLoaded', function(){
        const menuRoot = document.querySelector('.th-mobile-menu');
        if(!menuRoot) return;

        const viewport = menuRoot.querySelector('.mn-viewport');
        const track    = menuRoot.querySelector('.mn-track');
        const panels   = Array.from(menuRoot.querySelectorAll('.mn-panel'));
        const idToIdx  = Object.fromEntries(panels.map((p,i)=>[p.id, i]));
        const stack    = ['mn-root'];

        function setActive(id){
            const idx = idToIdx[id];
            if(idx == null) return;
            track.style.transform = `translateX(-${idx*100}%)`;
            requestAnimationFrame(()=> viewport && (viewport.style.height = panels[idx].scrollHeight+'px'));
        }
        setActive(stack[0]);

        function onNavEvent(e){
            // chỉ xử lý nếu click nằm trong menu
            if(!menuRoot.contains(e.target)) return;

            // tìm phần tử có data-target (ưu tiên chính phần tử, nếu không có tìm lên li)
            const el = e.target.closest('[data-target], .to-sub, .mn-back');
            if(!el) return;

            // Back trước
            if(el.classList.contains('mn-back')){
                e.preventDefault();
                if(stack.length > 1){ stack.pop(); setActive(stack[stack.length-1]); }
                return;
            }

            // Đi tới submenu
            let target = el.getAttribute('data-target');
            if(!target){
                const li = el.closest('li[data-target]');
                if(li) target = li.getAttribute('data-target');
            }
            if(!target) return;

            e.preventDefault();               // chặn <a> nhảy trang
            const id = target.replace('#','');
            if(!(id in idToIdx)) return;      // panel không tồn tại
            stack.push(id);
            setActive(id);
        }

        // dùng capture để “đón” sự kiện trước khi script khác chặn
        menuRoot.addEventListener('click', onNavEvent, true);
        menuRoot.addEventListener('pointerup', onNavEvent, true);
        menuRoot.addEventListener('touchend', onNavEvent, {capture:true, passive:false});

        window.addEventListener('resize', ()=> setActive(stack[stack.length-1]), {passive:true});
    });
</script>

</body>

</html>
