<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    ob_start();
    session_start();

    function pedidosLogged($id, $type) {

        include_once "../Model/Model.php";

        $pedidos = array();

        if ($type == "instituicao"){
            $candidaturas = candidaturas_instituicao($id);
        } if ($type == "voluntario"){
            $candidaturas = candidaturas_voluntario($id);
        }

        while ($rowc = $candidaturas->fetch_assoc()) {

            $id_cand = $rowc['id'];
            
            $id_vol = $rowc['id_voluntario'];
            if ($rowv = query_voluntario($id_vol)->fetch_assoc()){
                $nome_vol = $rowv['nome_voluntario'];
                $foto_vol = $rowv['foto'];
            }

            $id_acao = $rowc['id_acao'];
            if ($rowa = query_acao($id_acao)->fetch_assoc()){
                $nome_acao = $rowa['titulo'];
            };

            $candidatura = array();
            $candidatura["id"] = $id_cand;
            $candidatura["tipo"] = "candidatura";
            $candidatura["tipologged"] = $type;
            $candidatura["id_voluntario"] = $id_vol;
            $candidatura["nome_voluntario"] = $nome_vol;
            $candidatura["foto_voluntario"] = $foto_vol;
            $candidatura["id_acao"] = $id_acao;
            $candidatura["nome_acao"] = $nome_acao;
            $candidatura["id_instituicao"] = $rowc["id_instituicao"];
            $candidatura["estado"] = $rowc["estado"];
            $candidatura["data"] = $rowc["data_candidatura"];

            array_push($pedidos, $candidatura);
        }

        if ($type == "instituicao"){
            $convites = convites_instituicao($id);
        } if ($type == "voluntario"){
            $convites = convites_voluntario($id);
        }

        while ($rowc = $convites->fetch_assoc()) {

            $id_con = $rowc['id'];

            $id_vol = $rowc['id_voluntario'];
            if ($rowv = query_voluntario($id_vol)->fetch_assoc()){
                $nome_vol = $rowv['nome_voluntario'];
                $foto_vol = $rowv['foto'];
            }

            $id_acao = $rowc['id_acao'];
            if ($rowa = query_acao($id_acao)->fetch_assoc()){
                $nome_acao = $rowa['titulo'];
            };

            $convite = array();
            $convite["id"] = $id_con;
            $convite["tipo"] = "convite";
            $convite["tipologged"] = $type;
            $convite["id_voluntario"] = $id_vol;
            $convite["nome_voluntario"] = $nome_vol;
            $convite["foto_voluntario"] = $foto_vol;
            $convite["id_acao"] = $id_acao;
            $convite["nome_acao"] = $nome_acao;
            $convite["id_instituicao"] = $rowc["id_instituicao"];
            $convite["estado"] = $rowc["estado"];
            $convite["data"] = $rowc["data_convite"];

            array_push($pedidos, $convite);
        }
        
        usort($pedidos, "date_sort");

        return $pedidos;
    }

    function date_sort($a, $b) {
        return strtotime($b["data"]) - strtotime($a["data"]);
    }

    $verpedidos = $_REQUEST['verpedidos'];

    $loggedid = $_SESSION['loggedid'];
    $loggedtype = $_SESSION['loggedtype'];

    if ($verpedidos) {
        $pedidos = pedidosLogged($loggedid, $loggedtype);

        if (count($pedidos) == 0) {
            echo "<h6 class='w3-center w3-small'><b>Não existem pedidos pendentes.</b></h6>";
        }

        if ($verpedidos == 'open') {
            $max = count($pedidos);
        }
        if ($verpedidos == 'closed') {
            if (count($pedidos) > 2) {
                $max = 2;
            } else {
                $max = count($pedidos);
            }
        }
        
        for ($x = 0; $x < $max; $x++) {
            if ($pedidos[$x]['tipo'] == 'candidatura') {
                echo "<div id='ca".$pedidos[$x]['id']."' class='pedido w3-container w3-border-top w3-border-bottom'>
                    <img src='../".$pedidos[$x]['foto_voluntario']."' alt='Avatar' class='w3-left w3-circle'>";
            } else {
                echo "<div id='co".$pedidos[$x]['id']."' class='pedido w3-container w3-border-top w3-border-bottom'>
                    <img src='../".$pedidos[$x]['foto_voluntario']."' alt='Avatar' class='w3-left w3-circle'>";
            }
            
            if ($pedidos[$x]['tipologged'] == "instituicao"){
                if ($pedidos[$x]['tipo'] == 'candidatura'){
                        echo "<p><b>".$pedidos[$x]['nome_voluntario']."</b> candidatou-se a <b>".$pedidos[$x]['nome_acao']."</b>.</p>";
                        if ($pedidos[$x]['estado'] == 'Pendente'){
                            echo "<button id=aca".$pedidos[$x]['id']." onclick='responderPed(".json_encode('Aceitar').", ".json_encode('Candidatura').", ".json_encode(strval($pedidos[$x]['id'])).")' class='aceitarped w3-button w3-green'><i class='fas fa-check'></i></button>
                                <button id=rca".$pedidos[$x]['id']." onclick='responderPed(".json_encode('Rejeitar').", ".json_encode('Candidatura').", ".json_encode(strval($pedidos[$x]['id'])).")' class='rejeitarped w3-button w3-red'><i class='fas fa-times'></i></button>";
                        } 
                        if ($pedidos[$x]['estado'] == 'Aceite') {
                            echo "<p class='estadop w3-text-green'><b>".$pedidos[$x]['estado']."</b></p>";
                        } 
                        if ($pedidos[$x]['estado'] == 'Rejeitado') {
                            echo "<p class='estadop w3-text-red'><b>".$pedidos[$x]['estado']."</b></p>";
                        }
                } else {
                    echo "<p><b>".$pedidos[$x]['nome_acao']."</b> convidou <b>".$pedidos[$x]['nome_voluntario']."</b>.</p>";
                    if ($pedidos[$x]['estado'] == 'Pendente'){
                        echo "<p class='estadop w3-text-gray'><b>".$pedidos[$x]['estado']."</b></p>";
                    } 
                    if ($pedidos[$x]['estado'] == 'Aceite') {
                        echo "<p class='estadop w3-text-green'><b>".$pedidos[$x]['estado']."</b></p>";
                    } 
                    if ($pedidos[$x]['estado'] == 'Rejeitado') {
                        echo "<p class='estadop w3-text-red'><b>".$pedidos[$x]['estado']."</b></p>";
                    }
                }
            } else {
                if ($pedidos[$x]['tipo'] == 'candidatura'){
                    echo "<p><b>".$pedidos[$x]['nome_voluntario']."</b> candidatou-se a <b>".$pedidos[$x]['nome_acao']."</b>.</p>";
                    if ($pedidos[$x]['estado'] == 'Pendente'){
                        echo "<p class='estadop w3-text-gray'><b>".$pedidos[$x]['estado']."</b></p>";
                    } 
                    if ($pedidos[$x]['estado'] == 'Aceite') {
                        echo "<p class='estadop w3-text-green'><b>".$pedidos[$x]['estado']."</b></p>";
                    } 
                    if ($pedidos[$x]['estado'] == 'Rejeitado') {
                        echo "<p class='estadop w3-text-red'><b>".$pedidos[$x]['estado']."</b></p>";
                    }
                } else {
                    echo "<p><b>".$pedidos[$x]['nome_acao']."</b> convidou <b>".$pedidos[$x]['nome_voluntario']."</b>.</p>";
                    if ($pedidos[$x]['estado'] == 'Pendente'){
                        echo "<button id=aco".$pedidos[$x]['id']." onclick='responderPed(".json_encode('Aceitar').", ".json_encode('Convite').", ".json_encode(strval($pedidos[$x]['id'])).")' class='aceitarped w3-button w3-green'><i class='fas fa-check'></i></button>
                        <button id=rco".$pedidos[$x]['id']." onclick='responderPed(".json_encode('Rejeitar').", ".json_encode('Convite').", ".json_encode(strval($pedidos[$x]['id'])).")' class='rejeitarped w3-button w3-red'><i class='fas fa-times'></i></button>";
                    } 
                    if ($pedidos[$x]['estado'] == 'Aceite') {
                        echo "<p class='estadop w3-text-green'><b>".$pedidos[$x]['estado']."</b></p>";
                    } 
                    if ($pedidos[$x]['estado'] == 'Rejeitado') {
                        echo "<p class='estadop w3-text-red'><b>".$pedidos[$x]['estado']."</b></p>";
                    }
                }

            }
            echo "</div>";
        } 
    }

    $responderped = $_REQUEST['responderped'];

    if ($responderped == 'yes') {
        $resposta = $_REQUEST['resposta'];
        $tipo = $_REQUEST['tipo'];
        $id = $_REQUEST['id'];

        responderAoPedido($resposta, $tipo, $id);
    }

    function responderAoPedido($resposta, $tipo, $id) {

        include "../Model/Model.php";

        if ($resposta == "Aceitar") {
            if ($tipo == "Candidatura") {
                $respostaq = candidatura_aceite($id);
            
                $candidatura = query_candidatura($id);
                if ($rowc = $candidatura->fetch_assoc()) {
                    $id_voluntario = $rowc['id_voluntario'];
                    $id_instituicao = $rowc['id_instituicao'];
                    $id_acao = $rowc['id_acao'];
                }
                participa_em_acao($id_voluntario, $id_instituicao, $id_acao); 

                $acao = query_acao($id_acao);
                if ($a = $acao->fetch_assoc()) {
                    $nome_acao = $a['titulo'];
                }
                $not = "A sua candidatura à ação $nome_acao foi aceite.";
                new_notificacao($id_voluntario, $not);

            } else {
                $respostaq = convite_aceite($id);

                $convite = query_convite($id);
                if ($rowc = $convite->fetch_assoc()) {
                    $id_voluntario = $rowc['id_voluntario'];
                    $id_instituicao = $rowc['id_instituicao'];
                    $id_acao = $rowc['id_acao'];
                }
                participa_em_acao($id_voluntario, $id_instituicao, $id_acao); 

                $voluntario = query_voluntario($id_voluntario);
                if ($v = $voluntario->fetch_assoc()) {
                    $nome_voluntario = $v['nome_voluntario'];
                }
                $acao = query_acao($id_acao);
                if ($a = $acao->fetch_assoc()) {
                    $nome_acao = $a['titulo'];
                }
                $not = "O voluntário $nome_voluntario aceitou o seu convite para a ação $nome_acao.";
                new_notificacao($id_instituicao, $not);
            }
            
            
        } else {
            if ($tipo == "Candidatura") {
                $respostaq = candidatura_rejeitada($id);

                $candidatura = query_candidatura($id);
                if ($rowc = $candidatura->fetch_assoc()) {
                    $id_voluntario = $rowc['id_voluntario'];
                    $id_instituicao = $rowc['id_instituicao'];
                    $id_acao = $rowc['id_acao'];
                }

                $acao = query_acao($id_acao);
                if ($a = $acao->fetch_assoc()) {
                    $nome_acao = $a['titulo'];
                }
                $not = "A sua candidatura à ação $nome_acao foi rejeitada.";
                new_notificacao($id_voluntario, $not);
            } else {
                $respostaq = convite_rejeitado($id);

                $convite = query_convite($id);
                if ($rowc = $convite->fetch_assoc()) {
                    $id_voluntario = $rowc['id_voluntario'];
                    $id_instituicao = $rowc['id_instituicao'];
                    $id_acao = $rowc['id_acao'];
                }

                $voluntario = query_voluntario($id_voluntario);
                if ($v = $voluntario->fetch_assoc()) {
                    $nome_voluntario = $v['nome_voluntario'];
                }
                $acao = query_acao($id_acao);
                if ($a = $acao->fetch_assoc()) {
                    $nome_acao = $a['titulo'];
                }
                $not = "O voluntário $nome_voluntario rejeitou o seu convite para a ação $nome_acao.";
                new_notificacao($id_instituicao, $not);
            }
        }

        if ($respostaq == TRUE) {
            echo 'yes';
        } else {
            echo 'no';
        }

    }



