<?php

class RankingService {

    private $repositorio;

    public function __construct($repositorioRanking) {

    $this->repositorio = $repositorioRanking;   


    }

    public function ordenarRankingPorMovimento($idMovimento) {

        $obterRankingDesordenado = $this->repositorio->obterRankingPorMovimento($idMovimento);

        if(count($obterRankingDesordenado) === 0) {

            return array();

        }

        $nomeDoMovimento = $obterRankingDesordenado[0]['movimento'];

        $listaOrdenadaMovimento = array();
        $posicao = 0;
        $ultimoPeso = null;

        foreach($obterRankingDesordenado as $dadoRanking) {

            $peso = $dadoRanking['peso'];

            if($peso !== $ultimoPeso) {

                $posicao = $posicao + 1;

            }

            $dadosPrUsuario = array(

                "nome_usuario" => $dadoRanking['nome_usuario'],
                "rp" => $peso,                
                "data" => $dadoRanking['data_pr']
            );

        if(!isset($listaOrdenadaMovimento[$posicao])) {

            $listaOrdenadaMovimento[$posicao] = array();

        }         
        array_push($listaOrdenadaMovimento[$posicao], $dadosPrUsuario);

        $ultimoPeso = $peso;


        }

    $rankingOrdenado = array(

        $nomeDoMovimento => $listaOrdenadaMovimento

    );

        return $rankingOrdenado;


    }


}