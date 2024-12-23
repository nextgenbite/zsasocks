@extends('admin.layouts.app')
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
                    <div class="card-body">

                        <div class="table-responsive ps ps--theme_default">

                            <input class="form-control w-25 my-2" type="search" placeholder="Search Date Range"
                                id="dateFilters" style="float:right;">
                            <table id="reportTable" class="table table-striped table-bordered table table-striped "
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col"> Date</th>
                                        <th scope="col"> Sell Count</th>
                                        <th scope="col"> Selling Ammount</th>
                                        <th scope="col">Delivery charge</th>
                                        <th scope="col">after charge</th>
                                        <th scope="col">COD Charge</th>
                                        <th scope="col">Cash payment</th>
                                        <th scope="col">Expense</th>
                                        <th scope="col"> Profit</th>
                                        {{-- <th scope="col" class="text-center">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $key => $item)
                                        <tr>
                                            @php
                                                $selling_amount = $item['total_orders'] + $item['delivery_cost'];
                                                $afterCharge = $selling_amount - $item['delivery_cost'];
                                                $cod = ($afterCharge / 100) * 1;
                                            @endphp
                                            <td>{{ $item['date'] }}</td>
                                            <td class="text-end">{{ $item['orders_count'] }}</td>
                                            <td class="text-end">{{ $selling_amount }}</td>
                                            <td class="text-end">{{ $item['delivery_cost'] }}</td>
                                            <td class="text-end">{{ $selling_amount - $item['delivery_cost'] }}</td>
                                            <td class="text-end">{{ $cod }}</td>
                                            <td class="text-end">{{ $afterCharge - $cod }}</td>
                                            <td class="text-end">{{ $item['total_expenses'] }}</td>
                                            <td class="text-end">{{ $afterCharge - $cod - $item['total_expenses'] }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    </section>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
        integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
        integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Initialize Flatpickr on the input field
        $("#dateFilters").flatpickr({
            dateFormat: "Y-m-d",
            mode: 'range',
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length == 2) {
                    fetchReportData(selectedDates[0], selectedDates[1]);
                }
            },
            onChange: function(selectedDates, dateStr) {
                // table.draw();
                // Filter DataTables based on selected date
                //    console.log(dateStr);
                //    let url = $('#datatable-buttons').data('url');
                $.ajax({
                    url: '/admin/report/profit-loss',
                    method: "GET",
                    data: {
                        date_range: dateStr
                    },
                    success: function(response) {
                        console.log(response)

                        // $("tbody#expenseBody").html(response.html)
                        //    console.log($( $("tbody#expenseBody")));
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                });

            }
        });

        function fetchReportData(startDate, endDate) {
            $.ajax({
                url: '{{ url('/admin/report/profit-loss') }}',
                method: 'GET',
                data: {
                    start_date: startDate.toISOString().split('T')[0],
                    end_date: endDate.toISOString().split('T')[0]
                },
                success: function(data) {
                    renderTable(data);
                }
            });
        }

        function renderTable(data) {
            var tbody = $('#reportTable tbody');
            tbody.empty();
            $.each(data, function(index, item) {
                var profitLoss = (item.total_orders * 0.99) - item.total_expenses;
                tbody.append(
                    '<tr>' +
                    '<td>' + item.date + '</td>' +
                    '<td>' + item.total_orders + '</td>' +
                    '<td>' + item.total_expenses + '</td>' +
                    '<td>' + profitLoss + '</td>' +
                    '</tr>'
                );
            });
        }
    </script>
@endpush
