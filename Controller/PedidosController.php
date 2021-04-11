<?php

    function pedidosInstituicao($id) {

        $candidaturas = array();

        $candidaturas_ins = candidaturas_instituicao($id);

        while ($rowc = $candidaturas_ins->fetch_assoc()) {

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
            $candidatura["id_voluntario"] = $id_vol;
            $candidatura["nome_voluntario"] = $nome_vol;
            $candidatura["foto_voluntario"] = $foto_vol;
            $candidatura["id_acao"] = $id_acao;
            $candidatura["nome_acao"] = $nome_acao;
            $candidatura["id_instituicao"] = $rowc["id_instituicao"];
            $candidatura["estado"] = $rowc["estado"];
            $candidatura["data_candidatura"] = $rowc["data_candidatura"];

            array_push($candidaturas, $candidatura);
        }

        return $candidaturas;
    }

?>