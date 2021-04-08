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

    function Candidatar($id_vol, $id_acao) {
        
        $acao = query_acao($id_acao);
        if ($row = $acao->fetch_assoc()){
            $id_inst = $row['id'];
        }

        return insert_candidatura($id_vol, $id_inst, $id_acao);
    }

    function ECandidato($id_vol, $id_instituicao, $id_acao) {

        $candidaturas = query_candidaturas();

        while ($row = $candidaturas->fetch_assoc()) {
            if ($row['id_voluntario'] == $id_vol and $row['id_instituicao'] == $id_instituicao and $row['id_acao'] == $id_acao) {
                return TRUE;
            }
        }

        return FALSE;
    }

?>