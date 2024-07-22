<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends BaseController
{

    public function searchCeps($ceps){

        // inverte o array para estar na ordem dos CEPs que foi solicitada
        $ceps = array_reverse(explode(',',$ceps));
        $return = [];
        foreach ($ceps as $cep) {

            // remove o "-" se existir
            $cep = trim(str_replace('-','',$cep));

            // se não exsitir 8 caracteres no CEP
            if(strlen($cep) != 8){
                return response()->json([
                    'success' => false,
                    'message' => 'Formato do CEP invalido'
                ], 500);
            }

            // esta acontecendo um erro ao verificar o SSL do viacep por isso o veirify false
            $response = Http::withOptions(['verify' => false])->get("https://viacep.com.br/ws/{$cep}/json");

            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro viacep'
                ], 500);
            }

            if ($response->successful()) {
                $response = $response->json();

                $formattedResponse = [
                    'cep' => str_replace('-','',$response['cep']),
                    'label' => $response['logradouro'] . ', ' . $response['localidade'], // add campo label ao array na ordem que foi solicitada
                    'logradouro' => $response['logradouro'],
                    'complemento' => $response['complemento'],
                    'bairro' => $response['bairro'],
                    'localidade' => $response['localidade'],
                    'uf' => $response['uf'],
                    'ibge' => $response['ibge'],
                    'gia' => $response['gia'],
                    'ddd' => $response['ddd'],
                    'siafi' => $response['siafi']
                ];


                $return[] = $formattedResponse;
            }


        }

        // JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE para corrigir problemas de formatação
        return response()->json($return, 200,[],JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
