<?php

namespace App\Http\Controllers;

use App\Category;
use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('main')
            ->withCategories(Category::rootCategories())
            ->withAds(DB::table('Ads')->orderBy('updated_at', 'desc')->limit(10)->get());
    }
}
