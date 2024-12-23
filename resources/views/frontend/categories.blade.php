@extends('frontend.layouts.app')
@section('title', $category->category_name)
@section('content')
<section class="py-4">
    <div class="container">
        <div id="section_all_products">
            <section class="mb-2 mb-lg-3">
                <div class="container">
                    <div class="px-2 py-2 p-md-4 bg-white shadow-sm">
                        <div class="section-title-1 clearfix">
                            <h3 class="heading-5 strong-700 mb-0 float-left">
                                <span class="mr-4 text-capitalize">{{$category->category_name}}</span>
                            </h3>
                            <ul class="inline-links float-right mt-2">
    
                            </ul>
                        </div>
                        <div class="row">
                            @forelse ($paginatedProducts->where('status', true) as $item)
                                <div class="col-6 col-sm-4 col-lg-2">
                                    @include('frontend.partials.product', ['product' => $item])
                                </div>
                            @empty
                                <!-- Handle case when $products array is empty -->
                            @endforelse
                        </div>
                        
    
    
                        <nav class=" d-flex justify-content-center">
                            {{ $paginatedProducts->links('vendor.pagination.custom')}}
                        </nav>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

 
@endsection