/*
    $r_resposta = $_REQUEST['r_resposta'];
    $r_tipo = $_REQUEST['r_tipo'];
    $r_id_vol = $_REQUEST['r_id_vol'];
    $r_id_acao = $_REQUEST['r_id_acao'];

    if (isset($r_resposta)) {
        
        responderAoPedido($r_resposta, $r_tipo, $r_id_vol, $r_id_acao);
        
    }

    function responderAoPedido($resposta, $tipo, $id_vol, $id_acao) {

        include "../Model/Model.php";

        if ($resposta == "Aceitar") {
            if ($tipo == "Candidatura") {
                $respostaq = candidatura_aceite($id_vol, $id_acao);
            } else {
                $respostaq = convite_aceite($id_vol, $id_acao);
            }
            $acao = query_acao($id_acao);
            if ($rowa = $acao->fetch_assoc()) {
                $id_instituicao = $rowa['id'];
            }
            participa_em_acao($id_candidato, $id_instituicao, $id_acao);
            
        } else {
            if ($tipo == "Candidatura") {
                $respostaq = candidatura_rejeitada($id_vol, $id_acao);
            } else {
                $respostaq = convite_rejeitado($id_vol, $id_acao);
            }
        }

        if ($respostaq == TRUE) {
            echo 'yes';
        } else {
            echo 'no';
        }

    }

    $logid = $_REQUEST['logid'];
    $logtype = $_REQUEST['logtype'];

    if (isset($logid)) {

        include_once "../Model/Model.php";

        echo json_encode(pedidosLogged($logid, $logtype));

    } */

?>