@extends('frontend.layouts.app')
@section('title', $product->product_name)
@push('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $product->product_name }}">
    <meta itemprop="description" content="{{ $product->short_descp_en }}">
    <meta itemprop="image" content="{{ $product->product_image ? asset($product->product_image) : '' }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $product->product_name }}">
    <meta name="twitter:description" content="{{ $product->short_descp_en }}">
    <meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{ $product->product_image ? asset($product->product_image) : '' }}">
<meta name="twitter:data1" content="{{ $product->discount_price ?: $product->selling_price }}">
<meta name="twitter:label1" content="Price">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $product->product_name }}" />
<meta property="og:type" content="product" />
<meta property="og:url" content="{{ url('/product', $product->slug) }}" />
<meta property="og:image" content="{{ $product->product_image ? asset($product->product_image) : '' }}" />
<meta property="og:description" content="{{ $product->short_descp_en }}" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:price:amount" content="{{ $product->discount_price ?: $product->selling_price }}" />
<meta property="product:brand" content="{{ $product->brand ? $product->brand->name : config('app.name') }}">
<meta property="product:availability" content="{{ $product->product_qty > 0 ? 'in stock' : 'out of stock' }}">
<meta property="product:condition" content="new">
<meta property="product:price:amount" content="{{ $product->discount_price ?: $product->selling_price }}">
<meta property="product:retailer_item_id" content="{{ $product->slug }}">
<meta property="product:price:currency" content="TK" />

<meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}"> 
@endpush
@push('css')
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <!-- Fancybox CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endpush
@section('content')
<style>
.btn-circle.btn-sm { 
width: 30px; 
height: 30px; 
padding: 6px 0px; 
border-radius: 15px; 
text-align: center; 
background-color: #fff;
} 

.owl-theme .owl-nav {
    /*default owl-theme theme reset .disabled:hover links */
    [class*='owl-'] {
      transition: all .3s ease;
      &.disabled:hover {
       background-color: #D6D6D6;
      }   
    }

}

.owl-theme {
  position: relative;


}


.owl-theme  .owl-next, .owl-prev {
    width: 2rem;
    height: 2rem;
    margin-top: -30px;
    position: absolute;
    top: 50%;
    border-radius: 50% !important;
    transform: translate(-50%,-50%);
    

  }
  .owl-theme  .owl-next:hover, .owl-prev:hover{
    background: var(--primary) !important;
  }
  .owl-theme .owl-prev {
    left: 10px;
  }
  .owl-theme .owl-next {
    right: 10px;
  }
  .gallery .item iframe {
        height: 26rem !important; /* Adjust height as necessary */
        /* object-fit: cover; This will ensure the image covers the entire area */
    }
    .gallery #main-carousel .item {
        position: relative;
    }
    .gallery #main-carousel .item iframe {
        width: 100%;
    }
</style>
<!-- MAIN WRAPPER -->
<div class="body-wrap shop-default shop-cards shop-tech gry-bg">


<div class="breadcrumb-area">
<div class="container">

<div class="row">
<div class="col">
<ul class="breadcrumb">
<li><a href="{{ url('/') }}">Home</a></li>


<li><a
href="{{ url('category/' . $product->category->slug) }}">{{ $product->category->category_name }}</a>
</li>

<li class="active text-truncate">{{ $product->product_name }}
</li>
</ul>
</div>
</div>
</div>
</div>
<!-- SHOP GRID WRAPPER -->
<section class="product-details-area gry-bg">
<div class="container">

<div class="bg-white">

