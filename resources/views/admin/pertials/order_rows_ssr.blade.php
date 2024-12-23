
<tr>
    <td></td>
    <td>
        <input type="checkbox" class="itemCheckbox" data-item-id="{{ $item->id }}">
        {{-- <input type="checkbox" name="selected_ids[]" value="{{ $item->id }}"> --}}
    </td>
    <td>@include('admin.pertials.order_status', ['item' =>$item])</td>
    <td>{{'8'+ $item->id }}</td>
    <td><small>{{ $item->phone }}</td>
    <td><small>{{ $item->name }}</td>
    <td class="text-center">{{ ($item->amount + $item->delivery_type) -  $item->coupon}}</td>
    <td>
        @foreach ($item->orderitem()->get() as $key => $orderItem)
           {{ $orderItem->product->sku }}
        @endforeach
    </td>
    <td>
        @foreach ($item->orderitem()->get() as $key => $orderItem)
           {{ $orderItem->color }}
        @endforeach
    </td>
    <td>
        @foreach ($item->orderitem()->get() as $key => $orderItem)
           {{ $orderItem->size }}
        @endforeach
    </td>
    <td>{{ $item->created_at->isToday() ? $item->created_at->format('h:ia') : $item->created_at->format('d/m/y') }}</td>

    <td class="noExl">
        <div class="dropdown">
            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Action
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @switch($item->status)
                    @case(0)
                    <li><a class="dropdown-item" href="javascript:void(0)" data-url="{{ URL::to('/admin/order/' . $item->id . '/confirm') }}" id="confirmBtn">Confirm</a></li>
                    <li><a class="dropdown-item text-danger" href="javascript:void(0)" data-url="{{URL::to('/admin/'.$title[1].'/'.$item->id.'/cancel')}}" id="cancelBtn">Cancel</a></li>
                    @break
                    @case(1)
                    <li><a class="dropdown-item" href="javascript:void(0)" data-url="{{ URL::to('/admin/order/' . $item->id . '/sent') }}" id="sentBtn">Sent To Courier</a></li>
                    <li><a class="dropdown-item text-danger" href="javascript:void(0)" data-url="{{URL::to('/admin/'.$title[1].'/'.$item->id.'/cancel')}}" id="cancelBtn">Cancel</a></li>
                    @break
                    @case(3)

                    <li><a class="dropdown-item" href="javascript:void(0)" data-url="{{ URL::to('/admin/order/' . $item->id . '/delivered') }}" id="deliveryBtn">Delivery</a></li>
                    <li><a class="dropdown-item text-danger" href="javascript:void(0)" data-url="{{ URL::to('/admin/order/' . $item->id . '/return') }}" id="returnBtn">Return</a></li>
                    @break
                    @default

                @endswitch
              <li><a class="dropdown-item" href="{{ URL::to('/admin/order/' . $item->id) }}">View</a></li>
              <li><a class="dropdown-item" href="{{URL::to('/admin/'.$title[1].'/'.$item->id.'/edit')}}">Edit</a></li>
              <li><hr class="dropdown-divider"></li>

              <li>
                <a id="delete" href="{{URL::to('/admin/'.$title[1].'/'.$item->id)}}" class="dropdown-item text-bg-danger">Remove</a>
                <form id="delete-form"  action="{{URL::to('/admin/'.$title[1].'/'.$item->id)}}" method="post" class="d-none">
                    @csrf
                    @method('DELETE')
                    </form>
            </li>

            </ul>
          </div>


    </td>
</tr>
