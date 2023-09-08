@extends('admin.layouts.layout')
@section('content')
  <div class="content-wrapper">
   <div class="row">
      <div class="col-md-12 grid-margin">
         <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
               <h3 class="font-weight-bold">Settings</h3>
            </div>
            <div class="col-12 col-xl-4">
               <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                     <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                     </button>
                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                        <a class="dropdown-item" href="#">January - March</a>
                        <a class="dropdown-item" href="#">March - June</a>
                        <a class="dropdown-item" href="#">June - August</a>
                        <a class="dropdown-item" href="#">August - November</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
      <div class="row">
      <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Product Images</h4>
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
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" name="imageForm" id="imageForm" enctype="multipart/form-data"
                    action="{{ url('admin/add-images/'.$productDetails['id']) }}">@csrf
                    <div class="form-group">
                      <label for="product_name" style="font-weight: bold; color: black;">Product Name :</label>
                      &nbsp; {{ $productDetails['product_name'] }}
                    </div>
                    <div class="form-group">
                        <label for="product_code" style="font-weight: bold; color: black;">product Code :</label>
                        &nbsp; {{ $productDetails['product_code'] }}
                    </div>
                    <div class="form-group">
                       <label for="product_color" style="font-weight: bold; color: black;">product Color :</label>
                        &nbsp; {{ $productDetails['product_color'] }}
                    </div>
                    <div class="form-group">
                        <label for="product_price" style="font-weight: bold; color: black;">product Price :</label>
                         &nbsp; {{ $productDetails['product_price'] }}
                    </div>
                    <div class="form-group">
                        <label for="product_image" style="font-weight: bold; color: black;">Product Main Image :</label>
                        <div style="height: 100px;"><a href="{{ asset('admin/images/product_images/medium/'.$productDetails['product_image']) }}" target="_blank">
                            <img style="width: 100px;" src="{{ asset('admin/images/product_images/medium/'.$productDetails['product_image']) }}" alt="Product Image"></a>
                        </div>
                    </div>
                    <div class="form-group">
                         <div style="margin-top: 50px;">
                            <input type="file" multiple="" name="images[]">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                  <div style="margin-top: 50px;">
                     <h4 class="card-title">Products Images</h4>
                   <div class="table-responsive pt-3">
                        <table id="products" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Image</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($productDetails['images'] as $image)
                              <tr>
                                 <td>{{ $image['id'] }}</td>
                                 <td>
                                    <img style="height: 100px !important; width: 100px !important;" src="{{ url('admin/images/product_images/medium/'.$image['image']) }}">
                                </td>
                                 <td>@if($image['status'] == 1) 
                                    <a href="javascript:void(0)" class="updateProductImageStatus" id="image-{{ $image['id'] }}" image_id="{{$image['id']}}">
                                    <i status="Active" style="font-size: 20px; " class="mdi mdi-check-circle-outline"></i></a>
                                    @elseif($image['status'] == 0)
                                    <a href="javascript:void(0)" class="updateProductImageStatus" id="image-{{ $image['id']}}" image_id="{{$image['id']}}">
                                    <i style="font-size: 20px; " class="mdi mdi-checkbox-blank-circle-outline" status="InActive"></i></a>
                                    @endif 
                                 </td>
                                 <td>
                                    <a href="javascript:void(0)" class="deleteProductImage" id="image-{{ $image['id'] }}" image_id = "{{ $image['id'] }}" title="Delete Image"><i style="color:red; font-size: 20px;" class="fa fa-trash"></i></a>
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
</div>
@endsection