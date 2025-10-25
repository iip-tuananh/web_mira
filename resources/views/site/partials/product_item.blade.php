<style>
    /* Giới hạn 2 dòng cho tên sản phẩm */
    .product-title-item {
        margin: 6px 0 8px;
        font-size: 16px; /* tùy theme */
        line-height: 1.4; /* quan trọng để tính chiều cao */
    }

    .product-title-item a {
        display: -webkit-box; /* clamp chuẩn WebKit */
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;

        /* Fallback cho trình duyệt không hỗ trợ -webkit-line-clamp */
        display: block; /* vẫn cần block để max-height hoạt động */
        max-height: calc(1.4em * 2); /* 2 dòng * line-height */
        min-height: calc(1.4em * 2); /* đảm bảo item 1 dòng vẫn cao bằng 2 dòng */
        white-space: normal;
        word-wrap: break-word;
    }

    /* (khuyến nghị) để card cao đều khi có nhiều phần bên dưới */
    .product-content {
        display: flex;
        flex-direction: column;
    }

    .product-content .price,
    .product-content .woocommerce-product-rating {
        margin-top: 6px;
    }

    @media (max-width: 575.98px) {
        .product-title-item {
            font-size: 15px;
        }
    }

</style>
<div class="th-product product-grid">
    @php
        $types = $product->types ?? collect();
        $hasTypes = $types->count() > 0;

        if ($hasTypes) {
            $first = $types->first();
            $initPrice = (int) $first->price;
            $initBase  = (int) $first->base_price;
        } else {
            $initPrice = (int) $product->price;
            $initBase  = (int) $product->base_price;
        }

        $save = ($initBase > $initPrice && $initPrice > 0) ? max(0, round((1 - ($initPrice/$initBase))*100)) : 0;

    @endphp

    <div class="product-img">
        <img src="{{ $product->image->path ?? '' }}" alt="Product Image">
        @if($initBase > $initPrice)
            <span class="product-tag">Sale</span>
        @endif
        <div class="actions">
            <a href="javascript:void(0)" class="icon-btn" ng-click="addToCart({{ $product->id }}, 1)"><i
                    class="far fa-cart-plus"></i></a>
        </div>
    </div>
    <div class="product-content"><a href="{{ route('front.getProductDetail', $product->slug) }}"
                                    class="product-category">{{ $product->category->name ?? '' }}</a>
        <h3 class="product-title product-title-item"><a
                href="{{ route('front.getProductDetail', $product->slug) }}">{{ $product->name }}</a></h3>

            @if($initPrice > 0)
            <span class="price">
            {{ formatCurrency($initPrice) }}đ
                @if($initBase > $initPrice)
                    <del> {{ formatCurrency($initBase) }}đ</del>
                @endif
             </span>
            @else
                <span class="price">Liên hệ</span>
            @endif







        <div class="woocommerce-product-rating">
            <div class="star-rating" role="img"
                 aria-label="Rated 5.00 out of 5"><span>Rated <strong
                        class="rating">5.00</strong> out of 5 based on <span
                        class="rating">1</span> customer rating</span>
            </div>
        </div>
    </div>
</div>
