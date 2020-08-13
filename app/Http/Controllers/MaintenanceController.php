<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(){
        if(app()->isDownForMaintenance()) return view('frontend.maintenance');
        else return redirect()->route('main');
    }
}
