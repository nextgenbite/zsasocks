@extends('frontend.layouts.app', ['title', 'confirmation'])
@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center py-4 border-bottom mb-4">
                                <i class="la la-check-circle la-3x text-success mb-3"></i>
                                <h1 class="h3 mb-3">Thank You for Your Order!</h1>
                                <h2 class="h5 strong-700">Order Code: #{{ $order->id }}</h2>
                    
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="strong-600 mb-3 border-bottom pb-2">Order Summary</h5>
                                    </div>
                                    {{-- <div class="col-4 text-right">
                                        <a href="/invoice/customer/151">Download Invoice</a>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="details-table table">
                                            <tbody>
                                                <tr>
                                                    <td class="w-50 strong-600">Order Code:</td>
                                                    <td>#{{ $order->id }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">Name:</td>
                                                    <td>{{ $order->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">Phone:</td>
                                                    <td>{{ $order->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">Shipping address:</td>
                                                    <td>{{ $order->address }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="details-table table">
                                            <tbody>
                                                <tr>
                                                    <td class="w-50 strong-600">Order date:</td>
                                                    <td>{{$order->order_date}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">Order status:</td>
                                                    <td><span class="badge {{($order->status == 0) ? 'badge-danger' : (($order->status == 1) ? 'badge-info' : 'badge-success')}}">{{$order->status == 0? 'Pending' : ($order->status == 1? 'Confirm': 'Delivered')}}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">Total order amount:</td>
                                                    <td>Tk{{ $order->delivery_type + $order->amount }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">Payment method:</td>
                                                    <td>Cash on Delivery-TK{{ $order->delivery_type + $order->amount }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="strong-600 mb-3 border-bottom pb-2">Order Details</h5>
                                <div>
                                    <table class="details-table table">
                                        <thead>
                                            <tr>
                                                <th width="10%"></th>
                                                <th width="30%">Product</th>
                                                <th>Variation</th>
                                                <th>Quantity</th>
                                                <th>Delivery Type</th>
                                                <th class="text-right">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                      
                                            @foreach ($order->orderitem()->get() as $key => $item)
                                            <tr>
                                                <td> 
                                                    <a href="{{url('/product/'. $item->product->slug) }}">
                                                    <img style="width: 4rem" class="media-object w-50"
                                                        src="{{ asset($item->product->product_image) }}" alt="...">
                                                </a>
                                            </td>
                                                <td>
                                                    <a href="{{url('/product/'. $item->product->slug) }}"
                                                        target="_blank">
                                                        {{ $item->product->product_name }}
                                                    </a>
                                                </td>
                                                <td class="">
                                                    @if (isset($item->color))
                                                         <small>Color:{{ $item->color }}</small>,
                                                    @endif
                                                    @if (isset($item->size))
                                                         <small>Size: {{ $item->size }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item->qty }}
                                                </td>
                                                <td>
                                                </td>
                                                <td class="text-right">Tk{{ $item->price * $item->qty }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-xl-5 col-md-6 ml-auto">
                                        <table class="table details-table">
                                            <tbody>
                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td class="text-right">
                                                        <span class="strong-600">Tk{{ $order->amount}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping</th>
                                                    <td class="text-right">
                                                        <span class="text-italic">Tk{{ $order->delivery_type}}</span>
                                                    </td>
                                                </tr>
                                           
                                                <tr>
                                                    <th>Coupon Discount</th>
                                                    <td class="text-right">
                                                        <span class="text-italic">Tk0</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><span class="strong-600">Total</span></th>
                                                    <td class="text-right">
                                                        <strong><span>Tk{{$order->amount + $order->delivery_type}}</span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ url('/') }}"
                            class="btn btn-primary">Continue shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
@if(isset($fbq_purchase_value) && isset($currency))
<script>
    fbq('track', 'Purchase', {
        value: '{{round($fbq_purchase_value)}}', // Total order value
        currency: '{{$currency}}'
    });
</script>
    @endif
@endpush
