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
                  <form class="add_edit_category" 
                  @if(empty($categories['id']))
                  action="{{ url('/admin/add-edit-category') }}"
                  @else 
                  action="{{ url('/admin/add-edit-category/'.$categories['id']) }}"
                  @endif enctype="multipart/form-data" method="post">@csrf
                    <div class="form-group">
                      <label for="cat_name">Category Title</label>
                      <input type="text" name="cat_name" @if(!empty($categories['category_name'])) value="{{ $categories['category_name'] }}"
                      @else value="{{ old('cat_name') }}" @endif placeholder="Enter category name" class="form-control" id="cat_name">
                    </div>
                    <div class="form-group">
                      <label>Select Section</label>
                        <select name="section_id" id="section_id" class="custom-select" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach($sections as $section)
                        <option value="{{ $section['id'] }}" @if(!empty($categories['section_id']) && $categories['section_id'] == 
                         $section['id']) Selected @endif >{{ $section['name'] }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                       <label>Select Category Level</label>
                      <select name="parent_id" id="parent_id" class="custom-select" style="width: 100%;">
                      <option value="0" @if(!isset($categories['parent_id']) && $categories['parent_id'] == 0 ) selected="" @endif>Main Category</option>
                      @if(!empty($getCategories))
                      @foreach($getCategories as $category)
                          <option value="{{ $category['id'] }}" @if(isset($categories['parent_id']) 
                          && $categories['parent_id'] == $category['id'] ) selected="" @endif>{{ $category['category_name'] }}</option>
                              @if(!empty($category['subcategories']))
                                  @foreach($category['subcategories'] as $subcategory)
                              <option value="{{ $subcategory->id }}">&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                              @endforeach
                          @endif  
                          @endforeach
                          @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="cat_discount">Category Discount</label>
                      <input type="text" class="form-control" name="cat_discount" id="cat_discount" @if(!empty($categories['category_discount'])) value="{{ $categories['category_discount'] }}"
                      @else value="{{ old('cat_discount') }}" @endif placeholder="discount">
                    </div>
                    <div class="form-group">
                      <label for="url">Url</label>
                      <input type="text" name="url" class="form-control" id="url" @if(!empty($categories['url'])) value="{{ $categories['url'] }}"
                      @else value="{{ old('url') }}" @endif placeholder="category url">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" name="description" class="form-control" id="description"  @if(!empty($categories['description'])) value="{{ $categories['description'] }}"
                      @else value="{{ old('description') }}" @endif placeholder="description">
                    </div>
                    <div class="form-group">
                      <label for="meta_title">Meta Title</label>
                      <input type="text" name="meta_title" class="form-control" id="meta_title"  @if(!empty($categories['meta_title'])) value="{{ $categories['meta_title'] }}"
                      @else value="{{ old('meta_title') }}" @endif placeholder="meta title">
                    </div>
                    <div class="form-group">
                      <label for="meta_description">Meta Description</label>
                      <input type="text" name="meta_description" class="form-control" id="meta_description"  @if(!empty($categories['meta_description'])) value="{{ $categories['meta_description'] }}"
                      @else value="{{ old('meta_description') }}" @endif placeholder="meta description">
                    </div>
                    <div class="form-group">
                      <label for="meta_keywords">Meta Keywords</label>
                      <input type="text" name="meta_keywords" class="form-control" id="meta_keywords"  @if(!empty($categories['meta_keywords'])) value="{{ $categories['meta_keywords'] }}"
                      @else value="{{ old('meta_keywords') }}" @endif placeholder="meta keywords">
                    </div>
                    <div class="form-group">
                      <label for="cat_image">Category Image</label>
                      <input type="file" name="cat_image" class="form-control" id="cat_image" >
                      @if(!empty($categories['category_image']))
                      <a target="_blank" href="{{ url('vendor/images/category_images/'.$categories['category_image'] ) }}">View Image</a>
                      <input type="hidden" name="current_cat_image" id="current_cat_image" value="{{ $categories['category_image'] }}">
                    <div>
                      <a <?php /*href="{{ url('admin/delete-category-image/'. $categories['id']) }}"*/ ?> 
                        class="imageConfirmDelete" href="javascript:void(0)" id="category-{{ $categories['id'] }}" category_id = "{{ $categories['id'] }}">| Delete Image</a> 
                    </div>
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