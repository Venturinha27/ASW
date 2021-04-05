<?php

    function searchVoluntariosFilter($nome, $email, $idade, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $areaInteresse, $populacaoAlvo, $disDia, $disHora, $disDuracao) {

        $primeiro = 0;

        $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                            , distrito, freguesia, telefone, cc, carta_c, covid, email, foto
                            FROM Voluntario ";

        if (!empty($nome)){
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE nome_voluntario = '".$nome."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND nome_voluntario = '".$nome."' ";
            }
        }

        if (!empty($email)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE email = '".$email."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND email = '".$email."' ";
            }
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
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
            }
        }

        if (!empty($distrito)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE distrito = '".$distrito."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND distrito = '".$distrito."' ";
            }
        }

        if (!empty($concelho)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE concelho = '".$concelho."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND concelho = '".$concelho."' ";
            }
        }

        if (!empty($freguesia)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE freguesia = '".$freguesia."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND freguesia = '".$freguesia."' ";
            }
        }

        if (!empty($genero)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE genero = '".$genero."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND genero = '".$genero."' ";
            }
        }

        if (!empty($carta)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE carta_c = '".$carta."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND carta_c = '".$carta."' ";
            }
        }

        if (!empty($covid)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE covid = '".$covid."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND covid = '".$covid."' ";
            }
        }

        if (!empty($areaInteresse)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Area
                                    WHERE area = '".$areaInteresse."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Area
                                    WHERE area = '".$areaInteresse."') ";
            }
        }

        if (!empty($populacaoAlvo)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Populacao_Alvo
                                    WHERE populacao_alvo = '".$populacaoAlvo."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Populacao_Alvo
                                    WHERE populacao_alvo = '".$populacaoAlvo."') ";
            }
        }

        if (!empty($disDia) and 
        !empty($disHora) and
        !empty($disDuracao)) {

            $intervalo = intval($disHora) + intval($disDuracao);

            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Disponibilidade
                                    WHERE dia = '".$disDia."'
                                        AND hora >= ".$disHora."
                                        AND hora <= ".$intervalo.") ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Disponibilidade
                                    WHERE dia = '".$disDia."'
                                        AND hora >= ".$disHora."
                                        AND hora <= ".$intervalo.") ";
            }
        }

        if (isset($_SESSION['loggedid'])) {

            return orderVoluntarios($queryVoluntario, TRUE);

        }

        $queryVoluntario .= "ORDER BY nome_voluntario ";

        return free_query($queryVoluntario);

    }

    function searchVoluntarios() {

        $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                        , distrito, freguesia, telefone, cc, carta_c, covid, email, foto
                        FROM Voluntario ";

        if (isset($_SESSION['loggedid'])) {

            return orderVoluntarios($queryVoluntario, FALSE);

        }

        $queryVoluntario .= "ORDER BY nome_voluntario ";

        return free_query($queryVoluntario);

    }

    function orderVoluntarios($queryVoluntario, $filter) {
        
        if ($_SESSION['loggedtype'] == "voluntario") {

            $loggedid = $_SESSION['loggedid'];
            $logged = query_voluntario($loggedid);

            if ($filter == TRUE) {
                $queryVoluntario .= "AND id <> '".$_SESSION['loggedid']."' 
                                    ORDER BY nome_voluntario ";
            } else {
                $queryVoluntario .= "WHERE id <> '".$_SESSION['loggedid']."' 
                                    ORDER BY nome_voluntario ";
            }
            
            $all = free_query($queryVoluntario);

            $final = array();

            if ($loggedv = $logged->fetch_assoc()) {

                while ($voluntario = $all->fetch_assoc()) {
                    
                    // POR DISTRITO
                    $points = 0; 
                    if ($voluntario['distrito'] == $loggedv['distrito']) {
                        $points = $points + 5;
                    }

                    // POR AREA
                    $areas_logged = areas_voluntario($loggedid);
                    while ($rowA_logged = $areas_logged->fetch_assoc()){
                        $areas_vol = areas_voluntario($voluntario['id']);
                        while ($rowA_vol = $areas_vol->fetch_assoc()) {
                            if ($rowA_vol['area'] == $rowA_logged['area']){
                                $points = $points + 2;
                            }
                        }
                    }

                    // POR POPULACAO ALVO
                    $populacao_logged = populacao_voluntario($loggedid);
                    while ($rowP_logged = $populacao_logged->fetch_assoc()){
                        $populacao_vol = populacao_voluntario($voluntario['id']);
                        while ($rowP_vol = $populacao_vol->fetch_assoc()) {
                            if ($rowP_vol['populacao_alvo'] == $rowP_logged['populacao_alvo']){
                                $points = $points + 2;
                            }
                        }
                    }

                    $voluntario['points'] = $points;

                    array_push($final, $voluntario);

                }

            }
            
            usort($final, 'comparePoints');

            return $final;

        }

        if ($_SESSION['loggedtype'] == "instituicao") {

            $loggedid = $_SESSION['loggedid'];
            $logged = query_instituicao($loggedid);

            if ($filter == TRUE) {
                $queryVoluntario .= "AND id <> '".$_SESSION['loggedid']."' 
                                    ORDER BY nome_voluntario ";
            } else {
                $queryVoluntario .= "WHERE id <> '".$_SESSION['loggedid']."' 
                                    ORDER BY nome_voluntario ";
            }

            $all = free_query($queryVoluntario);

            $final = array();

            if ($loggedv = $logged->fetch_assoc()) {

                while ($voluntario = $all->fetch_assoc()) {

                    $points = 0; 
                
                    // POR DISTRITO
                    if ($voluntario['distrito'] == $loggedv['distrito']) {
                        $points = $points + 5;
                    }
                    
                    $acoes_logged = acoes_instituicao($loggedid);
                    while ($acao = $acoes_logged->fetch_assoc()) {

                        $areas_vol = areas_voluntario($voluntario['id']);
                        while ($rowA_vol = $areas_vol->fetch_assoc()) {
                            if ($rowA_vol['area'] == $acao['area_interesse']){
                                $points = $points + 2;
                            }
                        }

                        $populacao_vol = populacao_voluntario($voluntario['id']);
                        while ($rowP_vol = $populacao_vol->fetch_assoc()) {
                            if ($rowP_vol['populacao_alvo'] == $acao['populacao_alvo']){
                                $points = $points + 2;
                            }
                        }

                    }

                    $voluntario['points'] = $points;

                    array_push($final, $voluntario);

                }

            }
            
            usort($final, 'comparePoints');

            return $final;

        }
    }

    function comparePoints($a, $b) {
        return $b['points'] - $a['points'];
    }

    function areasVoluntario($id) {

        $areasVoluntario = areas_voluntario($id);

        if ($areasVoluntario->num_rows > 0) {     
            $areas = array();
            while ($rowA = $areasVoluntario->fetch_assoc()){
                array_push($areas, $rowA['area']);
            }
        }
        return $areas;

    }

    function populacaoVoluntario($id) {

        $populacaoVoluntario = populacao_voluntario($id);

        if ($populacaoVoluntario->num_rows > 0) {     
            $populacao = array();
            while ($rowP = $populacaoVoluntario->fetch_assoc()){
                array_push($populacao, $rowP['populacao_alvo']);
            }
        }
        return $populacao;

    }

    function nomeVoluntario($id) {

        $resultV = nome_voluntario($id);
        if ($rowV = $resultV->fetch_assoc()) {
            $nomeV = $rowV['nome_voluntario'];
            return $nomeV;
        }
    }

    function CorrespondeVoluntarioAcoes($voluntario, $id) {
        $acoesInstituicao = acoes_instituicao($id);

        $acoesCorrespondentes = array();
        while ($acao = $acoesInstituicao->fetch_assoc()){

            if ($acao['distrito'] == $voluntario['distrito']) {

                $populacao = populacaoVoluntario($voluntario['id']);
                if (in_array($acao['populacao_alvo'], $populacao)) {

                    $area = areasVoluntario($voluntario['id']);
                    if (in_array($acao['populacao_alvo'], $populacao)) {

                        array_push($acoesCorrespondentes, $acao['titulo']);

                    }
                }
            }
        }

        if (count($acoesCorrespondentes) > 0) {
            return $acoesCorrespondentes;
        }

        return FALSE;
    }
    
?>