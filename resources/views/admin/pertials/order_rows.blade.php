<tr>
    <td class="noExl"><input type="checkbox" class="checkbox"></td>
    <td>8{{ $item->id }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->phone }}</small></td>
    <td class="text-center">{{formatCurrency(($item->delivery_type + $item->amount) -$item->coupon)}}</td>


    <td>
        @foreach ($item->orderitem as $orderItem)
            <small>{{ $orderItem->qty }}</small>
        @endforeach
    </td>
    <td><small>{{ $item->created_at }}</small></td>
    <td>
        @include('admin.pertials.order_status', ['item' =>$item])
    </td>
    <td class="noExl">
        <div class="dropdown">
            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Action
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @switch($item->status)
                    @case(0)
                    <li><a class="dropdown-item" href="javascript:void(0)" data-url="{{ URL::to('/admin/order/' . $item->id . '/confirm') }}" id="confirmBtn">Confirm</a></li>
                    <li><a class="dropdown-item text-danger" href="javascript:void(0)" data-url="{{URL::to('/admin/'.$title[1].'/'.$item->id.'/cancel')}}" id="canceleBtn">Cancel</a></li>
                    @break
                    @case(1)
                    <li><a class="dropdown-item" href="javascript:void(0)" data-url="{{ URL::to('/admin/order/' . $item->id . '/sent') }}" id="sentBtn">Sent To Courier</a></li>
                    <li><a class="dropdown-item text-danger" href="javascript:void(0)" data-url="{{URL::to('/admin/'.$title[1].'/'.$item->id.'/cancel')}}" id="canceleBtn">Cancel</a></li>
                    @break
                    @case(3)

                    <li><a class="dropdown-item" href="javascript:void(0)" data-url="{{ URL::to('/admin/order/' . $item->id . '/delivered') }}" id="delivaryBtn">Delivery</a></li>
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
