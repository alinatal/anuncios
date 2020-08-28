<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('order') && strlen($request->order)){
            $sponsors = Sponsor::orderBy($request->order, 'asc');
        }
        else $sponsors = Sponsor::orderBy('id', 'desc');

        //$sponsors = $sponsors->paginate(10);

        /*foreach ($sponsors as $sponsor){
            $key = explode('.', $sponsor->zone, -1);
            if($key && $key[0] == 'categories'){
                $sponsor->zone = Category::find(explode('.', $sponsor->zone)[1])->name;
            }
        }
        $links = $sponsors;
        $sponsors = $sponsors->sortBy('zone');*/


        return view('admin.sponsor.index')->withSponsors($sponsors->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$categories = Category::whereIsRoot();
        $categories = Category::whereIsLeaf()->defaultOrder()->get();
        return view('admin.sponsor.create')->withMethod('store')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sponsor $sponsor)
    {



        $sponsor = new Sponsor($request->except(['_method', '_token']));
        $sponsor->save();

        if($request->hasFile('image')){
            $image = '/'.Storage::putFileAs('/images/sponsors', $request->file('image'), $sponsor->id.'.'.$request->file('image')->getClientOriginalExtension());
            $sponsor->image = $image;
            $sponsor->save();
        }
        if($request->hasFile('image_sm')){
            $image = '/'.Storage::putFileAs('/images/sponsors', $request->file('image_sm'), $sponsor->id.'-sm.'.$request->file('image_sm')->getClientOriginalExtension());
            $sponsor->image_sm = $image;
            $sponsor->save();
        }

        if($sponsor->image == null) $sponsor->image = $sponsor->image_sm;
        else if($sponsor->image_sm == null) $sponsor->image_sm = $sponsor->image;
        $sponsor->save();

        return redirect()->back()->withMessage('Patrocinador creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        $categories = Category::whereIsLeaf()->defaultOrder()->get();
        return view('admin.sponsor.create')->withMethod('update')->withSponsor($sponsor)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $data = $request->except(['_token', '_method', 'image', 'image_sm']);
        $image = $sponsor->image;
        $image_sm = $sponsor->image_sm;
        if($request->hasFile('image')){
            Storage::delete($sponsor->image);
            $path = Storage::putFileAs('/images/sponsors', $request->file('image'), $sponsor->id.'.'.$request->file('image')->getClientOriginalExtension());
            $image = '/'.$path;
            $data += ['image' => $image];
        }
        if($request->hasFile('image_sm')){
            Storage::delete($sponsor->image_sm);
            $path = Storage::putFileAs('/images/sponsors', $request->file('image_sm'), $sponsor->id.'-sm.'.$request->file('image_sm')->getClientOriginalExtension());
            $image_sm = '/'.$path;
            $data += ['image_sm' => $image_sm];
        }
        $sponsor->update($data);

        if($sponsor->image == null) $sponsor->image = $sponsor->image_sm;
        else if($sponsor->image_sm == null) $sponsor->image_sm = $sponsor->image;
        $sponsor->save();

       /* if(strlen($sponsor->image) && !$request->hasFile('image')){
            $data = $request->except(['_token', '_method', 'image']);
        }
        else $data = $request->except(['_token', '_method', 'image']) + ['image' => $image];
        $sponsor->update($data);*/

        return redirect()->back()->withMessage('Patrocinador creado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return back()->withMessage('Patrocinador "'.$sponsor->name.'" borrado correctamente');
    }
}
