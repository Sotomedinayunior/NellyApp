<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculo = Vehiculo::all();
        return response()->json($vehiculo);
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
    // Validar los datos del formulario
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        'name' => 'required|string',

        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'equipaje' => 'required|string',
        'capacidad' => 'required|string',
        'tipo' => 'required|string',
        'transmision' => 'required|string',
        'bluetooth' => 'nullable|boolean',
        'siriusX' => 'nullable|boolean',
        'GpS' => 'nullable|boolean',
        'apple_cars' => 'nullable|boolean',
        'landing_id' => 'required|exists:landings,id'
    ]);

    // Procesar las imágenes y guardar las URLs
    $imageFields = ['image'];
    $imageUrls = [];
    foreach ($imageFields as $field) {
        if ($request->hasFile($field)) {
            $imageName = time() . '_' . $request->$field->getClientOriginalName();
            $request->$field->move(public_path('uploads'), $imageName);
            $imageUrls[$field] = url('uploads/' . $imageName);
        }
    }

    // Crear un nuevo vehículo con las URLs de las imágenes
    $vehiculo = new Vehiculo();
    $vehiculo->name = $request->name;

    $vehiculo->descripcion = $request->descripcion;
    $vehiculo->precio = $request->precio;
    $vehiculo->equipaje = $request->equipaje;
    $vehiculo->capacidad = $request->capacidad;
    $vehiculo->tipo = $request->tipo;
    $vehiculo->transmision = $request->transmision;
    $vehiculo->bluetooth = $request->has('bluetooth');
    $vehiculo->siriusX = $request->has('siriusX');
    $vehiculo->GpS = $request->has('GpS');
    $vehiculo->apple_cars = $request->has('apple_cars');
    $vehiculo->landing_id = $request->landing_id;

    // Llenar los campos de las URLs de las imágenes
    $vehiculo->fill($imageUrls);

    $vehiculo->save();

    return response()->json(['message' => 'Vehículo creado con éxito' , 'vehiculo'=> $vehiculo], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo , $id)
    {
        $vehiculos = Vehiculo::where('landing_id',$id)->get();

        return response()->json($vehiculos);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo , $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->delete();

        return response()->json(['message' => 'El vehiculo ha sido eliminada exitosamente'], 200);
        //
    }
}