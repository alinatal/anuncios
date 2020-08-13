<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit(){
        $settings = Setting::orderBy('order')->get();
        foreach ($settings as $key => $setting){
            //if($setting->type == 'json') $settings[$key] = json_decode($setting);
        }
        return view('admin.settings')->withSettings($settings);
    }

    public function update(Request $request){
        foreach ($request->except('_method', '_token') as $key => $value){
            $setting = Setting::findOrFail($key);
            $setting->value = $value;
            $setting->save();
        }
        return back()->withSuccess('Información actualizada correctamente');
    }
}
