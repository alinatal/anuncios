<?php

namespace App\Http\Controllers;

use App\Category;
use App\Ad;
use App\Mail\AdExpiresNotification;
use App\Sponsor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        /*/// Avisamos a los usuarios que caducarán próximamente
        $user_ads = DB::table('ads')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->where('ads.updated_at', '<=', now()->subDays(62))
            ->where('ads.expire_notification', '=', false)
            ->get(['users.email as email', 'users.name as user', 'ads.id as id', 'ads.name as name']);

        foreach ($user_ads as $user_ad){
            $ad = Ad::findOrFail($user_ad->id);
            $ad->timestamps = false;
            $ad->expire_notification = true;
            $ad->updated_at = now()->subDays(62);
            $ad->save();
            Mail::to($user_ad->email)->send(new AdExpiresNotification($user_ad));
        }

        // Si los anuncios han caducado los borramos
        $ads = Ad::where('updated_at', '>=', now()->subDays(60))->where('expire_notification', '=', true)->get();
        foreach ($ads as $ad){
            $ad->delete();
        }*/


        //Obtenemos lista de sponsors para la página principal

        $carousel = Sponsor::where('zone', 'carousel')->where('alternative', false)->get();
        if(!$carousel->count()) $carousel = Sponsor::where('zone', 'carousel')->where('alternative', true)->get();

        $sponsor_card = Sponsor::where('zone', 'ads')->where('alternative', false)->get();
        //if(!$sponsor_card->count()) $sponsor_card = Sponsor::where('zone', 'ads')->where('alternative', true)->get();
        if(!$sponsor_card->count()) $sponsor_card = Sponsor::where('alternative', true)->get();


        return view('main')
            ->withCategories(Category::rootCategories())
            ->withAds(DB::table('ads')->orderBy('updated_at', 'desc')->paginate(10))
            ->withCarousel($carousel->shuffle())
            ->withSponsorCard($sponsor_card);
    }
}
