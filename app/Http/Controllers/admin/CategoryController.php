<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request){
        if($request->has('id')){
            $category = Category::findOrFail($request->id);
            return view('admin.category.index')->withCategories($category->children()->defaultOrder()->paginate(10))->withCategory($category)->withParents($category->ancestors());
        }
        $categories = Category::whereIsRoot()->defaultOrder()->paginate(10);
        return view('admin.category.index')->withCategories($categories);
    }

    public function create(){
        return view('admin.category.create')->withMethod('store');
    }
    public function store(Request $request){
        $image = '/img/no-image.png';
        $category = new Category($request->except(['_method', '_token', 'image']) + ['image' => $image]);
        if($request->has('parent_id')) $category->parent_id = $request->parent_id;
        $category->save();

        if($request->hasFile('image')){
            $path = Storage::putFileAs('/images/categories', $request->file('image'), $category->slug.'.'.$request->file('image')->getClientOriginalExtension());

            $image = '/'.$path;
            $category->image = $image;
            $category->save();
        }
        return redirect()->back()->withMessage('Categoría creada correctamente');
    }
    public function show(Category $category){
        return view('frontend.category')->withCategory($category);
    }
    public function edit(Category $category){
        return view('admin.category.create')->withMethod('update')->withCategory($category);
    }
    public function update(Category $category, Request $request){
        $image = '/img/no-image.png';
        if($request->hasFile('image')){
            $path = Storage::putFileAs('/images/categories', $request->file('image'), $category->slug.'.'.$request->file('image')->getClientOriginalExtension());
            $image = '/'.$path;
        }

        if(strlen($category->image) && !$request->hasFile('image')){
            $data = $request->except(['_token', '_method', 'image']);
        }
        else $data = $request->except(['_token', '_method', 'image']) + ['image' => $image];
        $category->update($data);

        return redirect()->route('admin.category.index')->withMessage('Categoría actualizada correctamente');
    }
    public function destroy(Category $category){
        if($category->children()->count() || $category->ads()->count() ) {
            return back()->withError('Para borrar la Categoría '. $category->name .' debe borrar primero todas sus subcategorías y anuncios');
        }
        $category->delete();
        return back()->withMessage('Categoría '. $category->name .' y todas sus subcategorías eliminadas correctamente');

    }

    public function shiftDown(Category $category){
        $category->down();
        return back();
    }

    public function shiftUp(Category $category){
        $category->up();
        return back();
    }

    public function stats(){
        //SELECT categories.name, COUNT(ads.id) FROM ads JOIN categories ON categories.id=ads.category_id GROUP BY categories.id ORDER BY COUNT(ads.id) DESC
        $stats = DB::table('categories')
            ->join('ads', 'categories.id', '=', 'ads.category_id')
            ->groupBy('categories.id')
            ->orderBy(DB::raw('COUNT(ads.id)'), 'DESC')
            ->select(['categories.name', DB::raw('COUNT(ads.id) as count')])
            ->limit(5)
            ->get();
        return response()->json($stats);
    }
}