<!-- Product gallery and Description -->
<div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
<div class="col-lg-6 mb-1">

    
    <div class="gallery mx-lg-3 mt-2 px-2">
        <div id="main-carousel" class="owl-carousel owl-theme">
            @if (isset($product->video))
            <div class="item  center-block active "
                id="vid-1">
                <iframe id="player" type="text/html" height="10000"  class="embed-responsive-item" 
                    src="https://www.youtube.com/embed/{{ $product->video }}"
                    allowfullscreen></iframe>
            </div>
        @endif
                           @foreach ($product->images as $image)
            <div class="item">
                <a href="{{  asset($image->path ?? 'placeholder.jpg') }}" data-fancybox="gallery"><img src="{{  asset($image->path ?? 'placeholder.jpg') }}" data-src="{{  asset($image->path ?? 'placeholder.jpg') }}" alt="Image 1"   class="zoom img-fluid rounded lazyload"></a>
            </div>
                
            
            @endforeach
            <!-- Add more items as needed -->
        </div>
        <div id="thumbnail-carousel" class="owl-carousel owl-theme mt-2">
    
            @if (isset($product->video))
            <div class="item thumbnail">
                <img src="{{ asset('images/playbutton.png') }}" style="width: 4rem"  class="img-fluid rounded "  >   
            </div>
    @endif
            @foreach ($product->images as $image)
            <div class="item thumbnail">
                <img src="{{ asset('placeholder.jpg') }}" style="width: 4rem" data-src="{{  asset($image->path ?? 'placeholder.jpg') }}" class="img-fluid rounded lazyload" alt="Image 1">
            </div>
            @endforeach
        </div>
    </div>
{{-- <div class="product-gal sticky-top d-flex flex-row-reverse ">

<div class="product-gal-img">
<img src="{{ asset('placeholder.jpg') }}"
class="xzoom img-fluid lazyload"
data-src="{{ $product->images()->first()->path ? asset($product->images()->first()->path) : '' }}"
xoriginal="{{ $product->images()->first()->path ? asset($product->images()->first()->path) : '' }}"
style="width: 413px;">


</div>

<div class="product-gal-thumb d-lg-block ">
<div class="xzoom-thumbs">
<!-- Button trigger modal -->
@if (isset($product->video))
<img src="{{ asset('images/playbutton.png') }}"  width="50" width="60" class="p-1" data-toggle="modal" data-target="#Video">   
@endif
@foreach ($product->images()->limit(6)->get() as $image)
<a href="{{ $image->path ? asset($image->path) : '' }}">
<img src="{{ asset('placeholder.jpg') }}"
class="xzoom-gallery lazyload" width="80"
data-src="{{ $image->path ? asset($image->path) : '' }}"
xpreview="{{ $image->path ? asset($image->path) : '' }}">
</a>
@endforeach

</div>
</div>



</div> --}}
</div>

<div class="col-lg-6 mb-1">
<!-- Product description -->
<div class="product-description-wrapper">
<!-- Product title -->
<h1 class="product-title mb-2">
{{ $product->product_name }}
</h1>

{{-- <div class="row align-items-center my-1">
<div class="col-6">
<!-- Rating stars -->
<div class="rating">
<span class="star-rating">
<i class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i>
</span>
<span class="rating-count ml-1">(0 reviews)</span>
</div>
</div>
<div class="col-6 text-right">
<ul class="inline-links inline-links--style-1">
<li>
<span class="badge badge-md badge-pill bg-green">In stock</span>
</li>
</ul>
</div>
</div> --}}

@if ($product->sku)
<hr>
<div class="row no-gutters mt-4">
<div class="col-2">
<div class="product-description-label">Model:</div>
</div>
<div class="col-10">
<div class="product-price-old">
{{ $product->sku }}
</div>
</div>
</div>
@endif
{{-- 
<hr>

<div class="row align-items-center">
<div class="sold-by col-auto">
<small class="mr-2">Sold by: </small><br>
Inhouse product
</div>
</div> --}}

@if ($product->discount_price)
<hr>

<div class="row no-gutters mt-4">
<div class="col-2">
<div class="product-description-label">Price:</div>
</div>
<div class="col-10">
<div class="product-price-old">
<del>
Tk {{ $product->selling_price }}
<span>/1pc</span>
</del>
</div>
</div>
</div>
@else
@endif

<div class="row no-gutters mt-3">
<div class="col-3">
<div class="product-description-label mt-1">{{ $product->discount_price !== null ? 'Discount' : '' }} Price:</div>
</div>
<div class="col-9">
<div class="product-price">
<strong>
Tk {{ $product->discount_price ?: $product->selling_price }}
</strong>
<span class="piece">/1pc</span>
</div>
</div>
</div>



<hr>

<form id="option-choice-form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="id" value="{{ $product->id }}">


<div class="row no-gutters">
<div class="col-2">
<div class="product-description-label mt-2 ">Size:</div>
</div>
<div class="col-10">
<ul
class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
@foreach (json_decode($product->size) as $key => $size)
<li>
<input type="radio" id="1-{{ $size }}" name="size"
value="{{ $size }}" >
<label for="1-{{ $size }}">{{ $size }}</label>
</li>
@endforeach

</ul>
</div>
</div>
<div class="row no-gutters">
<div class="col-2">
<div class="product-description-label mt-2 ">Color:</div>
</div>
<div class="col-10">
<ul
class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
@foreach (json_decode($product->color) as $key => $color)
<li>
<input type="radio" id="1-{{ $color }}" name="color"
value="{{ $color }}">
<label for="1-{{ $color }}">{{ $color }}</label>
</li>
@endforeach

</ul>
</div>
</div>


{{-- <div class="row no-gutters">
<div class="col-2">
<div class="product-description-label mt-2">Color:</div>
</div>
<div class="col-10">
<ul class="list-inline checkbox-color mb-1">
<li>
<input type="radio" id="204-color-0" name="color"
value="#0000FF" checked="">
<label style="background: #0000FF;" for="204-color-0"
data-toggle="tooltip" data-original-title=""
title=""></label>
</li>
<li>
<input type="radio" id="204-color-1" name="color"
value="#00008B">
<label style="background: #00008B;" for="204-color-1"
data-toggle="tooltip" data-original-title=""
title=""></label>
</li>
<li>
<input type="radio" id="204-color-2" name="color"
value="#A9A9A9">
<label style="background: #A9A9A9;" for="204-color-2"
data-toggle="tooltip" data-original-title=""
title=""></label>
</li>
</ul>
</div>
</div> --}}

<hr>

<!-- Quantity + Add to cart -->
<div class="row no-gutters">
<div class="col-2">
<div class="product-description-label mt-2">Quantity:</div>
</div>
<div class="col-10">
<div class="product-quantity d-flex align-items-center">
<div class="input-group input-group--style-2 pr-3" style="width: 160px;">
<span class="input-group-btn">
<button class="btn btn-number" type="button" data-type="minus"
data-field="quantity" disabled="disabled">
<i class="la la-minus"></i>
</button>
</span>
<input type="text" name="quantity"
class="form-control input-number text-center" placeholder="1"
value="1" min="1" max="{{ $product->product_qty }}">
<span class="input-group-btn">
<button class="btn btn-number" type="button" data-type="plus"
data-field="quantity">
<i class="la la-plus"></i>
</button>
</span>
</div>
<div class="avialable-amount">(<span id="available-quantity">{{ $product->product_qty }}</span>
available)</div>
</div>
</div>
</div>


</form>

<div class="d-table width-100 mt-3">

<div class="d-table-cell">
  @if($product->product_qty > 0)
<!-- Buy Now button -->
<button type="button"
class="btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now"
id="{{ $product->id }}"  onclick="buyNow(this.id)">
<i class="la la-shopping-cart"></i> Buy Now
</button>
<button type="button"
class="btn btn-styled btn-outline-primary  btn-icon-left strong-700 hov-bounce hov-shaddow ml-2 add-to-cart"
id="{{ $product->id }}" onclick="addToCart(this.id)">
<i class="la la-shopping-cart"></i>
<span class=" d-md-inline-block"> Add to cart</span>
</button>
@else
<button type="button"
class="btn btn-outline-danger strong-700 hov-bounce hov-shaddow disabled">
 Stock Out
</button>
@endif
</div>

</div>



{{-- <div class="d-table width-100 mt-3">
<div class="d-table-cell">
<!-- Add to wishlist button -->
<button type="button" class="btn pl-0 btn-link strong-700"
onclick="addToWishList(101)">
Save Item
</button>
<!-- Add to compare button -->
<button type="button" class="btn btn-link btn-icon-left strong-700"
onclick="addToCompare(101)">
Add to compare
</button>
</div>
</div> --}}




