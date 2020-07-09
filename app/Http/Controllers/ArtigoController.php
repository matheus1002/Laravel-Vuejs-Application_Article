<?php

namespace App\Http\Controllers;

use App\Artigo;
use App\Http\Resources\ArtigoResource;
use Illuminate\Http\Request;

class ArtigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artigos = Artigo::paginate(5);

        return ArtigoResource::collection($artigos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artigo = $request->isMethod('put') ? Artigo::findOrFail
        ($request->id) : new Artigo;

        $artigo->id = $request->input('id');
        $artigo->titulo = $request->input('titulo');
        $artigo->descricao = $request->input('descricao');

        if ($artigo->save())
            return new ArtigoResource($artigo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artigo = Artigo::findOrFail($id);

        return new ArtigoResource($artigo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artigo = Artigo::findOrFail($id);

        if ($artigo->delete())
            return new ArtigoResource($artigo);
    }
}
