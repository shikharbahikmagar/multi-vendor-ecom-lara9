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
                    <form method="post" name="bannerForm" id="bannerForm" enctype="multipart/form-data"
                    @if(empty($bannerDetails['id']))
                    action="{{ url('admin/add-edit-banner') }}" 
                    @else
                    action="{{ url('admin/add-edit-banner/'.$bannerDetails['id']) }}" 
                    @endif>@csrf
                     <div class="form-group">
                      <label for="banner_type" >Banner Type</label>
                        <select name="banner_type" id="banner_type" class="custom-select" required="">
                          <option value="">Select</option>
                          <option value="slider" @if(!empty($bannerDetails['type']) && $bannerDetails['type'] == "slider") select="" @endif>Slider</option>
                          <option value="fix" @if(!empty($bannerDetails['type']) && $bannerDetails['type'] == "fix") select="" @endif>Fix</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="banner_image">Banner Image</label>
                      <input type="file" class="form-control" name="banner_image" id="banner_image">
                      @if(!empty($bannerDetails['image']))
                      <a href="{{ url('admin/images/banner_images/'.$bannerDetails['image']) }}" target="_blank"> View Image </a>
                       <input type="hidden" name="current_banner_image" id="current_banner_image" value="{{ $bannerDetails['image'] }}">
                    @endif
                    </div>
                     <div class="form-group">
                      <label for="banner_link">Banner Link</label>
                      <input type="text" class="form-control" name="banner_link" id="banner_link" @if(!empty($bannerDetails['link'])) value="{{ $bannerDetails['link'] }}
                      " @else value="{{ old('banner_link') }}" @endif placeholder="enter banner link">
                    </div>
                     <div class="form-group">
                      <label for="banner_title">Banner Title</label>
                      <input type="text" class="form-control" name="banner_title" id="banner_title" @if(!empty($bannerDetails['title'])) value="{{ $bannerDetails['title'] }}
                      " @else value="{{ old('banner_title') }}" @endif placeholder="enter banner title">
                    </div>
                     <div class="form-group">
                      <label for="banner_alt">Banner Alt</label>
                      <input type="text" class="form-control" name="banner_alt" id="banner_alt" @if(!empty($bannerDetails['alt'])) value="{{ $bannerDetails['alt'] }}
                      " @else value="{{ old('banner_alt') }}" @endif placeholder="enter banner alt">
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