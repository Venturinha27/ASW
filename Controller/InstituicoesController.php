<?php
    function searchAcoes() {

        $queryAcao = "SELECT I.id, I.nome_instituicao, I.foto , A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao ";

        /* if (isset($_SESSION['loggedid'])) {

            return orderVoluntarios($queryVoluntario, FALSE);

        } */

        $queryAcao .= "ORDER BY A.titulo ";

        return free_query($queryAcao);

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
?>