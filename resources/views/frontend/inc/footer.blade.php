
<!-- FOOTER -->
<footer id="footer" class="footer accent-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="/" class="logo d-flex align-items-center">
            <span class="sitename">{{ settingHelper('app_name')}}</span>
          </a>
          <p>{!! settingHelper('about') !!}</p>
          <div class="social-links d-flex mt-4">
            <a href="{{settingHelper('twitter')}}"><i class="bi bi-twitter-x"></i></a>
            <a href="{{settingHelper('facebook')}}"><i class="bi bi-facebook"></i></a>
            <a href="{{settingHelper('instagram')}}"><i class="bi bi-instagram"></i></a>
            <a href="{{settingHelper('linkedin')}}"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="#about">About us</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>



        <div class="col-lg-4 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>{{ settingHelper('address')}}</p>
          <p class="mt-4"><strong>Phone:</strong> <span>{{settingHelper('phone') }}</span></p>
          <p><strong>Email:</strong>  <a href="mailto:{{ settingHelper('contact_mail') }}">{{ settingHelper('contact_mail') }}</a></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ settingHelper('app_name') }}</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Develop by <a href="https://nextgenbite.com/">Nextgenbite</a>
      </div>
    </div>

  </footer>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

