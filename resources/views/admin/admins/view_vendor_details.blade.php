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
            <!-- vendor personal details -->
            <div class="col-md-6 grid-margin stretch-card">
               <div class="card">
                  <div class="card-body">
                     <h4 class="card-title">Vendor Personal Informations</h4>
                     <!-- vendors personal details -->
                     <div class="form-group">
                        <label for="email">Vendor Username/Email</label>
                        <input readonly="" type="email" name="email" value="{{ $vendorDetails['vendorPersonal']['email'] }}" class="form-control" id="email" readonly="">
                     </div>
                     <div class="form-group">
                        <label for="vendor_name">Vendor Name</label>
                        <input readonly="" type="text" class="form-control" name="vendor_name" id="vendor_name" value="{{ $vendorDetails['vendorPersonal']['name'] }}">
                     </div>
                     <div class="form-group">
                        <label for="vendor_address">Address</label>
                        <input readonly="" type="text" name="vendor_address" class="form-control" id="vendor_address" value="{{ $vendorDetails['vendorPersonal']['address'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="vendor_city">City</label>
                        <input readonly="" type="text" name="vendor_city" class="form-control" id="vendor_city" value="{{ $vendorDetails['vendorPersonal']['city'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="vendor_state">State</label>
                        <input readonly="" type="text" name="vendor_state" class="form-control" id="vendor_state" value="{{ $vendorDetails['vendorPersonal']['state'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="vendor_country">Country</label>
                        <input readonly="" type="text" name="vendor_country" class="form-control" id="vendor_country" value="{{ $vendorDetails['vendorPersonal']['country'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="vendor_pincode">Pincode</label>
                        <input readonly="" type="text" name="vendor_pincode" class="form-control" id="vendor_pincode" value="{{ $vendorDetails['vendorPersonal']['pincode'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input readonly="" type="text" name="mobile" class="form-control" id="mobile"  value="{{ $vendorDetails['vendorPersonal']['mobile'] }}" placeholder="mobile">
                     </div>
                     <div class="form-group"> 
                        <label for="vendor_image">Photo</label><br>
                        <img style="width: 200px; height: 200px;" src="{{ asset('admin/images/photos/'.$vendorDetails['vendorPersonal']['image']) }}" alt="Vendor Image">
                     </div>
                  </div>
               </div>
            </div>
              <!-- business details -->
            <div class="col-md-6 grid-margin stretch-card">
               <div class="card">
                  <div class="card-body">
                     <h4 class="card-title">Vendor Business Informations</h4>
                     <div class="form-group">
                        <label for="shop_email">Shop Email</label>
                        <input readonly="" type="email" readonly="" name="shop_email" value="{{ $vendorDetails['VendorBusiness']['shop_email'] }}" class="form-control" id="shop_email">
                     </div>
                     <div class="form-group">
                        <label for="shop_name">Shop Name</label>
                        <input readonly="" type="text" class="form-control" name="shop_name" id="shop_name" value="{{ $vendorDetails['VendorBusiness']['shop_name'] }}">
                     </div>
                     <div class="form-group">
                        <label for="shop_address">Shop Address</label>
                        <input readonly="" type="text" name="shop_address" class="form-control" id="shop_address" value="{{ $vendorDetails['VendorBusiness']['shop_address'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="shop_city">Shop City</label>
                        <input readonly="" type="text" name="shop_city" class="form-control" id="shop_city" value="{{ $vendorDetails['VendorBusiness']['shop_city'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="shop_state">Shop State</label>
                        <input readonly="" type="text" name="shop_state" class="form-control" id="shop_state" value="{{ $vendorDetails['VendorBusiness']['shop_state'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="shop_country">Shop Country</label>
                        <input readonly="" type="text" name="shop_country" class="form-control" id="shop_country" value="{{ $vendorDetails['VendorBusiness']['shop_country'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="shop_pincode">Shop Pincode</label>
                        <input readonly="" type="text" name="shop_pincode" class="form-control" id="shop_pincode"  value="{{ $vendorDetails['VendorBusiness']['shop_pincode'] }}" placeholder="mobile">
                     </div>
                     <div class="form-group">
                        <label for="shop_mobile">Shop Mobile</label>
                        <input readonly="" type="text" name="shop_mobile" class="form-control" id="shop_mobile" value="{{ $vendorDetails['VendorBusiness']['shop_mobile'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="shop_website">Shop Website</label>
                        <input readonly="" type="text" name="shop_website" class="form-control" id="shop_website" value="{{ $vendorDetails['VendorBusiness']['shop_website'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="business_license_number">Business License Number</label>
                        <input readonly="" type="text" name="business_license_number" class="form-control" id="business_license_number" value="{{ $vendorDetails['VendorBusiness']['business_license_number'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="gst_number">Gst Number</label>
                        <input readonly="" type="text" name="gst_number" class="form-control" id="gst_number" value="{{ $vendorDetails['VendorBusiness']['gst_number'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="pan_number">Pan Number</label>
                        <input readonly="" type="text" name="pan_number" class="form-control" id="pan_number"  value="{{ $vendorDetails['VendorBusiness']['pan_number'] }}" placeholder="mobile">
                     </div>
                     <div class="form-group">
                        <label for="address_proof">Address Proof</label>
                        <select name="address_proof" readonly="" id="address_proof" class="form-control">
                        <option value="passport" @if( $vendorDetails['VendorBusiness']['address_proof'] == "passport") selected="" @endif>Passport</option>
                        <option value="voting card"@if( $vendorDetails['VendorBusiness']['address_proof'] == "voting card") 
                        selected="" @endif>Voting Card</option>
                        <option value="license" @if( $vendorDetails['VendorBusiness']['address_proof'] == "license") 
                        selected="" @endif>License</option>
                        <option value="citizenship" @if( $vendorDetails['VendorBusiness']['address_proof'] == "citizenship") 
                        selected="" @endif>Citizenship</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="address_proof_image">Address Proof Image</label><br>
                        <img style="width: 200px; height: 200px;" src="{{ asset('vendor/images/address_proof/'.$vendorDetails['VendorBusiness']['address_proof_image']) }}" alt="Address Proof Image">
                     </div>
                  </div>
               </div>
            </div>
            <!-- bank details -->
            <div class="col-md-6 grid-margin stretch-card">
               <div class="card">
                  <div class="card-body">
                     <h4 class="card-title">Vendor Bank Informations</h4>
                     <div class="form-group">
                        <label for="account_holder_name">Account Holder Name</label>
                        <input readonly="" type="text" name="account_holder_name" value="{{ $vendorDetails['VendorBank']['account_holder_name'] }}" class="form-control" id="account_holder_name">
                     </div>
                     <div class="form-group">
                        <label for="bank_name">Bank Name</label>
                        <input readonly="" type="text" class="form-control" name="bank_name" id="bank_name" value="{{ $vendorDetails['VendorBank']['bank_name'] }}">
                     </div>
                     <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <input readonly="" type="text" name="account_number" class="form-control" id="account_number" value="{{ $vendorDetails['VendorBank']['account_number'] }}" placeholder="name">
                     </div>
                     <div class="form-group">
                        <label for="bank_ifsc_code">Bank IFSC Code</label>
                        <input readonly="" type="text" name="bank_ifsc_code" class="form-control" id="bank_ifsc_code" value="{{ $vendorDetails['VendorBank']['bank_ifsc_code'] }}" placeholder="name">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection