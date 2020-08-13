<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Mail\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function report(Ad $ad, Request $request){
        //sreturn $request;
        Mail::to(config('settings.site_email'))->send(new Report($ad, $request->reason));

        return back()->withMessage('Gracias por tu denuncia sobre el anuncio '.$ad->name.' . Nuestro equipo lo examinará pronto.');
    }
}
