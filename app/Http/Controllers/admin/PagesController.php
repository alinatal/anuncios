<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $pages = Page::paginate(10);
        return view('admin.pages.index')->withPages($pages);
    }

    public function create(){
        return view('admin.pages.create')->withMethod('store');
    }
    public function store(Request $request){
        $page = new Page($request->except(['_method', '_token']));
        $page->save();
        return redirect()->route('admin.pages.index')->withMessage('Página creada correctamente');
    }
    public function show(Page $page){
        return view('frontend.page')->withPage($page);
    }
    public function edit(Page $page){
        return view('admin.pages.create')->withMethod('update')->withPage($page);
    }
    public function update(Page $page, Request $request){
        $page->update($request->except(['_method', '_token']));
        return redirect()->route('admin.pages.index')->withMessage('Página actualizada correctamente');
    }
    public function destroy(Page $page){
        $page->delete();
        return redirect()->route('admin.pages.index')->withMessage('Página eliminada correctamente');

    }
}
