<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Correios;
use Cep;
use Endereco;

class CepController extends Controller
{
    public function buscaPorCep()
    {
        $cepResponse = cep(request()->get('cep'));
        $data = $cepResponse->getCepModel();
        //return response()->json(['data' => $data]);
        
        if ($data != null){
            return response()->json(['success' => true, 'data' => $data], 422);
        }
        else{
            return response()->json(['success' => false]);
        }
    }
}

