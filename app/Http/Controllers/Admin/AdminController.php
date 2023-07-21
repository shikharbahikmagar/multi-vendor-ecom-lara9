<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use App\Models\VendorsBankDetail;
use App\Models\Country;
use App\Models\Category;
use App\Models\Author;
use Response;
use Image;


class AdminController extends Controller
{
    //redirect to dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    // admin login page
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            //laravel validations
                $rules = [
                    'email' => 'required|email|max:255',
                    'password' => 'required',
                ];

                $cutomMessages = [
                    'email.required' => 'Email is Required',
                    'email.email' => 'Valid Email is Required',
                    'password.required' => 'Password is Required',

                ];
                $this->validate($request, $rules, $cutomMessages);
            
                //check if email and password is correct with the help of auth guard
            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'status'=>1]))
            {
                return redirect('admin/dashboard');
            }else
            {
                return redirect()->back()->with('error_message', 'Invalid Email and Password');
            }
        }
        //echo $pass = Hash::make('123456'); die;
        return view('admin.login');
    }
    
    //admin logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    //update admin password
    public function updatePassword(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //check if current password is correct
            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password))
            {
                //check new and confirm password
                if($data['new_password'] == $data['confirm_password'])
                {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password updated Successfully');
                    
                }
                else
                {
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password does not match!');
                }
            }
            else{
                return redirect()->back()->with('error_message', 'Current Password is Incorrect!');
            }
            // if($data['current_password'])
            //echo "<pre>"; print_r($data); die;
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        // echo "<pre>"; print_r($adminDetails); die;
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    //check current password admin
    public function CheckPassword(Request $request)
    {
        $data = $request->all();
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password))
        {
            return "true";
        }
        else
        {
            return "false";
        }
        
        
        
    }
    //update admin details
    public function updateAdminDetail(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
           
            $rules = [
                'user_name' => 'required|regex:/^[\pL\s]+$/u',
                'mobile' => 'required|numeric|digits:10',
            ];
            $cutomMessages = [
                'user_name.required' => 'Name is Required',
                'user_name.regex' => 'Valid Name is Required',
                'mobile.required' => 'Mobile is Required',
                'mobile.numeric' => 'Valid Mobile is Required',
                'mobile.digits' => 'Number must be 10 digits',

            ];
            $this->validate($request, $rules, $cutomMessages);
            //upload admin image
            // dd("hello");
            if($request->hasFile('admin_image'))
            {
           
                $image_tmp = $request->file('admin_image');
                // echo "<pre>"; print_r($image_tmp); die;
                if($image_tmp->isValid())
                {
                   $extension = $image_tmp->getClientOriginalExtension(); 
                   $image_name = rand(111,99999).'.'.$extension;
                   $Image_path = 'admin/images/photos/'.$image_name;

                   Image::make($image_tmp)->save($Image_path);
                    // dd($extension);
                }
            }
            else if(!empty($data['admin_current_image']))
            {
                $image_name = $data['admin_current_image'];
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['user_name'], 
            'mobile'=>$data['mobile'], 'image'=>$image_name]);
            return redirect()->back()->with('success_message', 'Admin Details Updated Successfully');
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        // dd($adminDetails);
        return view('admin.settings.update_admin_details')->with(compact('adminDetails'));
    }
    //update vendors details(personal, business, bank)
    public function updateVendorDetail($slug, Request $request)
    {
        if($slug == "personal")
        {
            if($request->isMethod('post'))
            {
                $data = $request->all();
                //dd($data);
                //echo "<pre>"; print_r($data); die;
            $rules = [
                'vendor_name' => 'required|regex:/^[\pL\s]+$/u',
                'vendor_city' => 'required|regex:/^[\pL\s]+$/u',
                'mobile' => 'required|numeric|digits:10',
            ];
            $cutomMessages = [
                'vendor_name.required' => 'Name is Required',
                'vendor_city.required' => 'City Name is Required',
                'vendor_name.regex' => 'Valid Name is Required',
                'vendor_city.regex' => 'Valid City Name is Required',
                'mobile.required' => 'Mobile is Required',
                'mobile.numeric' => 'Valid Mobile is Required',
                'mobile.digits' => 'Number must be 10 digits',

            ];
            $this->validate($request, $rules, $cutomMessages);
            //upload admin image
            // dd("hello");
            if($request->hasFile('vendor_image'))
            {
           
                $image_tmp = $request->file('vendor_image');
                // echo "<pre>"; print_r($image_tmp); die;
                if($image_tmp->isValid())
                {
                   $extension = $image_tmp->getClientOriginalExtension(); 
                   $image_name = rand(111,99999).'.'.$extension;
                   $Image_path = 'admin/images/photos/'.$image_name;

                   Image::make($image_tmp)->save($Image_path);
                    // dd($extension);
                }
            }
            else if(!empty($data['vendor_current_image']))
            {
                $image_name = $data['vendor_current_image'];
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['vendor_name'], 
            'mobile'=>$data['mobile'], 'image'=>$image_name]);
            //update vendor table
              Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(['name'=>$data['vendor_name'],'address'=>$data['vendor_address'],
              'city'=>$data['vendor_city'],'state'=>$data['vendor_state'],'country'=>$data['vendor_country'],'pincode'=>$data['vendor_pincode'],
            'mobile'=>$data['mobile'], 'image'=>$image_name]);
            return redirect()->back()->with('success_message', 'Vendors Personal Details Updated Successfully');
            }
            $countries = Country::where('status', 1)->get()->toArray();
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first();
            $form_title = "Update Personal Information";
            //dd($vendorDetails);
            return view('vendor.settings.update_vendor_details')->with(compact('countries','form_title','slug','vendorDetails'));
        }
       else if($slug == "business")
        {
             if($request->isMethod('post'))
            {
                $data = $request->all();
                // dd($data);
            $rules = [
                'shop_name' => 'required|regex:/^[\pL\s]+$/u',
                'shop_city' => 'required|regex:/^[\pL\s]+$/u',
                'shop_mobile' => 'required|numeric|digits:10',
                'address_proof'=>'required',
            ];
            $cutomMessages = [
                'shop_name.required' => 'Name is Required',
                'shop_city.required' => 'City Name is Required',
                'shop_name.regex' => 'Valid Name is Required',
                'shop_city.regex' => 'Valid City Name is Required',
                'shop_mobile.required' => 'Mobile is Required',
                'shop_mobile.numeric' => 'Valid Mobile is Required',
                'shop_mobile.digits' => 'Number must be 10 digits',
                'address_proof.required' => 'Address proof is Required',

            ];
            $this->validate($request, $rules, $cutomMessages);
            //upload admin image
            // dd("hello");
            if($request->hasFile('address_proof_image'))
            {
           
                $image_tmp = $request->file('address_proof_image');
                // echo "<pre>"; print_r($image_tmp); die;
                if($image_tmp->isValid())
                {
                   $extension = $image_tmp->getClientOriginalExtension(); 
                   $image_name = rand(111,99999).'.'.$extension;
                   $Image_path = 'vendor/images/address_proof/'.$image_name;

                   Image::make($image_tmp)->save($Image_path);
                    // dd($extension);
                }
            }
            else if(!empty($data['current_proof_image']))
            {
                $image_name = $data['current_proof_image'];
            }

            //update vendor business details table
            VendorsBusinessDetail::where('id', Auth::guard('admin')->user()->vendor_id)->update(['vendor_id'=>Auth::guard('admin')->user()->vendor_id, 'shop_name'=>$data['shop_name'],'shop_address'=>$data['shop_address'],
              'shop_city'=>$data['shop_city'],'shop_state'=>$data['shop_state'],'shop_country'=>$data['shop_country'],'shop_pincode'=>$data['shop_pincode'],
            'shop_mobile'=>$data['shop_mobile'],'address_proof'=>$data['address_proof'], 'address_proof_image'=>$image_name, 'shop_website'=>$data['shop_website'], 'shop_email'=>$data['shop_email'],
        'business_license_number'=>$data['business_license_number'], 'gst_number'=>$data['gst_number'], 'pan_number'=>$data['pan_number']]);
            return redirect()->back()->with('success_message', 'Vendors Business Details Updated Successfully');
        }
            $vendorBusinessDetails = VendorsBusinessDetail::where('id', Auth::guard('admin')->user()->vendor_id)->first();
            $form_title = "Update Business Information";
            $countries = Country::where('status', 1)->get()->toArray();
            //dd($vendorBusinessDetails);
            return view('vendor.settings.update_vendor_details')->with(compact('countries','form_title','slug','vendorBusinessDetails'));
        }
       else if($slug = "bank")
        {
            if($request->isMethod('post'))
            {
                $data = $request->all();
                // dd($data);
            $rules = [
                'account_holder_name' => 'required|regex:/^[\pL\s]+$/u',
                'bank_name' => 'required|regex:/^[\pL\s]+$/u',
                'account_number' => 'required|numeric',
                'bank_ifsc_code' => 'required',
            ];
            $cutomMessages = [
                'account_holder_name.required' => 'Name is Required',
                'bank_name.required' => 'City Name is Required',
                'bank_ifsc_code.required' => 'IFSC Number is Required',
                'account_holder_name.regex' => 'Valid Name is Required',
                'bank_name.regex' => 'Valid City Name is Required',
                'account_number.required' => 'Account Number is Required',
                'account_number.numeric' => 'Valid Account Number is Required',

            ];
            $this->validate($request, $rules, $cutomMessages);

            //update vendor bank details table
              VendorsBankDetail::where('id', Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name'=>$data['account_holder_name'],'bank_name'=>$data['bank_name'],
              'account_number'=>$data['account_number'],'bank_ifsc_code'=>$data['bank_ifsc_code']]);
            return redirect()->back()->with('success_message', 'Vendors Bank Details Updated Successfully');
            }
            $vendorBankDetails = VendorsBankDetail::where('id', Auth::guard('admin')->user()->vendor_id)->first();
            $form_title = "Update Bank Information";
            //dd($vendorBankDetails);
             return view('vendor.settings.update_vendor_details')->with(compact('form_title','slug','vendorBankDetails'));
        }
        
        

    }
    //admins management
    public function admins($type = null)
    {

        $admins = Admin::query();
        if(!empty($type))
        {
            $admin = $admins->where('type', $type);
            $title = ucfirst($type)."s";
            $admins = $admins->get()->toArray();
        }
        else{
            $title = "All Admins/Vendors/SubAdmins";
            $admins = Admin::get()->toArray();
        }
        //dd($admins);
        return view('admin.admins.admins')->with(compact('admins', 'title'));
    }
    //view vendor details
    public function viewVendorDetail($id)
    {
        $vendorDetails = Admin::with('VendorPersonal', 'VendorBusiness', 'VendorBank')->where('id', $id)->first();
        // echo "<pre>"; print_r($vendorDetails); die;
        // $vendorDetails = json_decode(json_encode($vendorDetails), true);
        // dd($vendorDetails);
        return view('admin.admins.view_vendor_details')->with(compact('vendorDetails'));
    }
    //update admin status
    public function updateAdminStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active")
            {
                $status = 0;
            } 
            else
            {
                $status = 1;
            }
            Admin::where('id', $data['admin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'admin_id'=>$data['admin_id']]);
            
        }
    }
    //catalogues for admin
    public function adminCatalogue($type)
    {
        if($type == "genres")
        {
            $genres = Category::where('status', 1)->get()->toArray();
            return view('admin.settings.view_admin_catalogues')->with(compact('type', 'genres'));
        }
        
        
    }
    //catalogue for vendor
    public function vendorCatalogue($type)
    {
        // dd($type);
        if($type == "genres")
        {
            $genres = Category::where(['vendor_id'=> Auth::guard('admin')->user()->vendor_id])->get()->toArray();
            // dd($genres);
             return view('vendor.catalogue.genre')->with(compact('type', 'genres'));
        }
        //for authors table
        else if($type == "authors")
        {
            $authors = Author::where(['vendor_id'=> Auth::guard('admin')->user()->vendor_id])->get()->toArray();
            dd($authors);
             return view('vendor.catalogue.authors')->with(compact('type', 'authors'));
        }
    }
    public function addEditGenre(Request $request, $id=null)
    {
        if($id == "")
        {
            $title = "Add Genres";
            $message = "Category Added Successfully";
            $catDetails = New Category;
        }else
        {
            $title = "Edit Genres";
            $message = "Category Updated Successfully";
            $catDetails = Category::find($id);
            // echo "<pre>"; print_r($catDetails); die;
        }
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $rules = [
                'cat_name' => 'required|regex:/^[\pL\s]+$/u',
                'description' => 'required',
                'url' => 'required',
            ];
            $cutomMessages = [
                'cat_name.required' => 'Name is Required',
                'description.required' => 'Description is Required',
                'url.required' => 'URL is Required',
                'cat_name.regex' => 'Valid Name is Required',
               

            ];
            $this->validate($request, $rules, $cutomMessages);
              if($request->hasFile('cat_image'))
            {
           
                $image_tmp = $request->file('cat_image');
                // echo "<pre>"; print_r($image_tmp); die;
                if($image_tmp->isValid())
                {
                   $extension = $image_tmp->getClientOriginalExtension(); 
                   $image_name = rand(111,99999).'.'.$extension;
                   $Image_path = 'vendor/images/category_images/'.$image_name;

                   Image::make($image_tmp)->save($Image_path);
                    // dd($extension);
                }
            }
            else if(!empty($data['current_cat_image']))
            {
                $image_name = $data['current_cat_image'];
            }
            //save to database
            $catDetails->vendor_id = Auth::guard('admin')->user()->vendor_id;            
            $catDetails->category_name = $data['cat_name'];
            $catDetails->category_image = $image_name;
            $catDetails->category_discount = $data['cat_discount'];
            $catDetails->description = $data['description'];
            $catDetails->url = $data['url'];
            $catDetails->meta_title = $data['meta_title'];
            $catDetails->meta_description = $data['meta_description'];
            $catDetails->meta_keywords = $data['meta_keywords'];
            $catDetails->status = 1;
            $catDetails->save();
            
            return redirect('admin/vendor/genres')->with('success_message', $message);

        }

        // $catDetails = Category::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->get()->toArray();
        return view('vendor.catalogue.add_edit_genre')->with(compact('catDetails', 'title'));

    }
    //update genres status
    public function updateGenreStatus(Request $request)
    {
        if($request->ajax())
        {

            $data = $request->all();
            //echo"<pre>"; print_r($data); die;
            if($data['status'] == "Active")
            {
                $status = 0;
            }
            else if($data['status'] = "InActive")
            {
                $status = 1;
            }
            Category::where('id', $data['genre_id'])->update(['status'=> $status]);
            
            return response()->json(['status'=> $status, 'genre_id'=>$data['genre_id']]);
        }
    }

    //delete genre
    public function deleteGenre($id)
    {
       $data =  Category::where('id', $id)->delete();
       return redirect('admin/vendor/genres')->with('success_message', 'Category Deleted Successfully');
        //dd($data);
    }
}