<hr class="mt-4">
{{-- <div class="row no-gutters mt-4">
<div class="col-2">
<div class="product-description-label mt-2">Share:</div>
</div>
<div class="col-10">
<div id="share" class="jssocials">
<div class="jssocials-shares">
<div class="jssocials-share jssocials-share-email"><a target="_self"
href="mailto:?&amp;body=https%3A%2F%2Fqbdbox.com%2Fproduct%2FNima-Grinder-9HpIM"
class="jssocials-share-link"><i
class="fa fa-at jssocials-share-logo"></i></a></div>
<div class="jssocials-share jssocials-share-twitter"><a target="_blank"
href="https://twitter.com/share?url=https%3A%2F%2Fqbdbox.com%2Fproduct%2FNima-Grinder-9HpIM"
class="jssocials-share-link"><i
class="fa fa-twitter jssocials-share-logo"></i></a></div>
<div class="jssocials-share jssocials-share-facebook"><a target="_blank"
href="https://facebook.com/sharer/sharer.php?u=https%3A%2F%2Fqbdbox.com%2Fproduct%2FNima-Grinder-9HpIM"
class="jssocials-share-link"><i
class="fa fa-facebook jssocials-share-logo"></i></a></div>
<div class="jssocials-share jssocials-share-linkedin"><a target="_blank"
href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https%3A%2F%2Fqbdbox.com%2Fproduct%2FNima-Grinder-9HpIM"
class="jssocials-share-link"><i
class="fa fa-linkedin jssocials-share-logo"></i></a></div>
<div class="jssocials-share jssocials-share-pinterest"><a target="_blank"
href="https://pinterest.com/pin/create/bookmarklet/?&amp;url=https%3A%2F%2Fqbdbox.com%2Fproduct%2FNima-Grinder-9HpIM"
class="jssocials-share-link"><i
class="fa fa-pinterest jssocials-share-logo"></i></a></div>
<div class="jssocials-share jssocials-share-stumbleupon"><a
target="_blank"
href="http://www.stumbleupon.com/submit?url=https%3A%2F%2Fqbdbox.com%2Fproduct%2FNima-Grinder-9HpIM"
class="jssocials-share-link"><i
class="fa fa-stumbleupon jssocials-share-logo"></i></a></div>
<div class="jssocials-share jssocials-share-whatsapp"><a target="_self"
href="whatsapp://send?text=https%3A%2F%2Fqbdbox.com%2Fproduct%2FNima-Grinder-9HpIM"
class="jssocials-share-link"><i
class="fa fa-whatsapp jssocials-share-logo"></i></a></div>
</div>
</div>
</div>
</div> --}}
</div>
</div>
{{--  <div class="col-lg-3 pl-2 d-none d-lg-block">
<div class="row no-gutters mt-3 ">
<div class="col-1">
<i class="fa fa-phone" aria-hidden="true"
style="font-size: 18px;color: #8a8686;"></i>
</div>
<div class="col-5">
<div class="product-description-label">
Call:</div>
</div>
<div class="col-6">
<a href="tel:{{ $settings['phone'] ?? '' }}" target="_blank">
{{ $settings['phone'] ?? '' }}
</a>
</div>
</div>
<div class="row no-gutters mt-3">
<div class="col-1">
<i class="fa fa-plane" aria-hidden="true"
style="font-size: 18px;color: #8a8686;"></i>
</div>
<div class="col-5">
<div class="product-description-label">

Outside Dhaka:</div>
</div>
<div class="col-6">
3-4 working days
</div>
</div>
<div class="row no-gutters mt-3">
<div class="col-1">
<i class="fa fa-truck" aria-hidden="true"
style="font-size: 18px;color: #8a8686;"></i>
</div>
<div class="col-5">
<div class="product-description-label">

Inside Dhaka:</div>
</div>
<div class="col-6">
1-2 working days

</div>
</div>
<div class="row no-gutters mt-3">
<div class="col-1">
<i class="fa fa-money" aria-hidden="true"
style="font-size: 18px;color: #8a8686;"></i>
<span> </span>
</div>

<div class="col-5">
<div class="product-description-label">

Cash on Delivery :</div>
</div>
<div class="col-6">
Available
</div>

</div>



<div class="row no-gutters mt-3">
<div class="col-2">
<div class="product-description-label">Refund:</div>
</div>
<div class="col-10">
<a href="https://qbdbox.com/returnpolicy" target="_blank"> <img
src="./product_details_files/refund-sticker.jpg" height="36"> </a>
<a href="https://qbdbox.com/returnpolicy" class="ml-2" target="_blank">View
Policy</a>
</div>
</div>=
<div class="row no-gutters mt-3">
<div class="col-2">
<div class="product-description-label alpha-6">Payment:</div>
</div>
<div class="col-10">
<ul class="inline-links">
<li>
<img src="./product_details_files/visa.png"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/visa.png"
width="30" class=" ls-is-cached lazyloaded">
</li>
<li>
<img src="./product_details_files/mastercard.png"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/mastercard.png"
width="30" class=" ls-is-cached lazyloaded">
</li>
<li>
<img src="./product_details_files/maestro.png"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/maestro.png"
width="30" class=" ls-is-cached lazyloaded">
</li>
<li>
<img src="./product_details_files/paypal.png"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/paypal.png"
width="30" class=" lazyloaded">
</li>
<li>
<img src="./product_details_files/cod.png"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/cod.png"
width="30" class=" ls-is-cached lazyloaded">
</li>
</ul>
</div>
</div>
<div class="row no-gutters mt-3">
<div class="box-title"
style="padding: 5px;font-size: 18px;background: #ddd;width: 100%;margin-bottom: 5px;">
Recently viewed products
</div>

<div class="mb-3 product-box-3">
<div class="clearfix">
<div class="product-image float-left">
<a href="https://qbdbox.com/product/Nima-Grinder-9HpIM">
<img class="img-fit ls-is-cached lazyloaded"
src="./product_details_files/v951a84aNtDYtZPp7DL2i9xShTbEGBjX2lsYnp7n.jpeg"
data-src="https://qbdbox.com/public/uploads/products/featured/v951a84aNtDYtZPp7DL2i9xShTbEGBjX2lsYnp7n.jpeg"
alt="Nima Grinder">
</a>
</div>
<div class="product-details float-left">
<h4 class="title text-truncate">
<a href="https://qbdbox.com/product/Nima-Grinder-9HpIM"
class="d-block">Nima Grinder</a>
</h4>
<div class="star-rating star-rating-sm mt-1">
<i class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i>
</div>
<div class="price-box">
<!--  -->
<span class="product-price strong-600">Tk700</span>
</div>
</div>
</div>
</div>

</div> 

</div> --}}


