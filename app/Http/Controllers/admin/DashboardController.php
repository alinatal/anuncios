<?php

namespace App\Http\Controllers\admin;

use App\Ad;
use App\Http\Controllers\Controller;
use App\Sponsor;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $registered_users = User::where('admin', false)->count();
        $sponsors = Sponsor::where('alternative', false)->distinct('name')->count('name');
        $ads_last_7 = Ad::where('created_at', '>=', now()->subDays(7))->count();
        $ads_last_30 = Ad::where('created_at', '>=', now()->subDays(30))->count();
        return view('admin.dashboard')
            ->withSponsors($sponsors)
            ->withAdsLast7($ads_last_7)
            ->withAdsLast30($ads_last_30)
            ->withRegisteredUsers($registered_users);
    }
}
