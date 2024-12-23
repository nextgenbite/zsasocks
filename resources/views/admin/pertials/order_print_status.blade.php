@switch($item->status)
        @case(0)
        <span class="text-danger">Panding</span>
        @break
        @case(1)
        <span class="text-info">Confirm</span>
        @break
        @case(2)
        <span class="text-success">Delivered</span>

        @break
        @case(3)
        <span class="text-primary">Sent</span>
        @break
        @case(4)
        <span class="text-danger">Returned</span>
        @break
        @case(5)
        <span class="text-danger">Canceled</span>
        @break
        @default
        <span class="text-danger">Panding</span>
        @endswitch