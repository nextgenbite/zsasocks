@extends('admin.layouts.app')
@push('css')
    <style>
        body{
            font-size: .9rem
        }
    </style>
@endpush
@section('content')
<div class="pagetitle">
    <h1>{{$title[0]}}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
        <li class="breadcrumb-item active">POS</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="card text-center">
                <div class="card-body mt-4"> 
    
    
    
    <div class="table-responsive">
            <table class="table table-bordered border-primary mb-0">
                <thead>
                    <tr>
                        <th>Model</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>SubTotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
    
                @php
                $allcart = Cart::content();
                @endphp
                <tbody>
                    @foreach($allcart as $cart)
                    <tr>
                        <td>{{ $cart->name }}
                            <br>
                        <small style="font-size:.6rem">Color:{{ ($cart->options->color ?  : '')}}</small>
                            <br>
                        <small style="font-size:.6rem">Size:{{ ($cart->options->size ?  : '')}}</small>
                        
                        </td>
                        <td>
           <form method="post" action="{{ url('/admin/pos/cart-update/'.$cart->rowId) }}">
           @csrf
    
        <input type="number" name="qty" value="{{ $cart->qty }}" style="width:40px;" min="1">
     <button type="submit" class="btn btn-sm btn-success" style="margin-top:-2px ;"> <i class="bi bi-check"></i> </button>   
    
       </form> 
                        </td>
                        <td>{{ $cart->price }}</td>
                        <td>{{ $cart->price*$cart->qty }}</td>
         <td> <a href="{{ url('/admin/pos/cart-remove/'.$cart->rowId) }}" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
    
        <div class="bg-primary">
            <br>
            <p style="font-size:16px; color:#fff"> Quantity : {{ Cart::count() }} </p>
            <p style="font-size:16px; color:#fff"> SubTotal : {{ Cart::subtotal() }} </p>
            <p style="font-size:16px; color:#fff"> shipping Cost : <span id="shipping-cost">0</span> </p>
            <p style="font-size:16px; color:#fff"> Discount : <span id="discount">0</span> </p>
            <p class="text-center"><h2 class="text-white"> Total </h2> <h1 class="text-white"><input  type="number" name="update_total" value="{{Cart::total()}}" class="form-control text-center px-4"></h1>   </p>
             <br>
        </div>
    
     <br>
        <form id="myForm" method="post" action="{{ url('/create-invoice') }}" class=" text-start">
            @csrf
            <input type="hidden" name="total">
            <input type="hidden" name="shipping_cost">
            <input type="hidden" name="discount">
            <div class="form-group" style="padding-bottom: 15px;">
                <label for="customer_name">আপনার নাম </label>
                <input 
                    name="customer_name" required type="text" class="form-control  @error('customer_name') is-invalid @enderror " aria-describedby="customer_name"
                    placeholder="আপনার নাম লিখুন">
                    @error('customer_name')
                    <div  id="customer_name" class="invalid-feedback">
                        {{ $message }}
                      </div>
                @enderror
            </div>

            <div class="form-group" style="padding-bottom: 15px;">
                <label for="customer_address">আপনার ঠিকানা</label>
                <input
                    
                    name="customer_address" required type="text" class="form-control  @error('customer_address') is-invalid @enderror"
                    placeholder="আপনার ঠিকানা লিখুন">
                    @error('customer_address')
                    <div id="customer_address" class="invalid-feedback">
                        {{ $message }}
                      </div>
                @enderror
            </div>

            <div class="form-group" style="padding-bottom: 15px;">
                <label for="customer_phone">আপনার মোবাইল</label>
                <input
                    name="customer_phone" required="" type="text"  class="form-control  @error('customer_phone') is-invalid @enderror"
                    pattern="\d*" maxlength="11" minlength="11" placeholder="আপনার মোবাইল লিখুন">
                    @error('customer_phone')
                    <div id="customer_phone" class="invalid-feedback">
                        {{ $message }}
                      </div>
                @enderror
            </div>

            <div class="form-group" style="padding-bottom: 15px;">
                <label for="shipping_method">ডেলিভারি জোন</label>
                <select id="shipping_id" name="shipping_type" required="required" class="form-control  @error('shipping_type') is-invalid @enderror"
                    >
                    <option selected="" disabled="">আপনার ডেলিভারি জোন সিলেক্ট করুন</option>
                    @forelse ($shipping_cost as $item)
                        
                    <option class="text-capitalize" value="{{$item->cost}}">{{$item->title. ' '. $item->cost}} TK</option>
                    @empty
                        
                    @endforelse
                </select>

                @error('shipping_type')
                <div id="validationServer05Feedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
            @enderror
            </div>

            <div class="form-group" style="padding-bottom: 15px;">
                <label for="customer_address">ডেলিভারি নোট (যদি থাকে)</label>
                <input
                    
                    name="customera_note"  type="text" class="form-control"
                    placeholder="ডেলিভারি নোট লিখুন"> 
            </div>
        
            <button class="btn btn-primary ">Create Invoice</button>
    
    
        </form>
    
    
    
    
    
    
                                       
     
                </div>                                 
            </div> <!-- end card -->
    
                                    
    
                                </div> <!-- end col-->
    
                                <div class="col-lg-6 col-xl-6">
                                    <div class="card">
                                        <div class="card-body mt-4"> 
                                               
    
        <!-- end timeline content-->
    
        <div class="tab-pane" id="settings">
    
    <div class="table-responsive ps ps--theme_default">

        <table class="table dt-responsive nowrap table-striped table-bordered table table-striped datatable  w-100">
                     <thead>
                         <tr>
                             <th>Image</th> 
                             <th>Model</th>
                             <th>Color</th> 
                             <th>Size</th> 
                              <th> </th> 
                         </tr>
                     </thead>
                 
 
     <tbody>
         @foreach($product as $key=> $item)
         <tr>

             <td> <img src="{{ asset($item->product_image) }}" style="width:50px; height: 40px;"> </td>
             <td>{{ $item->sku }}</td>
             <td>
                <ul
                class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                @foreach (json_decode($item->color) as $key => $color)
                <li>
                <input type="radio" id="color" name="select_color"
                value="{{ $color }}">
                <label for="1-{{ $color }}">{{ $color }}</label>
                </li>
                @endforeach
                
                </ul>   
            </td>
             <td>
                <ul
                class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                @foreach (json_decode($item->size) as $key => $size)
                <li>
                <input type="radio" id="1-{{ $size }}" name="select_size"
                value="{{ $size }}">
                <label for="1-{{ $size }}">{{ $size }}</label>
                </li>
                @endforeach
                
                </ul>   
            </td>
             
                          <td>
 <form method="post" action="{{ route('admin.addToCart') }}">
     @csrf
     <input type="hidden" name="id" value="{{ $item->id }}">
     <input type="hidden" name="name" value="{{ $item->sku }}">
     <input type="hidden" name="qty" value="1">
     <input type="hidden" name="color" >
     <input type="hidden" name="size" >
    
                <button type="submit" class="btn btn-outline-primary" > <i class="bi bi-bag-plus"></i> </button> 
                
                
            </form>
        </td> 
         </tr>
         @endforeach
     </tbody>
                 </table>
    </div>
    
    
        
        </div>
        <!-- end settings content-->
        
                                           
                                        </div>
                                    </div> <!-- end card-->
    
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->
  </section>

