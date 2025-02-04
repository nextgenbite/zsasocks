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

    <!-- Hero Section -->

    <div class="portfolio-details-slider swiper init-swiper"  data-aos="fade-up" data-aos-delay="100">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "navigation": {
            "nextEl": ".swiper-button-next",
            "prevEl": ".swiper-button-prev"
          },
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          }
        }
      </script>
      <div class="swiper-wrapper align-items-center">
@foreach ($sliders as $item)
  
<div class="swiper-slide">
  <img src="{{asset($item->slider_image)}}" alt="{{ $item->title }}" class="w-100" >
</div>
@endforeach

    

      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-pagination"></div>
    </div>
    {{-- <section id="hero" class="hero section accent-background">

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5 justify-content-between">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h2><span>Welcome to </span><span class="accent">Impact</span></h2>
            <p>Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque eum
              quaerat.</p>
            <div class="d-flex">
              <a href="#about" class="btn-get-started">Get Started</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch
                  Video</span></a>
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 mb-4">
            <img src="{{ asset('frontend/img/hero-img.svg') }}" class="img-fluid" alt="">
          </div>
        </div>
      </div>

     

    </section> --}}
    <!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us<br></h2>
        <!-- <p>To Be a Company that Our Customers and Society Appetent.</p> -->
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h4>Vision :To Be a Company that Our Customers and Society Appetent.</h4>
            <p class="text">With integrity, passion, pride, and speed, we actively communicate with our customers to
              deliver insightful products and services that exceed their expectations. We value integrity, customer
              focus, creativity, efficient and nimble actions, and respect highly motivated people and team spirit. We
              positively support environmental matters, safety, and society. Guided by these values, we provide rewards
              to all people associated with ZSA INTERWEAVE.
            </p>
            <p class="text">
              Mission:ZSA Interweave is a socks knit factory manufacturer and supplier of sports and everyday comfort socks. We
              manufacture for top brands worldwide, and we offer services that exceed customer satisfaction through
              continuous improvement. We aim to establish long-term relationships with our clients through ethical,
              honest, and transparent transactions
            </p>


          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
            <img src="{{ asset('frontend/img/about.jpg') }}" class="img-fluid rounded-4 mb-4" alt="">
            <div class="content ps-0 ps-lg-5">
              <!-- <p class="fst-italic">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua.
              </p> -->


              <!-- <ul>
                <li><i class="bi bi-check-circle-fill"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
              </ul> -->
              <!-- <p>
                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
              </p>

              <div class="position-relative mt-4">
                <img src="{{ asset('frontend/img/about-2.jpg') }}" class="img-fluid rounded-4" alt="">
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
              </div> -->
            </div>
          </div>
        </div>

      </div>
      <section class="services section">

        <div class="container">

          <div class="row gy-4">

            <div class=" col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item  position-relative">
                <div class="icon">
                  <i class="bi bi-box"></i>
                </div>
                <h3>Product and services</h3>
                <p class="text">We have been producing all kind of plain, terry, socks containing any design and pattern
                  high quality socks with high emphasis in to the quality control, commitment & competitive
                  price and been exporting to Europe, USA, & Canada. Our fashion socks are unisex-socks for
                  men, women and child. Our company is also manufacturer of socks in different style &
                  pattern according to the buyers’ requirement. We are special for manufacturing all type of
                  socks such as Plain, Rib, Tennis/Terry, Jacquard , Knee high, Half cushion, Ankle, 3D socks.
                  Our focus on total quality management trainings at all levels and good teamwork are our
                  basic foundation of manufacturing world class products. We create variations that can give
                  our customers a lot of various choices to select from. Continuous improvement from design
                  to productivity enhancement is part of our vision of emerging with unique products of ZSA
                  Interweave. The Price and quality of our products are always competitive with the other
                  companies of the world.</p>
                <!-- <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a> -->
              </div>
            </div><!-- End Service Item -->

            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="bi bi-building-fill-gear"></i>
                </div>
                <h3>Machineries</h3>
                <div class="content">
                  <p class="text">
                    We have 10 number of single cylinder “Soosan” Brand knitting machine along with
                    supporting machine ranging from 72 to 156 needles, others specification are drum less,

                    Fully electronic control system, Italian DEIMO -32- bit controller, 1 main feeders, possibility
                    multi colors including 1 ground color an same course. The most efficient reciprocated
                    knitting for true heel & toe. Multiple stop motion sensors in case of error. Automatic oil
                    checking, device, pattern, chain and jacquard program can be modified and then
                    downloaded to disk storage, screen readout for causes of machine stoppage. Moreover, we
                    are able to incorporate:
                  </p>
                  <ul>
                    <li>
                      <i class="bi bi-check-circle-fill"></i>
                      <span> Unlimited patterning for socks of all sizes.</span>
                    </li>
                    <li>
                      <i class="bi bi-check-circle-fill"></i>
                      <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span>
                    </li>
                    <li>
                      <i class="bi bi-check-circle-fill"></i>
                      <span>8 patterns of different types are available for one sock.</span>
                    </li>
                    <li>
                      <i class="bi bi-check-circle-fill"></i>
                      <span>10 units Soosan branded socks knitting machine. </span>
                    </li>
                    <li>
                      <i class="bi bi-check-circle-fill"></i>
                      <span>156 needles single cylinder, 3.75 DIA. </span>
                    </li>
                    <li>
                      <i class="bi bi-check-circle-fill"></i>
                      <span>Automatic Linking Machine. </span>
                    </li>
                    <li>
                      <i class="bi bi-check-circle-fill"></i>
                      <span>Iron Facility.</span>
                    </li>
                  </ul>
                </div>
                <!-- <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a> -->
              </div>
            </div><!-- End Service Item -->

            <div class=" col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item  position-relative">
                <div class="icon">
                  <i class="bi bi-boxes"></i>
                </div>
                <h3>Production capacity</h3>
                <p class="text">60,000 pair per month production capacity.</p>
                <!-- <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a> -->
              </div>
            </div><!-- End Service Item -->
            <div class=" col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item  position-relative">
                <div class="icon">
                  <i class="bi bi-patch-check-fill"></i>
                </div>
                <h3>Compliance</h3>
                <p class="text">On process of SADEX</p>
                <!-- <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a> -->
              </div>
            </div><!-- End Service Item -->

          </div>

        </div>
      </section>
    </section><!-- /About Section -->

