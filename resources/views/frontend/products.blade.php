@extends('frontend.layouts.app')
@section('title', 'Home')
@push('meta')
<meta name="description" content="{{settingHelper('app_name', config('app.name'))}} is one of the trusted e-commerce shops in Bangladesh, where people can buy their desired unique and genuine products with a single click.">
<meta name="keywords" content="Ecommerce, Online Shopping">
<meta name="author" content="{{settingHelper('app_name', config('app.name'))}}">
<meta name="sitemap_link" content="{{config('app.url')}}">

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{settingHelper('app_name', config('app.name'))}}">
<meta itemprop="description" content="{{settingHelper('app_name', config('app.name'))}} is one of the trusted e-commerce shops in Bangladesh, where people can buy their desired unique and genuine products with a single click.">
<meta itemprop="image" content="{{  asset(settingHelper('logo', '/logo.png')) }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{settingHelper('app_name', config('app.name'))}}">
<meta name="twitter:description" content="{{settingHelper('app_name', config('app.name'))}} is one of the trusted e-commerce shops in Bangladesh, where people can buy their desired unique and genuine products with a single click.">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{  asset(settingHelper('logo', '/logo.png')) }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{settingHelper('app_name', config('app.name'))}}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{config('app.url')}}">
<meta property="og:image" content="{{  asset(settingHelper('logo', '/logo.png')) }}">
<meta property="og:description" content="{{settingHelper('app_name', config('app.name'))}} is one of the trusted e-commerce shops in Bangladesh, where people can buy their desired unique and genuine products with a single click.">
<meta property="og:site_name" content="{{settingHelper('app_name', config('app.name'))}}">

@endpush
@section('content')
<main class="main">


    <!-- Product Section -->
    <section id="products" class="products portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2> Products</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            {{-- <li data-filter="*" class="filter-active">All</li> --}}
            @foreach ($categories as $key => $category)
            
            <li data-filter=".filter-{{$category->id}}" class="text-capitalize @if ($loop->first) filter-active @endif">{{$category->category_name}}</li>
            @endforeach
            {{-- <li data-filter=".filter-product">Product</li> --}}
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
            @foreach ($products as $key => $product)
            <div class="col-lg-3 col-md-6 portfolio-item isotope-item filter-{{$product->category_id}} rounded">
              <div class="portfolio-content h-100">
                <a href="{{ $product->product_image ? asset($product->product_image) : '/placeholder.jpg' }}" data-gallery="portfolio-gallery-app" class="glightbox"><img
                    src="{{ $product->product_image ? asset($product->product_image) : '/placeholder.jpg' }}" class="img-fluid rounded w-100" alt="{{ $product->product_name }}"></a>
                <div class="portfolio-info">
                  <div>{{ $product->product_name }}</div>
                  <div class="d-flex justify-content-center align-items-center gap-2 mb-1">
                    @if ($product->discount_price == null)
                    <span class="text-dark fw-semibold">{{ formatCurrency($product->selling_price) }}</span>
                    @else
                    <del class="text-muted">{{ formatCurrency($product->selling_price) }}</del>
                    <span class="text-dark fw-semibold">{{ formatCurrency($product->discount_price) }}</span>
                    <span
                      class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">{{discountPercentage($product->selling_price,$product->discount_price)}}%
                      OFF</span>
                    @endif
                  </div>
                </div>
                <div class="d-flex gap-1 justify-content-between px-1 pb-1">
                  <input type="number" name="name" class="form-control" style="width: 30%;" value="1" min="1"
                    required="">

                  <button class="btn btn-outline-primary d-block w-100" id="{{ $product->id }}"  onclick="buyNow(this.id)"><i class="bi bi-basket pr-4"></i> Order Now</button>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            @endforeach

         



          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Product Section -->

  </main>
@endsection

