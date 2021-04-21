<?php

    session_start();
    ob_start();

    function echo_voluntarios($row) {
        echo "
            <div class='w3-card-4 w3-round-xxlarge'>

                <header class='w3-container'>
                    <h3><i class='fa fa-male'></i> &nbsp<b>Voluntário</b></h3>
                </header>";

        if ($_SESSION['loggedtype'] == 'instituicao') {
            $acoes = CorrespondeVoluntarioAcoes($row, $_SESSION['loggedid']);

            if ($acoes != FALSE) {
                if (count($acoes) > 1) {
                    echo "<header class='w3-container w3-green'>
                    <p>Este voluntário corresponde às suas ações ";
                } else {
                    echo "<header class='w3-container w3-green'>
                    <p>Este voluntário corresponde à sua ação ";
                }

                $ultimo = count($acoes);
                $acc = 0;
                foreach ($acoes as $ac) {
                    $acc = $acc + 1;
                    if ($acc == $ultimo) {
                        echo "<b>$ac</b>.";
                    } else {
                        echo "<b>$ac</b>, ";
                    }
                    
                }
                echo "</p>
                </header>";
            }
        }
                
            echo "<div class='w3-container'>
                    <h5><b>".$row['nome_voluntario']."</b></h5>
                    <img src='../".$row['foto']."' alt='Avatar' class='w3-left w3-circle'>
                    <p><i class='fas fa-map-marker-alt'></i> &nbsp ".$row['concelho'].", ".$row['distrito']."</p>
                    <p><i class='fas fa-heart'></i> &nbsp ";

            $areas = areasVoluntario($row['id']);         

            $ultimo = count($areas);

            $c = 0;
            foreach ($areas as $are) {
                $c = $c + 1;
                if ($c == $ultimo){
                    echo "$are";
                } else {
                    echo "$are, ";
                }
            }


            echo "</p>
                    <p><i class='fas fa-users'></i> &nbsp ";

            $populacao = populacaoVoluntario($row['id']);

            $ultimo = count($populacao);

            $c = 0;
            foreach ($populacao as $pop) {
                $c = $c + 1;
                if ($c == $ultimo){
                    echo "$pop";
                } else {
                    echo "$pop, ";
                }
            }
   
            echo "</p>";
            
            echo    "</div>
                <form action='../View/Voluntarios.php' method='post'>
                    <button type='submit' value='".$row['id']."' name='verPerfil' class='w3-button w3-block w3-hover-blue'>Ver Perfil</button>
                </form>
                
            </div>";
    }

    include_once "../View/TestInput.php";

    $show_voluntarios_filter = $_REQUEST['show_voluntarios_filter'];

    if ($show_voluntarios_filter) {

        $nome = test_input($_REQUEST['nome']);
        $email = test_input($_REQUEST['email']);
        $idade = test_input($_REQUEST['idade']);
        $distrito = test_input($_REQUEST['distrito']);
        $concelho = test_input($_REQUEST['concelho']);
        $freguesia = test_input($_REQUEST['freguesia']);
        $genero = test_input($_REQUEST['genero']);
        $carta = test_input($_REQUEST['carta']);
        $covid = test_input($_REQUEST['covid']);
        $areaInteresse = test_input($_REQUEST['area']);
        $populacaoAlvo = test_input($_REQUEST['populacao']);
        $disDia = test_input($_REQUEST['dia']);
        $disHora = test_input($_REQUEST['hora']);
        $disDuracao = test_input($_REQUEST['duracao']);

        $voluntarios = searchVoluntariosFilter($nome, $email, $idade, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $areaInteresse, $populacaoAlvo, $disDia, $disHora, $disDuracao);

        // SE ESTIVER LOGGADO
        if ($voluntarios->num_rows > -1) {
            while ($row = $voluntarios->fetch_assoc()){
                echo_voluntarios($row);
            }
        } 

        // SE NÃO ESTIVER LOGGADO
        else {
            foreach ($voluntarios as $row) {
                echo_voluntarios($row);
            }
        }
    }

    function searchVoluntariosFilter($nome, $email, $idade, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $areaInteresse, $populacaoAlvo, $disDia, $disHora, $disDuracao) {

        include_once "../Model/Model.php";

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

            if ($primeiro == 0) {
                return orderVoluntarios($queryVoluntario, FALSE);
            } else {
                return orderVoluntarios($queryVoluntario, TRUE);
            }
            

        }

        $queryVoluntario .= "ORDER BY nome_voluntario ";

        return free_query($queryVoluntario);

    }

    $show_voluntarios = $_REQUEST['show_voluntarios'];

    if ($show_voluntarios) {

        $voluntarios = searchVoluntarios();
        
        // SE ESTIVER LOGGADO
        if ($voluntarios->num_rows > -1) {
            while ($row = $voluntarios->fetch_assoc()){
                echo_voluntarios($row);
            }
        } 

        // SE NÃO ESTIVER LOGGADO
        else {
            foreach ($voluntarios as $row) {
                echo_voluntarios($row);
            }
        }
    }

    function searchVoluntarios() {

        include_once "../Model/Model.php";

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

        include_once "../Model/Model.php";
        
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
                    if (in_array($acao['area_interesse'], $area)) {

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