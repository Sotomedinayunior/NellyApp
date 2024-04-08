<?php

namespace App\Http\Controllers;

use App\Models\Landings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
        $request->validate([
            'nombre' => 'required',
            'primary_color' => 'required',
            'secondary_color' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'user_id' => 'required'
        ]);

       $imagePath = $request->file('logo')->store('public/images');

    // Obtener la ruta relativa a partir del path completo
    $imageUrl = str_replace('public', 'storage', $imagePath);


        // Crear un nuevo objeto Landing
        $landing = new Landings();
        $landing->nombre = $request->input('nombre');
        $landing->logo = $imageUrl;
        $landing->primary_color = $request->input('primary_color');
        $landing->secondary_color = $request->input('secondary_color');
        $landing->user_id = $request->input('user_id');

        $landing->save();

        return response()->json(["success" => true, "landing_id" => $landing->id]);
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
   /**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    $landing = Landings::findOrFail($id);
    $landing->delete();

    return response()->json(['message' => 'La landing ha sido eliminada exitosamente'], 200);
}
}