<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Session;

class BrandController extends Controller
{
    public function brands()
    {
        Session::put('page', 'brands');
        $brands = Brand::get()->toArray();
        return view('admin.brands.brands')->with(compact('brands'));
    }

    //update brand status
    public function updateBrandStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            if($data['status'] == "Active")
            {
                $status = 0;
            }else if($data['status'] == "InActive")
            {
                $status = 1; 
            }

            Brand::where('id', $data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }

    //delete brand
    public function deleteBrand($id)
    {
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Brand Deleted Successfully');
    }

    //add edit brand
    public function addEditBrand(Request $request, $id=null)
    {
         Session::put('page', 'brands');
        if($id == "")
        {
            $brand = New Brand;
            $message = "Brand Added Successfully";
            $title = "Add Brand";
        }else
        {
            $brand = Brand::find($id);
            $title = "Update Brand";
            $message = "Brand Updated SUccessfully";
        }

        if($request->isMethod('post'))
        {
            $data = $request->all();

            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $custom_messages = [
                'brand_name.required' => 'Brand Name is Required!',
                'brand_name.regex' => 'Enter Valid Brand Name!',
            ];
            $this->validate($request, $rules, $custom_messages);

            $brand->name = $data['brand_name'];
            $brand->status = 1;
            $brand->save();

           return redirect('/admin/brands')->with('success_message', $message);
        }

        return view('admin.brands.add_edit_brand')->with(compact('brand', 'title'));
    }
}
