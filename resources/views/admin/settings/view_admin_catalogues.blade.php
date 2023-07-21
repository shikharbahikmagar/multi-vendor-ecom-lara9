@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <div class="row">
   </div>
    <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">Admin Catalogue Details</h4>
                  <div class="table-responsive pt-3">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                            <th>Admin ID</th>
                            <th>Vendor ID</th>
                            <th>Category Name</th>
                            <th>Category Discount</th>
                            <th>Category URL</th>
                            <th>Category Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach($genres as $genre)
                           <tr>
                              <td>{{ $genre['id'] }}</td>
                              <td>{{ $genre['vendor_id'] }}</td>
                              <td>{{ $genre['category_name'] }}</td>
                              <td>Rs. {{ $genre['category_discount'] }}</td>
                              <td>{{ $genre['url'] }}</td>
                              <td><img src="{{ asset('admin/images/catalogue/'.$genre['category_image'] ) }}" alt="Genre Image"></td>
                              <td>@if($genre['status'] == 1) 
                                 <a href="javascript:void(0)" class="updateGenreStatus" id="genre-{{ $genre['id'] }}" genre_id="{{$genre['id']}}">
                                    <i status="Active" style="font-size: 20px; " class="mdi mdi-check-circle-outline"></i></a>
                               @elseif($genre['status'] == 0)
                               <a href="javascript:void(0)" class="updateGenreStatus" id="genre-{{ $genre['id']}}" genre_id="{{$genre['id']}}">
                              <i style="font-size: 20px; " class="mdi mdi-checkbox-blank-circle-outline" status="InActive"></i></a>
                                 @endif </td>
                              <td>
                               Edit
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
        </div>
   </div>
</div>

@endsection