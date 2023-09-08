<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {
        $slidebanners = Banner::where(['type'=>'slider', 'status' => 1])->get()->toArray();
         $fixbanners = Banner::where(['type'=>'fix', 'status' => 1])->get()->toArray();
         //new products
         $newProducts = Product::orderBy('id', 'Desc')->where('status', 1)->limit(4)->get()->toArray();
         //best seller products
         $best_seller_products = Product::where(['is_bestseller'=> 'Yes', 'status'=>1])->limit(6)->inRandomOrder()->get()->toArray();
         $best_seller_products = json_decode(json_encode($best_seller_products), true);
        //  dd($best_seller_products);

        //discounted products
        $discounted_products = Product::where('product_discount', '>', '0')->where('status', 1)->limit(6)->inRandomOrder()->get()->toArray();
        $discounted_products = json_decode(json_encode($discounted_products), true);
        //dd($discounted_products);

        //is featureed products
         $featured_products = Product::where(['is_featured'=> 'Yes', 'status'=>1])->limit(6)->inRandomOrder()->get()->toArray();
         $featured_products = json_decode(json_encode($featured_products), true);
        return view('front.index')->with(compact('slidebanners', 'fixbanners', 'newProducts', 'best_seller_products', 'discounted_products', 'featured_products'));
    }
}
