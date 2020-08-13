<?php

namespace App\Http\Controllers\admin;

use App\Ad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    public function index(Request $request){
        if($request->has('id')){
          $ads = Ad::where('id', '=', $request->id)->paginate(10);
        }
        else if($request->has('search') && strlen($request->search)){
            $columns = ['name','description', 'id'];
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
                })->paginate(10);
        }
        else if($request->has('order') && strlen($request->order) > 0){
            if($request->order == 'category_id'){
                $ads = Ad::join('categories', 'ads.category_id','=', 'categories.id')
                    ->orderBy('categories.name', 'asc')
                    ->select(['ads.*'])
                    ->paginate(10);
            }
            else $ads = Ad::orderBy($request->order, 'desc')->paginate(10);
        }
        else $ads = Ad::orderBy('id', 'desc')->paginate(10);


        return view('admin.ad.index')->withAds($ads);
    }

    public function create(){
        return view('admin.ad.create')->withMethod('store');
    }
    public function store(Request $request){
        $ad = new Ad($request->except(['_method', '_token']));
        //if($request->has('parent_id')) $ad->parent_id = $request->parent_id;
        $ad->save();

        return redirect()->route('admin.ad.index')->withMessage('Anuncio '. $ad->name .' creado correctamente');
    }
    public function show(Ad $ad){
        return view('frontend.ad')->withAd($ad);
    }
    public function edit(Ad $ad){
        return view('admin.ad.create')->withMethod('update')->withAd($ad);
    }
    public function update(Ad $ad, Request $request){
        $ad->update($request->except(['_method', '_token']));
        return redirect()->route('admin.ad.index')->withMessage('Anuncio '. $ad->name .' actualizado correctamente');
    }
    public function destroy(Ad $ad){
        $ad->delete();
        return redirect()->route('admin.ad.index')->withMessage('Anuncio '. $ad->name .' eliminado correctamente');

    }
}
