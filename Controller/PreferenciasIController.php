<?php

    include_once "../Model/Model.php";

    function AcoesPreferenciasI($instituicao){
        return acoes_instituicao($instituicao);

    }

    function inserirAcao($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao){
        return inserir_acao($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao);
    }

    function removeAcao($id){
        return remove_acao($id);
    }

    function PreferenciasINomeIns($id) {
        if ($row = nome_instituicao($id)->fetch_assoc()){
            return $row['nome_instituicao'];
        }
    }
?>