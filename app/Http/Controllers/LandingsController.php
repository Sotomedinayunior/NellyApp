<?php

namespace App\Http\Controllers;

use App\Models\Landings;
use Illuminate\Http\Request;


class LandingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landings = Landings::all();
        return response()->json($landings);

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Landings $landings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Landings $landings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Landings $landings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Landings $landings)
    {
        //
    }
}