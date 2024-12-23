<a href="/" class="nav-box-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="la la-shopping-cart d-inline-block nav-box-icon"></i>
    <span class="nav-box-text d-none d-xl-inline-block">Cart</span>
                                                    <span class="nav-box-number">{{$data['count'] ?? 0}}</span>
                                            </a>
<ul class="dropdown-menu dropdown-menu-right px-1">
    @if(isset($data['content']) && $data['count']  > 0 )
        
    <li>
        <div class="dropdown-cart px-0">
                                                                                                                                <div class="dc-header">
                        <h3 class="heading heading-6 strong-700">Cart Items</h3>
                    </div>
                   
                    <div class="dropdown-cart-items c-scrollbar">
                                        @forelse ($data['content'] as $item)
                                            
                                        <div class="d-flex align-items-center">
                                            <div class="dc-image">
                                                <a href="{{url('product/'. $item->slug)}}">
                                                    <img src="{{asset($item->options->image)}}" class="img-fluid ls-is-cached lazyloaded" alt="Foot Brush">
                                                </a>
                                            </div>
                                            <div class="dc-content">
                                                <span class="d-block dc-product-name text-capitalize strong-600 mb-1">
                                                    <a href="{{url('product/'.$item->slug)}}">
                                                        {{$item->name . ($item->options->size ? '-' . $item->options->size : '') . ($item->options->color ? '-' . $item->options->color : '')}}

                                                    </a>
                                                </span>
        
                                                <span class="dc-quantity">x{{$item->qty}}</span>
                                                <span class="dc-price">Tk{{$item->price}}</span>
                                            </div>
                                            <div class="dc-actions">
                                                <button id="{{$item->rowId}}" onclick="removeFromCart(this.id)">
                                                    <i class="la la-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @empty
                                            
                                        @endforelse                                                                                                                                                                                        <div class="dc-item">
                            </div>
                                                                                    </div>
                    <div class="dc-item py-3">
                        <span class="subtotal-text">Subtotal</span>
                        <span class="subtotal-amount">Tk{{$data['total']}}</span>
                    </div>
                    <div class="py-2 text-center dc-btn">
                        <ul class="inline-links inline-links--style-3">
                            <li class="px-1">
                                <a href="{{url('/checkout')}}" class="link link--style-1 text-capitalize btn btn-base-1 px-3 py-1">
                                    <i class="la la-shopping-cart"></i> View cart
                                </a>
                            </li>
                                                                                            </ul>
                    </div>
                                                                                                                    </div>
    </li>
    @else
    <li class="text-center font-bold">Cart item not found</li>

    @endif
</ul>