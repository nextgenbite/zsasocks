
    <div class="product-inner ">
        <div class="product-top">
            <div class="flash">
                <span class="onnew">
                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price) * 100;
                    @endphp

                      <div>
                        @if ($product->discount_price == NULL)
                         <span class="text">new</span>
                        @else
                         <span class="text">{{ round($discount) }}%</span>
                        @endif
                      </div>
                </span>
            </div>
        </div>
        <div class="product-thumb">
            <div class="thumb-inner">
                <a href="{{url('product/'.$product->slug)}}">
                    <img src="{{asset($product->product_image)}}" alt="img">
                </a>
            </div>
        </div>
        <div class="product-info">
            <h5 class="product-name product_title">
                <a class="text-truncate" href="{{url('product/'.$product->slug)}}">{{$product->product_name}}</a>
            </h5>
            <h6> Model: {{$product->slug}}</h6>
            <div class="group-info">
                <div class="price">
                    <div class="product-price">
                        @if ($product->discount_price == NULL)
                        <span class="price" id="productPrice"> ৳ {{round($product->selling_price)}} </span>

                             @else
                             <span class="price" id="productPrice"> ৳ {{ round($product->discount_price) }} </span>
                             <del class="price-before-discount">৳ {{round($product->selling_price)}}</del>

                             @endif
        </div>
                </div>
                <div class="loop-form-add-to-cart">
                    {{-- <button class="single_add_to_cart_button button" id="{{$product->id}}" onclick="buyNow(this.id)">অর্ডার করুন</button> --}}
                    <a href="{{url('product_details/'.$product->id)}}" class="single_add_to_cart_button button">বিস্তারিত দেখুন</a>
                </div>
            </div>
        </div>
        </div>
