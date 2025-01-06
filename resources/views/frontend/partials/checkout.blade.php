<style>

.input-group--style-2 .form-control {
  border-left: 0;
  border-right: 0;
}

.input-group--style-2 .form-control:focus {
  background: transparent;
}

.input-group--style-2 .input-group-btn > .btn {
  border-radius: 50%;
  background: transparent;
  border-color: #e6e6e6;
  color: #818a91;
  font-size: 1rem;
  padding-top: 0.6875rem;
  padding-bottom: 0.6875rem;
  cursor: pointer;
}

.input-group--style-2 .input-group-btn > .btn[disabled] {
  color: #eceeef;
}

.input-group--style-2 .input-group-btn > .btn:focus {
  box-shadow: none;
}

.input-group--style-2 .input-group-btn:not(:first-child) > .btn {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  border-left-color: #FFF;
}

.input-group--style-2 .input-group-btn:not(:last-child) > .btn {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  border-right-color: #FFF;
}
.table-cart{
    font-size: 14px;
}
</style>

<div class="container">
    <div class="row cols-xs-space cols-sm-space cols-md-space">
        <div class="col-xl-6">

            <div class="">
                {{-- <h3 class="card-heading p-3">
                    <center>Billing address</center>
                </h3> --}}
                <div class="col-sm-12">
                    <form class="form-default php-email-form" role="form" id="orderForm" action="{{ url('/placeOrder') }}" method="POST">
                        @csrf
                        <div class="form-group" style="padding-bottom: 15px;">
                            <label for="customer_name">Full Name</label>
                            <input
                                name="customer_name" required="" value=" {{ old('customer_name', auth()->check() ?  auth()->user()->name : '') }}" type="text" class="form-control  @error('customer_name') is-invalid @enderror " aria-describedby="customer_name"
                                >
                                @error('customer_name')
                                <div  id="customer_name" class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                            @enderror
                        </div>

                        <div class="form-group" style="padding-bottom: 15px;">
                            <label for="customer_phone">Mobile No.</label>
                            <input
                                
                                name="customer_phone" required="" type="text" value="{{ old('customer_phone', auth()->check() ?  auth()->user()->phone : '') }}" class="form-control  @error('customer_phone') is-invalid @enderror"
                                >
                                @error('customer_phone')
                                <div id="customer_phone" class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                            @enderror
                        </div>
                        <div class="form-group" style="padding-bottom: 15px;">
                            <label for="customer_email">Email</label>
                            <input
                                
                                name="customer_email" required="" type="text" value="{{ old('customer_email', auth()->check() ?  auth()->user()->email : '') }}" class="form-control  @error('customer_email') is-invalid @enderror"
                                >
                                @error('customer_email')
                                <div id="customer_email" class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                            @enderror
                        </div>

                        <div class="form-group" style="padding-bottom: 15px;">
                            <label for="customer_address">Address</label>
                            <textarea name="customer_address" required="" class="form-control  @error('customer_address') is-invalid @enderror">
                                {{auth()->check() ?  auth()->user()->address : ''}}
                            </textarea>
               
                                @error('customer_address')
                                <div id="customer_address" class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                            @enderror
                        </div>



                        <div class="form-group" style="padding-bottom: 15px;">
                            <label for="shipping_method">Delivary Zone</label>
                            <select id="shipping_id" name="shipping_type" required="required" class="form-control  @error('shipping_type') is-invalid @enderror"
                                >
                                <option selected="" disabled="">Select a zone</option>
                                @forelse ($data['shipping_cost'] as $item)
                                    
                                <option class="text-capitalize" value="{{$item->cost}}">{{$item->title. ' '. formatCurrency($item->cost)}}</option>
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
                            <label for="customer_address">Delivery Note (optional)</label>
                            <input name="customera_note"  type="text" class="form-control"> 
                        </div>

                        <div class="form-group pb-2">
                            <button type="submit" class="btn btn-primary w-100 rounded" id="order-btn"> 
                                {{-- <i class='bi bi-arrow-repeat fa-spin mr-2 '></i>  --}}
                               Order Place</button>
                             
                        {{-- <div class="form-group pb-2" >
                            <a href="{{ url('/') }}" class="btn btn-outline-info btn-block"> আরো শপিং
                                করুন </a>
                        </div> --}}
                    </form>
                </div>

                </div>
            </div>
        </div>
        <div class="col-xl-6 ml-lg-auto">
            <div class="form-default bg-white p-4">
                <div class="">
                    <div class="">
                        <h6>Order Details</h6>
                        <hr>
                        <table class="table-cart table border-bottom">
                            <thead>
                                <tr>
                                    <th class="product-image "></th>
                                    <th class="product-name">Product</th>

                                    <th class="product-price d-none d-lg-table-cell">Price</th>
                                    <th class="product-quanity  d-md-table-cell">Quantity</th>
                                    <th class="product-total">Total</th>

                                    <th class="product-remove"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['content'] as $item)
                                    <tr class="cart-item">
                                        <td class="product-image ">
                                            <a href="{{ url('product/' . $item->slug) }}" class="mr-3">
                                                <img style="width: 50px" loading="lazy"
                                                    src="{{ asset($item->options->image) }}">
                                            </a>
                                        </td>

                                        <td class="product-name" data-title="Product" style="max-width: 200px;">
                                            <span
                                                class="pr-4 d-block">{{ $item->name . ($item->options->size ? '-' . $item->options->size : '') . ($item->options->color ? '-' . $item->options->color : '') }}.</span>
                                        </td>

                                        <td class="product-price d-none d-lg-table-cell">
                                            <span class="pr-3 d-block">{{ formatCurrency($item->price) }}</span>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[0]" style="width: 80px"
                                            class="form-control text-center" placeholder="1"
                                            value="{{ $item->qty }}" min="1" max="10"
                                            data-id="{{ $item->rowId }}"
                                            onchange="updateQuantity(this.dataset.id, this)">
                                    </td>


                                        <td class="product-total">
                                            <span>{{ formatCurrency($item->qty * $item->price) }}</span>
                                        </td>

                                        <td class="product-remove">
                                            <a href="javascript:void(0)" id="{{ $item->rowId }}"
                                                onclick="removeFromCartView(event,this.id)" class="text-end pl-4 btn btn-danger btn-sm rounded-circle">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="card ">
                <div class="card-body py-0">
       

                    <table class="table table-cart-review">

                        <tfoot>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td class="text-end">
                                    <span id="subtotal" class="strong-600">{{ formatCurrency($data['subtotal']) }}</span>
                                </td>
                            </tr>

                            <tr class="cart-discount">
                                <th class=" font-weight-normal">Discount</th>
                                <td class="text-end">
                                    <span id="total-discount" class="text-italic">{{formatCurrency($data['discount'])}}</span>
                                </td>
                            </tr>
                            <tr class="cart-shipping">
                                <th>Total Shipping</th>
                                <td class="text-end">
                                    <span id="shipping-cost" class="text-italic">{{formatCurrency(0)}}</span>
                                </td>
                            </tr>



                            <tr class="cart-total">
                                <th><span class="strong-600">Total</span></th>
                                <td class="text-end">
                                    <strong><span id="total">{{ formatCurrency($data['total']) }}</span></strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
