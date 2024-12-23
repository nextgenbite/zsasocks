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
                      <th scope="col"> Model</th>
                      <th scope="col">Buying Price</th>
                       <th scope="col" >Stock</th>
                       <th scope="col" class="text-center">Total Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($index as $key => $item)

                    <tr>

                      <td>{{$item->product_name}}</td>
                      <td>{{$item->sku}}</td>
                      <td class="text-center">{{$item->buying_price}}</td>
                      <td>
                        {{$item->product_qty}}
                        </td>
                     
                        <td  class=" text-end">
                          {{ $item->buying_price * $item->product_qty}}
                        </td>

                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3">Total</td>
                      <td colspan="2">00 </td>
                    </tr>
               </tfoot>
              </table>
            </div>
            <div class=" row">
              <h4 class=" col-8 text-center">Total:</h4>
              <h4  class=" col-4 text-end">{{$total}} </h4>
            </div>
      </div>
    </div>
  </div>

</section>

@endsection


