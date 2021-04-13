<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->


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

?>