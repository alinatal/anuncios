<?php

namespace App\Http\Controllers\admin;

use App\Ad;
use App\Http\Controllers\Controller;
use App\Sponsor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $registered_users = User::where('admin', false)->count();
        $sponsors = Sponsor::where('alternative', false)->distinct('name')->count('name');
        $ads_last_7 = Ad::where('created_at', '>=', now()->subDays(7))->count();
        $ads_last_30 = Ad::where('created_at', '>=', now()->subDays(30))->count();
        $active_users = DB::table('users')
            ->join('ads', 'users.id', '=', 'ads.user_id')
            ->groupBy('users.id')
            ->orderBy(DB::raw('COUNT(ads.id)'), 'DESC')
            ->select(['users.name','users.email', 'users.phone', DB::raw('COUNT(ads.id) as count')])
            ->limit(10)
            ->get();
        return view('admin.dashboard')
            ->withSponsors($sponsors)
            ->withAdsLast7($ads_last_7)
            ->withAdsLast30($ads_last_30)
            ->withActiveUsers($active_users)
            ->withRegisteredUsers($registered_users);
    }
}
