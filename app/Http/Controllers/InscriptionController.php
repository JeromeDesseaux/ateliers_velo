<?php

namespace App\Http\Controllers;

use App\Inscription;
use App\Workshop;
use Illuminate\Http\Request;
use Auth;

class InscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $workshop = Workshop::find($request->input('workshop_id'));
        $user = Auth::user();
        if($user->id != $workshop->user_id)
        {
            $inscription = new Inscription([
                'message' => $request->input('message'),
                'workshop_id' => $workshop->id,
                'user_id' => $user->id
            ]);
            if($workshop->automatic_validation){
                $inscription->status = 'accepted';
            }
            $inscription->save();
            return redirect()->route('workshop.index')->with('success','Super!');;
        }
        return redirect()->route('workshop.index')->with('error','Coquin!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function show(Inscription $inscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscription $inscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscription $inscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscription $inscription)
    {
        //
    }
}
