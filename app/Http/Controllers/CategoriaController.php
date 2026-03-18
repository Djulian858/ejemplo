<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias = Categoria::orderBy('id', 'DESC')->paginate(8);
        return view("categoria.index", compact("categorias"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("categoria.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //vamos a validar el formulario
        $datosValidos=$request->validate(
            ['nombre' => 'required|max:100|unique:categorias,nombre',
            'descripcion' => 'required|',
            'status'=>'required|boolean'
            
            ],['nombre.required'=>'El campo nombre es obligatorio',
            'nombre.max'=>'El campo nombre no puede tener mas de 100 caracteres',
            'nombre.unique'=>'El campo nombre ya existe',
            'descripcion.required'=>'El campo descripcion es obligatorio',
            'status.required'=>'El campo estatus es obligatorio',

            ]);

            $categoia=Categoria::create($datosValidos);
            return redirect()->route("categoria.index")->with("success","Categoria agregada correctamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