</div>
</div>
</div>
</section>

<section class="gry-bg">
<div class="container">
<div class="row">
{{-- <div class="col-xl-3 d-block d-xl-block">
<div class="seller-info-box mb-3">
<div class="sold-by position-relative">
<div class="title">Sold By</div>
Nobabi E-Shop

<div class="rating text-center d-block">
<span class="star-rating star-rating-sm d-block">
<i class="fa fa-star active"></i><i class="fa fa-star active"></i><i
class="fa fa-star active"></i><i class="fa fa-star active"></i><i
class="fa fa-star"></i>
</span>
<span class="rating-count d-block ml-0">(1 customer reviews)</span>
</div>
</div>
<div class="row no-gutters align-items-center">
</div>
</div>
<div class="seller-top-products-box bg-white sidebar-box mb-3  d-none d-lg-block">
<div class="box-title">
Top Selling Products From This Seller
</div>
<div class="box-content">
<div class="mb-3 product-box-3">
<div class="clearfix">
<div class="product-image float-left">
<a href="https://qbdbox.com/product/Baby-Bouncer-QLUrP">
<img class="img-fit lazyloaded"
src="./product_details_files/56v4QWJuRjGQ3ULqcA5tBWtqHMAj1WWNf3jNKhVI.jpeg"
data-src="https://qbdbox.com/public/uploads/products/featured/56v4QWJuRjGQ3ULqcA5tBWtqHMAj1WWNf3jNKhVI.jpeg"
alt="Baby Bouncer">
</a>
</div>
<div class="product-details float-left">
<h4 class="title text-truncate">
<a href="https://qbdbox.com/product/Baby-Bouncer-QLUrP"
class="d-block">Baby Bouncer</a>
</h4>
<div class="star-rating star-rating-sm mt-1">
<i class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i>
</div>
<div class="price-box">
<!--  -->
<span class="product-price strong-600">Tk1,500</span>
</div>
</div>
</div>
</div>
<div class="mb-3 product-box-3">
<div class="clearfix">
<div class="product-image float-left">
<a href="https://qbdbox.com/product/Nima-Grinder-9HpIM">
<img class="img-fit ls-is-cached lazyloaded"
src="./product_details_files/v951a84aNtDYtZPp7DL2i9xShTbEGBjX2lsYnp7n.jpeg"
data-src="https://qbdbox.com/public/uploads/products/featured/v951a84aNtDYtZPp7DL2i9xShTbEGBjX2lsYnp7n.jpeg"
alt="Nima Grinder">
</a>
</div>
<div class="product-details float-left">
<h4 class="title text-truncate">
<a href="https://qbdbox.com/product/Nima-Grinder-9HpIM"
class="d-block">Nima Grinder</a>
</h4>
<div class="star-rating star-rating-sm mt-1">
<i class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i>
</div>
<div class="price-box">
<!--  -->
<span class="product-price strong-600">Tk700</span>
</div>
</div>
</div>
</div>
<div class="mb-3 product-box-3">
<div class="clearfix">
<div class="product-image float-left">
<a href="https://qbdbox.com/product/Capsule-Cutter-TRqhq">
<img class="img-fit ls-is-cached lazyloaded"
src="./product_details_files/30g2ueggCtFLOW4Gt9WVTAZLMR7nDLW70fdvONtS.jpeg"
data-src="https://qbdbox.com/public/uploads/products/featured/30g2ueggCtFLOW4Gt9WVTAZLMR7nDLW70fdvONtS.jpeg"
alt="Capsule Cutter">
</a>
</div>
<div class="product-details float-left">
<h4 class="title text-truncate">
<a href="https://qbdbox.com/product/Capsule-Cutter-TRqhq"
class="d-block">Capsule Cutter</a>
</h4>
<div class="star-rating star-rating-sm mt-1">
<i class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i>
</div>
<div class="price-box">
<!--  -->
<span class="product-price strong-600">Tk1,100</span>
</div>
</div>
</div>
</div>
<div class="mb-3 product-box-3">
<div class="clearfix">
<div class="product-image float-left">
<a href="https://qbdbox.com/product/Yogurt-Maker-GDuP7">
<img class="img-fit ls-is-cached lazyloaded"
src="./product_details_files/8KeXf26KnSKxe0RRxsKWSTgr8xKgDoqJOKR2YwSV.jpeg"
data-src="https://qbdbox.com/public/uploads/products/featured/8KeXf26KnSKxe0RRxsKWSTgr8xKgDoqJOKR2YwSV.jpeg"
alt="Yogurt Maker.">
</a>
</div>
<div class="product-details float-left">
<h4 class="title text-truncate">
<a href="https://qbdbox.com/product/Yogurt-Maker-GDuP7"
class="d-block">Yogurt Maker.</a>
</h4>
<div class="star-rating star-rating-sm mt-1">
<i class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i>
</div>
<div class="price-box">
<!--  -->
<span class="product-price strong-600">Tk600</span>
</div>
</div>
</div>
</div>
<div class="mb-3 product-box-3">
<div class="clearfix">
<div class="product-image float-left">
<a href="https://qbdbox.com/product/Electric-Hot-Water-Bag-5zSn4">
<img class="img-fit ls-is-cached lazyloaded"
src="./product_details_files/0yJh4LtU0Bg42EGAviw6jSOCWl5ZlgTsoBE3Kiht.jpeg"
data-src="https://qbdbox.com/public/uploads/products/featured/0yJh4LtU0Bg42EGAviw6jSOCWl5ZlgTsoBE3Kiht.jpeg"
alt="Electric Hot Water Bag">
</a>
</div>
<div class="product-details float-left">
<h4 class="title text-truncate">
<a href="https://qbdbox.com/product/Electric-Hot-Water-Bag-5zSn4"
class="d-block">Electric Hot Water Bag</a>
</h4>
<div class="star-rating star-rating-sm mt-1">
<i class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i>
</div>
<div class="price-box">
<!--  -->
<span class="product-price strong-600">Tk400</span>
</div>
</div>
</div>
</div>
<div class="mb-3 product-box-3">
<div class="clearfix">
<div class="product-image float-left">
<a href="https://qbdbox.com/product/Kaju-Badam-cIdd3">
<img class="img-fit lazyloaded"
src="./product_details_files/9YwkCL4ohUaxwnqwBNGGiM7PLiFELNYkcawFK6bT.jpeg"
data-src="https://qbdbox.com/public/uploads/products/featured/9YwkCL4ohUaxwnqwBNGGiM7PLiFELNYkcawFK6bT.jpeg"
alt="Kaju Badam">
</a>
</div>
<div class="product-details float-left">
<h4 class="title text-truncate">
<a href="https://qbdbox.com/product/Kaju-Badam-cIdd3"
class="d-block">Kaju Badam</a>
</h4>
<div class="star-rating star-rating-sm mt-1">
<i class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i><i class="fa fa-star"></i><i
class="fa fa-star"></i>
</div>
<div class="price-box">
<!--  -->
<span class="product-price strong-600">Tk300</span>
</div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
<div class="col-xl-12">
<div class="product-desc-tab bg-white">
<div class="tabs tabs--style-2">
<ul class="nav nav-tabs justify-content-left sticky-top bg-white">
<li class="nav-item">
<a href="https://qbdbox.com/product/Nima-Grinder-9HpIM#tab_default_1"
data-toggle="tab"
class="nav-link text-uppercase strong-600 active show">Description</a>
</li>
<li class="nav-item">
<a href="https://qbdbox.com/product/Nima-Grinder-9HpIM#tab_default_4"
data-toggle="tab" class="nav-link text-uppercase strong-600">Reviews</a>
</li>
<li class="nav-item">
<a href="https://qbdbox.com/product/Nima-Grinder-9HpIM#tab_default_5"
data-toggle="tab" class="nav-link text-uppercase strong-600">Shipping Info</a>
</li>
</ul>

<div class="tab-content pt-0">
<div class="tab-pane active show" id="tab_default_1">
<div class="py-2 px-4">
<div class="row">
<div class="col-md-12">
<div class="mw-100 overflow--hidden">
<p>{!! $product->short_descp_en !!}</p>
</div>
</div>
</div>
</div>
</div>
<div class="tab-pane" id="tab_default_5">
<div class="py-2 px-4">
<div class="row">
<div class="col-md-12">
<div class="mw-100 overflow--hidden">
<div class="row no-gutters mt-3 ">
<div class="col-1">
<i class="fa fa-phone" aria-hidden="true"
style="font-size: 18px;color: #8a8686;"></i>
</div>
<div class="col-4">
<div class="product-description-label">
Call:</div>
</div>
<div class="col-7">
<a href="tel:{{isset($settings['phone']) ? $settings['phone'] : '01715808563' }}" target="_blank">
{{isset($settings['phone']) ? $settings['phone'] : '01715808563' }}
</a>
</div>
</div>
<div class="row no-gutters mt-3">
<div class="col-1">
<i class="fa fa-plane" aria-hidden="true"
style="font-size: 18px;color: #8a8686;"></i>
</div>
<div class="col-4">
<div class="product-description-label">

Outside Dhaka:</div>
</div>
<div class="col-7">
4-5 working days
</div>
</div>
<div class="row no-gutters mt-3">
<div class="col-1">
<i class="fa fa-truck" aria-hidden="true"
style="font-size: 18px;color: #8a8686;"></i>
</div>
<div class="col-4">
<div class="product-description-label">

Inside Dhaka:</div>
</div>
<div class="col-7">
2-3 working days

</div>
</div>
<div class="row no-gutters mt-3">
<div class="col-1">
<i class="fa fa-money" aria-hidden="true"
style="font-size: 18px;color: #8a8686;"></i>
<span> </span>
</div>

<div class="col-4">
<div class="product-description-label">

Cash on Delivery :</div>
</div>
<div class="col-4">
Available
</div>

</div>



{{-- <div class="row no-gutters mt-3">
<div class="col-2">
<div class="product-description-label">Refund:</div>
</div>
<div class="col-10">
<a href="https://qbdbox.com/returnpolicy"
target="_blank"> <img
src="./product_details_files/refund-sticker.jpg"
height="36"> </a>
<a href="https://qbdbox.com/returnpolicy"
class="ml-2" target="_blank">View Policy</a>
</div>
</div>
<div class="row no-gutters mt-3">
<div class="col-2">
<div class="product-description-label alpha-6">Payment:
</div>
</div>
<div class="col-10">
<ul class="inline-links">
<li>
<img src="./product_details_files/placeholder.jpg"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/visa.png"
width="30" class="lazyload">
</li>
<li>
<img src="./product_details_files/placeholder.jpg"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/mastercard.png"
width="30" class="lazyload">
</li>
<li>
<img src="./product_details_files/placeholder.jpg"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/maestro.png"
width="30" class="lazyload">
</li>
<li>
<img src="./product_details_files/placeholder.jpg"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/paypal.png"
width="30" class="lazyload">
</li>
<li>
<img src="./product_details_files/placeholder.jpg"
data-src="https://qbdbox.com/public/frontend/images/icons/cards/cod.png"
width="30" class="lazyload">
</li>
</ul>
</div>
</div> --}}
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane" id="tab_default_3">
<div class="py-2 px-4">
<div class="row">
<div class="col-md-12">
<a href="https://qbdbox.com/public">Download</a>
</div>
</div>
<span class="space-md-md"></span>
</div>
</div>
<div class="tab-pane" id="tab_default_4">
<div class="fluid-paragraph py-4">

<div class="text-center">
There have been no reviews for this product yet.
</div>

</div>
</div>

</div>
</div>
</div>
<div class="my-2 bg-white p-2">
<div class="section-title-1">
<h3 class="heading-5 strong-700 mb-0">
<span class="mr-4">Related products</span>
</h3>
</div>
<div class="products-box-bar p-1 bg-white rep">
<div class="row sm-no-gutters gutters-5 infinite-scroll">
@forelse ( $relatedProduct as $item)

<div class="col-6 col-sm-4 col-lg-2">
@include('frontend.partials.product', ['product' => $item])
</div>
@empty

@endforelse

</div>
</div>

</div>
</div>
</div>
</div>
</section>






</section>




</div><!-- END: body-wrap -->
<!-- Modal -->

<div class="modal fade show" id="Video" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg mx-xs-3 mx-md-auto">
<div class="modal-content" style="position: relative">
<button type="button" class="close btn-circle btn-sm" onclick="stopVideo()" style="position: absolute; top: -1rem; right: -1rem;" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true" class="text-lg">&times;</span>
</button>

@if (isset($product->video))
<iframe id="player" type="text/html" class="embed-responsive-item w-100" style="height: 30rem" src="https://www.youtube.com/embed/{{ $product->video }}" width="100%" height="360" allowfullscreen></iframe> @endif
    </div>
    </div>
    </div>
@endsection

@push('scripts')

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

<!-- ElevateZoom JS -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script> --}}


