<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavController extends Controller
{
    public function store(Ad $ad, Request $request){
        $array = [];
        if($request->hasCookie('my-favs')){
            $array = json_decode($request->cookie('my-favs'), true);
        }

        if(!in_array($ad->id, $array)){
            $array[] = $ad->id;
        }

        //sreturn var_dump($array);


        //dd($array);

        return back()->withCookie(cookie()->forever('my-favs', json_encode($array), 450000))->withMessage('Anuncio añadido a favoritos');
    }

    public function index(Request $request){
        if($request->hasCookie('my-favs')){
            $array = json_decode($request->cookie('my-favs'), true);
            if(sizeof($array) > 0){
                $ads = Ad::from('ads');
                foreach ($array as $key => $ad){
                    $ads->OrWhere('id', $ad);
                }
            }
            else return redirect()->route('main')->withError('Agrega anuncios a favoritos antes de acceder a esta sección');

        }
        else return back()->withError('Agrega anuncios a favoritos antes de acceder a esta sección');
        return view('frontend.fav.index')->withAds($ads->paginate(10));

    }

    public function destroy(Ad $ad, Request $request){
        $array = [];
        if($request->hasCookie('my-favs')){
            $array = json_decode($request->cookie('my-favs'), true);
            unset($array[array_search($ad->id, $array)]);
        }

        return back()->withCookie(cookie()->forever('my-favs', json_encode($array), 450000))->withMessage('Anuncio eliminado de favoritos');

    }
}
