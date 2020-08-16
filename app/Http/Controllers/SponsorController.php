<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\SponsorContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SponsorController extends Controller
{
    public function create(){
        $categories = Category::whereIsLeaf()->defaultOrder()->get();

        foreach ($categories as $key => $category){
            $count = DB::table('sponsors')->where('zone', 'categories.'.$category->slug)->count();
            if($count >= 3) $categories->pull($key);
        }

        return view('frontend.sponsor.create')->withCategories($categories);
    }

    public function store(Request $request){
        //send email
        Mail::to(config('settings.site_email'))->send(new SponsorContract($request->except(['_method', '_token'])));

        //return message
        return redirect()->route('main')->withMessage('Contratación de publicidad efectuada correctamente.<p class="mt-2">

                <strong>IMPORTANTE</strong>: No olvide enviarnos por email a
                <a href="mailto:'.config('settings.site_email').'">
                    '.config('settings.site_email').'
                </a>
                el anuncio que quiere poner, el tamaño debe de ser de
                1200 x 450 pixeles, o si lo prefiere envíenos su logotipo
                con una descripción de lo que quiere poner y nosotros se
                lo diseñamos.

        </p>');
    }
}
