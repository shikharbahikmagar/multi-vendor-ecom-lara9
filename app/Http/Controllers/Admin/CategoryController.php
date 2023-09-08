<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Image;
use Session;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'categories');
            $categories = Category::with('parentcategory')->get();
            return view('admin.categories.categories')->with(compact('categories'));
    }

    public function addEditCategory(Request $request, $id=null)
    {
        if($id == "")
        {
            $title = "Add Category";
            $message = "Category Added Successfully";
            $categories = New Category;
            $getCategories = Category::where('parent_id', 0)->get()->toArray();
        }else
        {
            $title = "Edit Category";
            $message = "Category Updated Successfully";
            $categories = Category::find($id);
             $getCategories = Category::with('subcategories')->where(['parent_id'=>0, 'section_id'=>$categories['section_id']])->get();
            //$getCategories = json_decode(json_encode($getCategories), true);
             //echo "<pre>"; print_r($getCategories); die;
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
                   $Image_path = 'admin/images/category_images/'.$image_name;

                   Image::make($image_tmp)->save($Image_path);
                    // dd($extension);
                }
            }
            else if(!empty($data['current_cat_image']))
            {
                $image_name = $data['current_cat_image'];
            }
            //save to database
            $categories->parent_id = $data['parent_id'];
            $categories->section_id = $data['section_id'];
            $categories->category_name = $data['cat_name'];
            $categories->category_image = $image_name;
            $categories->category_discount = $data['cat_discount'];
            $categories->description = $data['description'];
            $categories->url = $data['url'];
            $categories->meta_title = $data['meta_title'];
            $categories->meta_description = $data['meta_description'];
            $categories->meta_keywords = $data['meta_keywords'];
            $categories->status = 1;
            $categories->save();

            return redirect('admin/categories')->with('success_message', $message);

        }
        //echo "<pre>"; print_r($categories); die;
       
        //echo "<pre>"; print_r($categories['parentcategory']); die;
        $sections = Section::get();
        return view('admin/categories/add_edit_categories')->with(compact('categories', 'getCategories', 'title', 'sections'));

    }
    //update genres status
    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax())
        {

            $data = $request->all();
            //echo"<pre>"; print_r($data); die;
            if($data['status'] == "Active")
            {
                $status = 0;
            }
            else if($data['status'] == "InActive")
            {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status'=> $status]);

            return response()->json(['status'=> $status, 'category_id'=>$data['category_id']]);
        }
    }

    //delete category
    public function deleteCategory($id)
    {
       $data =  Category::where('id', $id)->delete();
       return redirect('admin/categories')->with('success_message', 'Category Deleted Successfully');
        //dd($data);
    }

    //delete category image
    public function deleteCategoryImage($id)
    {
        $category_image = Category::select('category_image')->where('id', $id)->first();

        //category image path
        $category_image_path = 'admin/images/category_images/';

        //delete image from folder location
        if(file_exists($category_image_path.$category_image->category_image))
        {
            unlink($category_image_path.$category_image->category_image);
        }

        //remove image from database
        Category::where('id', $id)->update(['category_image'=>'']);

        $message = "Image deleted successfully";
        return redirect()->back()->with('success_message', $message);
    }
}
