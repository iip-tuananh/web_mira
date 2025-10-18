@extends('site.layouts.master')
@section('title')
    Liên hệ - {{ $config->web_title }}
@endsection
@section('description')
    {{ strip_tags(html_entity_decode($config->introduction)) }}
@endsection
@section('image')
    {{@$config->image->path ?? ''}}
@endsection

@section('css')

    <style>
        .invalid-feedback {
            margin-bottom: 10px;
            margin-top: 5px;
            display: none;
            width: 100%;
            font-size: 100%;
            color: #dc3545;
        }
    </style>
@endsection

@section('content')
    <div class="breadcumb-wrapper" data-bg-src="{{ $banner->image->path ?? '/site/assets/img/bg/breadcumb-bg.jpg' }}">
        <div class="container">
            <div class="breadcumb-content"><h1 class="breadcumb-title">Liên hệ</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                    <li>Liên hệ</li>
                </ul>
            </div>
        </div>
    </div>
    <style>
        /* cho các cột equal-height */
        .row.gy-4 > [class*="col-"]{
            display:flex;
        }
        .contact-feature{
            display:flex;
            gap:12px;
            padding:16px;
            border:1px solid rgba(0,0,0,.08);
            border-radius:14px;
            background:#fff;
            width:100%;
            /* quan trọng: cho card cao bằng nhau */
            align-items:flex-start;
        }

        /* icon + body */

        .contact-feature .media-body{
            display:flex;
            flex-direction:column;
            min-width:0; /* cho text-ellipsis hoạt động */
        }

        /* tiêu đề */
        .box-title{
            margin:0 0 4px;
            font-size:16px;
            font-weight:700;
        }

        /* clamp cho đoạn text để không làm lệch chiều cao */
        .box-text{
            margin:0;
            color:#4b5563;
            line-height:1.55;

            display:-webkit-box;
            -webkit-line-clamp: 2;            /* đổi 2-3 tuỳ ý */
            -webkit-box-orient: vertical;
            overflow:hidden;
            text-overflow:ellipsis;
            min-height: calc(1.55em * 2);     /* giữ chiều cao đều cho ô 1 dòng */
            word-wrap:break-word;
        }

        /* khiến khu social “đẩy” xuống đáy để các card bằng chiều cao */
        .contact-feature .th-social{ margin-top:auto; }
        .contact-feature .th-social a{ margin-right:10px; font-size:16px; }

        /* mobile tweak */
        @media (max-width: 575.98px){
            .contact-feature{ padding:14px; }
            .box-title{ font-size:15px; }
        }

    </style>
    <div class="space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-7">
                    <div class="title-area text-center"><h2 class="sec-title">Thông tin liên hệ</h2>

                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="contact-feature">
                        <div class="box-icon"><i class="fa-light fa-location-dot"></i></div>
                        <div class="media-body"><h3 class="box-title">Địa chỉ công ty</h3>
                            <p class="box-text" title="{{ $config->address_company }}">{{ $config->address_company }}</p></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="contact-feature">
                        <div class="box-icon"><i class="fa-light fa-phone"></i></div>
                        <div class="media-body"><h3 class="box-title">Số điện thoại</h3>
                            <p class="box-text"><a href="tel:+{{ $config->hotline }}">{{ $config->hotline }}</a>
                            </p></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="contact-feature">
                        <div class="box-icon"><i class="fa-light fa-envelope"></i></div>
                        <div class="media-body"><h3 class="box-title">Email</h3>
                            <p class="box-text"><a href="mailto:{{ $config->email }}">{{ $config->email }}</a></p></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="contact-feature">
                        <div class="media-body">
                            <h3 class="box-title">Follow Social Media</h3>
                            <div class="th-social">
                                <a target="_blank" href="{{ $config->facebook }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>

                                <a target="_blank" href="{{ $config->twitter }}">
                                    <i class="fab fa-twitter"></i>
                                </a>

                                <a target="_blank" href="{{ $config->instagram }}/">
                                    <i class="fab fa-instagram"></i>
                                </a>

                                <a target="_blank" href="{{ $config->youtube }}/">
                                    <i class="fab fa-youtube"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-bottom" ng-controller="AboutPage">
        <div class="container">
            <form id="form-contact"
                  class="contact-form input-smoke"><h2 class="sec-title">Để lại lời nhắn</h2>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Họ tên"> <i class="fal fa-user"></i>
                        <div class="invalid-feedback d-block" ng-if="errors['name']"><% errors['name'][0] %></div>
                    </div>


{{--                    <div class="form-group col-md-6"><input type="email" class="form-control" name="email" id="email"--}}
{{--                                                            placeholder="Email"> <i class="fal fa-envelope"></i>--}}
{{--                        <div class="invalid-feedback d-block" ng-if="errors['email1']"><% errors['email1'][0] %></div>--}}

{{--                    </div>--}}
                    <div class="form-group col-md-6"><input type="tel" class="form-control" name="phone" id="number"
                                                            placeholder="Số điện thoại"> <i class="fal fa-phone"></i>
                        <div class="invalid-feedback d-block" ng-if="errors['phone']"><% errors['phone'][0] %></div>

                    </div>

                    <div class="form-group col-12"><textarea name="message" id="message" cols="30" rows="3"
                                                             class="form-control" placeholder="Lời nhắn"></textarea>
                        <i
                            class="fal fa-pencil"></i>
                        <div class="invalid-feedback d-block" ng-if="errors['message']"><% errors['message'][0] %></div>

                    </div>
                    <div class="form-btn col-12">
                        <button class="th-btn btn-fw" ng-click="submitContact()">Gửi tin nhắn<i class="fas fa-chevrons-right ms-2"></i></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="space-bottom">
        <div class="contact-map">
           {!! $config->location !!}
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        app.controller('AboutPage', function ($rootScope, $scope, $sce, $interval) {
            $scope.errors = [];
            $scope.submitContact = function () {
                var url = "{{route('front.submitContact')}}";
                var data = jQuery('#form-contact').serialize();
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
                            jQuery('#form-contact')[0].reset();
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
@endpush
