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

    function areasVoluntarioF($id) {

        $areasVoluntario = areas_voluntario($id);

        if ($areasVoluntario->num_rows > 0) {     
            $areas = array();
            while ($rowA = $areasVoluntario->fetch_assoc()){
                array_push($areas, $rowA['area']);
            }
        }
        return $areas;

    }

    function populacaoVoluntarioF($id) {

        $populacaoVoluntario = populacao_voluntario($id);

        if ($populacaoVoluntario->num_rows > 0) {     
            $populacao = array();
            while ($rowP = $populacaoVoluntario->fetch_assoc()){
                array_push($populacao, $rowP['populacao_alvo']);
            }
        }
        return $populacao;

    }

    function VoluntariosMatchAcao($id_acao) {
        $acao = query_acao($id_acao);
        $voluntarios = all_voluntarios();

        $arrayVoluntarios = array();

        if ($racao = $acao->fetch_assoc()) {
            while ($rvol = $voluntarios->fetch_assoc()) {
                
                if ($racao['distrito'] == $rvol['distrito']) {

                    $populacao = populacaoVoluntarioF($rvol['id']);
                    if (in_array($racao['populacao_alvo'], $populacao)) {
    
                        $area = areasVoluntarioF($rvol['id']);
                        if (in_array($racao['area_interesse'], $area)) {
    
                            array_push($arrayVoluntarios, $rvol);
    
                        }
                    }
                }

            }
        }

        return $arrayVoluntarios;
    }

    function CandidatosAcaoFilter($id_acao, $nome, $email, $idade, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $areaInteresse, $populacaoAlvo, $disDia, $disHora, $disDuracao) {

        $candidaturas = candidaturas_acao($id_acao);

        $candidatos = array();
        while ($candidatura = $candidaturas->fetch_assoc()) {
            if ($candidatura['estado'] == "Pendente") {
                $id_vol = $candidatura['id_voluntario'];

                $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                                    , distrito, freguesia, telefone, cc, carta_c, covid, email, foto
                                    FROM Voluntario 
                                    WHERE id = '".$id_vol."' ";

                if (!empty($nome)){
                    $queryVoluntario .= "AND nome_voluntario = '".$nome."' ";
                }

                if (!empty($email)) {
                    $queryVoluntario .= "AND email = '".$email."' ";
                }

                if (!empty($idade)) {
                    
                    if ($idade == "10 aos 20") {
                        $time1 = strtotime("-10 years", time());
                        $date1 = date("Y-m-d", $time1);
                        $time2 = strtotime("-20 years", time());
                        $date2 = date("Y-m-d", $time2);
                    }
                    if ($idade == "21 aos 30") {
                        $time1 = strtotime("-20 years", time());
                        $date1 = date("Y-m-d", $time1);
                        $time2 = strtotime("-30 years", time());
                        $date2 = date("Y-m-d", $time2);
                    }
                    if ($idade == "31 aos 40") {
                        $time1 = strtotime("-30 years", time());
                        $date1 = date("Y-m-d", $time1);
                        $time2 = strtotime("-40 years", time());
                        $date2 = date("Y-m-d", $time2);
                    }
                    if ($idade == "41 aos 50") {
                        $time1 = strtotime("-40 years", time());
                        $date1 = date("Y-m-d", $time1);
                        $time2 = strtotime("-50 years", time());
                        $date2 = date("Y-m-d", $time2);
                    }
                    if ($idade == "51 aos 60") {
                        $time1 = strtotime("-50 years", time());
                        $date1 = date("Y-m-d", $time1);
                        $time2 = strtotime("-60 years", time());
                        $date2 = date("Y-m-d", $time2);
                    }
                    if ($idade == "61 aos 70") {
                        $time1 = strtotime("-60 years", time());
                        $date1 = date("Y-m-d", $time1);
                        $time2 = strtotime("-70 years", time());
                        $date2 = date("Y-m-d", $time2);
                    }
                    if ($idade == "71 aos 80") {
                        $time1 = strtotime("-70 years", time());
                        $date1 = date("Y-m-d", $time1);
                        $time2 = strtotime("-80 years", time());
                        $date2 = date("Y-m-d", $time2);
                    }
                    if ($idade == "81+") {
                        $time1 = strtotime("-80 years", time());
                        $date1 = date("Y-m-d", $time1);
                        $time2 = strtotime("-150 years", time());
                        $date2 = date("Y-m-d", $time2);
                    }
                    $queryVoluntario .= "AND (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
                }

                if (!empty($distrito)) {
                    $queryVoluntario .= "AND distrito = '".$distrito."' ";
                }

                if (!empty($concelho)) {
                    $queryVoluntario .= "AND concelho = '".$concelho."' ";
                }

                if (!empty($freguesia)) {
                    $queryVoluntario .= "AND freguesia = '".$freguesia."' ";
                }

                if (!empty($genero)) {
                    $queryVoluntario .= "AND genero = '".$genero."' ";
                }

                if (!empty($carta)) {
                    $queryVoluntario .= "AND carta_c = '".$carta."' ";
                }

                if (!empty($covid)) {
                    $queryVoluntario .= "AND covid = '".$covid."' ";
                }

                if (!empty($areaInteresse)) {
                    $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                            FROM Voluntario_Area
                                            WHERE area = '".$areaInteresse."') ";
                }

                if (!empty($populacaoAlvo)) {
                    $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                            FROM Voluntario_Populacao_Alvo
                                            WHERE populacao_alvo = '".$populacaoAlvo."') ";
                }

                if (!empty($disDia) and 
                !empty($disHora) and
                !empty($disDuracao)) {

                    $intervalo = intval($disHora) + intval($disDuracao);

                    $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                        FROM Voluntario_Disponibilidade
                                        WHERE dia = '".$disDia."'
                                            AND hora >= ".$disHora."
                                            AND hora <= ".$intervalo.") ";
                }

                $queryVoluntario .= "ORDER BY nome_voluntario ";

                $voluntario = free_query($queryVoluntario);
                if ($rowv = $voluntario->fetch_assoc()){
                    array_push($candidatos, $rowv);
                }

            }
        }

        
        return $candidatos;

    }

    function nomeVoluntario($id) {

        $vquery = nome_voluntario($id);
        if ($voluntario = $vquery->fetch_assoc()) {
            return $voluntario['nome_voluntario'];
        }
    }
?>