@extends('frontend.layouts.app')
@section('title', 'Invoice-8'. $data->id)
@push('css')
<style>
      @media print {
            body * {
                visibility: hidden;
            }
            #printArea, #printArea * {
                visibility: visible;
            }
            /* Reset padding and margin for all elements except printArea */
            body *:not(#printArea *) {
                padding: 0;
                margin: 0;
            }
            /* You can add more specific selectors if needed */
            #printArea {
                position: static;
            }
        }
</style>
@endpush
@section('content')
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.user_sidebar')
                </div>
                <div class="col-lg-9">

                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        Purchase History
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="/">Home</a></li>
                                            <li><a href="/dashboard">Dashboard</a></li>
                                            <li class="active"><a href="/purchase_history">Purchase History</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container-fluid" id="printArea">
                
                                            <div class="d-flex justify-content-between">
                                                <img style="max-width: 13rem; max-height: 4rem" class="my-2"
                                                    src="{{ asset(isset($settings['logo']) ? $settings['logo'] : 'favicon.png') }}"
                                                    alt="logo">
                                                <h3 class=" my-2">Invoice #8{{ $data->id }}</h3>
                                               
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class=" pl-0">
                                                    <p class="mb-0  mt-2">Order Date : {{ $data->order_date }}</p>
                
                                                </div>
                                                <div class=" pr-0">
                                                    <p class="mb-0 mt-2  text-right ">Order Status : <b
                                                            class="{{ $data->status == 0 ? 'text-danger' : ($data->status == 1 ? 'text-info' : 'text-success') }}">{{ $data->status == 0 ? 'Pending' : ($data->status == 1 ? 'Confirm' : 'Delivered') }}</b>
                                                    </p>
                                                </div>
                                            </div>
                
                                            <div class="d-flex justify-content-between">
                                                <div class=" pl-0">
                                                    <p class="mt-2 mb-0 text-bold"><b>From</b></p>
                                                    <p class=" text-bold text-capitalize">{{isset($settings['app_name']) ? $settings['app_name'] : 'nextgenbite'}}</p>
                                                    <p class="">{{isset($settings['phone']) ? $settings['phone'] : '01715808563'}}</p>
                                                    <p>{{isset($settings['address']) ? $settings['address'] : ''}}</p>
                                               
                                                </div>
                                                <div class=" pr-0">
                                                    <p class="mt-2 mb-0 text-end"><b>Invoice to</b></p>
                                                    <p class="text-end">Customer : <b>{{ $data->name }}</b></p>
                                                    <p class="text-end">Mobile No.:{{ $data->phone }}</p>
                                                    <p class="text-end">Address :{{ $data->address }}</p>
                                                    {{-- <p  class="text-end">Thana :{{$data->thana}}</p>
                                <p  class="text-end">District :{{$data->district}}</p> --}}
                                                    <p class="text-end">Note:{{ $data->notes }}</p>
                                                </div>
                                            </div>
                                            <div class="text-endmt-2 d-flex justify-content-center w-100">
                                                <div class="table-responsive table-bordered  w-100">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="">
                                                                <th>#</th>
                                                                <th>Title</th>
                                                                <th>Image</th>
                                                                <th class="text-end">Quantity</th>
                                                                <th class="text-end">Unit cost</th>
                                                                <th class="text-end">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data->orderitem()->get() as $key => $item)
                                                                <tr class="text-end">
                                                                    <td class="text-start">{{ $key + 1 }}</td>
                                                                    <td class="text-start">
                                                                        {{ $item->product->product_name }} <br>
                                                                        @if (isset($item->color))
                                                                            Color: <small>{{ $item->color }}</small><br>
                                                                        @endif
                                                                        @if (isset($item->size))
                                                                            Size: <small>{{ $item->size }}</small>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-start"><img style="width: 4rem; height:4rem"
                                                                            src="{{ asset($item->product->product_image) }} "
                                                                            class="img-rounded" width="100px" alt="sadd"> </td>
                                                                    <td>{{ $item->qty }}</td>
                                                                    <td>{{ $item->price }}</td>
                                                                    <td>{{ $item->price * $item->qty }}</td>
                                                                </tr>
                                                            @endforeach
                
                                                        </tbody>
                                                    </table>
                                                    <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                                        <div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;">
                                                        <div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right mt-2 w-100">
                
                                                <p class="text-right">Delivery Cost : {{ $data->delivery_type }} TK</p>
                                                <p class="text-right"> Discount : {{ $data->coupon }} TK</p>
                                                <h4 class="text-rightmb-5">Total :
                                                    {{ $data->delivery_type + $data->amount - $data->coupon }} TK</h4>
                                                <hr>
                                            </div>
                                            <strong> Visit for more Proudcts: <b class="">{{config('app.url')}}</b></strong>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                
                                        <button class="btn btn-primary float-right" id="printButton">Print</button>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script>

 $(document).ready(function() {
  $('#printButton').on('click', function() {
    window.print();
  });
})

 </script>
@endpush