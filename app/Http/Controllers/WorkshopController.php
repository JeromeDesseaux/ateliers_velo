<?php

namespace App\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use App\WorkshopCategory;
use Auth;
use Image;

class WorkshopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshops = Workshop::orderByDesc('date')->get();
        return view('workshop.index', ['workshops' => $workshops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = WorkshopCategory::all()->pluck('title','id');
        return view('workshop.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $workshop = new Workshop($data);
        $workshop->user_id = Auth::user()->id;
        $workshop->automatic_validation = $request->has('automatic_validation')?true:false;
        // dd($workshop);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imagename = Auth::id().str_random(30).'.'.$image->getClientOriginalExtension();
            $thumbnailsDestinationPath = public_path('thumbnails');
            $compressedDestinationPath = public_path('uploads');

            // CREATE THUMBNAIL
            $img = Image::make($image->getRealPath());
            $img->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 75)->save($thumbnailsDestinationPath.DIRECTORY_SEPARATOR.$imagename);

            // OPTIMIZE IMAGE : COMPRESSION & REDUCTION
            $img = Image::make($image->getRealPath());
            $img->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 85)->save($compressedDestinationPath.DIRECTORY_SEPARATOR.$imagename);

            $workshop->image = $imagename;
        }
        $workshop->status = 'validated';
        $workshop->save();
        return redirect()->route('workshop.index')->with('success','Super!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $workshop = Workshop::where('slug', '=', $slug)->firstOrFail();
        return view('workshop.details', ['workshop' => $workshop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $workshop = Workshop::where('slug', '=', $slug)->firstOrFail();
        $categories = WorkshopCategory::all()->pluck('title','id');
        return view('workshop.update', ['workshop' => $workshop, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'category_id' => 'required'
        ]);
            
        $workshop = Workshop::where('slug', '=', $slug)->firstOrFail();
        $user = Auth::user();
        if($user->id == $workshop->user_id)
        {
            $workshop->update($request->all());
            return redirect()->route('workshop.index')->with('success','Super!');
        }
        return redirect()->route('workshop.index')->with('error','Petit coquin!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user = Auth::user();
        $workshop = Workshop::where('slug', '=', $slug)->firstOrFail();
        if($user->id != $workshop->user_id)
        {
            $workshop->delete();
            return redirect()->route('workshop.index')->with('success','Super!');
        }
        return redirect()->route('workshop.index')->with('error','Petit coquin!');
    }
}
