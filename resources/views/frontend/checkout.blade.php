@extends('frontend.layouts.app')
@section('title','Checkout')
@push('css')
    <style>
        .loader {
            border: 4px solid #f3f3f3;
            /* Light grey */
            border-top: 4px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 2s linear infinite;
            margin-right: 5px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
@section('content')
    <!-- MAIN WRAPPER -->
    <div class="body-wrap shop-default shop-cards shop-tech gry-bg">


        <div class="breadcrumb-area">
            <div class="container">

                <div class="row">
                    <div class="col">
                        <ul class="breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>


                            <li class="active text-truncate">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <section class="py-4 gry-bg" id="cart-summary">
            @if (count($data['content']) > 0)
                @include('frontend.partials.checkout', ['data' => $data])
            @else
                <div class="card ">

                    <h4 class="text-danger text-center d-flex align-items-center justify-content-center"
                        style=" height:60vh">Please Shopping First</h4>
                </div>
            @endif
            {{-- <button id="loading-btn" type="button" class="btn btn-primary">
                <i class='fa fa-spinner fa-spin mr-2 d-none'></i>
                Load Data
              </button> --}}

        </section>

    </div><!-- END: body-wrap -->
@endsection
@push('scripts')
<script type="text/javascript">
    fbq('track', 'InitiateCheckout', {
        value: '{{round($data['subtotal'])}}', // Total order value
        currency: 'BDT'
    });
        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
        }

        // function updatePrice(key, element) {
        //     $.post('/cart/updatePrice', {
        //         _token: 'ICfOSFfxY90pFoZfpJZknXzMruYDXQrIYtv9VHEo',
        //         key: key,
        //         price: element.value
        //     }, function(data) {
        //         updateNavCart();
        //         $('#cart-summary').html(data);
        //     });
        // }

        function updateQuantity(rawId, element) {
            var originalRawId = element.dataset.id;

            $.post('/cart/update-quantity', {
                key: originalRawId,
                quantity: element.value
            }, function(data) {
                $('#cart-summary').html(data);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                // Handle AJAX errors
                console.error('AJAX request failed:', textStatus, errorThrown);
            });

        }



        function showCheckoutModal() {
            $('#GuestCheckout').modal();
        }
    </script>


    <script>
        $(document).ready(function() {
            // Change event listener for the select element
            $(document).on('change', '#shipping_id', function() {
                // Get the selected option value
                // var selectedShippingOption = $(this).val();
                var shippingCost = parseFloat($(this).val());

                // You'll need to replace these values with your actual shipping costs
                // var shippingCostForOption1 = 130;
                // var shippingCostForOption2 = 70;

                // Update the displayed shipping cost based on the selected option
                // var shippingCost = (selectedShippingOption === '130') ?
                //     shippingCostForOption1 : shippingCostForOption2;
                $('#shipping-cost').text('Tk ' + shippingCost);

                // Update the subtotal and total based on the new shipping cost
                var subtotalText = $('#subtotal').text().replace(/[^\d.-]/g, '');
                var subtotal = parseFloat(subtotalText);
                var newTotal = 'Tk ' + (subtotal + shippingCost);

                $('#total').text(newTotal);
            });

            $('#order-btn').click(function(e) {
        e.preventDefault(); // Prevent the default form submission behavior
        
        var $btn = $(this);
        $btn.prop('disabled', true);
        $btn.find('i').removeClass('d-none');
        
        $('#orderForm').submit(); // Submit the form
        // Simulate loading delay
        setTimeout(function() {
            $btn.prop('disabled', false);
        $btn.find('i').addClass('d-none');
        }, 8000); // Change 1000 to the desired loading duration in milliseconds
    });

        });
    </script>
@endpush
