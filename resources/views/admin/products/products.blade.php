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
                     <h4 class="card-title">Product Details</h4>
                      <a href="{{ url('/admin/add-edit-product') }}" class="btn btn-block btn-primary" style="max-width: 150px; float: right; display:inline-block;">
                        Add Product</a>
                     <div class="table-responsive pt-3">
                        <table id="products" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Product Name</th>
                                 <th>Product Code</th>
                                 <th>Section</th>
                                 <th>Category</th>
                                 <th>Product Color</th>
                                 <th>Product Image</th>
                                 <th>Added By</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($products as $product)
                              <tr>
                                 <td>{{ $product['id'] }}</td>
                                 <td>{{ $product['product_name'] }}</td>
                                 <td>{{ $product['product_code'] }}</td>
                                 <td> {{ $product['section']['name'] }} </td>
                                 <td> {{ $product['category']['category_name'] }} </td>
                                 <td>{{ $product['product_color'] }}</td>
                                 <td> @if(!empty($product['product_image']))
                                       <img style="width: 100px; height: 110px" src="{{ asset('admin/images/product_images/large/'. $product['product_image']) }}" alt="Product Image">
                                       @else
                                       <img style="width: 100px; height: 110px" src="{{ asset('admin/images/product_images/no_image.png') }}" alt="Product Image">
                                       @endif
                                </td>
                                 <td>@if($product['admin_type'] == "vendor")
                                       <a href="{{ url('admin/view-vendor-details/'.$product['admin_id']) }}">
                                          {{ $product['admin_type'] }}
                                       </a>
                                     @else
                                       {{ $product['admin_type'] }}
                                       @endif
                                 </td>
                                 <td>@if($product['status'] == 1) 
                                    <a href="javascript:void(0)" class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{$product['id']}}">
                                    <i status="Active" style="font-size: 20px; " class="mdi mdi-check-circle-outline"></i></a>
                                    @elseif($product['status'] == 0)
                                    <a href="javascript:void(0)" class="updateProductStatus" id="product-{{ $product['id']}}" product_id="{{$product['id']}}">
                                    <i style="font-size: 20px; " class="mdi mdi-checkbox-blank-circle-outline" status="InActive"></i></a>
                                    @endif 
                                 </td>
                                 <td>
                                    <a href="{{ url('admin/add-edit-product/'.$product['id']) }}"><i style="font-size: 20px;" class="fa fa-edit" title="Edit Product"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a href="{{ url('admin/add-edit-product-attribute/'.$product['id']) }}"><i style="font-size: 20px;" title="Add Attribute" class="fa fa-plus"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a href="{{ url('admin/add-images/'.$product['id']) }}"><i style="font-size: 20px;" title="Add Image" class="fa fa-image"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a href="javascript:void(0)" class="deleteProduct" id="product-{{ $product['id'] }}" product_id = "{{ $product['id'] }}" title="Delete Product"><i style="color:red; font-size: 20px;" class="fa fa-trash"></i></a>
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