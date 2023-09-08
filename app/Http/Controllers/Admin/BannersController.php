<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Image;
use Session;

class BannersController extends Controller
{
    public function banner()
    {
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        return view('admin.banners.banners')->with(compact('banners'));
    }

    //update banner status
    public function updateBannerStatus(Request $request)
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

            Banner::where('id', $data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }

    //delete banner
    public function deleteBanner($id)
    {
        Banner::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Banner Deleted Successfully');
    }

    //add edit banner
    public function addEditBanner(Request $request, $id=null)
    {
        if($id == "")
        {
            $banners = New Banner;
            $title = "Add Banner";
            $message = "Banner Added Successfully";
        }else
        {
            $banners = Banner::find($id);
            $title = "Update Banner";
            $message = "Banner Updated Successfully";
        }
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //dd($data);
            $banners->link = $data['banner_link'];
            $banners->type = $data['banner_type'];
            $banners->title = $data['banner_title'];
            $banners->alt = $data['banner_alt'];
            $banners->status = 1;

            if($data['banner_type'] == "slider")
            {
                $width = "1920";
                $height = "720";
                
            }else if($data['banner_type'] == "fix")
            {
                $width = "1920";
                $height = "450";
            }

            if($request->hasFile('banner_image'))
            {
                $image_tmp = $request->file('banner_image');
                // echo "<pre>"; print_r($image_tmp); die;
                if($image_tmp->isValid())
                {
                   $extension = $image_tmp->getClientOriginalExtension();
                   $image_name = rand(111,99999).'.'.$extension;
                   $Image_path = 'admin/images/banner_images/'.$image_name;

                   Image::make($image_tmp)->resize($width, $height)->save($Image_path);
                    // dd($extension);
                }
            }
            else
            {
                $image_name = $data['current_banner_image'];
            }
            $banners->image = $image_name;
            $banners->save();

            return redirect('admin/banners')->with('success_message', $message);
        }
        $bannerDetails = Banner::where('id', $id)->get()->first();
        //dd($bannerDetails);
        return view('admin.banners.add_edit_banner')->with(compact('bannerDetails', 'title'));
    }

}
