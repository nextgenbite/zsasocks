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


    <!-- Main CSS File -->
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">

    <!-- jQuery -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



    <style>
        :root {
            --primary: {{ $settings['color'] ?? '#0457b1' }};
            --primary-hover: {{ $settings['hover_color'] ?? '#fff' }};


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

    <script>
          // const div = document.getElementById("right-menu");
        // div.addEventListener("contextmenu", (e) => {
        //     e.preventDefault()
        // });
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

        $(document).ready(function() {

            // If the 'hide cookie is not set we show the message
            if (!readCookie('hide')) {
                $('#popupDiv').show();
            }

            // Add the event that closes the popup and sets the cookie that tells us to
            // not show it again until one day has passed.
            $('#close').click(function() {
                $('#popupDiv').hide();
                createCookie('hide', true, 1)
                return false;
            });

        });

        // ---
        // And some generic cookie logic
        // ---
        function createCookie(name, value, days) {
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 1 * 60 * 60 * 1000));
                var expires = "; expires=" + date.toGMTString();
            } else var expires = "";
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            createCookie(name, "", -1);
        }
    </script>

    <script>
        // Set CSRF token globally for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('.category-nav-element').each(function(i, el) {
                $(el).on('mouseover', function() {
                    if (!$(el).find('.sub-cat-menu').hasClass('loaded')) {
                        $.post('/sub-category', {
                            // _token: 'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl',
                            id: $(el).data('id')
                        }, function(data) {
                            $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                        });
                    }
                });
            });
            // if ($('#lang-change').length > 0) {
            //     $('#lang-change .dropdown-item a').each(function() {
            //         $(this).on('click', function(e) {
            //             e.preventDefault();
            //             var $this = $(this);
            //             var locale = $this.data('flag');
            //             $.post('/language', {
            //                 _token: 'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl',
            //                 locale: locale
            //             }, function(data) {
            //                 location.reload();
            //             });

            //         });
            //     });
            // }

            // if ($('#currency-change').length > 0) {
            //     $('#currency-change .dropdown-item a').each(function() {
            //         $(this).on('click', function(e) {
            //             e.preventDefault();
            //             var $this = $(this);
            //             var currency_code = $this.data('currency');
            //             $.post('/currency', {
            //                 _token: 'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl',
            //                 currency_code: currency_code
            //             }, function(data) {
            //                 location.reload();
            //             });

            //         });
            //     });
            // }
        });

        $('#search').on('keyup', function() {
            search();
        });

        $('#search').on('focus', function() {
            search();
        });

        function search() {
            var search = $('#search').val();
            if (search.length > 0) {
                $('body').addClass("typed-search-box-shown");

                $('.typed-search-box').removeClass('d-none');
                $('.search-preloader').removeClass('d-none');
                $.post('/ajax-search', {
                    search: search
                }, function(data) {
                    if (data == '0') {
                        // $('.typed-search-box').addClass('d-none');
                        $('#search-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html(
                            'Sorry, nothing found for <strong>"' + search + '"</strong>');
                        $('.search-preloader').addClass('d-none');

                    } else {
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                });
            } else {
                $('.typed-search-box').addClass('d-none');
                $('body').removeClass("typed-search-box-shown");
            }
        }
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
                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) - 1);
                $('#rmpro').html(parseInt($('#rmpro').html()) - 1);
            });
        }

        function addToCompare(id) {
            $.post('/compare/addToCompare', {
                _token: 'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl',
                id: id
            }, function(data) {
                $('#compare').html(data);
                showFrontendAlert('success', 'Item has been added to compare list');
                $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html()) + 1);
            });
        }

        function addToWishList(id) {
            showFrontendAlert('warning', 'Please login first');
        }

        function showAddToCartModal(id) {
            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('/cart/show-cart-modal', {
                _token: 'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl',
                id: id
            }, function(data) {
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                $('.xzoom, .xzoom-gallery').xzoom({
                    Xoffset: 20,
                    bg: true,
                    tint: '#000',
                    defaultScale: -1
                });
                getVariantPrice();
            });
        }

        $('#option-choice-form input').on('change', function() {
            getVariantPrice();
        });

        function getVariantPrice() {
            if ($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
                $.ajax({
                    type: "POST",
                    url: '/product/variant_price',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {
                        $('#option-choice-form #chosen_price_div').removeClass('d-none');
                        $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                        $('#available-quantity').html(data.quantity);
                        $('.input-number').prop('max', data.quantity);
                        //console.log(data.quantity);
                        if (parseInt(data.quantity) < 1 && data.digital != 1) {
                            $('.buy-now').hide();
                            $('.add-to-cart').hide();
                        } else {
                            $('.buy-now').show();
                            $('.add-to-cart').show();
                        }
                    }
                });
            }
        }

        function checkAddToCartValidity() {
            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                count++;
            });

            if ($('#option-choice-form input:radio:checked').length == count) {
                return true;
            }

            return false;
        }

        function addToCart(id) {
           // if (checkAddToCartValidity()) {
                $('#addToCart').modal('show');

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
                        $('head').append(data.fbq_script);
                        //    $('#addToCart-modal-body').html(null);
                        $('.c-preloader').hide();
                        $('#addToCart').hide();
                        $('.modal-backdrop').remove();

                        //    $('#modal-size').removeClass('modal-lg');
                        //    $('#addToCart-modal-body').html(data);
                        showFrontendAlert('success', 'Item added to your cart!');
                        updateNavCart();
                        $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) + 1);
                    }
                });
            // } else {
            //     showFrontendAlert('warning', 'Please choose all the options');
            // }
        }

        // function addToListCart(key) {
        //     // alert(232);
        //     if (checkAddToCartValidity()) {
        //         $('#addToCart').modal();
        //         $('.c-preloader').show();
        //         $.post('/cart/addtocart', {
        //             _token: 'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl',
        //             id: key
        //         }, function(data) {
        //             $('#addToCart-modal-body').html(null);
        //             $('.c-preloader').hide();
        //             $('#modal-size').removeClass('modal-lg');
        //             $('#addToCart-modal-body').html(data);
        //             updateNavCart();
        //             $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) + 1);

        //         });
        //     } else {
        //         showFrontendAlert('warning', 'Please choose all the options');
        //     }
        // }

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
                        $('head').append(data.fbq_script);
                        updateNavCart();
                        $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) + 1);
                        window.location.replace("/checkout");
                    }
                });
            // } else {
            //     showFrontendAlert('warning', 'Please choose all the options');
            // }
        }

        // function show_purchase_history_details(order_id) {
        //     $('#order-details-modal-body').html(null);

        //     if (!$('#modal-size').hasClass('modal-lg')) {
        //         $('#modal-size').addClass('modal-lg');
        //     }

        //     $.post('/purchase_history/details', {
        //         _token: 'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl',
        //         order_id: order_id
        //     }, function(data) {
        //         $('#order-details-modal-body').html(data);
        //         $('#order_details').modal();
        //         $('.c-preloader').hide();
        //     });
        // }

        function show_order_details(order_id) {
            $('#order-details-modal-body').html(null);

            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }

            $.post('/orders/details', {
                _token: 'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl',
                order_id: order_id
            }, function(data) {
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }

        function imageInputInitialize() {
            $('.custom-input-file').each(function() {
                var $input = $(this),
                    $label = $input.next('label'),
                    labelVal = $label.html();

                $input.on('change', function(e) {
                    var fileName = '';

                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}',
                            this.files.length);
                    else if (e.target.value)
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        $label.find('span').html(fileName);
                    else
                        $label.html(labelVal);
                });

                // Firefox bug fix
                $input
                    .on('focus', function() {
                        $input.addClass('has-focus');
                    })
                    .on('blur', function() {
                        $input.removeClass('has-focus');
                    });
            });
        }
    </script>

    <script>

        $(document).ready(function() {
            // $.post('https://qbdbox.com/home/section/featured', {_token:'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl'}, function(data){
            //     $('#section_featured').html(data);
            //     slickInit();
            // });

            // $.post('https://qbdbox.com/home/section/best_selling', {_token:'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl'}, function(data){
            //     $('#section_best_selling').html(data);
            //     slickInit();
            // });

            // $.post('https://qbdbox.com/home/section/home_categories', {_token:'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl'}, function(data){
            //     $('#section_home_categories').html(data);
            //     slickInit();
            // });

            // $.post('https://qbdbox.com/home/section/best_sellers', {_token:'LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl'}, function(data){
            //     $('#section_best_sellers').html(data);
            //     slickInit();
            // });

        });

        $(document).on({
            mouseover: function(e) {
                $('.get_quote_link').hide();
                $(this).children().children('.get_quote_link').show();
            }
        }, '.product-hover');
        $(document).on({
            mouseout: function(e) {
                $('.get_quote_link').hide();
            }
        }, '.product-hover');
    </script>
       <!-- Meta Pixel Code -->

{{-- <!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '267436919651988');
    fbq('init', '1079098336681296');
    fbq('init', '1696641144197459');
   
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=267436919651988&ev=PageView&noscript=1"
    /></noscript>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1079098336681296&ev=PageView&noscript=1"
    /></noscript>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1696641144197459&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code --> --}}

    
    @stack('scripts')
</body>

</html>
