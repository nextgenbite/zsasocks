@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>{{ $title[0] }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/' . $title[1]) }}">{{ $title[0] }}</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">{{ $title[0] }} Table</h2>
                        <div class="table-responsive ps ps--theme_default">
                            <table class="table table-striped table-bordered table table-striped datatable">
                                <thead>

                                    <tr>

                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($index as $key => $item)
                                        <tr>

                                            <td>{{ $item->date }}</td>
                                            <td>{!! $item->description !!}</td>
                                            <td>{{ $item->amount }}</td>

                                            <td>
                                                <div class="btn-group">

                                                    <a href="{{ URL::to('/admin/' . $title[1] . '/' . $item->id . '/edit') }}"
                                                        class="btn btn-primary btn-sm">Manage</a>
                                                    <a id="delete"
                                                        href="{{ URL::to('/admin/' . $title[1] . '/' . $item->id) }}"
                                                        class="btn btn-danger btn-sm">Remove</a>

                                                    <form id="delete-form"
                                                        action="{{ URL::to('/admin/' . $title[1] . '/' . $item->id) }}"
                                                        method="post" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection
