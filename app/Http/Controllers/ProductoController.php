<?php
 
namespace App\Http\Controllers;
 
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use Illuminate\Database\QueryException;
 
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::orderBy('id', 'desc')->paginate(1);
        return view('producto.index', compact('productos'));
 
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::orderBy('id', 'desc')
        ->select('categorias.id', 'categorias.nombre')
        ->get();
        return view('producto.create', compact('categorias'));
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        //validacion de datos
          $request->validated();
     //procesar la imagen

        if($request->hasFile('imagen')){
            $imagen=$request->file('imagen');
            $nombreImagen=time().'.'.$imagen->getClientOriginalExtension();
            $imagen->move(public_path('img'),$nombreImagen);
        }
        //asignacion masiva
        $data=$request->except('imagen');
        $data['imagen']=$nombreImagen;
       Producto::create($data);
       return redirect()->route('producto.index')->with('success','Producto agregado con exito');
        
    }
 
    /**
     * Display the specified resource.
     */
      public function show(Producto $producto)
    {
        //
        return view('producto.show', compact('producto'));
 
 
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
        $categorias = Categoria::orderBy('id', 'DESC')
        ->select('categorias.id', 'categorias.nombre')
        ->get();
        return view('producto.edit', compact('categorias', 'producto'));

    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        //
        //validacion
        $request->validated();

        if($request->hasFile('imagen')){
            if($producto->imagen&& file_exists(public_path('img/'.$producto->imagen))){
              //eliminar imagen antigua
                unlink(public_path('img/'.$producto->imagen));
                }
                $imagen=$request->file('imagen');
                $nombreImagen=time().'.'.$imagen->getClientOriginalExtension();
                $imagen->move(public_path('img'),$nombreImagen);
            }else{
                $nombreImagen=$producto->imagen;
            }
            $data=$request->except('imagen');
            $data['imagen']=$nombreImagen;
            $producto->update($data);
            return redirect()->route('producto.index')->with('success','Producto actualizado con exito');
}

    
    
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
        try{
            $producto->delete();
            return redirect()->route('producto.index')->with('success','Producto eliminado correctamente');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
            return redirect()->back()->with('error', 'No se puede eliminar el producto porque está relacionado con otros registros');
        }
        return redirect()->back()-with('error','Error inesperado');
        }
    }
}