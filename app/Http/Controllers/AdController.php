<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Http\Requests\AdCreateRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Mail\AdUserRequest;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdController extends Controller
{
    public function show(Request $request){
        $ad = Ad::where('slug', '=', $request->slug)->first();
        $category = Category::where('id', '=', $ad->category_id)->first();
        $categories = $category->getAncestors();
        $categories->push($category);
        $user = $ad->user;

        return view('ad')->withAd($ad)->withImages(json_decode($ad->images))->withCategories($categories)->withUser($user);
    }

    public function create(Request $request){
        if($request->category && ($category = Category::find($request->category)) && $category->isLeaf()){
            return view('create_add')->withCategory($category);
        }
        else{
            $categories = Category::get()->toTree();
            return view('create_add')->withCategories($categories);
        }
    }

    public function store(AdCreateRequest $request){
            $images = ['/img/no-image.png'];
            if($request->images){
                $images = [];
                foreach ($request->images as $image){
                    $path = Storage::putFileAs('/images/posts/'.$request->email.'/'.$request->name, $image, $image->getClientOriginalName());
                    $images[] = '/'.$path;
                }
            }

            $password = Str::random(8);
            $user = User::firstOrCreate(['email' => $request->email], [
                'name' => $request->fullName,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($password)
            ]);

            $ad = new Ad([
                'name' => $request->name,
                'description' => $request->description,
                'location' => $request->location,
                'fullName' => $request->fullName,
                'email' => $request->email,
                'phone' => $request->phone,
                'images' => json_encode($images),
                'category_id' => $request->category,
                'user_id' => $user->id,
                'price' => $request->price
            ]);
            $ad->save();

            return redirect(route('ads.show', ['slug' => $ad->slug]));
    }

    public function destroyRequest(Request $request){
        $ad = Ad::findOrFail($request->ad);
        $user = $ad->user;
        Mail::to($user->email)->send(new AdUserRequest($ad, $user, 'destroy'));
        return back()->withMessage('Solicitud de <b>borrado</b> recibida para el anuncio <b>'. $ad->name .'</b>. Siga las instrucciones que le hemos enviado a <b>'.$user->email.'</b>. Revise la bandeja de "<b>SPAM</b>" o "<b>Correo no deseado</b>" si no encuentra nuestro correo.');
    }
    public function editRequest(Request $request){
        $ad = Ad::findOrFail($request->ad);
        $user = $ad->user;
        Mail::to($user->email)->send(new AdUserRequest($ad, $user, 'edit'));
        return back()->withMessage('Solicitud de <b>edición</b> recibida para el anuncio <b>'. $ad->name .'</b>. Siga las instrucciones que le hemos enviado a <b>'.$user->email.'.</b> Revise la bandeja de "<b>SPAM</b>" o "<b>Correo no deseado</b>" si no encuentra nuestro correo.');
    }

    public function edit(Request $request){
        $ad = Ad::findOrFail($request->ad);
        return view('edit_add')->withAd($ad);
    }

    public function update(AdUpdateRequest $request){

        $ad = Ad::findOrFail($request->ad);
        $images = ['/img/no-image.png'];
        if($request->images){
            $images = [];
            foreach ($request->images as $image){
                $path = Storage::putFileAs('/images/posts/'.$request->email.'/'.$request->name, $image, $image->getClientOriginalName());
                $images[] = '/'.$path;
            }
            foreach(json_decode($ad->images) as $image){
                $images[] = $image;
            }
        }
        else $images = json_decode($ad->images);
        $ad->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'images' => json_encode($images)

        ]);
        //$request->only(['name', 'description', 'price', 'location'])

        $ad->user()->update(['name' => $request->fullName, 'email' => $request->email, 'phone' => $request->phone]);

        if($request->routeIs('ads.update', ['id', $ad->id])){
            return redirect(route('ads.show', ['slug' => $ad->slug]))->withMessage('Anuncio actualizado correctamente');
        }

    }


    public function destroy(Request $request){
        $ad = Ad::findOrFail($request->ad);
        $ad->delete();
        if($request->method() == 'GET') {
            return redirect(route('main'))
                ->withMessage('Su anuncio fue borrado correctamente de nuestra base de datos');
        }
    }
}
