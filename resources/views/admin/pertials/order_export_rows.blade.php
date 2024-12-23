{{--
<th>Note</th>
<th>Contact Name</th>
<th>Contact Phone</th>
<th>Product Title</th>
<th>Color & Size</th>
<th>Quantity</th> --}}

<tr>
    <td></td>

    <td>
        <input type="checkbox" class="itemCheckbox" data-item-id="{{ $item->id }}">
        {{-- <input type="checkbox" name="selected_ids[]" value="{{ $item->id }}"> --}}
    </td>
    
    <td>8{{ $item->id }}</td>
    <td><small>{{ $item->name }}</small></td>
    <td>{{ $item->phone }}</td>
    <td class="text-center">{{ $item->amount + $item->delivery_type }}</td>
    <td>
        @foreach ($item->orderitem()->get() as $key => $orderItem)
            <small>{{ $orderItem->product->product_name }}</small>
        @endforeach
    </td>

    @if ($item->status == 1)
        <td>
            <div class="badge badge-info">Confirm</div>
        </td>
    @elseif ($item->status == 2)
        <td><a href="{{ URL::to('/admin/order/' . $item->id . '/panding') }} " class="badge badge-success">Delivered </a>
        </td>
    @else
        <td><a href="{{ URL::to('/admin/order/' . $item->id . '/panding') }} " class="badge badge-warning">Pending </a>
        </td>
    @endif
    <td>
        <div class="btn-group">

            @if ($item->status == 0)
                <a href="javascript:void(0)" data-url="{{ URL::to('/admin/order/' . $item->id . '/confirm') }}"
                    id="confirmBtn" class="btn btn-outline-info  btn-sm text-sm">Confirm</a>
            @elseif ($item->status == 1)
                <a href="javascript:void(0)" data-url="{{ URL::to('/admin/order/' . $item->id . '/delivered') }}"
                    id="delivaryBtn" class="btn btn-outline-success btn-sm text-sm">Delivery</a>
            @endif
            <a href="{{ URL::to('/admin/order/' . $item->id) }}" class="btn btn-outline-secondary btn-sm">View Details</a>
            <form action="{{ URL::to('/admin/order/' . $item->id) }}" method="post">
                <input type="submit" onclick="return confirm('Are you sure?')" name="submit"
                    class="btn btn-outline-danger btn-sm" value="Remove">
                @csrf
                @method('DELETE')
            </form>
        </div>


    </td>
</tr>
