<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeployController extends Controller
{
    public function deploy(){
        \Illuminate\Support\Facades\Artisan::call('fetch');
    }
}
