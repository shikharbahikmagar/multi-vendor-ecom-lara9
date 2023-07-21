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
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                  <form class="forms-sample" 
                  @if(empty($catDetails['id']))
                  action="{{ url('/admin/add-edit-catalogue') }}"
                  @else 
                  action="{{ url('/admin/add-edit-catalogue/'.$catDetails['id']) }}"
                  @endif enctype="multipart/form-data" method="post">@csrf
                    <div class="form-group">
                      <label for="cat_name">Genre Title</label>
                      <input type="text" name="cat_name" @if(!empty($catDetails['category_name'])) value="{{ $catDetails['category_name'] }}"
                      @else value="{{ old('cat_name') }}" @endif placeholder="Enter category name" class="form-control" id="cat_name">
                    </div>
                    <div class="form-group">
                      <label for="cat_discount">Genre Discount</label>
                      <input type="text" class="form-control" name="cat_discount" id="cat_discount" @if(!empty($catDetails['category_discount'])) value="{{ $catDetails['category_discount'] }}"
                      @else value="{{ old('cat_discount') }}" @endif placeholder="discount">
                    </div>
                    <div class="form-group">
                      <label for="url">Url</label>
                      <input type="text" name="url" class="form-control" id="url" @if(!empty($catDetails['url'])) value="{{ $catDetails['url'] }}"
                      @else value="{{ old('url') }}" @endif placeholder="category url">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" name="description" class="form-control" id="description"  @if(!empty($catDetails['description'])) value="{{ $catDetails['description'] }}"
                      @else value="{{ old('description') }}" @endif placeholder="description">
                    </div>
                    <div class="form-group">
                      <label for="meta_title">Meta Title</label>
                      <input type="text" name="meta_title" class="form-control" id="meta_title"  @if(!empty($catDetails['meta_title'])) value="{{ $catDetails['meta_title'] }}"
                      @else value="{{ old('meta_title') }}" @endif placeholder="meta title">
                    </div>
                    <div class="form-group">
                      <label for="meta_description">Meta Description</label>
                      <input type="text" name="meta_description" class="form-control" id="meta_description"  @if(!empty($catDetails['meta_description'])) value="{{ $catDetails['meta_description'] }}"
                      @else value="{{ old('meta_description') }}" @endif placeholder="meta description">
                    </div>
                    <div class="form-group">
                      <label for="meta_keywords">Meta Keywords</label>
                      <input type="text" name="meta_keywords" class="form-control" id="meta_keywords"  @if(!empty($catDetails['meta_keywords'])) value="{{ $catDetails['meta_keywords'] }}"
                      @else value="{{ old('meta_keywords') }}" @endif placeholder="meta keywords">
                    </div>
                    <div class="form-group">
                      <label for="cat_image">Genre Image</label>
                      <input type="file" name="cat_image" class="form-control" id="cat_image" >
                      @if(!empty($catDetails['category_image']))
                      <a target="_blank" href="{{ url('vendor/images/category_images/'.$catDetails['category_image'] ) }}">View Image</a>
                      <input type="hidden" name="current_cat_image" id="current_cat_image" value="{{ $catDetails['category_image'] }}">
                      @endif
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