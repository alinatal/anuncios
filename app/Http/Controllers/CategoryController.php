<?php

namespace App\Http\Controllers;

use App\Category;
use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index(){
        $categories = Category::defaultOrder()->get()->toTree();
        return view('categories')->withCategories($categories);
    }
    public function show(Category $category, Request $request){
        $parents = $category->getAncestors();
        //dd($category->allDescendantAds()->max('price'));
        $max = $category->allDescendantAds()->max('price');
        $min = $category->allDescendantAds()->min('price');
        if($request->has('min_price') && $request->has('max_price') && strlen($request->min_price) > 0 && strlen($request->max_price) > 0){
            $ads = $category->allDescendantAds()
                ->where('price', '>=', $request->min_price)
                ->where('price', '<=', $request->max_price)
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        }
        else $ads = $category->allDescendantAds()->orderBy('updated_at', 'desc')->paginate(10);

        $root = $category;
//        while($root->parent != null){
//            $root = $root->parent;
//        }

        $sponsor_card = Sponsor::where('zone', 'categories.'.$root->slug)->where('alternative', false)->get();
        //if(!$sponsor_card->count()) $sponsor_card = Sponsor::where('zone', 'categories.'.$root->id)->where('alternative', true)->get();
        if(!$sponsor_card->count()) $sponsor_card = Sponsor::where('alternative', true)->get();


        return view('category')
            ->withCategory($category)
            ->withParents($parents)
            ->withAds($ads)
            ->withMax($max)
            ->withMin($min)
            ->withSponsorCard($sponsor_card->shuffle());
    }
}
