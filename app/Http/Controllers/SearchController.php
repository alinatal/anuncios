<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request){
        $columns = ['name','description'];
        $words_search = explode(" ",$request->search);
        $ads = Ad::from('ads as a')
            ->where(function ($query) use ($columns, $words_search) {
                foreach ($words_search as $word) {
                    $query = $query->where(function ($query) use ($columns,$word) {
                        foreach ($columns as $column) {
                            $query->orWhere($column,'like',"%$word%");
                        }
                    });
                }
            })->paginate(10)/*->limit(15)*/;
        //print_r($ads->paginate());
        return view('search')->withAds($ads)->withSearch($request->search);
    }

    public function test(){
        $test = Category::with('allChildren')->first();
/*        $test = $test->allChildren();*/
        return view('test')->withTest($test);
    }

    public function myAds(Request $request){
        if($request->input('email')){

            $ads = DB::table('users')
                ->join('ads', 'users.id', '=', 'ads.user_id')
                ->where('users.email', '=', $request->email)
                ->orderBy('ads.updated_at', 'desc')->select(['ads.*'])->paginate(10);

            return view('my-ads')->withAds($ads)->withEmail($request->email);
        }
        else return view('my-ads');
    }
}
