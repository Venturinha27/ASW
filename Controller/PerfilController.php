<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    ob_start();
    session_start();

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
        include_once "../Model/Model.php";
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
        
        include_once "../Model/Model.php";

        $acao = query_acao($id_acao);
        if ($row = $acao->fetch_assoc()){
            $id_inst = $row['id'];
        }

        return insert_candidatura($id_vol, $id_inst, $id_acao);
    }

    function ECandidato($id_vol, $id_instituicao, $id_acao) {

        include_once "../Model/Model.php";

        $candidaturas = query_candidaturas();

        while ($row = $candidaturas->fetch_assoc()) {
            if ($row['id_voluntario'] == $id_vol and $row['id_instituicao'] == $id_instituicao and $row['id_acao'] == $id_acao) {
                return TRUE;
            }
        }

        return FALSE;
    }

    function EConvidado($id_vol, $id_instituicao, $id_acao) {

        include_once "../Model/Model.php";

        $convites = query_convites();

        while ($row = $convites->fetch_assoc()) {
            if ($row['id_voluntario'] == $id_vol and $row['id_instituicao'] == $id_instituicao and $row['id_acao'] == $id_acao) {
                return TRUE;
            }
        }

        return FALSE;
    }

    $convida = $_REQUEST['convida_acao'];
    $id_acao_convida = $_REQUEST['id_acao_convida'];
    $id_vol_convida = $_REQUEST['id_vol_convida'];

    if ($convida == 'yes') {
        include "../Model/Model.php";
        $resposta = insert_convite($id_acao_convida, $id_vol_convida);
        if ($resposta == TRUE) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    $candidata = $_REQUEST['candidata_acao'];

    if ($candidata == 'yes') {
        $id_acao_candidata = $_REQUEST['id_acao_candidata'];
        $id_vol_candidata = $_REQUEST['id_vol_candidata'];
        $resposta = Candidatar($id_vol_candidata, $id_acao_candidata);
        if ($resposta == TRUE) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    $show_div_convida = $_REQUEST['show_div_convida'];

    if ($show_div_convida == 'yes') {

        $loggedid = $_SESSION['loggedid'];
        $openid = $_SESSION['openid'];

        echo "<header class='w3-container w3-indigo'>";
        echo "<h3 class='w3-center'><b>Convida voluntários</b></h3>";
        echo "<button id='closeConvida' onclick='closeConvida()' class='w3-display-topright w3-button w3-hover-white'><b>X</b></button>";
        echo "</header>";
        $acoesIns = AcoesInstituicao($loggedid);
        echo "<ul class='w3-ul w3-hoverable'>";
        while ($rowa = $acoesIns->fetch_assoc()) {
            echo "<li class='w3-padding-16 w3-white w3-card'><b>".$rowa['titulo']."</b>";
            $EConvidado = EConvidado($openid, $loggedid, $rowa['id_acao']);
            $ECandidato = ECandidato($openid, $loggedid, $rowa['id_acao']);
            if ($EConvidado == TRUE){
                echo "<button id='ca".$rowa['id_acao']."' class='w3-right w3-indigo w3-round-xxlarge w3-gray' disabled>Convidado</button>";
            } else if ($ECandidato == TRUE) {
                echo "<button id='ca".$rowa['id_acao']."' class='w3-right w3-indigo w3-round-xxlarge w3-gray' disabled>Candidato</button>";
            } else {
                echo "<button id='ca".$rowa['id_acao']."' onclick='convidaAcao(".json_encode($rowa['id_acao']).", ".json_encode($openid).")' class='w3-right w3-indigo w3-round-xxlarge'>Convidar</button>";
            }
            echo "</li>";
        }
        echo "</ul>";
    }

    $show_div_candidata = $_REQUEST['show_div_candidata'];

    if ($show_div_candidata == 'yes') {

        include_once "../Model/Model.php";

        $loggedid = $_SESSION['loggedid'];
        $openid = $_SESSION['openid'];
        $loggedtype = $_SESSION['loggedtype'];

        if ($loggedtype == 'voluntario') {
            $acao = query_acao($openid);
            if ($row = $acao->fetch_assoc()) {
                $id_instituicao = $row['id'];
            }
            $ECandidato = ECandidato($loggedid, $id_instituicao, $openid);
            $EConvidado = EConvidado($loggedid, $id_instituicao, $openid);
            if ($ECandidato == TRUE) {
                echo "<br>
                <button class='w3-button w3-block w3-center w3-round-xxlarge w3-gray cand' disabled>Já se candidatou a esta ação.</button>
                <br>";
            } else if ($EConvidado == TRUE) {
                echo "<br>
                <button class='w3-button w3-block w3-center w3-round-xxlarge w3-gray cand' disabled>Já foi convidado para esta ação.</button>
                <br>";
            } else {
                echo "<br>
                    <button onclick='candidataAcao(".json_encode($loggedid).", ".json_encode($openid).")' class='w3-button w3-block w3-center w3-round-xxlarge w3-indigo w3-hover-blue cand'>Candidatar-se a esta ação!</button>
                <br>";
            }
        }
    }

    $show_div_seguir = $_REQUEST['show_div_seguir'];

    if ($show_div_seguir == 'yes') {

        include_once "../Model/Model.php";

        $loggedid = $_SESSION['loggedid'];
        $openid = $_SESSION['openid'];
        $loggedtype = $_SESSION['loggedtype'];
        $opentype = $_SESSION['opentype'];

        if ($opentype == 'voluntario' or $opentype == 'instituicao') {
            if ($loggedid != $openid) {

                $segue = segue($loggedid, $openid);

                if ($segue->num_rows > 0) {
                    echo "<button class='w3-button' id='Seguindo' onclick='deixarSeguir()'>
                        <i class='fas fa-user-plus'></i> Seguindo
                    </button>";                        
                } else {
                    echo "<button class='w3-button' id='Seguir' onclick='Seguir()'>
                            <i class='fas fa-user-plus'></i> Seguir
                        </button>";
                }
                
            }
        }
    }

    $seguir_user = $_REQUEST['seguir_user'];

    if ($seguir_user == 'yes') {

        include_once "../Model/Model.php";

        $loggedid = $_SESSION['loggedid'];
        $openid = $_SESSION['openid'];

        echo seguir($loggedid, $openid);

    }

    $deixar_seguir_user = $_REQUEST['deixar_seguir_user'];

    if ($deixar_seguir_user == 'yes') {
        
        include_once "../Model/Model.php";

        $loggedid = $_SESSION['loggedid'];
        $openid = $_SESSION['openid'];

        echo deixar_seguir($loggedid, $openid);

    }
?>