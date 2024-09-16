<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;

class ContratoController extends Controller
{
    public function list()
    {
        $contratos = Contrato::all();

        return response()->json(['contratos' => $contratos]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        Contrato::create($request->all());

        return response()->json(['response' => 'contrato inserido com sucesso!']);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $contrato = Contrato::find($request->id);
        $contrato->update($request->all());

        return response()->json(['response' => 'contrato atualizado com sucesso!']);
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        $contrato = Contrato::find($request->id);
        $contrato->delete();

        return response()->json(['response' => 'contrato deletado com sucesso!']);
    }
}
