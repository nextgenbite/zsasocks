@php
    $amount = $product->selling_price - $product->discount_price;
    $discount = ($amount / $product->selling_price) * 100;
@endphp



<div class="caorusel-card mb-1 ">
    <div class="product-card-2 card card-product shop-cards shop-tech product-hover">
        <div class="card-body p-0">


            <div class="card-image">
                <a href="{{ url('product/' . $product->slug) }}" class="d-block">
                    <img class="img-fit lazyload mx-auto" src="{{ asset('placeholder.jpg') }}"
                        data-src="{{ $product->product_image ? asset($product->product_image) : '' }}"
                        alt="{{ $product->product_name }}" style="max-width: 100%; height: auto;">
                </a>
            </div>


            <div class="p-md-3 p-2">
                <h2 class="product-title p-0 text-truncate">
                    <a href="{{ url('product/' . $product->slug) }}">{{ $product->product_name }}</a>
                </h2>
                @if ($product->sku)
                    <p class="text-info"> Model: {{ $product->sku }}</p>
                @endif
                <div class="price-box">
                    @if ($product->discount_price == null)
                        <span class="product-price strong-600">Tk{{ round($product->selling_price) }}</span>
                    @else
                        <del class="old-product-price strong-400">Tk{{ round($product->selling_price) }}</del>
                        <span class="product-price strong-600">Tk{{ round($product->discount_price) }}</span>
                    @endif
                </div>


            </div>
        </div>
    </div>
</div>
