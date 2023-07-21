@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <div class="row">
      <div class="col-md-12 grid-margin">
         <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
               <h3 class="font-weight-bold">Vendor Details</h3>
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
                  <h4 class="card-title">{{$form_title}}</h4>
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
                <!-- vendors personal details -->
                @if($slug == "personal")
                  <form class="forms-sample" action="{{ url('/admin/update-vendor-details/personal')}}" enctype="multipart/form-data" method="post">@csrf
                    <div class="form-group">
                      <label for="email">Vendor Username/Email</label>
                      <input type="email" name="email" value="{{ $vendorDetails['email'] }}" class="form-control" id="email" readonly="">
                    </div>
                    <div class="form-group">
                      <label for="vendor_name">Vendor Name</label>
                      <input type="text" class="form-control" name="vendor_name" id="vendor_name" value="{{ $vendorDetails['name'] }}">
                    </div>
                    <div class="form-group">
                      <label for="vendor_address">Address</label>
                      <input type="text" name="vendor_address" class="form-control" id="vendor_address" value="{{ $vendorDetails['address'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="vendor_city">City</label>
                      <input type="text" name="vendor_city" class="form-control" id="vendor_city" value="{{ $vendorDetails['city'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="vendor_state">State</label>
                      <input type="text" name="vendor_state" class="form-control" id="vendor_state" value="{{ $vendorDetails['state'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="vendor_country">Country</label>
                      <select class="form-control" name="vendor_country" id="vendor_country">
                        <!-- <option value="">Select</option> -->
                        @foreach($countries as $country)
                        <option @if($vendorDetails['country'] == $country['country_name']) selected="" @endif value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="vendor_pincode">Pincode</label>
                      <input type="text" name="vendor_pincode" class="form-control" id="vendor_pincode" value="{{ $vendorDetails['pincode'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="text" name="mobile" class="form-control" id="mobile"  value="{{ $vendorDetails['mobile'] }}" placeholder="mobile">
                    </div>
                    <div class="form-group">
                      <label for="vendor_image">Image</label>
                      <input type="file" name="vendor_image" class="form-control" id="vendor_image" >
                      @if(!empty(Auth::guard('admin')->user()->image))
                      <a target="_blank" href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                      <input type="hidden" name="vendor_current_image" id="vendor_current_image" value="{{ Auth::guard('admin')->user()->image }}">
                      @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                @endif
                <!-- vendors business details -->
                @if($slug == "business")
                  <form class="forms-sample" action="{{ url('/admin/update-vendor-details/business')}}" enctype="multipart/form-data" method="post">@csrf
                    <div class="form-group">
                      <label for="shop_email">Shop Email</label>
                      <input type="email" readonly="" name="shop_email" value="{{ $vendorBusinessDetails['shop_email'] }}" class="form-control" id="shop_email">
                    </div>
                    <div class="form-group">
                      <label for="shop_name">Shop Name</label>
                      <input type="text" class="form-control" name="shop_name" id="shop_name" value="{{ $vendorBusinessDetails['shop_name'] }}">
                    </div>
                    <div class="form-group">
                      <label for="shop_address">Shop Address</label>
                      <input type="text" name="shop_address" class="form-control" id="shop_address" value="{{ $vendorBusinessDetails['shop_address'] }}" placeholder="name">
                    </div>
                     <div class="form-group">
                      <label for="shop_city">Shop City</label>
                      <input type="text" name="shop_city" class="form-control" id="shop_city" value="{{ $vendorBusinessDetails['shop_city'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="shop_state">Shop State</label>
                      <input type="text" name="shop_state" class="form-control" id="shop_state" value="{{ $vendorBusinessDetails['shop_state'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="shop_country">Shop Country</label>
                      <select class="form-control" name="shop_country" id="shop_country">
                        <!-- <option value="">Select</option> -->
                        @foreach($countries as $country)
                        <option @if($vendorBusinessDetails['shop_country'] == $country['country_name']) selected="" @endif value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="shop_pincode">Shop Pincode</label>
                      <input type="text" name="shop_pincode" class="form-control" id="shop_pincode"  value="{{ $vendorBusinessDetails['shop_pincode'] }}" placeholder="mobile">
                    </div>
                    <div class="form-group">
                      <label for="shop_mobile">Shop Mobile</label>
                      <input type="text" name="shop_mobile" class="form-control" id="shop_mobile" value="{{ $vendorBusinessDetails['shop_mobile'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="shop_website">Shop Website</label>
                      <input type="text" name="shop_website" class="form-control" id="shop_website" value="{{ $vendorBusinessDetails['shop_website'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="business_license_number">Business License Number</label>
                      <input type="text" name="business_license_number" class="form-control" id="business_license_number" value="{{ $vendorBusinessDetails['business_license_number'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="gst_number">Gst Number</label>
                      <input type="text" name="gst_number" class="form-control" id="gst_number" value="{{ $vendorBusinessDetails['gst_number'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="pan_number">Pan Number</label>
                      <input type="text" name="pan_number" class="form-control" id="pan_number"  value="{{ $vendorBusinessDetails['pan_number'] }}" placeholder="mobile">
                    </div>
                    <div class="form-group">
                      <label for="address_proof">Address Proof</label>
                    <select name="address_proof" id="address_proof" class="form-control">
                      <option value="passport" @if( $vendorBusinessDetails['address_proof'] == "passport") selected="" @endif>Passport</option>
                      <option value="voting card"@if( $vendorBusinessDetails['address_proof'] == "voting card") 
                      selected="" @endif>Voting Card</option>
                      <option value="license" @if( $vendorBusinessDetails['address_proof'] == "license") 
                      selected="" @endif>License</option>
                      <option value="citizenship" @if( $vendorBusinessDetails['address_proof'] == "citizenship") 
                      selected="" @endif>Citizenship</option>
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="address_proof_image">Address Proof Image</label>
                      <input type="file" name="address_proof_image" class="form-control" id="address_proof_image" >
                      @if(!empty($vendorBusinessDetails['address_proof_image']))
                      <a target="_blank" href="{{ url('vendor/images/address_proof/'.$vendorBusinessDetails['address_proof_image']) }}">View Image</a>
                      <input type="hidden" name="current_proof_image" id="current_proof_image" value="{{ $vendorBusinessDetails['address_proof_image'] }}">
                      @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                @endif
                <!-- vendors bank details -->
                @if($slug == "bank")
                  <form class="forms-sample" action="{{ url('/admin/update-vendor-details/bank')}}" enctype="multipart/form-data" method="post">@csrf
                    <div class="form-group">
                      <label for="account_holder_name">Account Holder Name</label>
                      <input type="text" name="account_holder_name" value="{{ $vendorBankDetails['account_holder_name'] }}" class="form-control" id="account_holder_name">
                    </div>
                    <div class="form-group">
                      <label for="bank_name">Bank Name</label>
                      <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ $vendorBankDetails['bank_name'] }}">
                    </div>
                    <div class="form-group">
                      <label for="account_number">Account Number</label>
                      <input type="text" name="account_number" class="form-control" id="account_number" value="{{ $vendorBankDetails['account_number'] }}" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="bank_ifsc_code">Bank IFSC Code</label>
                      <input type="text" name="bank_ifsc_code" class="form-control" id="bank_ifsc_code" value="{{ $vendorBankDetails['bank_ifsc_code'] }}" placeholder="name">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                @endif
                </div>
              </div>
            </div>
          </div>
      </div>
   </div>
</div>

@endsection