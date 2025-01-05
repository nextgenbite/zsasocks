@extends('admin.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
<style>
        .table th{
            font-size: 0.8rem !important;
        }
    .table th, .table td{
        padding: 0.3rem !important;
        
    }
</style>
@endpush
@section('content')
<div class="pagetitle">
  <h1>{{$title[0]}}</h1>
  {{-- <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
      <li class="breadcrumb-item active"><a href="{{url('/admin/'.$title[1])}}">{{$title[0]}}</a></li>
    </ol>
  </nav> --}}
</div><!-- End Page Title -->
<section class="section">


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Order List <button class=" btn btn-primary btn-sm rounded float-right" id="exportBtn">Export Excel</button></h2>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive " style="font-size: .9rem">
                            <table class="table center-aligned-table " width="100%" id="myTable">
                                <thead>

                                    <tr>

                                        <th class="noExl"></th>
                                        <th>Invoice No.</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Date & Time</th>
                                        <th class="noExl">Status</th>
                                        <th class="text-center noExl">Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $index = App\Models\Order::latest()->get();
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
   
                dom: 'lBfrtip', // Include 'B' for buttons container
        buttons: [
            'colvis' // Column visibility button
        ]
});

            $("#exportBtn").click(function() {
                var selectedRows = $("#myTable tbody").find(".checkbox:checked").closest("tr");

                // Create an array to store the data
                var data = [['Invoice No.', 'Name', 'Address', 'Phone', 'Amount', 'Note', 'Contact Name', 'Contact Phone', 'Product Title', 'Color & Size', 'Quantity', 'Date & Time' ]];
                
                // Add selected rows data to the array
                selectedRows.each(function() {
                    var rowData = [];
                    $(this).find('td:not(.noExl)').each(function() {
                        rowData.push($(this).text());
                    });
                    data.push(rowData);
                });

                // Create a worksheet
                var ws = XLSX.utils.aoa_to_sheet(data);

                // Create a workbook
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Sheet 1');

                // Save the workbook as an XLSX file
                XLSX.writeFile(wb, 'exported_data.xlsx');
            });
            // var table = $('#myTable').DataTable({
            //     dom: 'Bfrtip',
            //     select: true,
            //     order: [
            //         [0, 'desc']
            //     ],
            //     buttons: [{
            //             extend: 'csvHtml5',
            //             exportOptions: {
            //                 columns: ':not(:last-child):not(:nth-last-child(2))',
            //                 columns: [0, 1, {
            //             // Custom function to include checkbox state in export
            //             render: function (data, type, row) {
            //                 return row[2].querySelector('.checkbox').checked ? 'Checked' : 'Unchecked';
            //             }
            //         }]
            //             },
            //             filename: 'order_table_csv',
            //             text: 'Export CSV',
            //             className: 'btn btn-primary'
            //         },
            //         {
            //             extend: 'excelHtml5',
            //             exportOptions: {
            //                 columns: ':not(:last-child):not(:nth-last-child(2))'
            //             },
            //             filename: 'order_table_excel',
            //             text: 'Export Excel',
            //             className: 'btn btn-primary'
            //         }
            //     ]
            // });


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
        });
    </script>
@endpush
