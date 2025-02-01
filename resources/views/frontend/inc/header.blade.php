<!-- Header -->
<header id="header" class="header">

  <div class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center">
          <a href="mailto:{{settingHelper('contact_mail')}}" aria-label="Email Us"> 
            {{ settingHelper('contact_mail') }}
          </a>
        </i>
        <i class="bi bi-phone d-flex align-items-center ms-4">
          <a href="tel:+{{settingHelper('phone')}}" class="top-bar-item" aria-label="Call Helpline">
            Helpline {{ settingHelper('phone') }}
          </a>
        </i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="{{settingHelper('twitter')}}" class="twitter" aria-label="Visit our Twitter">
          <i class="bi bi-twitter-x"></i>
        </a>
        <a href="{{settingHelper('facebook')}}" class="facebook" aria-label="Visit our Facebook">
          <i class="bi bi-facebook"></i>
        </a>
        <a href="{{settingHelper('instagram')}}" class="instagram" aria-label="Visit our Instagram">
          <i class="bi bi-instagram"></i>
        </a>
        <a href="{{settingHelper('linkedin')}}" class="linkedin" aria-label="Visit our LinkedIn">
          <i class="bi bi-linkedin"></i>
        </a>
      </div>
    </div>
  </div><!-- End Top Bar -->

  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center" aria-label="Go to homepage">
        @if (settingHelper('logo') == null)
        <h1 class="sitename">{{settingHelper('app_name', config('app.name'))}}</h1>
        @else
        <img src="{{ asset(settingHelper('logo')) }}" alt="Site Logo" loading="lazy">
        @endif
        <span class="visually-hidden">Home</span>
      </a>

      <nav id="navmenu" class="navmenu" aria-label="Main Navigation">
        <ul>
          <li><a href="/" class="active" aria-current="page">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="/products">Our Products</a></li>
          <li><a href="#gallary">Gallery</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="https://zsasocks.com:2096" target="_blank" title="Webmail">Webmail</a></li>
        </ul>
        <button class="mobile-nav-toggle d-xl-none" aria-label="Toggle Navigation">
          <i class="bi bi-list"></i>
        </button>
      </nav>
    </div>
  </div>

</header>
