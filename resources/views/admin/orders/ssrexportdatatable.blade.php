@extends('admin.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.bootstrap5.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> --}}
  <style>
      table>:not(caption)>*>*{
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

                        {{-- <div class="form-group float-right" style="width: 8rem">
                            <select class="form-control form-control-sm" name="" id="">
                              <option selected disabled>  Action</option>
                              <option>export to excel</option>
                              <option>Confirm</option>
                              <option>Delivary</option>
                              <option id="deleteSelectedItems">Delete Selected Items</option>
                            </select>
                          </div> --}}

                    </div>
                    <div class="card-body">

                        <div class=" float-lg-end">
                            <select id="multi-select" class="form-select form-select-sm my-2" name="multi-select">
                                <option selected disabled>Action</option>

                                <option id="exportSelected" value="exportSelected">Excel</option>
                                <option value="1">Confirm</option>
                                <option value="0">Delivary</option>
                                <option id="deleteSelectedItems" value="deleteSelectedItems">Delete</option>
                            </select>
                        </div>
                        {{-- <div class="dropdown float-end">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Multiple record
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" id="exportSelected">export to excel</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Confirm</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Delivary</a>
                                        <a class="dropdown-item" href="javascript:void(0)" id="deleteSelectedItems">Delete</a>
                                    </div>
                                </div> --}}
                        <table class="table center-aligned-table display nowrap" width="100%"
                            id="myTable"style="font-size: .9rem">
                            <thead>

                                <tr>

                                    <th width="5%"><input type="checkbox" id="selectAll" /></th>
                                    <th>Phone</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Product Model</th>
                                    <th>Time</th>
                                    <th>Status</th>
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
            $('#example').DataTable({
                fixedHeader: true,
                responsive: true
            });
            var table = $('#myTable').DataTable({
                fixedHeader: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ url('/admin/order') }}",
                order: [
                    [0, 'desc']
                ],
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return `<input type="checkbox" class="checkbox" data-item-id="${row.id}">`;
                        },
                        orderable: false,
                        searchable: false
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
                            return parseInt(row.amount) + parseInt(row.delivery_type);
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
                        data: "created_at"
                    },
                    {
                        data: "status",
                        render: function(data, type, row, meta) {
                            var url = '{{ url('/') }}';
                            if (data == 1) {
                                return '<a href="#" class="badge bg-info"><i class="bi bi-check-circle me-1"></i>Confirm</a>';
                            } else if (data == 2) {
                                return '<a href="' + url + '/admin/order/' + row.id +
                                    '/panding" class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Delivered</a>';
                            } else {
                                return '<a href="' + url + '/admin/order/' + row.id +
                                    '/panding" class="badge bg-warning"><i class="bi bi-exclamation-octagon me-1"></i>Pending</a>';
                            }
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            var buttons = '<div class="btn-group">';
                            var CSRF_TOKEN = '{{ csrf_token() }}';
                            var URL = '{{ URL::to('/') }}';

                            if (row.status == 0) {
                                buttons += '<a href="javascript:void(0)" data-url="' + URL +
                                    '/admin/order/' + row.id +
                                    '/confirm" id="confirmBtn" class="btn btn-outline-info btn-sm text-sm">Confirm</a>';
                            } else if (row.status == 1) {
                                buttons += '<a href="javascript:void(0)" data-url="' + URL +
                                    '/admin/order/' + row.id +
                                    '/delivered" id="delivaryBtn" class="btn btn-outline-success btn-sm text-sm">Delivery</a>';
                            }

                            buttons += '<a href="' + URL + '/admin/order/' + row.id +
                                '" class="btn btn-outline-secondary btn-sm">Details</a>';
                            buttons += '<a id="delete" href="' + URL + '/admin/order/' + row.id +
                                '" class="btn btn-outline-danger btn-sm">Remove</a>';
                            buttons += '<form id="delete-form" action="' + URL + '/admin/order/' +
                                row.id + '" method="post" class="d-none">';
                            buttons += '<input type="hidden" name="_token" value="' + CSRF_TOKEN +
                                '">';
                            buttons += '<input type="hidden" name="_method" value="DELETE">';
                            buttons += '</form> </div>';

                            return buttons;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
            });
            $('body').on('click', '#confirmBtn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                var trObj = $(this).closest('tr');

                // Make an Ajax request
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        // Handle success response here
                        $.toast({
                            heading: 'Success',
                            text: 'Order is confirm successfully!',
                            position: ('top-right'),
                            showHideTransition: 'slide',
                            icon: 'success',
                            loaderBg: '#d9534f'
                        });
                        trObj.html($(data.html).html());
                    },
                    error: function(error) {
                        // Handle error response here
                        console.error(error);
                    }
                });
            });
            $('body').on('click', '#delivaryBtn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                var trObj = $(this).closest('tr');

                // Make an Ajax request
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        // Handle success response here
                        $.toast({
                            heading: 'Success',
                            text: 'Order is Delivered!',
                            position: ('top-right'),
                            showHideTransition: 'slide',
                            icon: 'success',
                            loaderBg: '#d9534f'
                        });
                        trObj.html($(data.html).html());
                    },
                    error: function(error) {
                        // Handle error response here
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
                                const d = new Date();
                                const year = d.getFullYear();
                                const month = d.getMonth();
                                const date = d.getDate();
                                const name = date + '-' + month + '-' + year +
                                    '_Order_report.xlsx';
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
                        $.ajax({
                            url: '{{ route('multiple.order.delete') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                selected_ids: selectedItems
                            },
                            success: function(data) {
                                // Handle success (e.g., show a success message)
                                alert(data.message);
                                table.draw(); // Reload the page or update the UI as needed
                            },
                            error: function(xhr, status, error) {
                                // Handle error (e.g., show an error message)
                                console.error(error);
                            }
                        });
                        break
                    default:
                        break;
                }



            });


        });
    </script>
@endpush
