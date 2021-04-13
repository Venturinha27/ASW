<?php

    function pedidosLogged($id, $type) {

        $pedidos = array();

        if ($type == "instituicao"){
            $candidaturas = candidaturas_instituicao($id);
        } if ($type == "voluntario"){
            $candidaturas = candidaturas_voluntario($id);
        }

        while ($rowc = $candidaturas->fetch_assoc()) {
            
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

?>