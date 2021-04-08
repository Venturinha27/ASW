<?php

    function CandidatosAcao($id_acao) {
        $candidaturas = candidaturas_acao($id_acao);

        $candidatos = array();
        while ($candidatura = $candidaturas->fetch_assoc()) {
            if ($candidatura['estado'] == "Pendente") {
                $voluntario_id = $candidatura['id_voluntario'];
                $voluntario = query_voluntario($voluntario_id);
                if ($rowv = $voluntario->fetch_assoc()){
                    array_push($candidatos, $rowv);
                }
            }
            
        }

        $acao = query_acao($id_acao);
        if ($row = $acao->fetch_assoc()){
            $orderedCandidatos = orderCandidatos($candidatos, $row);
        }

        return $orderedCandidatos;
        
    }

    function orderCandidatos($candidatos, $acao) {

        $all = array();

        foreach ($candidatos as $candidato) {

            // POR DISTRITO
            $points = 0; 
            if ($candidato['distrito'] == $acao['distrito']) {
                $points = $points + 1;
            }

            // POR AREA
            $areas_vol = areas_voluntario($candidato['id']);
            while ($rowA_vol = $areas_vol->fetch_assoc()) {
                if ($rowA_vol['area'] == $acao['area_interesse']){
                    $points = $points + 1;
                }
            }

            // POR POPULACAO ALVO
            $populacao_vol = populacao_voluntario($candidato['id']);
            while ($rowP_vol = $populacao_vol->fetch_assoc()) {
                if ($rowP_vol['populacao_alvo'] == $acao['populacao_alvo']){
                    $points = $points + 1;
                }
            }

            $candidato['points'] = $points;

            array_push($all, $candidato);
        }

        usort($all, 'comparePoints');

        return $all;


    }

    function comparePoints($a, $b) {
        return $b['points'] - $a['points'];
    }

    function areasCandidato($id) {

        $areasVoluntario = areas_voluntario($id);

        if ($areasVoluntario->num_rows > 0) {     
            $areas = array();
            while ($rowA = $areasVoluntario->fetch_assoc()){
                array_push($areas, $rowA['area']);
            }
        }
        return $areas;

    }

    function populacaoCandidato($id) {

        $populacaoVoluntario = populacao_voluntario($id);

        if ($populacaoVoluntario->num_rows > 0) {     
            $populacao = array();
            while ($rowP = $populacaoVoluntario->fetch_assoc()){
                array_push($populacao, $rowP['populacao_alvo']);
            }
        }
        return $populacao;

    }

    function AceitarCandidatura($id_candidato, $id_acao) {
        candidatura_aceite($id_candidato, $id_acao);
        $acao = query_acao($id_acao);
        if ($rowa = $acao->fetch_assoc()) {
            $id_instituicao = $rowa['id'];
        }
        participa_em_acao($id_candidato, $id_instituicao, $id_acao);
    }

    function InstituicaoAcao($id_acao){
        $acao = query_acao($id_acao);
        if ($rowa = $acao->fetch_assoc()) {
            $id_instituicao = $rowa['id'];
            return $id_instituicao;
        }
    }
?>