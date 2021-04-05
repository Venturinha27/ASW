<?php
    
    function searchAcoesFilter($instituicao, $titulo, $distrito, $concelho, $freguesia, $areaInteresse, $populacaoAlvo, $funcao, $numvagas, $disDia, $disHora, $disDuracao) {

        $queryAcao = "SELECT I.id, I.nome_instituicao, I.foto, A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao ";

        if (!empty($_POST['instituicao'])){
            $queryAcao .= "AND I.nome_instituicao = '".$_POST['instituicao']."' ";
        }

        if (!empty($_POST['titulo'])) {
            $queryAcao .= "AND A.titulo = '".$_POST['titulo']."' ";
        }

        if (!empty($_POST['distrito'])) {
            $queryAcao .= "AND A.distrito = '".$_POST['distrito']."' ";
        }

        if (!empty($_POST['concelho'])) {
            $queryAcao .= "AND A.concelho = '".$_POST['concelho']."' ";
        }

        if (!empty($_POST['freguesia'])) {
            $queryAcao .= "AND A.freguesia = '".$_POST['freguesia']."' ";
        }

        if (!empty($_POST['area-interesse'])) {
            $queryAcao .= "AND A.area_interesse = '".$_POST['area-interesse']."' ";
        }

        if (!empty($_POST['populacao-alvo'])) {
            $queryAcao .= "AND A.populacao_alvo = '".$_POST['populacao-alvo']."' ";
        }

        if (!empty($_POST['funcao'])) {
            $queryAcao .= "AND A.funcao = '".$_POST['funcao']."' ";
        }

        if (!empty($_POST['numvagas'])) {
            
            if ($_POST['numvagas'] == "0 a 10"){
                $queryAcao .= "AND A.num_vagas >= 0 AND A.num_vagas <= 10 ";
            }
            if ($_POST['numvagas'] == "11 a 20"){
                $queryAcao .= "AND A.num_vagas >= 11 AND A.num_vagas <= 20 ";
            }
            if ($_POST['numvagas'] == "21 a 30"){
                $queryAcao .= "AND A.num_vagas >= 21 AND A.num_vagas <= 30 ";
            }
            if ($_POST['numvagas'] == "31 a 40"){
                $queryAcao .= "AND A.num_vagas >= 31 AND A.num_vagas <= 40 ";
            }
            if ($_POST['numvagas'] == "41 a 50"){
                $queryAcao .= "AND A.num_vagas >= 41 AND A.num_vagas <= 50 ";
            }
            if ($_POST['numvagas'] == "51 a 60"){
                $queryAcao .= "AND A.num_vagas >= 51 AND A.num_vagas <= 60 ";
            }
            if ($_POST['numvagas'] == "61 a 70"){
                $queryAcao .= "AND A.num_vagas >= 61 AND A.num_vagas <= 70 ";
            }
            if ($_POST['numvagas'] == "71 a 80"){
                $queryAcao .= "AND A.num_vagas >= 71 AND A.num_vagas <= 80 ";
            }
            if ($_POST['numvagas'] == "81+"){
                $queryAcao .= "AND A.num_vagas >= 81 ";
            }
            
        }

        if (!empty($_POST['disponibilidade-dia']) and 
        !empty($_POST['disponibilidade-hora']) and
        !empty($_POST['disponibilidade-duracao'])) {

            $intervalo = intval($_POST['disponibilidade-hora']) + intval($_POST['disponibilidade-duracao']);

            $queryAcao .= "AND A.dia = '".$_POST['disponibilidade-dia']."'
                            AND A.hora >= ".$_POST['disponibilidade-hora']."
                            AND A.hora <= ".$intervalo." ";
        }

        if (isset($_SESSION['loggedid'])) {

            return orderAcoes($queryAcao);

        }

        $queryAcao .= "ORDER BY A.titulo ";

        return free_query($queryAcao);

    }
    
    function searchAcoes() {

        $queryAcao = "SELECT I.id, I.nome_instituicao, I.foto , A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao ";

        if (isset($_SESSION['loggedid'])) {

            return orderAcoes($queryAcao);

        }

        $queryAcao .= "ORDER BY A.titulo ";

        return free_query($queryAcao);

    }

    function orderAcoes($queryAcao) {
        
        if ($_SESSION['loggedtype'] == "voluntario") {

            $loggedid = $_SESSION['loggedid'];
            $logged = query_voluntario($loggedid);

            $queryAcao .= "ORDER BY A.titulo";
            
            $all = free_query($queryAcao);

            $final = array();

            if ($loggedv = $logged->fetch_assoc()) {

                while ($acao = $all->fetch_assoc()) {
                    
                    // POR DISTRITO
                    $points = 0; 
                    if ($acao['distrito'] == $loggedv['distrito']) {
                        $points = $points + 5;
                    }

                    // POR AREA
                    $areas_logged = areas_voluntario($loggedid);
                    while ($rowA_logged = $areas_logged->fetch_assoc()){
                        if ($acao['area_interesse'] == $rowA_logged['area']){
                                $points = $points + 3;
                        }
                    }

                    // POR POPULACAO ALVO
                    $populacao_logged = populacao_voluntario($loggedid);
                    while ($rowP_logged = $populacao_logged->fetch_assoc()){
                        if ($acao['populacao_alvo'] == $rowP_logged['populacao_alvo']){
                            $points = $points + 3;
                        }
                    }

                    $acao['points'] = $points;

                    array_push($final, $acao);

                }

            }
            
            usort($final, 'comparePoints');

            return $final;

        }

        if ($_SESSION['loggedtype'] == "instituicao") {

            $loggedid = $_SESSION['loggedid'];
            $logged = query_instituicao($loggedid);

            $queryAcao .= "AND I.id <> '".$_SESSION['loggedid']."' 
                                ORDER BY A.titulo ";

            $all = free_query($queryAcao);

            $final = array();

            if ($loggedv = $logged->fetch_assoc()) {

                while ($acao = $all->fetch_assoc()) {

                    $points = 0; 
                
                    // POR DISTRITO
                    if ($acao['distrito'] == $loggedv['distrito']) {
                        $points = $points + 5;
                    }
                    
                    $acoes_logged = acoes_instituicao($loggedid);
                    while ($acaol = $acoes_logged->fetch_assoc()) {
                        
                        if ($acao['area_interesse'] == $acaol['area_interesse']){
                            $points = $points + 2;
                        }

                        if ($acao['populacao_alvo'] == $acaol['populacao_alvo']){
                            $points = $points + 2;
                        }
                    }

                    $acao['points'] = $points;

                    array_push($final, $acao);

                }

            }
            
            usort($final, 'comparePoints');

            return $final;

        }
    }

    function comparePoints($a, $b) {
        return $b['points'] - $a['points'];
    }

    function nomeAcao($id) {

        $aquery = nome_acao($id);
        if ($acao = $aquery->fetch_assoc()) {
            return $acao['titulo'];
        }
    }
?>