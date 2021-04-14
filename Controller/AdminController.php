<?php

    include "../Model/Model.php";

    function todosUtilizadores() {
        $acoes = all_acoes();
        $voluntarios = all_voluntarios();
        $instituicoes = all_instituicoes();

        $all = array();

        while ($acoesr = $acoes->fetch_assoc()) {
            $acaoa = array();
            $acaoa[0] = $acoesr['id_acao'];
            $acaoa[1] = $acoesr['titulo'];
            $acaoa[2] = $acoesr['distrito'];
            $acaoa[3] = $acoesr['concelho'];
            $acaoa[4] = $acoesr['freguesia'];
            $acaoa[5] = 'Ação';

            array_push($all, $acaoa);
        }

        while ($volr = $voluntarios->fetch_assoc()) {
            $vola = array();
            $vola[0] = $volr['id'];
            $vola[1] = $volr['nome_voluntario'];
            $vola[2] = $volr['distrito'];
            $vola[3] = $volr['concelho'];
            $vola[4] = $volr['freguesia'];
            $vola[5] = 'Voluntário';

            array_push($all, $vola);
        }

        while ($insr = $instituicoes->fetch_assoc()) {
            $insa = array();
            $insa[0] = $insr['id'];
            $insa[1] = $insr['nome_instituicao'];
            $insa[2] = $insr['distrito'];
            $insa[3] = $insr['concelho'];
            $insa[4] = $insr['freguesia'];
            $insa[5] = 'Instituição';

            array_push($all, $insa);
        }

        usort($all, "compareF");

        return $all;
    }

    function compareF($x, $y){   
        return $X[1] - $y[1];
    }

    function todosConvites() {
        $convites = query_convites();

        $final = array();
        while ($convr = $convites->fetch_assoc()) {
            $convite = array();

            $nomevol = nome_voluntario($convr['id_voluntario']);
            if ($nv = $nomevol->fetch_array()) {
                $convite[0] = $nv[1];
            }
            $nomeins = nome_instituicao($convr['id_instituicao']);
            if ($ni = $nomeins->fetch_array()) {
                $convite[1] = $ni[1];
            }
            $nomeac = nome_acao($convr['id_acao']);
            if ($na = $nomeac->fetch_array()) {
                $convite[2] = $na[1];
            }
            $convite[3] = $convr['estado'];
            $convite[4] = $convr['data_convite'];

            array_push($final, $convite);
        }

        return $final;
    }

    function todasCandidaturas() {
        $candidaturas = query_candidaturas();

        $final = array();
        while ($canr = $candidaturas->fetch_assoc()) {
            $candidatura = array();

            $nomevol = nome_voluntario($canr['id_voluntario']);
            if ($nv = $nomevol->fetch_array()) {
                $candidatura[0] = $nv[1];
            }
            $nomeins = nome_instituicao($canr['id_instituicao']);
            if ($ni = $nomeins->fetch_array()) {
                $candidatura[1] = $ni[1];
            }
            $nomeac = nome_acao($canr['id_acao']);
            if ($na = $nomeac->fetch_array()) {
                $candidatura[2] = $na[1];
            }
            $candidatura[3] = $canr['estado'];
            $candidatura[4] = $canr['data_candidatura'];

            array_push($final, $candidatura);
        }

        return $final;

    }

    function todasParticipacoes() {
        $participacoes = query_participacoes();

        $final = array();
        while ($part = $participacoes->fetch_assoc()) {
            $participacao = array();

            $nomevol = nome_voluntario($part['id_voluntario']);
            if ($nv = $nomevol->fetch_array()) {
                $participacao[0] = $nv[1];
            }
            $nomeins = nome_instituicao($part['id_instituicao']);
            if ($ni = $nomeins->fetch_array()) {
                $participacao[1] = $ni[1];
            }
            $nomeac = nome_acao($part['id_acao']);
            if ($na = $nomeac->fetch_array()) {
                $participacao[2] = $na[1];
            }

            array_push($final, $participacao);
        }

        return $final;
    }
?>