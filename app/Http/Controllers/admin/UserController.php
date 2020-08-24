<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request){
        if(isset($request->name)){
            $users = User::where('name','like', '%'.$request->name.'%')->orWhere('email', 'like', '%'.$request->name.'%')->paginate(10);
        }
        else $users = User::orderBy('admin', 'desc')->orderBy('updated_at', 'desc')->orderBy('id','desc')->paginate(10);
        return view('admin.user.index')->withUsers($users);
    }

    public function create(){
        return view('admin.user.create')->withMethod('store');
    }

    public function store(Request $request){
        $page = new User($request->except(['_method', '_token']));
        $page->save();
        return redirect()->route('admin.user.index')->withMessage('Usuario creado correctamente');
    }

    public function edit(User $user){
        return view('admin.user.create')->withMethod('update')->withUser($user);
    }

    public function update(User $user, Request $request){
        $array = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'admin' => $request->admin,

        ];
        if(strlen($request->password)) $array['password'] = Hash::make($request->password);
        $user->update($array);
        return redirect()->route('admin.user.index')->withMessage('Usuario actualizado correctamente');
    }

    public function destroy(User $user){
        $user->ads()->delete();
        $user->delete();
        return redirect()->route('admin.user.index')->withMessage('El usuario '.$user->name.' y sus anuncios fueron eliminados correctamente');
    }
}
