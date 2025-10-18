@extends('site.layouts.master')
@section('title')Tin tức - {{ $config->web_title }}@endsection
@section('description'){{ strip_tags(html_entity_decode($config->introduction)) }}@endsection
@section('image'){{@$config->image->path ?? ''}}@endsection

@section('css')

@endsection


@section('content')
    @php
        $banner = @$category->image->path ?? '/site/assets/img/bg/breadcumb-bg.jpg';
    @endphp
    <div class="breadcumb-wrapper" data-bg-src="{{ $banner }}">
        <div class="container">
            <div class="breadcumb-content"><h1 class="breadcumb-title">{{ $category ? $category->name : 'Tin tức' }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                    <li>{{ $category ? $category->name : 'Tin tức' }}</li>
                </ul>
            </div>
        </div>
    </div>
    <style>
        /* ====== BLOG GRID (2 COLS DESKTOP, 1 COL MOBILE) ====== */
        .blog-grid{
            display:grid;
            grid-template-columns:repeat(2, minmax(0,1fr));
            gap:28px;
        }

        @media (max-width: 767.98px){
            .blog-grid{ grid-template-columns:1fr; gap:20px; }
        }

        /* ====== CARD ====== */
        .blog-card{
            background:#fff;
            border:1px solid rgba(0,0,0,.08);
            border-radius:16px;
            overflow:hidden;
            display:flex;
            flex-direction:column;
            transition:transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }
        .blog-card:hover{
            transform:translateY(-2px);
            box-shadow:0 12px 28px rgba(0,0,0,.10);
            border-color:rgba(0,0,0,.12);
        }

        /* ====== THUMB ====== */
        .blog-card__thumb{
            display:block;
            position:relative;
            isolation:isolate;
        }
        .blog-card__thumb img{
            width:100%;
            height:auto;
            display:block;
            aspect-ratio: 16 / 9;        /* Giữ tỷ lệ ảnh gọn gàng */
            object-fit:cover;
            transition:transform .35s ease;
        }
        .blog-card:hover .blog-card__thumb img{
            transform:scale(1.04);
        }

        /* ====== BODY ====== */
        .blog-card__body{
            padding:18px 18px 16px;
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .blog-card__title{
            font-size: clamp(18px, 1.9vw, 20px);
            line-height:1.35;
            margin:0;
            font-weight:700;
        }
        .blog-card__title a{
            color:inherit;
            text-decoration:none;
        }
        .blog-card__title a:hover{
            text-decoration:underline;
        }

        /* ====== META ====== */
        .blog-card__meta{
            display:flex;
            align-items:center;
            flex-wrap:wrap;
            gap:8px;
            list-style:none;
            padding:0;
            margin:0;
            color:#6b7280;               /* gray-500 */
            font-size:13px;
        }
        .blog-card__meta .meta-item i{ margin-right:6px; }
        .blog-card__meta .meta-sep{ opacity:.6; }

        /* ====== EXCERPT (LINE CLAMP) ====== */
        .blog-card__excerpt{
            margin:2px 0 6px;
            color:#374151;               /* gray-700 */
            font-size:15px;
            line-height:1.6;
            display:-webkit-box;
            -webkit-line-clamp:3;        /* đổi 2-4 tùy nhu cầu */
            -webkit-box-orient:vertical;
            overflow:hidden;
            text-overflow:ellipsis;
            min-height: calc(1em * 1.6 * 3); /* giữ chiều cao đều khi clamp */
            word-wrap: break-word;
        }

        /* ====== READ MORE ====== */
        .blog-card__more{
            margin-top:auto;
            display:inline-flex;
            align-items:center;
            gap:8px;
            font-weight:600;
            font-size:14px;
            text-decoration:none;
            color:#0ea5e9;               /* sky-500 */
        }
        .blog-card__more:hover{ color:#0284c7; } /* sky-600 */

        /* Optional: tinh chỉnh pagination mặc định của Laravel */
        .th-pagination nav{ display:inline-block; }
        .th-pagination .pagination{ gap:8px; }
        .th-pagination .page-link{
            border-radius:10px !important;
        }

    </style>
    <section class="th-blog-wrapper space-top space-extra-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-lg-7">
                    <div class="blog-grid">
                        @foreach($blogs as $blog)
                            <article class="blog-card">
                                <a class="blog-card__thumb" href="{{ route('front.blogDetail', $blog->slug) }}" aria-label="{{ $blog->name }}">
                                    <img
                                        src="{{ $blog->image->path ?? 'https://picsum.photos/seed/blog/800/500' }}"
                                        alt="{{ $blog->name }}"
                                        loading="lazy">
                                </a>

                                <div class="blog-card__body">
                                    <h3 class="blog-card__title">
                                        <a href="{{ route('front.blogDetail', $blog->slug) }}">{{ $blog->name }}</a>
                                    </h3>

                                    <ul class="blog-card__meta">
                                        <li class="meta-item author">
                                            <i class="far fa-user" aria-hidden="true"></i>
                                            {{ $blog->author->name ?? 'Admin' }}
                                        </li>
                                        <li class="meta-sep" aria-hidden="true">•</li>
                                        <li class="meta-item date">
                                            <i class="far fa-calendar" aria-hidden="true"></i>
                                            {{ \Illuminate\Support\Carbon::parse($blog->created_at)->format('d/m/Y') }}
                                        </li>
                                    </ul>

                                    <p class="blog-card__excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->intro ?? ''), 220) }}
                                    </p>

                                    <a class="blog-card__more" href="{{ route('front.blogDetail', $blog->slug) }}">
                                        Đọc tiếp
                                        <i class="fas fa-chevrons-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>


                    {{ $blogs->links('site.pagination.paginate2') }}


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
