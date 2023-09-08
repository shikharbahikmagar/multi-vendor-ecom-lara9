<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Category extends Model
{
    use HasFactory;
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id')->select('id', 'name');
    }

    public function parentcategory()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id', 'category_name', 'parent_id');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where(['status'=>1]);
    }

    public static function categoryDetails($url)
    {
        $catDetails = Category::select('id', 'parent_id', 'url', 'category_name','description')->with(['subcategories'=>function($query)
        {
            $query->select('id', 'category_name', 'parent_id', 'url');
        }])->where(['url'=> $url, 'status'=>1])
        ->first()->toArray();
        //dd($catDetails);
        $catIds = array();
        $catIds[] = $catDetails['id'];

        if($catDetails['parent_id'] == 0)
        {
            //only show main category
            $breadCrumbs = '<li class="is-marked">
                    <a href="">'.$catDetails['category_name'].'</a>
                </li>';
        }
        else
        { //show sub category
            $parent_category = Category::select('id', 'url', 'category_name')->where('id', $catDetails['parent_id'])
            ->first()->toArray();
            $breadCrumbs = '<li class="has-separator">
                    <a href="">'.$parent_category['category_name'].'</a>
                </li><li class="is-marked">
                    <a href="">'.$catDetails['category_name'].'</a>
                </li>';
        }


        foreach($catDetails['subcategories'] as $key => $subcat)
        {
            $catIds[] = $subcat['id'];
        }
        $resp = array('catIds'=> $catIds, 'catDetails'=>$catDetails, 'breadCrumbs'=>$breadCrumbs);
        return $resp;
    }
}
