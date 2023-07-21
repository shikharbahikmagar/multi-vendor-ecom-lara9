@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <div class="row">
      <a href="{{ url('/admin/add-edit-catalogue') }}" class="btn btn-block btn-primary" style="max-width: 200px; margin-left: 87%; display:inline-block;">
      Add Genre</a>
   </div>
   <br>
    <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
         @if(Session::has('error_message'))
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         @endif
         @if(Session::has('success_message'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         @endif
         @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
            </div>
         @endif
                  <h4 class="card-title">Admin Genre Details</h4>
                  <div class="table-responsive pt-3">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                            <th>ID</th>
                            <th>Genre Title</th>
                            <th>Genre Discount</th>
                            <th>Genre URL</th>
                            <th>Genre Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach($genres as $genre)
                           <tr>
                              <td>{{ $genre['id'] }}</td>
                              <td>{{ $genre['category_name'] }}</td>
                              <td>Rs. {{ $genre['category_discount'] }}</td>
                              <td>{{ $genre['url'] }}</td>
                              <td><img src="{{ asset('vendor/images/category_images/'.$genre['category_image'] ) }}" alt="Genre Image"></td>
                              <td>@if($genre['status'] == 1) 
                                 <a href="javascript:void(0)" class="updateGenreStatus" id="genre-{{ $genre['id'] }}" genre_id="{{$genre['id']}}">
                                    <i status="Active" style="font-size: 20px; " class="mdi mdi-check-circle-outline"></i></a>
                               @elseif($genre['status'] == 0)
                               <a href="javascript:void(0)" class="updateGenreStatus" id="genre-{{ $genre['id']}}" genre_id="{{$genre['id']}}">
                              <i style="font-size: 20px; " class="mdi mdi-checkbox-blank-circle-outline" status="InActive"></i></a>
                                 @endif </td>
                              <td>
                               <a href="{{ url('admin/add-edit-catalogue/'.$genre['id']) }}"><i style="font-size: 20px;" class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                               <a href="javascript:void(0)" class="deleteCategory" id="cat-{{ $genre['id'] }}" cat_id = "{{ $genre['id'] }}"><i style="color:red; font-size: 20px;" class="fa fa-trash"></i></a>
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