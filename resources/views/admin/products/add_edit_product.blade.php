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
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ $title }}</h4>
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
                    @if(empty($product['id']))
                    action="{{ url('admin/add-edit-product') }}" 
                    @else
                    action="{{ url('admin/add-edit-product/'.$product['id']) }}" 
                    @endif>@csrf
                    <div class="form-group">
                      <label for="product_name">Product Name</label>
                      <input type="text" class="form-control" name="product_name" id="product_name" @if(!empty($product['product_name'])) value="{{ $product['product_name'] }}
                      " @else value="{{ old('product_name') }}" @endif placeholder="enter product name">
                    </div>
                    <div class="form-group">
                    <label>Select Category</label>
                    <select name="category_id" id="category_id" class="custom-select" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach($getcategories as $section)
                        <option disabled style="color: gray !important;">{{ $section['name'] }}</option>
                        @foreach($section['categories'] as $category)
                        <option style="color: black !important;" value="{{ $category['id'] }}" @if(!empty(@old('category_id')) && $category['id']==@old('category_id')) selected=""
                        @elseif(!empty($product['category_id']) && $product['category_id'] == $category['id']) selected=""    @endif>
                        &nbsp;&nbsp;--&nbsp;&nbsp;{{ $category['category_name'] }}</option>
                        @foreach($category['subcategories'] as $subcategory)
                        <option style="color: black !important;" value="{{ $subcategory['id'] }}" @if(!empty(@old('category_id')) && $subcategory['id'] == @old('category_id'))
                        selected="" @elseif(!empty($product['category_id']) && $product['category_id'] == $subcategory['id'])
                        selected="" @endif>
                        &nbsp;&nbsp;--&nbsp;&nbsp;{{ $subcategory['category_name'] }}</option>
                        @endforeach
                        @endforeach
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="brand_id">Select Brand</label>
                        <select name="brand_id" id="brand_id" class="custom-select" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand['id'] }}" 
                            @if(!empty($product['brand_id']) && $product['brand_id'] == $brand['id']) selected="" @endif>{{ $brand['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_code">product Code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product name"
                        @if(!empty($product['product_code']))
                        value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="product_color">product Color</label>
                        <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter product name"
                        @if(!empty($product['product_color']))
                        value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="product_price">product Price</label>
                        <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product name"
                        @if(!empty($product['product_price']))
                        value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="product_discount">product Discount</label>
                        <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter product name"
                        @if(!empty($product['product_discount']))
                        value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="product_weight">Product Weight</label>
                        <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter product discount"
                        @if(!empty($product['product_weight']))
                        value="{{ $product['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="product_image">Product Main Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="product_image" name="product_image">
                                <label class="custom-file-label" for="product_image">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="product_image">Upload</span>
                            </div>
                        </div>
                        <i>Recommended size (width: 1040px, height: 1200px)</i>
                        @if(!empty($product['product_image']))
                        <div style="height: 100px;"><a href="{{ asset('admin/images/product_images/large/'. $product['product_image']) }}" target="_blank"><img style="width: 60px;" src="{{ asset('admin/images/product_images/large/'. $product['product_image']) }}" alt="Product Image"></a>
                            &nbsp;
                            <a <?php /*href="{{ url('admin/delete-category-image/'. $categorydata['id']) }}"*/ ?> 
                                class="imageConfirmDelete" href="javascript:void(0)" id="product-image" product_id="{{ $product['id'] }}"
                                style="color:red;">Delete Image</a> 
                        </div>
                        @endif
                    </div>
                     <div class="form-group">
                        <label for="product_video">Product Video</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="product_video" name="product_video">
                                <label class="custom-file-label" for="product_video">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="product_video">Upload</span>
                            </div>
                        </div>
                        @if(!empty($product['product_video']))
                        <div>
                            <a href="{{ url('admin/videos/product_videos/'.$product['product_video']) }}" download>Download</a>
                            &nbsp;|&nbsp;
                            <a class="videoConfirmDelete" href="javascript:void(0)" id="product-video" product_id="{{ $product['id'] }}" 
                                style="color:red;">Delete Video</a> 
                        </div>
                        @endif            
                    </div>                   
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ...">@if(!empty($product['meta_title'])){{ $product['meta_title'] }} @else{{ old('meta_title') }} @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ...">@if(!empty($product['meta_description'])){{ $product['meta_description'] }} @else{{ old('meta_description') }} @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ...">@if(!empty($product['meta_keywords'])){{ $product['meta_keywords'] }} @else{{ old('meta_keywords') }} @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description </label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter ...">@if(!empty($product['description'])){{ $product['description'] }} @else{{ old('description') }} @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="is_featured">Is Featured</label>
                        <input type="checkbox" @if(!empty($product['is_featured']) && $product['is_featured'] == "Yes") checked="" @endif 
                        value="Yes" id="is_featured" name="is_featured">
                    </div>
                    <div class="form-group">
                        <label for="is_bestseller">Best Seller Item</label>
                        <input type="checkbox" @if(!empty($product['is_bestseller']) && $product['is_bestseller'] == "Yes") checked="" @endif 
                        value="Yes" id="is_bestseller" name="is_bestseller">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
   </div>
</div>
@endsection