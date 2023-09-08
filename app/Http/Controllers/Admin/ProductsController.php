<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use Auth;
use Image;


class ProductsController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');

        $products = Product::with(['section'=>function($query){
            $query->select('id', 'name');
        }, 'category'=>function($query){
            $query->select('id', 'category_name');
        }])->get()->toArray();
        //dd($products);

        return view('admin.products.products')->with(compact('products'));
    }
    //product status
    public function updateProductStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            // dd($data);
            if($data['status'] == "Active")
            {
                $status = 0;

            }elseif($data['status'] == "InActive")
            {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);
        }
    }
    //delete product
    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();

        $message = 'Product Deleted Successfully';
        return redirect()->back()->with('success_message', $message);
    }

    //product add edit
    public function addEditProduct(Request $request, $id = null)
    {
        if($id == "")
        {
            $product = New Product;
            $title = "Update Product";
            $message = "Product Added Successfully";
        }
        else
        {
            $product = Product::find($id);
            $title = "Update Product";
            $message = "Product Updated Successfully";
        }

        if($request->isMethod('post'))
        {
            $data = $request->all();
            //dd($data);
             $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessages = [
                'category_id.required' => 'category is required',
                'product_name.required' => 'Name is required',
                'product_name.regex' => 'Valid name is required',
                'product_code.required' => 'Product Code is required',
                'product_code.regex' => 'valid product code is required',
                'product_price.required' => 'Product price is required',
                'product_price.numeric' => 'valid product price is required',
                'product_color.required' => 'Product color is required',
                'product_color.regex' => 'Valid product color is required',
            ];
            
            $this->validate($request, $rules, $customMessages);

            if(empty($data['is_featured']))
            {
                $is_featured = "No";
            }else
            {
                $is_featured = "Yes";
            }
             if(empty($data['is_bestseller']))
            {
                $is_bestseller = "No";
            }else
            {
                $is_bestseller = "Yes";
            }

                        //upload image
            if($request->hasFile('product_image'))
            {
                $image_tmp = $request->file('product_image');
                if($image_tmp->isValid())
                {
                    $image_name = $image_tmp->getClientOriginalName();
                    $ImageFileName = pathinfo($image_name,PATHINFO_FILENAME);
                    $image_extension = $image_tmp->getClientOriginalExtension();
                    $imageName = $ImageFileName.'-'.rand(111,9999).'.'.$image_extension;
                    $large_image_path = 'admin/images/product_images/large/'.$imageName;
                    $medium_image_path = 'admin/images/product_images/medium/'.$imageName;
                    $small_image_path = 'admin/images/product_images/small/'.$imageName;
                    //save image to product_images folder
                    Image::make($image_tmp)->save($large_image_path); //original size will be  1040*1200 
                    Image::make($image_tmp)->resize(520, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260, 300)->save($small_image_path);
                    //save image name to database
                    $product->product_image = $imageName;
                }
            }

            //upload video of product
            if($request->hasFile('product_video'))
            {
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid())
                {
                    $video_name = $video_tmp->getClientOriginalName();
                    
                    $videoFileName = pathinfo($video_name,PATHINFO_FILENAME);
                    $video_extension = $video_tmp->getClientOriginalExtension();
                    
                    $videoName = $videoFileName.'-'.rand(111, 9999).'.'.$video_extension;
                    // dd($videoName);
                    $video_path = 'admin/videos/product_videos/';
                    //move video to videos/product_videos
                    $video_tmp->move($video_path, $videoName);
                    //save to table
                    $product->product_video = $videoName;

                }
            }

            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_type = Auth::guard('admin')->user()->type;
            $admin_id = Auth::guard('admin')->user()->id;

             //save product details into table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id']; 
            $product->vendor_id = $vendor_id;
            $product->admin_id = $admin_id;
            $product->admin_type = $admin_type;
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->is_featured = $is_featured;
            $product->is_bestseller = $is_bestseller;
            $product->status = 1;

            $product->save();

            return redirect('admin/products')->with('success_message', $message);
        }

        $getcategories = Section::with('categories')->get()->toArray();
        $brands = Brand::get()->toArray();
        //dd($getcategories);
        return view('admin.products.add_edit_product')->with(compact('title', 'product', 'getcategories', 'brands'));
    }

    //delete product image
    public function deleteProductImage($id)
    {
         $product_image = Product::select('product_image')->where('id', $id)->first();

        //category image path
        $product_small_image_path = 'admin/images/product_images/small/';
        $product_medium_image_path = 'admin/images/product_images/medium/';
        $product_large_image_path = 'admin/images/product_images/large/';

        //delete image from folder location
        if(file_exists($product_small_image_path.$product_image->product_image) || file_exists($product_medium_image_path.$product_image->product_image) ||
        file_exists($product_large_image_path.$product_image->product_image))
        {
            unlink($product_small_image_path.$product_image->product_image);
            unlink($product_medium_image_path.$product_image->product_image);
            unlink($product_large_image_path.$product_image->product_image);
        }

        //remove image from database
        Product::where('id', $id)->update(['product_image'=>'']);

        $message = "Image deleted successfully";
        return redirect()->back()->with('success_message', $message);
    }

    //delete product video

    public function deleteProductVideo($id)
    {
        $product_video = Product::select('product_video')->where('id', $id)->first();

        //category image path
        $product_video_path = 'admin/videos/product_videos/';

        //delete image from folder location
        if(file_exists($product_video_path.$product_video->product_video))
        {
            unlink($product_video_path.$product_video->product_video);
        }

        //remove image from database
        Product::where('id', $id)->update(['product_video'=>'']);

        $message = "Image deleted successfully";
        return redirect()->back()->with('success_message', $message);
    }

    //add edit products attribute
    public function addProductAttribute(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            foreach($data['sku'] as $key => $value)
            {
                if(!empty($value))
                {
                    $attributes = New ProductsAttribute;
                    $attributes->product_id = $id;
                    $attributes->sku = $value;
                    $attributes->size = $data['size'][$key];
                    $attributes->price = $data['price'][$key];
                    $attributes->stock = $data['stock'][$key];
                    $attributes->status = 1;
                    $attributes->save();
                }
            }
            return redirect('admin/products')->with('success_message', 'Attribute Added Successfully');
        }


        $products = Product::find($id);
        //dd($products);
        $attributes = ProductsAttribute::where('product_id', $id)->get()->toArray();
        //echo "<pre>"; print_r($attributes); die;
        return view('admin.products.add_edit_attributes')->with(compact('products', 'attributes'));
    }

    //update product attribute
    public function updateAttribute(Request $request, $id = null)
    {
        if($request->isMethod('post'))
        {
           $data =  $request->all();
           //echo "<pre>"; print_r($data); die;
           foreach($data['attribute_id'] as $key => $attribute)
           {
                ProductsAttribute::where(['id'=> $data['attribute_id'][$key]])->update(['price'=>$data['price'][$key],
                'stock'=>$data['stock'][$key]]);
           }
            return redirect()->back()->with('success_message', 'Product Attributes updated successfully');
        }
    }
    //update attribute status

    public function updateAttributeStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            // dd($data);
            if($data['status'] == "Active")
            {
                $status = 0;

            }elseif($data['status'] == "InActive")
            {
                $status = 1;
            }
            ProductsAttribute::where('id', $data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'attribute_id'=>$data['attribute_id']]);

        }
    }
    //delete product attribute
    public function deleteAttribute($id)
    {
        ProductsAttribute::where('id', $id)->delete();

        $message = 'Product Attribute Deleted Successfully';
        return redirect()->back()->with('success_message', $message);
    }

    //add product image
    public function addImage(Request $request, $id = null)
    {
        $productDetails = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'product_image')
        ->with('images')->find($id);
        // $products_images = ProductsImage::where('product_id', $id)->get()->toArray();
        //echo "<pre>"; print_r($productDetails); die;
        if($request->isMethod('post'))
        {
            $data = $request->all();
               
            if($request->hasFile('images'))
            {
                $images = $request->file('images');
                 //echo "<pre>"; print_r($images); die;
                    foreach($images as $key => $image)
                    { 
                        //get image name only
                        $image_name = $image->getClientOriginalName();
                        
                        //get image file name
                        $ImageFileName = pathinfo($image_name,PATHINFO_FILENAME);
                        
                        //get image extension
                        $image_extension = $image->getClientOriginalExtension();
                        
                        //asssignning new image name
                        $imageName = $ImageFileName.'-'.rand(111,9999).'.'.$image_extension;
                        
                        //set paths
                        $large_image_path = 'admin/images/product_images/large/'.$imageName;
                        $medium_image_path = 'admin/images/product_images/medium/'.$imageName;
                        $small_image_path = 'admin/images/product_images/small/'.$imageName;
                        
                        //save image to product_images folder
                        Image::make($image)->save($large_image_path); //original size will be  1040*1200 
                        Image::make($image)->resize(520, 600)->save($medium_image_path);
                        Image::make($image)->resize(260, 300)->save($small_image_path);
                        
                        //save image name to database
                        $image = new ProductsImage;
                        $image->product_id = $id;
                        $image->image = $imageName;
                        $image->status = 1;
                        $image->save();
                        
                    }
            }
             return redirect()->back()->with('success_message', 'Images Added Successfully');
        }
        return view('admin.products.add_images')->with(compact('productDetails'));
    }

    //update image status
    public function updateImageStatus(Request $request)
    {
         if($request->ajax())
        {
            $data = $request->all();
            // dd($data);
            if($data['status'] == "Active")
            {
                $status = 0;

            }elseif($data['status'] == "InActive")
            {
                $status = 1;
            }
            ProductsImage::where('id', $data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'image_id'=>$data['image_id']]);
        }
    }

    //delete image
     public function deleteImage($id)
    {
        ProductsImage::where('id', $id)->delete();

        $message = 'Product Image Deleted Successfully';
        return redirect()->back()->with('success_message', $message);
    }

}
