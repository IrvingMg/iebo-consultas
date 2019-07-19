<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Afiliado;

class AfiliadoController extends Controller
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
    public function create()
    {
        return view("create");
    }

    public function buscar(Request $request) 
    {
        $campo = $request->input('campo');
        $valor = $request->input('valor');

        $afiliados = Afiliado::where($campo, "=", $valor)->get();
        return view("results")
            ->with("campo", $campo)
            ->with("valor", $valor)
            ->with("total", sizeof($afiliados))
            ->with("afiliados", $afiliados);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Afiliado::create($request->post());
        return view("create");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $afiliado = Afiliado::find($id);
        return view("edit", compact("afiliado"));
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
        $data = request()->except(['_method','_token']);
        Afiliado::whereId($id)->update($data);

        return redirect("home");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $afiliado = Afiliado::find($id);
        $afiliado->delete();

        return redirect("home");
    }
}
