@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
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
                     <h4 class="card-title">Category Details</h4>
                      <a href="{{ url('/admin/add-edit-category') }}" class="btn btn-block btn-primary" style="max-width: 150px; float: right; display:inline-block;">
                        Add Category</a>
                     <div class="table-responsive pt-3">
                        <table id="categories" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Category Title</th>
                                 <th>Parent Category</th>
                                 <th>Category Discount</th>
                                 <th>Category URL</th>
                                 <th>Category Image</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($categories as $category)
                             
                              <tr>
                                 <td>{{ $category['id'] }}</td>
                                 <td>{{ $category['category_name'] }}</td>
                                 <td>@if($category['parent_id'] != 0){{ $category->parentcategory->category_name }} @else Root @endif</td>
                                 <td>Rs. {{ $category['category_discount'] }}</td>
                                 <td>{{ $category['url'] }}</td>
                                 <td><img src="{{ asset('admin/images/category_images/'.$category['category_image'] ) }}" alt="Genre Image"></td>
                                 <td>@if($category['status'] == 1) 
                                    <a href="javascript:void(0)" class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{$category['id']}}">
                                    <i status="Active" style="font-size: 20px; " class="mdi mdi-check-circle-outline"></i></a>
                                    @elseif($category['status'] == 0)
                                    <a href="javascript:void(0)" class="updateCategoryStatus" id="category-{{ $category['id']}}" category_id="{{$category['id']}}">
                                    <i style="font-size: 20px; " class="mdi mdi-checkbox-blank-circle-outline" status="InActive"></i></a>
                                    @endif 
                                 </td>
                                 <td>
                                    <a href="{{ url('admin/add-edit-category/'.$category['id']) }}"><i style="font-size: 20px;" class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a href="javascript:void(0)" class="deleteCategory" id="category-{{ $category['id'] }}" category_id = "{{ $category['id'] }}"><i style="color:red; font-size: 20px;" class="fa fa-trash"></i></a>
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