<?php

namespace App\Http\Controllers;

use App\Ad;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdController extends Controller
{
    public function index(Request $request){
        $ad = Ad::where('slug', '=', $request->slug)->first();
        $category = Category::where('id', '=', $ad->category_id)->first();
        $categories = $category->getAncestors();
        $categories->push($category);
        $user = $ad->user;

        return view('ad')->withAd($ad)->withCategories($categories)->withUser($user);
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

    public function store(Request $request){
        $attributeNames = array(
            'name' => 'nombre',
            'description' => 'descripción',
            'location' => 'ubicación',
            'phone' => 'teléfono',
            'images' => 'imagenes',
            'images.*' => 'imagenes',
            'fullName' => 'nombre',
        );

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'description' => 'required | max:10000',
            'location' => 'required',
            'images' => 'array|max:10',
            'images.*' => 'image | mimes:jpg,jpeg,webp,png,JPG,JPEG,WEBP,PNG | max:5120',
            'fullName' => 'required',
            'email' => 'required|email',
            'phone' => 'regex:/^\+?[0-9]{0,14}$/',
        ]);

        $validator->setAttributeNames($attributeNames);

        if($validator->fails()){

            $category = Category::find($request->category);
            return redirect(route('ads.create', ['category' => $request->category]))->withErrors($validator)->withCategory($category)->withInput();
        }
        else{
            foreach ($request->images as $image){
                $path = Storage::putFileAs('/images/posts/'.$request->email.'/'.$request->name, $image, $image->getClientOriginalName());
                $images[] = '/'.$path;
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
                'price' => 1.5
            ]);
            $ad->save();

            return redirect(route('ads.index', ['slug' => $ad->slug]));
        }
    }
}
