<?php

    function openVoluntario($id) {

        $voluntario = query_voluntario($id);
        if ($row = $voluntario->fetch_assoc()){
            return $row;
        }
        
    }

    function AreasVoluntario($id) {

        $areas = areas_voluntario($id);
        return $areas;

    }

    function PopulacaoVoluntario($id) {

        $populacao = populacao_voluntario($id);
        return $populacao;

    }

    function DisponibilidadeVoluntario($id) {

        $disponibilidade = disponibilidade_voluntario($id);
        return $disponibilidade;

    }

    function openInstituicao($id) {

        $instituicao = query_instituicao($id);
        if ($row = $instituicao->fetch_assoc()){
            return $row;
        }

    }

?>