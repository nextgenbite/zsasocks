<div class="keyword">
    {{-- <div class="title">Popular Suggestions</div>
    <ul>
        <li><a href="/search?q=two">two</a></li>
        <li><a href="/search?q=%20pant"> pant</a></li>
        <li><a href="/search?q=pant">pant</a></li>
    </ul>
</div>
<div class="category">
    <div class="title">Category Suggestions</div>
    <ul>
        <li><a href="/search?subsubcategory=Additives">Additives</a></li>
        <li><a href="/search?subsubcategory=Transmission-Fluids">Transmission Fluids</a></li>
        <li><a href="/search?subsubcategory=Trucks">Trucks</a></li>
    </ul>
</div> --}}
<div class="product">
    {{-- <div class="title">Products</div> --}}
    <ul>
        @foreach($products as $product)
      
        <li>
            <a href="{{ url('product/' . $product->slug) }}">
                <div class="d-flex search-product align-items-center">
                    <div class="image"
                        style="background-image:url('{{$product->product_image ? asset($product->product_image) : ''}}');">
                    </div>
                    <div class="w-100 overflow--hidden">
                        <div class="product-name text-truncate">
                            {{ $product->product_name }}
                        </div>
                        <div class="clearfix">
                            <div class="price-box float-left">
                                @if ($product->discount_price)
                                    
                                <del class="old-product-price strong-400">Tk{{round($product->selling_price)}}</del>
                                @endif
                                <span class="product-price strong-600">Tk{{round($product->discount_price ?: $product->selling_price)}}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
  
    </ul>
</div>

