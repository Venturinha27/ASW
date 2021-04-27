<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    ob_start();
    session_start();

    $q = $_REQUEST["q"];

    include "../Model/Model.php";

    

    if (isset($q)){

        $loggedid = $_SESSION['loggedid'];

        $resultados = searchUtilizadores();
            
        $hint = "";
        // lookup all hints from array if $q is different from "" 
        if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($resultados as $resultado) {
                if (stristr($q, substr($resultado['nome'], 0, $len))) {
                    $hint .= "<button type='submit' class='w3-card w3-button w3-white' onclick='showConversa(".json_encode($loggedid).", ".json_encode($resultado['id']).")'>
                                 <img class='w3-left w3-circle' src='../".$resultado['foto']."'>
                                <p><span class='w3-small'><b>".$resultado['nome']."</b></span></p> <p class='procuraMtipo'><span class='w3-tiny'>".$resultado['tipo']."</p>
                            </button>";                    
                }
            }
        }

        // Output "Nenhum resultado encontrado" if no hint was found or output correct values 
        echo $hint === "" ? "<button type='submit' class='w3-card w3-button w3-white'>Nenhum resultado encontrado.</button>" : $hint;
    }

    function searchUtilizadores() {
        
        include_once "../Model/Model.php";

        $type = $_SESSION['loggedtype'];
        $id = $_SESSION['loggedid'];

        $all_utilizadores = all_utilizadores();
        $final = array();

        if ($type == 'voluntario') {
            $loggedq = query_voluntario($loggedid);
            
        }
        if ($type == 'instituicao') {
            $loggedq = query_instituicao($loggedid);
            
        } 

        if ($loggedqu = $loggedq->fetch_assoc()){
            $loggeddistrito = $loggedqu['distrito'];
        }


        while ($user = $all_utilizadores->fetch_assoc()) {

            $segue = segue($id, $user['id']);

            if ($id != $user['id']) {

                $infouser = array();

                if ($user['tipo'] == 'voluntario') {
                    $uquery = query_voluntario($user['id']);
                    if ($row = $uquery->fetch_assoc()) {
                        $infouser['id'] = $user['id'];
                        $infouser['tipo'] = 'Voluntário';
                        $infouser['nome'] = $row['nome_voluntario'];
                        $infouser['foto'] = $row['foto'];
                        $userdistrito = $row['distrito'];
                    }
                }
                if ($user['tipo'] == 'instituicao') {
                    $uquery = query_instituicao($user['id']);
                    if ($row = $uquery->fetch_assoc()) {
                        $infouser['id'] = $user['id'];
                        $infouser['tipo'] = 'Instituição';
                        $infouser['nome'] = $row['nome_instituicao'];
                        $infouser['foto'] = $row['foto'];
                        $userdistrito = $row['distrito'];
                    }
                }

                $classificacao = 0;

                if ($segue->num_rows > 0) {
                    $classificacao = $classificacao + 100;
                }

                if ($loggeddistrito == $userdistrito) {
                    $classificacao = $classificacao + 1;
                }

                $npub = numero_publicacoes_user($user['id']);
                $nseg = numero_seguidores_user($user['id']);
                if ($rowp = $npub->fetch_array()){
                    $npublicacoes = $rowp[0];
                }
                if ($rows = $nseg->fetch_array()){
                    $nseguidores = $rows[0];
                }

                $classificacao = $classificacao + ($npublicacoes / 10);
                $classificacao = $classificacao + ($nseguidores / 10);

                $seguidores_logged = seguidores_user($id);
                $seguidores_user = seguidores_user($user['id']);

                while ($seguidor_logged = $seguidores_logged->fetch_array()) {
                    while ($seguidor_user = $seguidores_user->fetch_array()) {
                        if ($seguidor_logged[0] == $seguidor_user[0]) {
                            $classificacao = $classificacao + 0.5;
                        }
                    }
                }

                $seguindo_logged = seguindo_user($id);
                $seguindo_user = seguindo_user($user['id']);

                while ($seguin_logged = $seguindo_logged->fetch_array()) {
                    while ($seguin_user = $seguindo_user->fetch_array()) {
                        if ($seguin_logged[0] == $seguin_user[0]) {
                            $classificacao = $classificacao + 0.5;
                        }
                    }
                }

                $infouser['classificacao'] = $classificacao;

                array_push($final, $infouser);

            }

        }

        usort($final, 'compareClass');

        return $final;
    }

    function compareClass($a, $b) {
        return $b['classificacao'] - $a['classificacao'];
    }

    $vermensagens = $_REQUEST['vermensagens'];

    if ($vermensagens) {

        $loggedid = $_SESSION['loggedid'];
        $logged = $_SESSION['logged'];

        $conversas = conversasLogged($loggedid);

        echo "<div class='w3-indigo w3-border-top w3-border-white'>
                        &nbsp&nbsp<i class='fas fa-search'></i>&nbsp&nbsp<input type='text' class='searchMessage' onkeyup='searchMessage(this.value)' placeholder='Procura...'>
                        <div id='searchMensagemDiv' class='w3-block hidden'></div>
                    </div>";

        if (count($conversas) == 0) {
            echo "<h6 class='w3-center w3-small'><b>Ainda não participou em nenhuma conversa.</b></h6>";
        }

        if ($vermensagens == 'open') {
            $max = count($conversas);
        }
        if ($vermensagens == 'closed') {
            if (count($conversas) > 2) {
                $max = 2;
            } else {
                $max = count($conversas);
            }
        }

        for ($x = 0; $x < $max; $x++) {

            if ($conversas[$x]['de'] == $loggedid) {
                $conversante = $conversas[$x]['para'];
            } else {
                $conversante = $conversas[$x]['de'];
            }

            if ($tipoq = tipo_utilizador_query($conversante)->fetch_assoc()) {
                if ($tipoq['tipo'] == 'voluntario') {
                    $user = query_voluntario($conversante);
                    if ($vol = $user->fetch_assoc()) {
                        $nome = $vol['nome_voluntario'];
                        $foto = $vol['foto'];
                    }
                } else {
                    $user = query_instituicao($conversante);
                    if ($ins = $user->fetch_assoc()) {
                        $nome = $ins['nome_instituicao'];
                        $foto = $ins['foto'];
                    }
                }
            }

            $date = strtotime($conversas[$x]['data_msg']);
            $date = date('H:i', $date);

            if (strlen($conversas[$x]['texto']) > 35) {
                $texto = substr($conversas[$x]['texto'], 0, 35) . "...";
            } else {
                $texto = $conversas[$x]['texto'];
            }

            echo "<div class='conversa w3-container w3-border-top w3-border-bottom w3-hover' onclick='showConversa(".json_encode($loggedid).", ".json_encode($conversante).")'>
                    <img src='../".$foto."' alt='Avatar' class='w3-left w3-circle'>
                    <h6 class='nomeS w3-small'><b>".$nome."</b></h6>";
                    if ($conversas[$x]['de'] == $loggedid) {
                        $nomep = explode(" ", $logged);
                        echo "<p class='sugestaoTxt w3-tiny'>".$nomep[0].": ".$texto."</p>";
                    } else {
                        $nomep = explode(" ", $nome);
                        echo "<p class='sugestaoTxt w3-tiny'>".$nomep[0].": ".$texto."</p>";
                    }
                    echo "<p class='msgHora w3-tiny'>".$date."</p>
                </div>";
        }
    
    }

    function conversasLogged($id) {
        $mensagens = mensagens_user($id);

        $conversas = array();
        $conversantes = array();

        while ($mensagem = $mensagens->fetch_assoc()) {

            if ($id = $mensagem['de']) {
                if (!in_array($mensagem['para'], $conversantes)) {
                    $conversa = array();
    
                    $conversa['de'] = $mensagem['de'];
                    $conversa['para'] = $mensagem['para'];
                    $conversa['texto'] = $mensagem['texto'];
                    $conversa['data_msg'] = $mensagem['data_msg'];
    
                    array_push($conversantes, $mensagem['para']);
                    array_push($conversas, $conversa);
                }
            } else {
                if (!in_array($mensagem['de'], $conversantes)) {
                    $conversa = array();
    
                    $conversa['de'] = $mensagem['de'];
                    $conversa['para'] = $mensagem['para'];
                    $conversa['texto'] = $mensagem['texto'];
                    $conversa['data_msg'] = $mensagem['data_msg'];
    
                    array_push($conversantes, $mensagem['de']);
                    array_push($conversas, $conversa);
                }
            }
            
        }

        usort($conversas, "date_sort");

        return $conversas;
    }

    function date_sort($a, $b) {
        return strtotime($b["data_msg"]) - strtotime($a["data_msg"]);
    }

    $verconversa = $_REQUEST['verconversa'];

    if ($verconversa == 'yes') {

        $own = $_REQUEST['own'];
        $other = $_REQUEST['other'];

        conversaPrivada($own, $other);

    }

    function conversaPrivada($own, $other) {

        if ($tipoq = tipo_utilizador_query($other)->fetch_assoc()) {
            if ($tipoq['tipo'] == 'voluntario') {
                $user = query_voluntario($other);
                if ($vol = $user->fetch_assoc()) {
                    $nome = $vol['nome_voluntario'];
                }
            } else {
                $user = query_instituicao($other);
                if ($ins = $user->fetch_assoc()) {
                    $nome = $ins['nome_instituicao'];
                }
            }
        }

        /* echo "<div class='w3-container w3-border-top w3-border-bottom w3-hover' id='conversaopen'>
                            <header class='w3-white w3-text-indigo'>
                                    <button class='w3-button' onclick='backConversa()'><i class='fas fa-arrow-left'></i></button> <p><b>$nome</b></p>
                            </header>"; */

        // echo "<div class='textes'>";

        $conversa = query_conversa($own, $other);

        while ($mensagem = $conversa->fetch_assoc()) {
            if ($mensagem['de'] == $own) {
                
                if ($tipoq = tipo_utilizador_query($own)->fetch_assoc()) {
                    if ($tipoq['tipo'] == 'voluntario') {
                        $user = query_voluntario($own);
                        if ($vol = $user->fetch_assoc()) {
                            $nome = $vol['nome_voluntario'];
                            $foto = $vol['foto'];
                        }
                    } else {
                        $user = query_instituicao($own);
                        if ($ins = $user->fetch_assoc()) {
                            $nome = $ins['nome_instituicao'];
                            $foto = $ins['foto'];
                        }
                    }
                }

                $date = strtotime($mensagem['data_msg']);
                $date = date('H:i', $date);

                echo "<div class='msgt'>
                        <div class='msgown'>
                            <img src='../".$foto."' alt='Avatar' class='w3-left w3-circle'>
                            <div class='msgtext'>
                                <p class='msgtextp'>".$mensagem['texto']."</p>
                                <p class='msgtexth'>".$date."</p>
                            </div>
                        </div> 
                    </div>";
            } else {

                if ($tipoq = tipo_utilizador_query($mensagem['de'])->fetch_assoc()) {
                    if ($tipoq['tipo'] == 'voluntario') {
                        $user = query_voluntario($mensagem['de']);
                        if ($vol = $user->fetch_assoc()) {
                            $nome = $vol['nome_voluntario'];
                            $foto = $vol['foto'];
                        }
                    } else {
                        $user = query_instituicao($mensagem['de']);
                        if ($ins = $user->fetch_assoc()) {
                            $nome = $ins['nome_instituicao'];
                            $foto = $ins['foto'];
                        }
                    }
                }

                $date = strtotime($mensagem['data_msg']);
                $date = date('H:i', $date);

                echo "<div class='msgt'>
                        <div class='msgother'>
                            <img src='../".$foto."' alt='Avatar' class='w3-left w3-circle'>
                            <div class='msgtext'>
                                <p class='msgtextp'>".$mensagem['texto']."</p>
                                <p class='msgtexth'>".$date."</p>
                            </div>
                        </div> 
                    </div>";
            }
        }

       /*  echo "</div>
                <footer>
                    <input type='text' id='send_msg_input' placeholder='Escreva uma mensagem...'></input>
                    <button class='w3-button w3-hover-none' onclick='sendMessage(".json_encode($own).", ".json_encode($other).")'>
                        <i class='fas fa-paper-plane'></i>
                    </button>
                </footer>
        </div>"; */
    }

    $sendmessage = $_REQUEST['sendmessage'];

    if ($sendmessage == 'yes') {

        $send_own = $_REQUEST['send_own'];
        $send_other = $_REQUEST['send_other'];
        $send_text = $_REQUEST['send_text'];

        echo insert_message($send_own, $send_other, $send_text);
        
    }

    $verheader = $_REQUEST['verheader'];

    if ($verheader == 'yes') {

        $header_other = $_REQUEST['header_other'];

        if ($tipoq = tipo_utilizador_query($header_other)->fetch_assoc()) {
            if ($tipoq['tipo'] == 'voluntario') {
                $user = query_voluntario($header_other);
                if ($vol = $user->fetch_assoc()) {
                    $nome = $vol['nome_voluntario'];
                }
            } else {
                $user = query_instituicao($header_other);
                if ($ins = $user->fetch_assoc()) {
                    $nome = $ins['nome_instituicao'];
                }
            }
        }

        echo "<header class='w3-white w3-text-indigo'>
                <button class='w3-button' onclick='backConversa()'><i class='fas fa-arrow-left'></i></button> <p><b>$nome</b></p>
            </header>";
    }

    
    
?>