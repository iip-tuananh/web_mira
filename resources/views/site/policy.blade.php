@extends('site.layouts.master')
@section('title'){{ $policy->title }} - {{ $config->web_title }}@endsection
@section('description'){{ strip_tags(html_entity_decode($config->introduction)) }}@endsection
@section('image'){{@$config->image->path ?? ''}}@endsection

@section('css')
    <link href="/site/assets/main.scssd27c.css?1739018973665" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/assets/breadcrumb_style.scssd27c.css?1739018973665" rel="stylesheet" type="text/css" media="all" />




    <link href="/site/assets/blog_article_style.scssd27c.css?1739018973665" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/assets/sidebar_style.scssd27c.css?1739018973665" rel="stylesheet" type="text/css" media="all" />



@endsection

@section('content')

    <div class="bodywrap">
        <section class="bread-crumb">
            <div class="container">
                <ul class="breadcrumb" >
                    <li class="home">
                        <a  href="{{ route('front.home-page') }}" title="Trang chủ"><span >Trang chủ</span></a>
                        <span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" class=""></path></svg>&nbsp;</span>
                    </li>

                    <li><strong><span >{{ $policy->title }}</span></strong></li>

                </ul>
            </div>
        </section>



        <section class="blogpage">
            <div class="container layout-article" itemscope itemtype="https://schema.org/Article">
                <div class="bg_blog">
                    <article class="article-main">
                        <div class="row">
                            <div class="right-content col-lg-9 col-12">
                                <div class="article-details bg-shadow clearfix">
                                    <h1 class="article-title">{{ $policy->title }}</h1>
                                    <div class="posts">
                                        <div class="time-post f">

                                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-clock fa-w-16"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm216 248c0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216zm-148.9 88.3l-81.2-59c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h14c6.6 0 12 5.4 12 12v146.3l70.5 51.3c5.4 3.9 6.5 11.4 2.6 16.8l-8.2 11.3c-3.9 5.3-11.4 6.5-16.8 2.6z" class=""></path></svg>

                                            {{ \Carbon\Carbon::parse($policy->created_at)->format('d/m/Y') }}
                                        </div>
                                        <div class="time-post">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-user fa-w-14"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z" class=""></path></svg>
                                            <span>Admin</span>
                                        </div>
                                    </div>



                                    <div class="rte article-content-main">
                                        {!! $policy->content !!}
                                    </div>



                                </div>

                            </div>
                            <div class="blog_left_base col-lg-3 col-12">
                                <div class="side-right-stick">
                                    <script>
                                        $(".aside-content-blog .nav-category .open_mnu").click(function(){
                                            $(this).toggleClass('cls_mn').next().slideToggle();
                                        });
                                    </script>
                                    <div class="blog_noibat">
                                        <h2 class="h2_sidebar_blog">
                                            <a href="#" title="Tin tức gần đây">Chính sách khác</a>
                                        </h2>
                                        <div class="blog_content">

                                            @foreach($policeis as $poli)
                                                <div class="item clearfix">

                                                    <div class="contentright">
                                                        <h3><a title="  {{ $poli->title }}"
                                                               href="{{ route('front.getPolicy', $poli->slug) }}">
                                                                {{ $poli->title }}
                                                            </a></h3>
                                                        <p class="time-post">
						<span>
							{{ \Carbon\Carbon::parse($poli->created_at)->format('d/m/Y') }}
						</span>
                                                        </p>
                                                    </div>
                                                </div>

                                            @endforeach



                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <script>
            var $heading2 = $('.article-content-main h2');
            $heading2.attr("id", function() {
                return $(this)
                    .text() // get the h1 text
                    .trim() // remove spaces from start and the end
                    .toLowerCase() // optional
                    .replace(/\s/g, '_'); // convert all spaces to underscores
            });
            var $heading3 = $('.article-content-main h3');
            $heading3.attr("id", function() {
                return $(this)
                    .text() // get the h1 text
                    .trim() // remove spaces from start and the end
                    .toLowerCase() // optional
                    .replace(/\s/g, '_'); // convert all spaces to underscores
            });

            $('.title-goto-wrapper').click(function() {
                $(this).find('.fa').toggleClass('fa-angle-up');
                $(this).find('.fa').toggleClass('fa-angle-down');
                $('.menu-toc').toggleClass('hidden');
            });
        </script>


        <div id="js-global-alert" class="alert alert-success" role="alert">
            <button type="button" class="close"><span aria-hidden="true"><span aria-hidden="true">&times;</span></span></button>
            <h5 class="alert-heading"></h5>
            <p class="alert-content"></p>
        </div>


























    </div>


@endsection

@push('scripts')
    <script>
    </script>
@endpush
