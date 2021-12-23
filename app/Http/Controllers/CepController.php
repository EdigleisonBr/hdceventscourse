<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Correios;
use Cep;
use Endereco;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CepController extends Controller
{   
    // package:: canducci/cep
    public function buscaPorCepTeste()
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

    // package:: cagartner-correios-consulta
    public function buscaCep()
    {   
        return Correios::cep('14407627');
    }

    // package:: brasil-api
    public function buscaPorCep($cep) {
        $uri = 'https://brasilapi.com.br/api/cep/v1/' . $cep;

        $dados = [];
        try {
            $client = new Client();
            $response = $client->get($uri);
            $dados = json_decode($response->getBody()->getContents());

            $dados->cidade = $dados->city;
            $dados->logradouro = $dados->street;
            $dados->bairro = $dados->neighborhood;
            $dados->estado = $dados->state;

            unset($dados->city);
            unset($dados->street);
            unset($dados->neighborhood);
            unset($dados->state);

        } catch (\Exception $e) {
            if ($e->getCode() != 404) {
                Log::error($e);
                Bugsnag::notifyException($e);
            }
        }
        if ($dados != null){
            return response()->json(['success' => true, 'data' => $dados], 422);
            //return json_encode($dados);
        }
        else{
            //return json_encode($dados);
            return response()->json(['success' => false]);
        }

        
    }
}




