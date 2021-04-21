<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    session_start();
    ob_start();

    function echo_acoes($row) {
            
        echo "
            <div class='w3-card-4 w3-round-xxlarge'>

                <header class='w3-container'>
                    <h3><i class='fa fa-hands-helping'></i> &nbsp<b>Ação</b></h3>
                </header>";

        if ($_SESSION['loggedtype'] == 'voluntario') {
            $corresponde = CorrespondeAcaoVoluntario($row, $_SESSION['loggedid']);

            if ($corresponde != FALSE) {
                echo "<header class='w3-container w3-green'>
                    <p>Esta ação corresponde ao seu perfil.</p>
                </header>";
            }
        }
                
        echo "<div class='w3-container'>
                <h5><b><span style='font-size:large'>".$row['titulo']."</span> <span style='font-size:x-small'>(".$row['nome_instituicao'].")</span></b></h5>
                <img src='../".$row['foto']."' alt='Avatar' class='w3-left w3-circle'>
                <p><i class='fas fa-map-marker-alt'></i> &nbsp ".$row['concelho'].", ".$row['distrito']."</p>
                <p><i class='fas fa-heart'></i> &nbsp ".$row['area_interesse']."</p>
                <p><i class='fas fa-users'></i> &nbsp ".$row['populacao_alvo']."</p>
        </div>
            <form action='../View/Instituicoes.php' method='post'>
                <button type='submit' value='".$row['id_acao']."' name='verPerfil' class='w3-button w3-block w3-hover-blue'>Ver Perfil</button>
            </form>
            
        </div>";
    }

    include_once "../View/TestInput.php";

    $show_acoes_filter = $_REQUEST['show_acoes_filter'];

    if ($show_acoes_filter) {

        $instituicao = test_input($_REQUEST['instituicao']);
        $titulo = test_input($_REQUEST['titulo']);
        $distrito = test_input($_REQUEST['distrito']);
        $concelho = test_input($_REQUEST['concelho']);
        $freguesia = test_input($_REQUEST['freguesia']);
        $areaInteresse = test_input($_REQUEST['area']);
        $populacaoAlvo = test_input($_REQUEST['populacao']);
        $funcao = test_input($_REQUEST['funcao']);
        $numvagas = test_input($_REQUEST['numvagas']);
        $disDia = test_input($_REQUEST['dia']);
        $disHora = test_input($_REQUEST['hora']);
        $disDuracao = test_input($_REQUEST['duracao']);

        $acoes = searchAcoesFilter($instituicao, $titulo, $distrito, $concelho, $freguesia, $areaInteresse, $populacaoAlvo, $funcao, $numvagas, $disDia, $disHora, $disDuracao);

        // SE ESTIVER LOGGADO
        if ($acoes->num_rows > -1) {
            while ($row = $acoes->fetch_assoc()){
                echo_acoes($row);
            }
        } 

        // SE NÃO ESTIVER LOGGADO
        else {
            foreach ($acoes as $row) {
                echo_acoes($row);
            }
        }
    }
    
    function searchAcoesFilter($instituicao, $titulo, $distrito, $concelho, $freguesia, $areaInteresse, $populacaoAlvo, $funcao, $numvagas, $disDia, $disHora, $disDuracao) {

        include_once "../Model/Model.php";

        $queryAcao = "SELECT I.id, I.nome_instituicao, I.foto, A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao ";

        if (!empty($instituicao)){
            $queryAcao .= "AND I.nome_instituicao = '".$instituicao."' ";
        }

        if (!empty($titulo)) {
            $queryAcao .= "AND A.titulo = '".$titulo."' ";
        }

        if (!empty($distrito)) {
            $queryAcao .= "AND A.distrito = '".$distrito."' ";
        }

        if (!empty($concelho)) {
            $queryAcao .= "AND A.concelho = '".$concelho."' ";
        }

        if (!empty($freguesia)) {
            $queryAcao .= "AND A.freguesia = '".$freguesia."' ";
        }

        if (!empty($areaInteresse)) {
            $queryAcao .= "AND A.area_interesse = '".$areaInteresse."' ";
        }

        if (!empty($populacaoAlvo)) {
            $queryAcao .= "AND A.populacao_alvo = '".$populacaoAlvo."' ";
        }

        if (!empty($funcao)) {
            $queryAcao .= "AND A.funcao = '".$funcao."' ";
        }

        if (!empty($numvagas)) {
            
            if ($numvagas == "0 a 10"){
                $queryAcao .= "AND A.num_vagas >= 0 AND A.num_vagas <= 10 ";
            }
            if ($numvagas == "11 a 20"){
                $queryAcao .= "AND A.num_vagas >= 11 AND A.num_vagas <= 20 ";
            }
            if ($numvagas == "21 a 30"){
                $queryAcao .= "AND A.num_vagas >= 21 AND A.num_vagas <= 30 ";
            }
            if ($numvagas == "31 a 40"){
                $queryAcao .= "AND A.num_vagas >= 31 AND A.num_vagas <= 40 ";
            }
            if ($numvagas == "41 a 50"){
                $queryAcao .= "AND A.num_vagas >= 41 AND A.num_vagas <= 50 ";
            }
            if ($numvagas == "51 a 60"){
                $queryAcao .= "AND A.num_vagas >= 51 AND A.num_vagas <= 60 ";
            }
            if ($numvagas == "61 a 70"){
                $queryAcao .= "AND A.num_vagas >= 61 AND A.num_vagas <= 70 ";
            }
            if ($numvagas == "71 a 80"){
                $queryAcao .= "AND A.num_vagas >= 71 AND A.num_vagas <= 80 ";
            }
            if ($numvagas == "81+"){
                $queryAcao .= "AND A.num_vagas >= 81 ";
            }
            
        }

        if (!empty($disDia)) {
            $queryAcao .= "AND A.dia = '".$disDia."' ";
        }

        if (!empty($disHora)) {
            $queryAcao .= "AND A.hora = '".$disHora."' ";
        }

        if (!empty($disDuracao)) {
            $queryAcao .= "AND A.duracao >= '".$disDuracao."' ";
        }

        if (isset($_SESSION['loggedid'])) {

            return orderAcoes($queryAcao);

        }

        $queryAcao .= "ORDER BY A.titulo ";

        return free_query($queryAcao);

    }

    $show_acoes = $_REQUEST['show_acoes'];

    if ($show_acoes) {

        $acoes = searchAcoes();
        
        // SE ESTIVER LOGGADO
        if ($acoes->num_rows > 0) {
            while ($row = $acoes->fetch_assoc()){
                echo_acoes($row);
            }
        } 

        // SE NÃO ESTIVER LOGGADO
        else {
            foreach ($acoes as $row) {
                echo_acoes($row);
            }
        }
    }
    
    function searchAcoes() {

        include_once "../Model/Model.php";

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

        include_once "../Model/Model.php";
        
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

    function CorrespondeAcaoVoluntario($acao, $id) {
        
        $qvoluntario = query_voluntario($id);

        if ($voluntario = $qvoluntario->fetch_assoc()){

            if ($acao['distrito'] == $voluntario['distrito']) {

                $populacao = populacaoVoluntario($id);

                if (in_array($acao['populacao_alvo'], $populacao)) {
    
                    $area = areasVoluntario($id);
                    if (in_array($acao['area_interesse'], $area)) {
    
                        return TRUE;
    
                    }
                }
            }
        }

        return FALSE;
    }
?>