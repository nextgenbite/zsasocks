@extends('admin.layouts.app')
@section('content')
<div class="pagetitle">
  <h1>{{$title[0]}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
      <li class="breadcrumb-item active"><a href="{{url('/admin/'.$title[1])}}">{{$title[0]}}</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <div class="table-responsive ps ps--theme_default"      >

            <table  class="table table-striped table-bordered table table-striped datatable" style="width:100%">
                <thead>
                    <tr>
                      <th scope="col"> Title</th>
                      <th scope="col">Category</th>
                      <th scope="col"> Image</th>
                      <th scope="col"> Price</th>
                       <th scope="col" class="text-center">Status</th>
                       <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($index as $key => $item)

                    <tr>

                      <td>{{$item->product_name}}</td>
                      <td>{{$item->category->category_name}}</td>
                      <td><img src=" {{asset($item->product_image ?: '/placeholder.jpg')}}" class="img-rounded" width="50px" alt="sadd"> </td>
                      <td class="text-center">{{$item->selling_price}}</td>
                      <td>
                        @if ($item->status ==1)
                          <a href="{{URL::to('/admin/'.$title[1].'/'.$item->id.'/inactive')}} " class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Active</a>
                          @else
                          <a href="{{URL::to('/admin/'.$title[1].'/'.$item->id.'/active')}} " class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Deactive</a>
                          @endif
                        </td>
                     
                        <td class="btn-group">
                          <a  href="{{URL::to('/admin/'.$title[1].'/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm">Manage</a>
                          <a id="delete" href="{{URL::to('/admin/'.$title[1].'/'.$item->id)}}" class="btn btn-danger btn-sm">Remove</a>
                        
                          <form id="delete-form"  action="{{URL::to('/admin/'.$title[1].'/'.$item->id)}}" method="post" class="d-none">
                          @csrf
                          @method('DELETE')
                          </form>
                         
                        </td>

                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th class="text-center">Action</th>
                      </tr>
               </tfoot>
              </table>
          <div class="ps__scrollbar-x-rail" style="width: 276px; left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 105px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
      </div>
    </div>
  </div>

</section>

@endsection


