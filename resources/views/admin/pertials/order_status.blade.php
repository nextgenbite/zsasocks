@switch($item->status)
        @case(0)
        <div class="badge bg-danger"><i class="bi  bi-exclamation-octagon me-1"></i>Panding</div>
        @break
        @case(1)
        <div class="badge bg-info"><i class="bi bi-check-circle me-1"></i>Confirm</div>
        @break
        @case(2)
        <div class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Delivered</div>

        @break
        @case(3)
        <div class="badge bg-secondary"><i class="bi  bi-check-circle me-1"></i>Sent</div>
        @break
        @case(4)
        <div class="badge bg-danger"><i class="bi  bi-exclamation-octagon me-1"></i>Returned</div>
        @break
        @case(5)
        <div class="badge bg-warning"><i class="bi  bi-exclamation-octagon me-1"></i>Canceled</div>
        @break
        @default
        <div class="badge bg-danger"><i class="bi  bi-exclamation-octagon me-1"></i>Panding</div>
        @endswitch