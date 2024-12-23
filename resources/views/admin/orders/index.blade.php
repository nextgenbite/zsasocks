@extends('admin.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.bootstrap5.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> --}}
    <style>
        table>:not(caption)>*>* {
            padding: .5rem .2rem !important;
        }
    </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Order List</h2>

                        <form action="{{ route('order.excel.update') }}" enctype="multipart/form-data" method="post"
                            class="d-flex">
                            @method('post')
                            @csrf
                            <div class="form-group">
                                <label for="">Excel upload</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control form-control-sm " placeholder=""
                                        name="excel_file" aria-label="Example text with button addon"
                                        aria-describedby="button-addon1">
                                    <button class="btn btn-sm btn-outline-secondary" type="submit"
                                        id="button-addon1">Upload</button>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="card-body">

                        <div class=" float-lg-end">

                            <select id="multi-select" class="form-select form-select-sm my-2" name="multi-select">
                                <option selected disabled>Action</option>
                                <option>Choose...</option>

                                <option id="exportSelected" value="exportSelected">Excel</option>
                                {{-- <option value="1">Confirm</option>
                                <option value="0">Delivary</option> --}}
                                <option id="printSelectedItems" value="printSelectedItems">Print</option>
                                <option id="deleteSelectedItems" value="deleteSelectedItems">Delete</option>
                            </select>
                        </div>

                        <table class="table center-aligned-table display nowrap" width="100%"
                            id="myTable"style="font-size: .9rem">
                            <thead>

                                <tr>

                                    <th></th>
                                    <th width="10%"><input type="checkbox" class="ms-1" id="selectAll" /></th>
                                    <th>Status</th>
                                    <th>Invoice</th>
                                    <th>Phone</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Time</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            {{-- @php
                                    $index = App\Models\Order::with('orderitem')->orderBy('id', 'DESC')->get();
                                @endphp --}}
                            <tbody id="orderTableBody">
                                {{-- @foreach ($index as $key => $item)
                                        @include('admin.pertials.order_export_rows', ['item' => $item])
                                    @endforeach --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>


                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
    <script>

        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                    "lengthMenu": [
                        [10, 25, 50, 100, 500],
                        [10, 25, 50, 100, 500]
                    ],
                    fixedHeader: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('/admin/order') }}",
                    order: [
                        [0, 'desc']
                    ],
                    "start": 0,
                    "length": 225,
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return ``;
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return `<input type="checkbox" class="checkbox ms-1" data-item-id="${row.id}">`;
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "status",
                            render: function(data, type, row, meta) {
                                switch (parseInt(row.status)) {
                                    case 0:
                                        return '<div class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Pending</div>';
                                    case 1:
                                        return '<div class="badge bg-info"><i class="bi bi-check-circle me-1"></i>Confirm</div>';
                                    case 2:
                                        return '<div class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Delivered</div>';
                                    case 3:
                                        return '<div class="badge bg-secondary"><i class="bi bi-check-circle me-1"></i>Sent</div>';
                                    case 4:
                                        return '<div class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Returned</div>';
                                    case 5:
                                        return '<div class="badge bg-warning"><i class="bi bi-exclamation-octagon me-1"></i>Canceled</div>';
                                    default:
                                        return '<div class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Pending</div>';
                                }
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return '8' + row.id;
                            }
                        },
                        {
                            data: "phone"
                        },
                        {
                            data: "name"
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return (parseInt(row.amount) + parseInt(row
                                    .delivery_type)) - row.coupon;
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "orderitem",
                            render: function(data, type, row, meta) {
                                var items = '';
                                data.forEach(function(orderitem) {
                                    items += orderitem.product.sku + ', ';
                                });
                                return items.slice(0, -2);
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "orderitem",
                            render: function(data, type, row, meta) {
                                var items = '';
                                data.forEach(function(orderitem) {
                                    items += orderitem.color + ', ';
                                });
                                return items.slice(0, -2);
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "orderitem",
                            render: function(data, type, row, meta) {
                                var items = '';
                                data.forEach(function(orderitem) {
                                    items += orderitem.size + ', ';
                                });
                                return items.slice(0, -2);
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "created_at",
                            orderable: false,
                            searchable: false
                        },

                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                var buttons = `<div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Action </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">`;

                                var CSRF_TOKEN = '{{ csrf_token() }}';
                                var URL = '{{ URL::to('/') }}';

                                switch (parseInt(row.status)) {
                                    case 0:
                                        buttons +=
                                            `<li><a class="dropdown-item" href="javascript:void(0)" data-url="${URL}/admin/order/${row.id}/confirm" id="confirmBtn">Confirm</a></li>
                                        <li><a class="dropdown-item text-danger" href="javascript:void(0)" data-url="${URL}/admin/{{ $title[1] }}/${row.id}/cancel" id="cancelBtn">Cancel</a></li>`;
                                        break;
                                    case 1:
                                        buttons +=
                                            `<li><a class="dropdown-item text-info" href="javascript:void(0)" data-url="${URL}/admin/order/${row.id}/sent" id="sentBtn">Sent To Courier</a></li>
                                        <li><a class="dropdown-item text-danger" href="javascript:void(0)" data-url="${URL}/admin/{{ $title[1] }}/${row.id}/cancel" id="cancelBtn">Cancel</a></li>`;
                                        break;
                                    case 3:
                                        buttons +=
                                            `<li><a class="dropdown-item text-info" href="javascript:void(0)" data-url="${URL}/admin/order/${row.id}/delivered" id="deliveryBtn">Delivery</a></li>
                                            <li><a class="dropdown-item text-danger" href="javascript:void(0)" data-url="${URL}/admin/order/${row.id}/return" id="returnBtn">Return</a></li>
                                            `;
                                        break;
                                    default:
                                        break;
                                }

                                buttons += `<li><a class="dropdown-item" href="${URL}/admin/order/${row.id}">View</a></li>
                                <li><a class="dropdown-item" href="${URL}/admin/{{ $title[1] }}/${row.id}/edit">Edit</a></li>
                                <li><a class="dropdown-item text-danger" id="delete" href="${URL}/admin/{{ $title[1] }}/${row.id}">Remove</a>
                                    <form id="delete-form" action="${URL}/admin/{{ $title[1] }}/${row.id}" method="post" class="d-none">
                                        <input type="hidden" name="_token" value="${CSRF_TOKEN}">
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </li>
                            </ul></div>`;

                                return buttons;
                            },
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

            $(document).on('click', '#confirmBtn, #deliveryBtn, #sentBtn, #returnBtn, #cancelBtn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                var trObj = $(this).closest('tr');

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        Swal.fire({
                            position: "top-end",
                            text: data.msg,
                            icon: 'success',
                            toast: true,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        trObj.html($(data.html).html()); // Replace only inner HTML content
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });


            $('#selectAll').click(function(e) {
                var table = $(e.target).closest('table');
                $('td input:checkbox', table).prop('checked', this.checked);
            });


            // multiple delete data
            $('#multi-select').on('change', function() {
                var selectedItems = $('.checkbox:checked').map(function() {
                    return $(this).data('item-id');
                }).get();

                if (selectedItems.length === 0) {
                    alert('Please select at least one item.');
                    return;
                }
                console.log(selectedItems);
                let url = '';
                switch ($(this).find(":selected").val()) {
                    case 'exportSelected':
                        $.ajax({
                            url: '{{ route('order.export.selected') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                selected_ids: selectedItems
                            },
                            cache: false,
                            xhrFields: {
                                responseType: 'blob'
                            },
                            success: function(response) {
                                // const d = new Date();
                                // const year = d.getFullYear();
                                // const month = d.getMonth();
                                // const date = d.getDate();
                                // const name = date + '-' + month + '-' + year +
                                const name =
                                    "{{ Carbon\Carbon::now()->format('d-M-Y') }}_Order_report.xlsx";
                                var link = document.createElement('a');
                                link.href = window.URL.createObjectURL(response);
                                link.download = name;
                                link.click();
                            },
                            error: function(xhr, status, error) {
                                // Handle errors
                                console.error('Export failed:', error);
                            }
                        });
                        break;
                    case 'deleteSelectedItems':

                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '{{ route('multiple.order.delete') }}',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        selected_ids: selectedItems
                                    },
                                    success: function(data) {
                                        // Handle success (e.g., show a success message)
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "Your file has been deleted.",
                                            icon: "success"
                                        });
                                        table
                                            .draw(); // Reload the page or update the UI as needed
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle error (e.g., show an error message)
                                        console.error(error);
                                    }
                                });

                            }
                        });

                        break
                    case 'printSelectedItems':
                        window.location.href =
                            '{{ route('order.print.selected', ['selected_ids' => '']) }}' + selectedItems
                            .join(',');
                        break
                    default:
                        break;
                }



            });


        });
    </script>
@endpush
