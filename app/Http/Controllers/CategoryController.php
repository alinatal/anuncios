<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request){
        $category = Category::all()->where('slug', '=', $request->slug)->first();
        $parents = $category->getAncestors();
        //$parents = Category::allParents($category);
        $ads = $category->allDescendantAds()->paginate(10);
//        $ads = $category->ads()->paginate(10);
        return view('category')->withCategory($category)->withParents($parents)->withAds($ads);
    }
}
