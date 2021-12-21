<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Correios;

class CepController extends Controller
{
    public function buscaPorCep($cep)
    {
        return Correios::cep($cep);
    }
}
