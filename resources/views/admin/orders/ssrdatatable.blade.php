@extends('admin.layouts.app')
@push('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css" />
    <!-- DataTables Column Visibility Button CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" />
@endpush
@section('content')
    <div class="pagetitle">
        <h1>{{ $title[0] }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('/admin/' . $title[1]) }}">{{ $title[0] }}</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">


        <div class="card">

            <div class="card-body">

                <div class="table-responsive p-4" style="font-size: .9rem">
                    <table class="table center-aligned-table " width="100%" id="myTable">
                        <thead>

                            <tr>

                                <th><input type="checkbox" id="selectAll"></th>
                                {{-- <th>a</th> --}}
                                <th>Invoice No.</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Amount</th>
                                <th>Note</th>
                                <th>Contact Name</th>
                                <th>Contact Phone</th>
                                <th>Product Model</th>
                                <th>Color & Size</th>
                                <th>Quantity</th>
                                <th>Date & Time</th>
                                <th class="noExl">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            {{-- @foreach ($index as $key => $item)
                                @include('admin.pertials.order_rows', ['item' => $item])
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
    </section>
@endsection

@push('scripts')
    <!-- Include the DataTables JavaScript file -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Include the DataTables Buttons JavaScript file -->
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>



    <!-- Include the Column Visibility Button JavaScript file -->
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/admin/order') }}",
                columns: [{
                        data: null,
                        className: 'noExl',
                        render: function(data, type, row, meta) {
                            return '<input type="checkbox" class="checkbox">';
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "id"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "address"
                    },
                    {
                        data: "phone"
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
                        data: "notes",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "name",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "phone",
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
                            data.forEach(function(orderItem) {
                                if (orderItem.color) {
                                    items += '<small>' + orderItem.color + '</small>, ';
                                }
                                if (orderItem.size) {
                                    items += '<small>' + orderItem.size + '</small>, ';
                                }
                            });
                            return items.slice(0, -2);
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "orderitem",
                        render: function(data, type, row, meta) {
                            var quantities = '';
                            data.forEach(function(orderItem) {
                                quantities += '<small>' + orderItem.qty + '</small>';
                            });
                            return quantities;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "created_at"
                    },
                    // {data: 'action', name: 'action', orderable: false, searchable: false},
                    {
                        data: "status",
                        render: function(data, type, row, meta) {
                            var url ='{{ url('/') }}';
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
                        render: function (data, type, row, meta) {
    var buttons = '';
    var CSRF_TOKEN = '{{ csrf_token() }}';
    var URL = '{{ URL::to('/') }}';

    if (row.status == 0) {
        buttons += '<a href="javascript:void(0)" data-url="' + URL + '/admin/order/' + row.id + '/confirm" id="confirmBtn" class="btn btn-outline-info btn-sm text-sm">Confirm</a>';
    } else if (row.status == 1) {
        buttons += '<a href="javascript:void(0)" data-url="' + URL + '/admin/order/' + row.id + '/delivered" id="delivaryBtn" class="btn btn-outline-success btn-sm text-sm">Delivery</a>';
    }

    buttons += '<a href="' + URL + '/admin/order/' + row.id + '" class="btn btn-outline-secondary btn-sm">View Details</a>';
    buttons += '<a id="delete" href="' + URL + '/admin/order/' + row.id + '" class="btn btn-outline-danger btn-sm">Remove</a>';
    buttons += '<form id="delete-form" action="' + URL + '/admin/order/' + row.id + '" method="post" class="d-none">';
    buttons += '<input type="hidden" name="_token" value="' + CSRF_TOKEN + '">';
    buttons += '<input type="hidden" name="_method" value="DELETE">';
    buttons += '</form>';

    return buttons;
},
                        orderable: false,
                        searchable: false
                    }
                ],
                dom: 'Bfrtip',

                buttons: [{
                        className: 'btn-info exportBtn',
                        text: 'Excel'
                    },
                    {
                        extend: 'colvis',
                        className: 'btn-info waves-effect waves-light'
                    }
                ]
            });
            // 
            $('#selectAll').click(function(e) {
                var table = $(e.target).closest('table');
                $('td input:checkbox', table).prop('checked', this.checked);
            });
            $(".exportBtn").click(function() {
                var visibleColumnIndexes = [];
                var visibleColumnNames = [];
                var header = $('#myTable thead th');
                header.each(function(index) {
                    if ($(this).css('display') !== 'none') {
                        visibleColumnIndexes.push(index);
                        visibleColumnNames.push($(this).text());
                    }
                });

                var selectedRows = $("#myTable tbody .checkbox:checked").closest("tr");
                var data = [visibleColumnNames];

                selectedRows.each(function() {
                    var rowData = [];
                    $(this).find('td').each(function(index) {
                        if (visibleColumnIndexes.includes(index)) {
                            rowData.push($(this).text());
                        }
                    });
                    data.push(rowData);
                });

                var ws = XLSX.utils.aoa_to_sheet(data);
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Sheet 1');
                XLSX.writeFile(wb, 'exported_data.xlsx');
            });

            $(document).on('click', '#confirmBtn, #delivaryBtn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                var trObj = $(this).closest('tr');

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        Swal.fire({
                            text: 'Order is ' + (e.target.id === 'confirmBtn' ?
                                'confirmed' : 'delivered') + ' successfully!',
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

        });
    </script>
@endpush
