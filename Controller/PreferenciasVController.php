<?php

    include_once "../Model/Model.php";

    function areasV($id){
        return areas_voluntario($id);
    }

    function populacaoV($id){
        return populacao_voluntario($id);
    }
    
    function disponibilidadeV($id){
        return disponibilidade_voluntario($id);
    }

    function insertA($voluntario, $area_interesse){
        return insert_area($voluntario, $area_interesse);
    }

    function insertP($voluntario, $populacao_alvo){
        return insert_populacao($voluntario, $populacao_alvo);
    }

    function insertD($voluntario, $dia, $hora, $duracao){
        return insert_disponibilidade($voluntario, $dia, $hora, $duracao);
    }

    function removeArea($voluntario, $area){
        return remove_area($voluntario, $area);
    }

    function removePopulacao($voluntario, $populacao){
        return remove_populacao($voluntario, $populacao);
    }

    function removeDisponibilidade($voluntario, $disponibilidade){
        $dis = explode("/", $disponibilidade);
        $dia = $dis[0];
        $hora = $dis[1];
        $duracao = $dis[2];

        return remove_disponibilidade($voluntario, $dia, $hora, $duracao);
    }

?>