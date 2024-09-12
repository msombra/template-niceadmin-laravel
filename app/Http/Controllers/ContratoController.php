<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;

class ContratoController extends Controller
{
    public function store(Request $request)
    {
        Contrato::create($request->all());

        return response()->json(['response' => 'deu bom']);
    }

    public function table()
    {
        $contratos = Contrato::all();

        return response()->json(['contratos' => $contratos]);
    }
}