<!-- Custom JS -->
<script>
    $(document).ready(function(){
        // Initialize main carousel
        var sync1 = $("#main-carousel");
    var sync2 = $("#thumbnail-carousel");
    var slidesPerPage = 4; //globaly define number of elements per page
    var syncedSecondary = true;

    sync1.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: false,
        autoplay: false, 
        dots: false,
        // center: true,
            loop:true,
        responsiveRefreshRate: 200,
        navText: ['<i class="las la-angle-left"></i>', '<i class="las la-angle-right"></i>'],
    }).on('changed.owl.carousel', syncPosition);

    sync2
        .on('initialized.owl.carousel', function() {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            margin: 10,
            dots: false,
            nav: false,
            autoWidth:true,
            // loop:true,
            smartSpeed: 200,
            slideSpeed: 500,
            thumbs: false,
            thumbImage: false,
            slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
            responsiveRefreshRate: 100,
        }).on('changed.owl.carousel', syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();

        if (current > end) {
            sync2.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            sync2.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function(e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 300, true);
    });

        // Initialize Fancybox
        $('[data-fancybox="gallery"]').fancybox({
            loop: true,
            buttons: [
                "zoom",
                "slideShow",
                "thumbs",
                "close"
            ]
        });

 // Initialize ElevateZoom for larger devices
