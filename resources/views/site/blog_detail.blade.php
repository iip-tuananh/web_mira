@extends('site.layouts.master')
@section('title'){{ $blog->name }} - {{ $config->web_title }}@endsection
@section('description'){{ strip_tags(html_entity_decode($config->introduction)) }}@endsection
@section('image'){{@$config->image->path ?? ''}}@endsection

@section('css')

@endsection

@section('content')

    <div class="breadcumb-wrapper" data-bg-src="">
        <div class="container">
            <div class="breadcumb-content"><h1 class="breadcumb-title">{{ $blog->name }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                    <li>Tin tức</li>
                    <li>{{ $blog->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="th-blog-wrapper blog-details space-top space-extra-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-lg-7">
                    <div class="th-blog blog-single">
                        <div class="blog-content">
                            <div class="blog-meta"><a class="author" href="blog.html"><i class="far fa-user"></i>By
                                    Admin</a> <a href="blog.html"><i class="far fa-calendar"></i> {{ \Illuminate\Support\Carbon::parse($blog->created_at)->format('d/m/Y') }}</a> </div>
                            <h2 class="blog-title">{{ $blog->name }}</h2>

                            {!! $blog->body !!}


                            <div class="share-links clearfix">
                                <div class="row justify-content-between">
                                    <div class="col-sm-auto text-xl-end"><span class="share-links-title">Chia sẻ:</span>
                                        <div class="th-social"><a href="https://facebook.com/" target="_blank"><i
                                                    class="fab fa-facebook-f"></i></a> <a href="https://twitter.com/"
                                                                                          target="_blank"><i
                                                    class="fab fa-twitter"></i></a> <a href="https://linkedin.com/"
                                                                                       target="_blank"><i
                                                    class="fab fa-linkedin-in"></i></a> <a href="https://instagram.com/"
                                                                                           target="_blank"><i
                                                    class="fab fa-instagram"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">

                        <div class="widget widget_categories"><h3 class="widget_title">Danh mục</h3>
                            <ul>
                                @foreach($categories as $cate)
                                    <li><a href="{{ route('front.blogs', $cate->slug) }}">{{ $cate->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="widget"><h3 class="widget_title">Bài viết khác</h3>
                            <div class="recent-post-wrap">
                                @foreach($othersBlog as $otherBlog)
                                    <div class="recent-post">
                                        <div class="media-img"><a href="{{ route('front.blogDetail', $otherBlog->slug) }}"><img
                                                    src="{{ $otherBlog->image->path ?? '' }}" alt="Blog Image"></a></div>
                                        <div class="media-body"><h4 class="post-title"><a class="text-inherit"
                                                                                          href="{{ route('front.blogDetail', $otherBlog->slug) }}">{{ $otherBlog->name }}</a></h4>
                                            <div class="recent-post-meta"><a href="{{ route('front.blogDetail', $otherBlog->slug) }}"><i class="far fa-calendar"></i> {{ \Illuminate\Support\Carbon::parse($otherBlog->created_at)->format('d/m/Y') }}</a></div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts')
    <script>
    </script>
@endpush