<!-- Gallary Section -->
<section id="gallary" class="gallary portfolio section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Gallery</h2>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
      <!-- Gallery Filters -->
      <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
        @foreach ($categories as $category)
          <li data-filter=".filter-{{$category->id}}" 
              class="text-capitalize py-2 px-4 rounded shadow @if ($loop->first) filter-active @endif">
            {{$category->category_name}}
          </li>
        @endforeach
      </ul><!-- End Gallery Filters -->

      <!-- Gallery Container -->
      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
        @foreach ($categories as $category)
          @foreach ($category->reviews as $item)
            <div class="col-lg-3 col-md-6 portfolio-item isotope-item filter-{{$category->id}} rounded">
              <div class="portfolio-content h-100">
                <a href="{{ $item->path ? asset($item->path) : '/placeholder.jpg' }}" 
                   data-gallery="portfolio-gallery-app" class="glightbox">
                  <img src="{{ $item->path ? asset($item->path) : '/placeholder.jpg' }}" 
                       class="img-fluid rounded w-100" 
                       alt="{{ $category->category_name }}">
                </a>
              </div>
            </div><!-- End Gallery Item -->
          @endforeach
        @endforeach
      </div><!-- End Gallery Container -->
    </div>
  </div>
</section><!-- /Gallery Section -->


      <!-- Team Section -->
      <section id="team" class="team section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Our Team </h2>
          {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
        </div><!-- End Section Title -->
  
        <div class="container">
  
          <div class="row gy-4">
  
            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                <img src="{{asset('/user-img-female.jpg')}}" class="img-fluid" alt="">
                <h4>Shahira Jahan (Tithi)</h4>
                <span>General Manager</span>
                <a href=" telephon:+01756630755"><i class="bi bi-phone me-1"></i>01756630755</a>
                {{-- <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div> --}}
              </div>
            </div><!-- End Team Member -->

          </div>
  
        </div>
  
      </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" >
        <h2>Contact</h2>
        {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gx-lg-0 gy-4">

          <div class="col-lg-4">
            <div class="info-container d-flex flex-column align-items-center justify-content-center">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>  {{ settingHelper('address') }}</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Us</h3>
                  <p> <a class="text-light" href="tel:+{{ settingHelper('phone') }}" >{{ settingHelper('phone') }}</a></p>
                </div>
              </div><!-- End Info Item -->
              
              <div class="info-item d-flex" data-aos="fade-up">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Us</h3>
                  <p> <a class="text-light"
                    href="mailto:{{ settingHelper('contact_mail')  }}"> {{settingHelper('contact_mail')   }}</a></p>
              
                </div>
              </div><!-- End Info Item -->


            </div>

          </div>

          <div class="col-lg-8">
            <form action="{{route('contact')}}" method="post" class="php-email-form" data-aos="fade" data-aos-delay="100">
              @csrf
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="8" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>
@endsection

