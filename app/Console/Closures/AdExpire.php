<?php
namespace App\Console\Closures;

use App\Ad;
use App\Mail\AdExpiresNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdExpire{
    public function __invoke()
    {
        /// Avisamos a los usuarios que caducarán próximamente
        $days_expiration = config('ad.expiration_date');
        $days_expired = config('ad.expiration_notification');

        $days_notification = $days_expiration + $days_expired;

        echo "Ad expires in ".$days_expiration." days\n";
        echo "Notificate users ".$days_expired." days before\n";
        echo "So notification is sended ".$days_notification." days before of now\n";
        echo "Advert ads older than ".now()->subDays($days_notification)."\n";
        echo "Deleting ads older than ".now()->subDays($days_expiration);

        $user_ads = DB::table('ads')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->where('ads.updated_at', '<=', now()->subDays($days_notification))
            ->where('ads.expire_notification', '=', false)
            ->get(['users.email as email', 'users.name as user', 'ads.id as id', 'ads.name as name']);

        foreach ($user_ads as $user_ad){
            $ad = Ad::findOrFail($user_ad->id);
            $ad->timestamps = false;
            $ad->expire_notification = true;
            $ad->updated_at = now()->subDays($days_notification);
            $ad->save();
            Mail::to($user_ad->email)->send(new AdExpiresNotification($user_ad));
        }

        // Si los anuncios han caducado los borramos
        $ads = Ad::where('updated_at', '<=', now()->subDays($days_expiration))->where('expire_notification', '=', true)->get();
        foreach ($ads as $ad){
            $ad->delete();
        }


       /* $user_ads = DB::table('ads')
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
        $ads = Ad::where('updated_at', '<=', now()->subDays(64))->where('expire_notification', '=', true)->get();
        foreach ($ads as $ad){
            $ad->delete();
        }*/
    }
}
