<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('frontend.inc.title-meta', ['title' => isset($title) ?? null])
  

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"  media="none" onload="if(media!='all')media='all'">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('frontend/css/sweetalert2.min.css') }}" rel="stylesheet" media="all">


    <!-- Main CSS File -->
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">


    <style>
        :root {
            --primary: {{  settingHelper('color', '#0457b1')}};
            --primary-hover: {{ settingHelper('hover_color', '#023061') }};
        }

        .bg-primary, .btn-primary {
            background-color: var(--primary) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }
        .btn-primary{
            color: #fff !important;
            border-color: var(--primary) !important;
        }
        .btn-outline-primary {
    color: var(--primary) !important;
    border-color: var(--primary) !important;
    /* color: #fff !important; */
}
        .btn-outline-primary:hover {
    color: #fff !important;
    background-color: var(--primary-hover) !important;
    /* color: #fff !important; */
}

.btn-primary:hover {
    background-color: var(--primary-hover) !important;
    border-color: var(--primary-hover) !important;
}
        body {
            font-family: 'Public Sans', sans-serif;
            font-weight: 400;
        }



        .text {
        text-align: justify;
      }
    </style>

@stack('css')



</head>

<body id="right-menu" class="index-page">

    <!-- Header -->
    @include('frontend.inc.header')

    <!-- MAIN WRAPPER -->
    <main class="main">

        @yield('content')

        @include('frontend.inc.footer')
        
    </main><!-- END: body-wrap -->
    




     <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('frontend/js/main.js') }}"></script>

    <!-- jQuery -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('frontend/js/sweetalert2.min.js') }}"></script>
    <script>
          // const div = document.getElementById("right-menu");
        // div.addEventListener("contextmenu", (e) => {
        //     e.preventDefault()
        // });

        document.addEventListener("DOMContentLoaded", function() {
  window.addEventListener('scroll', function() {
      // Detect device type dynamically on each scroll event
      var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

      // Apply behavior based on scroll position and device type
      if (window.scrollY > 50) {
    
              // Apply desktop behavior
              document.getElementById('header').classList.add('fixed-top');

        
      } else {
          // Remove fixed class and reset padding if scroll position <= 50
          document.getElementById('header').classList.remove('fixed-top');
          document.body.style.paddingTop = '0';
      }
  });
});
        function showFrontendAlert(type, message) {
            // Map 'danger' type to 'error' for consistency
            if (type === 'danger') {
                type = 'error';
            }

            swal({
                position: 'top-end',
                type: type,
                title: message,
                showConfirmButton: false,
                toast: true,
                timer: 3000
            });
        }

        @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            var message = "{{ Session::get('messege') }}";
            showFrontendAlert(type, message);
        @endif




    </script>

    <script>
        // Set CSRF token globally for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  
        

        updateNavCart()

        function updateNavCart() {
            $.get('{{ url('/cart/nav-cart-items') }}', function(data) {
                $('#cart_items').html(data);
            });
        }

        function removeFromCart(key) {
            $.get("{{ url('/delete-cart') }}/" + key, function(data) {
                updateNavCart();
                $('#cart-summary').html(data);
                showFrontendAlert('success', 'Item has been removed from cart');
                // $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) - 1);
                // $('#rmpro').html(parseInt($('#rmpro').html()) - 1);
            });
        }



        function buyNow(id) {
            // if (checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                let quantity = 1;
                const inputQty = $('input[name="quantity"]');
                if (inputQty.length) {
                    quantity = inputQty.val();
                }
                const selectedSize = $('input[name="size"]:checked').val() || null;
                const selectedColor = $('input[name="color"]:checked').val() || null;
                $.ajax({
                    type: "POST",
                    url: '{{ url('/add-to-cart') }}',
                    data: {
                        id: id,
                        quantity: quantity,
                        color: selectedColor,
                        size: selectedSize
                    },
                    success: function(data) {
                        //$('#addToCart-modal-body').html(null);
                        //$('.c-preloader').hide();
                        //$('#modal-size').removeClass('modal-lg');
                        //$('#addToCart-modal-body').html(data);
                        updateNavCart();
                        window.location.replace("/checkout");
                    }
                });
        }





    </script>


    
    @stack('scripts')
</body>

</html>
