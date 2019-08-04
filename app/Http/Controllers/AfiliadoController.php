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
        //
    }

    public function buscar(Request $request) 
    {
        define("PAG", 25);

        $searchFields = $request->except(['_token', 'page']); 

        if (empty($searchFields)) {
            return back();
        }

        switch($searchFields["campo"]) {
            case "afiliacion":
                $afiliados = Afiliado::where("afiliacion", "=", $searchFields["valor"])
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
                break;
            case "nombre":
                $afiliados = Afiliado::where("nombre", "LIKE", "%".$searchFields["valor"]."%")
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
                break;
            case "mvto":
                $afiliados = Afiliado::where("mvto", "=", $searchFields["valor"])
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
                break;
            case "fec_mvto":
                $afiliados = Afiliado::where("fec_mvto", "LIKE", "%".$searchFields["valor"]."%")
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
                break;
            case "curp":
                $afiliados = Afiliado::where("curp", "=", $searchFields["valor"])
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
                break;
            case "matricula":
                $afiliados = Afiliado::where("matricula", "=", $searchFields["valor"])
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
                break;
            case "semestre":
                $afiliados = Afiliado::where("semestre", "=", $searchFields["valor"])
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
                break;
            case "num_p":
                $afiliados = Afiliado::where("num_p", "=", $searchFields["valor"])
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
                break;
            case "nom_p":
                $afiliados = Afiliado::where("nom_p", "LIKE", "%".$searchFields["valor"]."%")
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
                break;
            case "umf":
                $afiliados = Afiliado::where("umf", "=", $searchFields["valor"])
                    ->where("tabla", "!=", 6)
                    ->paginate(PAG);
        }
        
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
        
        return response()->json([
            'success' => '¡Registro guardado con éxito!'
        ]);
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
        //
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

        return response()->json([
            'success' => '¡Registro editado con éxito!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Afiliado::where("id", $id)->update(array("tabla" => 6));

        return response()->json([
            'success' => '¡Registro eliminado con éxito!'
        ]);
    }

    public function download(Request $request)
    {
        $afiliadosIds = $request->request->get('ids');
        $texto = "";
        $info = array();
        foreach ($afiliadosIds as $id){
            $info =  Afiliado::find($id);
            $info["afiliacion"] = str_pad($info["afiliacion"], 11, "0", STR_PAD_LEFT);

            $texto .= 
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
