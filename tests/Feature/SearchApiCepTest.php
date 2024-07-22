<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchApiCepTest extends TestCase
{
    /**
     * Testa a resposta da API para a URL com CEPs.
     *
     * @return void
     */
    public function testApiReturnsJsonFormat()
    {
        $response = $this->get('/search/local/01001000,17560-246');

        $response->assertStatus(200);

        $response->assertJson([
            [
                "cep" => "17560246",
                "label" => "Avenida Paulista, Vera Cruz",
                "logradouro" => "Avenida Paulista",
                "complemento" => "de 1600/1601 a 1698/1699",
                "bairro" => "CECAP",
                "localidade" => "Vera Cruz",
                "uf" => "SP",
                "ibge" => "3556602",
                "gia" => "7134",
                "ddd" => "14",
                "siafi" => "7235"
            ],
            [
                "cep" => "01001000",
                "label" => "Praça da Sé, São Paulo",
                "logradouro" => "Praça da Sé",
                "complemento" => "lado ímpar",
                "bairro" => "Sé",
                "localidade" => "São Paulo",
                "uf" => "SP",
                "ibge" => "3550308",
                "gia" => "1004",
                "ddd" => "11",
                "siafi" => "7107"
            ]
        ]);
    }
}
