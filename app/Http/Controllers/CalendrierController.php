<?php

namespace App\Http\Controllers;

use App\Models\Calendrier;
use Illuminate\Http\Request;

class CalendrierController extends Controller
{
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
    public function create(Request $request))
    {
      dd($request);
      $event = Calendrier::create([
          'titre' => $request->titre,
          'debut' => $request->debut,
          'fin' => $request->fin,
      ]);

      return response()->json($event);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calendrier  $calendrier
     * @return \Illuminate\Http\Response
     */
    public function show(Calendrier $calendrier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calendrier  $calendrier
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendrier $calendrier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calendrier  $calendrier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendrier $calendrier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calendrier  $calendrier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendrier $calendrier)
    {
        //
    }
}
