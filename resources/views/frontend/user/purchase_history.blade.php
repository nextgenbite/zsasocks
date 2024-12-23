@extends('frontend.layouts.app')
@section('title', auth()->user()->name)
@section('content')
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.user_sidebar')
                </div>
                <div class="col-lg-9">

                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        Purchase History
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="/">Home</a></li>
                                            <li><a href="/dashboard">Dashboard</a></li>
                                            <li class="active"><a href="/purchase_history">Purchase History</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- <form action="" method="get">
                                <div class="row align-items-center pt-2">

                                    <div class="form-group col-4">
                                        <div id="reportrange" class="form-control pull-left"
                                            style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                            <span>April 19, 2024 - May 18, 2024</span>
                                            <div><input type="hidden" name="start" value="2024-4-19"><input
                                                    type="hidden" name="end" value="2024-5-18"></div> <b
                                                class="caret"></b>
                                        </div>


                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <select name="status" class="form-control">
                                                <option value="">Select delivery status</option>
                                                <option value="pendding">Pendding</option>
                                                <option value="process">Processing</option>
                                                <option value="delivered">Delivered</option>
                                            </select>

                                        </div>

                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Search Keyword">

                                        </div>

                                    </div>
                                    <div class="form-group col-2">
                                        <button type="submit" class="btn btn-styled btn-base-1">Search</button>
                                    </div>


                                </div>
                            </form> --}}
                        </div>

                        <!-- Order history table -->
                        <div class="card no-border mt-4">

                            <div>
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Delivery Status</th>
                                            <th>Delivery Method</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data->orders as $item)
                                            <tr>
                                                <td>
                                                    <a href="#8{{ $item->id }}">#8{{ $item->id }}</a>
                                                </td>
                                                <td>{{ $item->order_date }}</td>
                                                <td>
                                                    Tk{{ $item->delivery_type + $item->amount - $item->coupon }}
                                                </td>
                                                <td>
                                                    <b
                                                        class="{{ $item->status == 0 ? 'text-danger' : ($item->status == 1 ? 'text-info' : 'text-success') }}">{{ $item->status == 0 ? 'Pending' : ($item->status == 1 ? 'Confirm' : 'Delivered') }}</b>
                                                    <span class="ml-2" style="color:green"><strong>*</strong></span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-inline badge-info p-2">
                                                      Cash on Delivery
                                                        {{-- <span class="ml-2" style="color:green"><strong>*</strong></span> --}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn" type="button" id=""
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                          
                                                            <a href="{{url('/invoice/customer/'. $item->id)}}"
                                                                class="dropdown-item">Order Details</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
