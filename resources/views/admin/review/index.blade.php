@extends('admin.layouts.app')

@section('content')
<div class="pagetitle">
  <h1>{{$title[0]}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{url('/admin/'.$title[1])}}">{{$title[0]}}</a></li>
      <li class="breadcrumb-item active">Create</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
    
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">{{$title[0]}} Table</h2>
          <div class="table-responsive ps ps--theme_default" data-ps-id="f342432d-4b6c-93b1-a6b9-79f39bb5a069">
            <table class="table center-aligned-table">
              <thead>
                
                <tr>
                
                  <th>Thumb</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($index as $cat)
                    
                <tr >
        
                  <td><img style="width: 2rem" src="{{asset($cat->path ?: '/placeholder.jpg')}}" alt="image">
                  
                <td> {{$cat->category?->category_name}}</td>
                  <td>
                  @if ($cat->status ==1)
                    <a href="{{URL::to('/admin/'.$title[1].'/'.$cat->id.'/inactive')}} " class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Active</a>
                    @else
                    <a href="{{URL::to('/admin/'.$title[1].'/'.$cat->id.'/active')}} " class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Deactive</a>
                    @endif
                  </td>
        
                  <td class="btn-group">
                    <a  href="{{URL::to('/admin/'.$title[1].'/'.$cat->id.'/edit')}}" class="btn btn-primary btn-sm">Manage</a>
                    <a id="delete" href="{{URL::to('/admin/'.$title[1].'/'.$cat->id)}}" class="btn btn-danger btn-sm">Remove</a>
                  
                    <form id="delete-form"  action="{{URL::to('/admin/'.$title[1].'/'.$cat->id)}}" method="post" class="d-none">
                    @csrf
                    @method('DELETE')
                    </form>
                   
                  </td>
                </tr>
                @endforeach
              
              </tbody>
            </table>
          <div class="ps__scrollbar-x-rail" style="width: 276px; left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 105px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
      </div>
    </div>
  </div>

</div>


@endsection