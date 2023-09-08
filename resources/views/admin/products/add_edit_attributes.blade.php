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
                  <h4 class="card-title">Product Attribute</h4>
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
                    <form method="post" name="productForm" id="productForm" enctype="multipart/form-data"
                    action="{{ url('admin/add-edit-product-attribute/'.$products['id']) }}">@csrf
                    <div class="form-group">
                      <label for="product_name" style="font-weight: bold; color: black;">Product Name :</label>
                      &nbsp; {{ $products['product_name'] }}
                    </div>
                    <div class="form-group">
                        <label for="product_code" style="font-weight: bold; color: black;">product Code :</label>
                        &nbsp; {{ $products['product_code'] }}
                    </div>
                    <div class="form-group">
                       <label for="product_color" style="font-weight: bold; color: black;">product Color :</label>
                        &nbsp; {{ $products['product_color'] }}
                    </div>
                    <div class="form-group">
                        <label for="product_price" style="font-weight: bold; color: black;">product Price :</label>
                         &nbsp; {{ $products['product_price'] }}
                    </div>
                    <div class="form-group">
                        <label for="product_image" style="font-weight: bold; color: black;">Product Main Image :</label>
                        <div style="height: 100px;"><a href="{{ asset('admin/images/product_images/medium/'.$products['product_image']) }}" target="_blank">
                            <img style="width: 100px;" src="{{ asset('admin/images/product_images/medium/'.$products['product_image']) }}" alt="Product Image"></a>
                        </div>
                    </div>
                    <div class="form-group">
                         <div class="section_wrap">
                            <div>
                                <input style="width: 120px;" type="text" name="size[]" placeholder="Size" Required/>
                                <input style="width: 120px;" type="text" name="price[]" placeholder="Price" Required/>
                                <input style="width: 120px;" type="text" name="stock[]" placeholder="Stock" Required/>
                                <input style="width: 120px;" type="text" name="sku[]" placeholder="Sku" Required/>
                                <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                  <form action="{{ url('admin/edit-attributes/'.$products['id']) }}" method="post">@csrf
                  <div style="margin-top: 50px;">
                     <h4 class="card-title">Product Attributes</h4>
                   <div class="table-responsive pt-3">
                        <table id="products" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Size</th>
                                 <th>Sku</th>
                                 <th>Price</th>
                                 <th>Stock</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($attributes as $attribute)
                              <input style="display: none;" type="text" name="attribute_id[]" value="{{ $attribute['id'] }}">
                              <tr>
                                 <td>{{ $attribute['id'] }}</td>
                                 <td>{{ $attribute['size'] }}</td>
                                 <td>{{ $attribute['sku'] }}</td>
                                 <td><input required style="width: 100px;" type="text" name="price[]" value="{{ $attribute['price'] }}"></td>
                                 <td><input required style="width: 100px;" type="text" name="stock[]" value="{{ $attribute['stock'] }}"></td>
                                 <td>@if($attribute['status'] == 1) 
                                    <a href="javascript:void(0)" class="updateProductAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{$attribute['id']}}">
                                    <i status="Active" style="font-size: 20px; " class="mdi mdi-check-circle-outline"></i></a>
                                    @elseif($attribute['status'] == 0)
                                    <a href="javascript:void(0)" class="updateProductAttributeStatus" id="attribute-{{ $attribute['id']}}" attribute_id="{{$attribute['id']}}">
                                    <i style="font-size: 20px; " class="mdi mdi-checkbox-blank-circle-outline" status="InActive"></i></a>
                                    @endif 
                                 </td>
                                 <td>
                                    <a href="javascript:void(0)" class="deleteProductAttribute" id="attribute-{{ $attribute['id'] }}" attribute_id = "{{ $attribute['id'] }}" title="Delete Attribute"><i style="color:red; font-size: 20px;" class="fa fa-trash"></i></a>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>   
                        </div> 
                         <button type="submit" class="btn btn-primary mr-2">Update Attributes</button>
                        </form>                   
                     </div>
                </div>
              </div>
            </div>
          </div>
      </div>
   </div>
</div>
@endsection