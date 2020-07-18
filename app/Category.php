<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\DB;



class Category extends Model
{

    use NodeTrait;

    public static function rootCategories(){
        return Category::whereIsRoot()->get();
        //return Category::all()->where('parent_id', '=', null);
    }
    public function children(){
        return $this->hasMany('\App\Category', 'parent_id');
    }

    public function ads(){
        return $this->hasMany('\App\Ad');
    }

    public function allDescendantAds(){
        $descendants = $this->descendants()->get(['id']);
        $query = DB::table('ads')->where('category_id', $this->id);
        foreach ($descendants as $descendant){
            $query->orWhere('category_id', $descendant->id);
        }
        return $query;
    }



    public static function allParents($root){
        $data = new Collection();
        $parent = $root->parent;
        while($parent){
            $data->prepend($parent);
            $parent = $parent->parent;
        }

        return $data;
    }

}
