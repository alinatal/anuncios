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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdController extends Controller
{
    public function show(Ad $ad){
        $category = Category::where('id', '=', $ad->category_id)->first();
        $categories = $category->getAncestors();
        $categories->push($category);
        $user = $ad->user;

        return view('ad')->withAd($ad)->withImages(json_decode($ad->images))->withCategories($categories)->withUser($user);
    }

    public function create(Request $request, Category $category){

        //if($request->category && ($category = Category::find($request->category)) && $category->isLeaf()){
        if($category->isLeaf()){
            return view('create_add')->withCategory($category);
        }
        else{
            $categories = Category::defaultOrder()->get()->toTree();
            return view('create_add')->withCategories($categories);
        }
    }

    public function store(AdCreateRequest $request){
        //return dd($request);
        //sleep(5);
        //return (($request));
        //return $request->file('images')[0];
        //return $request->file('images')[0]->getSize();
        if($request->has('images') && sizeof($request->images)>0){
            foreach ($request->images as $key => $value) {
                $image = $value;
                preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
                $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
                $image = str_replace(' ', '+', $image);
                $imageName = 'images/posts/' . uniqid() . '.' . $image_extension[1]; //generating unique file name;
                Storage::put($imageName, base64_decode($image));
                $paths[$key] = $imageName;
                //Storage::put($paths[$key], base64_decode($image));
                //$image->store('images/posts/');
            }
            //return $paths;
        }
        else $paths = ['/img/no-image.png'];
        //return $request;

        $user = User::updateOrCreate(['email' => $request->email], [
                'name' => $request->fullName,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make(Str::random(8))
            ]);
        $ad = Ad::create(
                $request->except(['_method', '_token', 'images'])
                +
                ['ip' => $request->ip(), 'user_id' => $user->id, 'images' => json_encode($paths)]
            );


        //return response(route('ads.show', ['ad' => $ad->slug])->withMessage('Anuncio creado correctamente. Le recordamos que su anuncio será eliminado en 60 días si no se renueva. Recibirá instrucciones para la renovación días antes de que caduque.'), 200);
        Session::flash('message', 'Anuncio creado correctamente. Le recordamos que su anuncio será eliminado en 60 días si no se renueva. Recibirá instrucciones para la renovación días antes de que caduque.');
        return route('ads.show', ['ad' => $ad->slug]);
        //return redirect(route('ads.show', ['ad' => $ad->slug]))->withMessage('Anuncio creado correctamente. Le recordamos que su anuncio será eliminado en 60 días si no se renueva. Recibirá instrucciones para la renovación días antes de que caduque.');
    }

    public function destroyRequest(Ad $ad){
        $user = $ad->user;
        Mail::to($user->email)->send(new AdUserRequest($ad, $user, 'destroy'));
        return back()->withMessage('Solicitud de <b>borrado</b> recibida para el anuncio <b>'. $ad->name .'</b>. Siga las instrucciones que le hemos enviado a <b>'.$user->email.'</b>. Revise la bandeja de "<b>SPAM</b>" o "<b>Correo no deseado</b>" si no encuentra nuestro correo.');
    }
    public function editRequest(Ad $ad){
        $user = $ad->user;
        Mail::to($user->email)->send(new AdUserRequest($ad, $user, 'edit'));
        return back()->withMessage('Solicitud de <b>edición</b> recibida para el anuncio <b>'. $ad->name .'</b>. Siga las instrucciones que le hemos enviado a <b>'.$user->email.'.</b> Revise la bandeja de "<b>SPAM</b>" o "<b>Correo no deseado</b>" si no encuentra nuestro correo.');
    }

    public function edit(Ad $ad){
        return view('edit_add')->withAd($ad);
    }

    public function renovate(Ad $ad){
        $ad->expire_notification = false;
        $ad->save();
        return redirect()->route('main')->withMessage('El anuncio "'.$ad->name.'" ha sido renovado por otros 60 días');
    }

    public function update(Ad $ad, AdUpdateRequest $request){
        //sleep(5);

        /*if($request->hasFile('images')){
            $paths = [];

            foreach ($request->file('images') as $image)
                $paths[] = $image->store('images/posts/');

            foreach(json_decode($ad->images) as $image)
                if($image != '/img/no-image.png') $paths[] = $image;
        }
        else $paths = json_decode($ad->images);*/
        foreach (json_decode($ad->images) as $image){
            Storage::delete($image);
        }

        if($request->has('images') && sizeof($request->images)>0){
            foreach ($request->images as $key => $value) {
                $image = $value;
                //if($key == 1 )dd($image);

                preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension

                $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
                $image = str_replace(' ', '+', $image);

                $imageName = 'images/posts/' . uniqid() . '.' . $image_extension[1]; //generating unique file name;
                Storage::put($imageName, base64_decode($image));
                $paths[$key] = $imageName;
                //Storage::put($paths[$key], base64_decode($image));
                //$image->store('images/posts/');
            }
            //return $paths;
        }
        else $paths = ['/img/no-image.png'];
        $ad->update(
            $request->except(['_method', '_token', 'images'])
            +
            ['ip' => $request->ip(), 'images' => json_encode($paths)]
        );
        $ad->user()->update(['name' => $request->fullName, 'email' => $request->email, 'phone' => $request->phone]);

        Session::flash('message', 'Anuncio actualizado correctamente. El plazo de vencimiento de su anuncio se reestablece a 60 días.');
        return route('ads.show', ['ad' => $ad->slug]);
        return redirect(route('ads.show', ['ad' => $ad->slug]))->withMessage('Anuncio actualizado correctamente. El plazo de vencimiento de su anuncio se reestablece a 60 días.');
    }

    public function destroy(Ad $ad){
        $ad->delete();
        return redirect(route('main'))->withMessage('Su anuncio fue borrado correctamente de nuestra base de datos');
    }
}
