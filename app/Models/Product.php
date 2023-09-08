<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\ProductsImage', 'product_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    //get discounted price
    public static function getDiscountedPrice($product_id)
    {
        $productDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first();
        $productDetails = json_decode(json_encode($productDetails), true);
        $categoryDetails = Category::select('category_discount')->where('id', $productDetails['category_id'])->first();
        $categoryDetails = json_decode(json_encode($categoryDetails), true);

        if($productDetails['product_discount']>0)
        {
            $discounted_price = $productDetails['product_price'] - ($productDetails['product_price'] * 
                $productDetails['product_discount']/100);
        }else if($categoryDetails['category_discount']>0)
        {
             $discounted_price = $productDetails['product_price'] - ($productDetails['product_price'] * 
                $categoryDetails['category_discount']/100);
        }else
        {
            $discounted_price = 0;
        }

        return $discounted_price;

    }

    public static function isProductNew($product_id)
    {
        $productIds = Product::select('id')->where('status', 1)->orderBy('id','Desc')->limit(3)->pluck('id');
        //dd($productIds);
        $productIds = json_decode(json_encode($productIds), true);
         //dd($productIds);
        if(in_array($product_id, $productIds))
        {
            $isNewProduct = "Yes";
        }
        else
        {
            $isNewProduct = "No";
        }

        return $isNewProduct;
    }
}
