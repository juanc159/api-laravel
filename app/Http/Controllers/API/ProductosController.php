<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductosModel;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ProductosModel::all();
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
        return response()->json([
            'data' => ProductosModel::create($request->all()),
            'res' => true,
            'msg' => 'guardado con exito'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($producto)
    {
        return response()->json([
            'data' => ProductosModel::find($producto),
            'res' => true,
            'msg' => 'guardado con exito'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductosModel $producto)
    {
        
        return response()->json([
            'data' => $producto->update($request->all()),
            'res' => true,
            'msg' => 'Actualizado con exito'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductosModel $producto)
    {
        return response()->json([
            'data' => $producto->delete(),
            'res' => true,
            'msg' => 'Actualizado con exito'
        ]);
    }
}
