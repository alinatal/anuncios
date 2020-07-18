<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    protected $fillable = ['key', 'value'];
    public $primaryKey = 'key';
    public $incrementing = false;

    public static function key(string $key): Setting{
        return Setting::where('key', $key)->first();
    }

    public static function add(string $key, string $value, string $type = 'text'){
        $setting = new Setting(['key' => $key, 'value' => $value, 'type' => 'text']);
        return $setting->save();
    }
}
