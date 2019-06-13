<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as Guzzle;
use Goutte\Client as Goutte;

class Teste extends Controller
{
    private $url = "http://www.guiatrabalhista.com.br/guia/salario_minimo.htm";

    public function getGuzzleRequest()
    {
        $guzzle = new Guzzle();
        $goutte = new Goutte();

        $goutte->setClient($guzzle);

        $response = $goutte->request('GET', $this->url);

        $tables = $response->filterXPath('//table')->filter('tr')->each(function ($tr, $i) {
            return $tr->filter('td')->each(function ($td, $i) {
                return trim($td->text());
            });
        });

        for ($j = 1; $j < 22; $j++) {
            $retorno[$j-1][$tables[0][0]] = $tables[$j][0];
            $retorno[$j-1][$tables[0][1]] = $tables[$j][1];
            $retorno[$j-1][$tables[0][2]] = $tables[$j][2];
            $retorno[$j-1][$tables[0][3]] = $tables[$j][3];
            $retorno[$j-1][$tables[0][4]] = $tables[$j][4];
            $retorno[$j-1][$tables[0][5]] = $tables[$j][5];
        }

        dd($retorno);
    }
}
