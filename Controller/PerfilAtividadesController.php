<?php

    function areasVoluntarioAT($id) {

        $areasVoluntario = areas_voluntario($id);

        if ($areasVoluntario->num_rows > 0) {     
            $areas = array();
            while ($rowA = $areasVoluntario->fetch_assoc()){
                array_push($areas, $rowA['area']);
            }
        }
        return $areas;

    }

    function populacaoVoluntarioAT($id) {

        $populacaoVoluntario = populacao_voluntario($id);

        if ($populacaoVoluntario->num_rows > 0) {     
            $populacao = array();
            while ($rowP = $populacaoVoluntario->fetch_assoc()){
                array_push($populacao, $rowP['populacao_alvo']);
            }
        }
        return $populacao;

    }

    function AcoesCorrespondentesVoluntario($id) {

        $acoes = all_acoes();

        $voluntarioq = query_voluntario($id);

        $final = array();

        if ($voluntario = $voluntarioq->fetch_assoc()) {
            while ($acao = $acoes->fetch_assoc()) {

                if ($acao['distrito'] == $voluntario['distrito']) {
    
                    $populacao = populacaoVoluntarioAT($id);
    
                    if (in_array($acao['populacao_alvo'], $populacao)) {
        
                        $area = areasVoluntarioAT($id);
                        if (in_array($acao['area_interesse'], $area)) {
        
                            array_push($final, $acao);
        
                        }
                    }
                }
            }
        }

        if (count($final) > 0) {
            return $final;
        }

        return FALSE;
        
    }

?>