@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
//         function updateTotal() {
//     let price = parseInt('{{ Cart::total() }}');
//     let updatePrice = parseInt($('input[name="update_total"]').val());
//     let shipping = parseFloat($('#shipping_id').val()) || 0;  // Default to 0 if shipping is not selected

//     let discount = price - updatePrice;
//     $('#discount').text(discount);
//     $('input[name="discount"]').val(discount);

//     let newTotal = updatePrice + shipping;
//     $('input[name="update_total"]').val(newTotal);
//     $('input[name="total"]').val(newTotal);
//     $('#total').text(newTotal);
// }
function updateTotal() {
            let shipping = parseFloat($('#shipping_id').val()) || 0;  // Default to 0 if shipping is not selected
    let price = parseInt('{{ Cart::total() }}') + shipping;
    let updatePrice = parseInt($('input[name="update_total"]').val());

    let discount = price - updatePrice;
    $('#discount').text(discount);
    $('input[name="discount"]').val(discount);

    let newTotal = updatePrice ;
    $('input[name="update_total"]').val(newTotal);
    $('input[name="total"]').val(parseInt('{{ Cart::total() }}'));
    $('#total').text(newTotal);
}

// Handle changes to the total input
$(document).on('change', 'input[name="update_total"]', function() {
    updateTotal();
});

// Handle changes to the shipping ID
$(document).on('change', '#shipping_id', function() {
    let shippingCost = parseFloat($(this).val());
    $('#shipping-cost').text(shippingCost);
    $('input[name="shipping_cost"]').val(shippingCost);

    updateTotal();
});

    // Handle changes to the shipping ID
    $(document).on('change', 'input[name="select_color"]', function() {
        let val = $(this).val();
        $('input[name="color"]').val(val)
    });
    $(document).on('change', 'input[name="select_size"]', function() {
        let val = $(this).val();
        $('input[name="size"]').val(val)
    });
});

    
</script>
@endpush