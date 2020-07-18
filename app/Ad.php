<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection as Collection;
use Cviebrock\EloquentSluggable\Sluggable;


class Ad extends Model
{
    //protected $dateFormat = 'd-m-Y H:i:s';
    protected $fillable = [
        'name', 'slug', 'images', 'location', 'description', 'price', 'category_id', 'user_id'
    ];
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }
    public function category(){
        return $this->belongsTo('\App\Category');
    }

    public static function descendants($category, Collection $ads){
        /*if($ads->count() == 0){
            $ads->push($category->ads);
        }
        else{
            $ads->push($category->ads);
            foreach ($category->children as $child){
                self::descendants($child, $ads);
            }
        }
        return $ads;*/

    }
}
