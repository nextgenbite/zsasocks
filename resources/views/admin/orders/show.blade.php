@extends('admin.layouts.app')
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
    <div class="pagetitle">
        <h1>{{ $title[0] }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('/admin/' . $title[1]) }}">{{ $title[0] }}</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section" >

<div class="row" >
    <div class="col-lg-12">
      <div class="card" >
        <div class="card-body" >
          <div class="container-fluid" id="printArea">
            
            <div class=" position-relative">
                <img style="left: 0;top:-20px;width: 13rem" class=" position-absolute" src="{{asset(isset($settings['logo']) ? $settings['logo'] : 'favicon.png')}}"  alt="" >
                <h3 class="text-end my-5">Invoice #8{{$order->id}}</h3>
                <hr>
            </div>
            {{-- <h1 class="text-center text-info mt-3">QBDbox.com</h1> --}}
          {{-- <div class="container-fluid d-flex justify-content-between">
              <div class=" pl-0">
                  <p class="mt-5 mb-2"><b>{{$order->name}}</b></p>
                  <p>{{$order->phone}}</p>
                  <p>{{$order->address}}</p>
                  <p>{{$order->note}}</p>
              </div>
              <div class=" pr-0">
                  <p class="mt-5 mb-2 text-end bold h4 {{$order->status == 0? 'text-danger' : $order->status == 1? 'text-info': 'text-success'}}"><b>{{$order->status == 0? 'Pending' : $order->status == 1? 'Confirm': 'Delivered'}}</b></p>

              </div>
            </div> --}}
            <div class="d-flex justify-content-between">
                <div class=" pl-0">
                    <p class="mb-0  mt-2">Order Date : {{$order->order_date}}</p>

                </div>
                <div class=" pr-0">
                    <p class="mb-0 mt-2  text-end  ">Order Status : @include('admin.pertials.order_print_status', ['item' =>$order])
                        
                        {{-- <b class="{{($order->status == 0) ? 'text-danger' : (($order->status == 1) ? 'text-info' : 'text-success')}}">{{$order->status == 0? 'Pending' : ($order->status == 1? 'Confirm': 'Delivered')}}</b> --}}
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
                <p   class="text-end">Customer : <b>{{$order->name}}</b></p>
                <p  class="text-end">Mobile No.:{{$order->phone}}</p>
                <p  class="text-end">Address :{{$order->address}}</p>
                {{-- <p  class="text-end">Thana :{{$order->thana}}</p>
                <p  class="text-end">District :{{$order->district}}</p> --}}
                <p  class="text-end">Note:{{$order->notes}}</p>
            </div>
        </div>
          <div class="text-endmt-2 d-flex justify-content-center w-100">
              <div class="table-responsive table-bordered  w-100" >
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
                      @foreach ($order->orderitem()->get() as $key=>$item)

                      <tr class="text-end">
                          <td class="text-start">{{$key+1}}</td>
                          <td class="text-start">
                            {{$item->product->product_name}} <br>
                            @if (isset($item->color))

                            Color: <small>{{$item->color}}</small><br>
                            @endif
                            @if (isset($item->size))

                            Size: <small>{{$item->size}}</small>
                            @endif
                        </td>
                          <td class="text-start"><img style="width: 4rem; height:4rem" src="{{asset($item->product->product_image)}} " class="img-rounded" width="100px" alt="sadd"> </td>
                          <td>{{$item->qty}}</td>
                          <td>{{$item->price}}</td>
                          <td>{{$item->price * $item->qty}}</td>
                      </tr>
                      @endforeach

                    </tbody>
                </table>
              <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
          </div>
          <div class="text-endmt-2 w-100">

              <p class="text-end">Delivery Cost : {{$order->delivery_type}} TK</p>
              <p class="text-end"> Discount : {{$order->coupon}} TK</p>
              <h4 class="text-end mb-5">Total : {{ ($order->delivery_type + $order->amount) -$order->coupon}}  TK</h4>
              <hr>
          </div>
          <strong> Visit for more Proudcts: <b class="">{{config('app.url')}}</b></strong>
          </div>
      </div>
      <div class="card-footer">

          <button class="btn btn-primary float-end" id="printButton" >Print</button>
        
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
