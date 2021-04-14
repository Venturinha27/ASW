<?php
    
    include "../Model/Model.php";

    function admin($instituicao, $titulo, $distrito, $concelho, $freguesia, $area_interesse, $populacao_alvo, $funcao, $numvagas, $disponibilidade_dia, $disponibilidade_hora, $disponibilidade_duracao ){
        
        $queryAcao = "SELECT I.id, I.nome_instituicao, A.id_acao, A.titulo, A.distrito,
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

        if (!empty($area_interesse)) {
            $queryAcao .= "AND A.area_interesse = '".$area_interesse."' ";
        }

        if (!empty($populacao_alvo)) {
            $queryAcao .= "AND A.populacao_alvo = '".$populacao_alvo."' ";
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

        if (!empty($disponibilidade_dia) and 
        !empty($disponibilidade_hora) and
        !empty($disponibilidade_duracao)) {

            $intervalo = intval($disponibilidade_hora) + intval($disponibilidade_duracao);

            $queryAcao .= "AND A.dia = '".$disponibilidade_dia."'
                            AND A.hora >= ".$disponibilidade_hora."
                            AND A.hora <= ".$intervalo." ";
        }

        $queryAcao .= "ORDER BY I.nome_instituicao ";

        return free_query($queryAcao);

    }

    function adminF() {
        
        $queryAcao = "SELECT I.id, I.nome_instituicao, A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao
                        ORDER BY I.nome_instituicao";
        
        return free_query($queryAcao);
    }

?>