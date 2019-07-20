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
        $searchFields = $request->except(['_token', 'page']); 
        $searchFields = array_filter($searchFields);
        if (empty($searchFields)) {
            return back();
        }

        //return $searchFields;
        $afiliados = Afiliado::where($searchFields["campo"], "=", $searchFields["valor"])->paginate(10);
        return view("results")
            ->with("campo", $searchFields["campo"])
            ->with("valor", $searchFields["valor"])
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

    public function download(Request $request)
    {
        $afiliadosIds = $request->request->get('ids');
        $texto = "";
        $info = array();
        foreach ($afiliadosIds as $id){
            $info =  Afiliado::find($id);

            $texto .= 
                $info["id"]."\t".
                $info["tabla"]."\t".
                $info["afiliacion"]."\t".
                $info["nombre"]."\t".
                $info["mvto"]."\t".
                $info["fec_mvto"]."\t".
                $info["curp"]."\t".
                $info["matricula"]."\t".
                $info["semestre"]."\t".
                $info["num_p"]."\t".
                $info["nom_p"]."\t".
                $info["umf"]."\n";
        }

        return json_encode($texto);
    }
}
