@extends('frontend.layouts.app', ['title', 'confirmation'])
@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class=" text-capitalize"><i class="la la-tags me-2"></i> {{$data->title}}</h5>
                            {!!$data->content!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
