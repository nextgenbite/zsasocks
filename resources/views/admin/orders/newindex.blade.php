@extends('admin.layouts.app')
@push('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css" />
    <!-- DataTables Column Visibility Button CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" />
    <style>
    
    </style>
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


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form action="{{route('order.excel.update')}}" enctype="multipart/form-data" method="post" class="d-flex">
                            @csrf
                            <div class="input-group mb-3 w-50">
                                <input type="file" class="form-control " placeholder="" name="excel_file" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Upload Excel</button>
                              </div>
                            
                        </form>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive mt-4">
                            <table class="table center-aligned-table " width="100%" id="myTable" style="font-size: .9rem">
                                <thead>

                                    <tr>

                                        <th class="noExl"></th>
                                        <th>Invoice</th>
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
                                        <th class="text-center noExl">Action</th>
                                    </tr>
                                </thead>
                                @php
                                $index = App\Models\Order::with('orderitem')->latest()->paginate(300);
                            @endphp
                                <tbody id="orderTableBody">
                                    @foreach ($index as $key => $item)
                                        @include('admin.pertials.order_rows', ['item' => $item])
                                    @endforeach
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
                dom: 'Bfrtip',
                "pageLength": 300,
                // buttons: ['colvis'] // Add column visibility button
                buttons: [
                    {
                        text: 'Excel',
                        className: 'btn-info exportBtn ',

                    },
                    {
                        extend: 'pageLength',
                        className: 'btn-primary'
                    },
                    {
                        extend: 'csv',
                        className: 'btn-warning waves-effect waves-light'
                    },
                    {
                        extend: 'excel',
                        className: 'btn-success waves-effect waves-light'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-danger waves-effect waves-light'
                    },
                    {
                        extend: 'colvis',
                        className: 'btn-info waves-effect waves-light'
                    }
                ],
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

            $(document).on('click', '#confirmBtn, #delivaryBtn, #sentBtn, #returnBtn, #canceleBtn', function(e) {
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

        });
    </script>
@endpush