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

    function AcoesInstituicao($id) {
        $acoes = acoes_instituicao($id);
        return $acoes;
    }

    function FotoInstituicao($id) {
        $foto = foto_instituicao($id);
        if ($row = $foto->fetch_assoc()){
            return $row;
        }
    }

    function openAcao($id) {

        $acao = query_acao($id);
        if ($row = $acao->fetch_assoc()){
            return $row;
        }

    }

?>