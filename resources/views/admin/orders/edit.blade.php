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
          <form method="post" action="{{URL::to('/admin/'.$title[1], $order->id)}} " class="container-fluid" id="printArea">
            @csrf
            @method('put')
            <div class=" position-relative">
                <img style="left: 0;top:-20px;width: 6rem" class=" position-absolute" src="{{asset('logo-2.png')}}"  alt="" >
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
                    <p class="mb-0 mt-2  text-left  ">Order Status : <b class="{{($order->status == 0) ? 'text-danger' : (($order->status == 1) ? 'text-info' : 'text-success')}}">{{$order->status == 0? 'Pending' : ($order->status == 1? 'Confirm': 'Delivered')}}</b></p>
              </div>
            </div>

          <div class="d-flex justify-content-between">
            <div class=" pl-0">
                <p class="mt-2 mb-0 text-bold"><b>From</b></p>
                <p class=" text-bold">Quick BD Box (qbdbox.com)</p>
                <p class="">01777666178</p>
                <p>South Banasree,<br>Dhaka, Bangladesh.</p>
        
            </div>
            <div class=" pr-0">
                <p class="mt-2 mb-0 text-left"><b>Invoice to</b></p>
                <p   class="text-left">Customer : <b>{{$order->name}}</b></p>
                <p  class="text-left">Mobile No.:{{$order->phone}}</p>
                <p  class="text-left">Address :{{$order->address}}</p>
                {{-- <p  class="text-left">Thana :{{$order->thana}}</p>
                <p  class="text-left">District :{{$order->district}}</p> --}}
                <p  class="text-left">Note:{{$order->notes}}</p>
            </div>
        </div>
          <div class="text-endmt-2 d-flex justify-content-center w-100">
              <div class="table-responsive table-bordered  w-100" >
                <table class="table">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Image</th>
                          <th>Quantity</th>
                          <th>Color</th>
                          <th class="text-end">Unit cost</th>
                          <th class="text-end">Total</th>
                          <th class="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($order->orderitem()->get() as $key=>$item)

                      <tr class="text-end">
                          <td class="text-left">{{$key+1}}</td>
                          <td class="text-left"> {{$item->product->product_name}} <br>
                            @if (isset($item->size))
                            Size: <small>{{$item->size}}</small>
                            @endif
                        </td>
                       
                          <td><img style="width: 4rem; height:4rem" src="{{asset($item->product->product_image)}} " class="img-rounded" width="100px" alt="sadd"> </td>
                          <td><input type="hidden" name="itemids[]" value="{{$item->id}}"> <input  type="number" data-price="{{$item->price}}" name="quantity[]" value="{{$item->qty}}" class="form-control w-50 text-center"> </td>
                          <td>
                           
                          <input  type="text" name="color[]" value="{{$item->color}}" class="form-control w-50 text-center">
                           
                          
                         </td>
                          <td>{{$item->price}}</td>
                          <td><div class="item-total">{{$item->price * $item->qty}}</div></td>
                          <td>            <a href="{{ URL::to('/admin/order/item/remove/' . $item->id) }}" class="btn btn-outline-danger btn-sm">Delete</a><td>
                      </tr>
                      @endforeach

                    </tbody>
                </table>
              <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
          </div>
          <div class="text-endmt-2 w-100">

              <p class="text-end">Subtotal : {{$order->amount}} TK</p>
              <p class="text-end">Delivery Cost : {{$order->delivery_type}} TK</p>
              <p class="text-end"> Discount : {{$order->coupon}} TK</p>
              <h4 class="text-end mb-5">Total : <input  type="number" name="total" value="{{($order->delivery_type+$order->amount) -$order->coupon}}" class="form-control float-end w-25 text-center mx-1"></h4>
              <hr>
          </div>
          </div>
      </div>
      <div class="card-footer">

          <button class="btn btn-primary float-end" >Update</button>
        
      </div>
      </div>
    </div>
  </div>

    </section>

@endsection
@push('scripts')
<script>

 $(document).ready(function() {
    $(document).on('change', 'input[name="quantity[]"]',  function(){
        let price = $(this).data('price');
        let qty = parseInt($(this).val());
        let shipping = parseInt('{{$order->delivery_type}}');
        $(this).closest('tr').find('.item-total').text(price * qty)
$('input[name="total"]').val( (price * qty) +  shipping)
  });

})

 </script>
@endpush