//  if ($(window).width() > 1024) {
//             $(".zoom").elevateZoom({
//                 zoomType: "lens",
//                 lensShape: "round",
//                 lensSize: 200
//             });
//         }

        // Reinitialize ElevateZoom on window resize if needed
        // $(window).resize(function() {
        //     if ($(window).width() > 1024) {
        //         $(".zoom").each(function() {
        //             $(this).elevateZoom({
        //                 zoomType: "lens",
        //                 lensShape: "round",
        //                 lensSize: 200
        //             });
        //         });
        //     } else {
        //         // Destroy zoom if window width is less than or equal to 1024
        //         $(".zoom").each(function() {
        //             if ($(this).data('elevateZoom')) {
        //                 $(this).data('elevateZoom').destroy();
        //             }
        //         });
        //     }
        // });

    });
</script>

    <script>
        // $(document).ready(function() {
        //     // Show modal when the document is ready
        //     $('#Video').modal('show');
        // });
        function stopVideo() {
            var videoURL = $('#player').prop('src');
videoURL = videoURL.replace("&autoplay=1", "");
$('#player').prop('src','');
$('#player').prop('src',videoURL);

  }
        fbq('track', 'ViewContent', {
            content_ids: ['{{ $product->id }}'],
            content_type: 'product',
            value: {{ round($product->discount_price ?: $product->selling_price) }},
            currency: 'BDT'
        });
    </script>
@endpush
