<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto =Producto::all();
        return $producto;
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
        $validar= Validator::make($request->all(), [
            'nombre'=> "required",

        ]);
        if(!$validar ->fails()){
            $producto = new Producto();

            $producto->nombre = $request ->nombre;


            $producto->save();

            return response()->json([
                'res'=> true,
                'mensaje' => 'producto  guardado'
            ]);
        }else{
            return response()->json([
                'res'=> false,
                'mensaje' => 'error al guardar'
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $producto = Producto::find($id);
        $producto->nombre=$request->nombre;
        $producto->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if(isset($producto)){
            $producto->delete();
            return response()->json([
                'res'=> true,
                'mensaje' => 'producto eliminado'
            ]);
        }else{
            return response()->json([
                'res'=> false,
                'mensaje' => 'error al eliminar el producto'
            ]);
        }
    }
}
