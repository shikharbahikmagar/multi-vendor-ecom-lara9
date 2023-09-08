<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function listing(Request $request)
    {
         if($request->ajax())
         {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $url = $data['url'];
            $_GET['sort'] = $data['sort'];
            $catCount = Category::where(['url'=>$url, 'status'=>1])->count();
            if($catCount>0)
            {
               $catDetails = Category::categoryDetails($url);
               $categoryProducts = Product::whereIn('category_id', $catDetails['catIds'])->with('brand')->where('status', 1);
               
               $productsCount = $categoryProducts->count();

               // dd($_GET['sort']);
               //check for sorting and apply sorting
               if(isset($_GET['sort']) && !empty($_GET['sort']))
               {
                  if($_GET['sort'] == "product_latest")
                  {
                  $categoryProducts->orderBy('products.id', 'Desc');
                  }
                  else if($_GET['sort'] == "product_price_lowest")
                  {
                     $categoryProducts->orderBy('products.product_price', 'Asc');
                  }
                  else if($_GET['sort'] == "product_price_highest")
                  {
                     $categoryProducts->orderBy('products.product_price', 'Desc');
                  }
                  else if($_GET['sort'] == "product_a_z")
                  {
                     $categoryProducts->orderBy('products.product_name', 'Asc');
                  }
                  else if($_GET['sort'] == "product_z_a")
                  {
                     $categoryProducts->orderBy('products.product_name', 'Desc');
                  }
               }

               $categoryProducts = $categoryProducts->paginate(4);
               //dd($catDetails);
               return view('front.products.ajax_products')->with(compact('categoryProducts', 'url', 'catDetails', 'productsCount'));
            } 
            else
            {
               abort(404);
            }
         }

         $url = Route::getFacadeRoot()->current()->uri();
         $catCount = Category::where(['url'=>$url, 'status'=>1])->count();
         if($catCount>0)
         {
            $catDetails = Category::categoryDetails($url);
            $categoryProducts = Product::whereIn('category_id', $catDetails['catIds'])->with('brand')->where('status', 1);
            
            $productsCount = $categoryProducts->count();

            // dd($_GET['sort']);
            //check for sorting and apply sorting
            if(isset($_GET['sort']) && !empty($_GET['sort']))
            {
               if($_GET['sort'] == "product_latest")
               {
                 $categoryProducts->orderBy('products.id', 'Desc');
               }
               else if($_GET['sort'] == "product_price_lowest")
               {
                  $categoryProducts->orderBy('products.product_price', 'Asc');
               }
               else if($_GET['sort'] == "product_price_highest")
               {
                  $categoryProducts->orderBy('products.product_price', 'Desc');
               }
               else if($_GET['sort'] == "product_a_z")
               {
                  $categoryProducts->orderBy('products.product_name', 'Asc');
               }
               else if($_GET['sort'] == "product_z_a")
               {
                  $categoryProducts->orderBy('products.product_name', 'Desc');
               }
            }

            $categoryProducts = $categoryProducts->paginate(4);
            //dd($catDetails);
            return view('front.products.listing')->with(compact('categoryProducts', 'url', 'catDetails', 'productsCount'));
         } 
         else
         {
            abort(404);
         }
    }
}
