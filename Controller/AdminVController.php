<?php

    include "../Model/Model.php";

    function adminVolPost($nome, $email, $idade, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $area_interesse, $populacao_alvo, $disponibilidade_dia, $disponibilidade_hora, $disponibilidade_duracao) {

        $primeiro = 0;

        $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                            , distrito, freguesia, telefone, cc, carta_c, covid, email
                            FROM Voluntario ";

        if (!empty($nome)){
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE nome_voluntario = '".$nome."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND nome_voluntario = '".$nome."' ";
            }
        }

        if (!empty($email)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE email = '".$email."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND email = '".$email."' ";
            }
        }

        if (!empty($idade)) {
            
            if ($idade == "10 aos 20") {
                $time1 = strtotime("-10 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-20 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "21 aos 30") {
                $time1 = strtotime("-20 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-30 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "31 aos 40") {
                $time1 = strtotime("-30 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-40 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "41 aos 50") {
                $time1 = strtotime("-40 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-50 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "51 aos 60") {
                $time1 = strtotime("-50 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-60 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "61 aos 70") {
                $time1 = strtotime("-60 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-70 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "71 aos 80") {
                $time1 = strtotime("-70 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-80 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "81+") {
                $time1 = strtotime("-80 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-150 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
            }
        }

        if (!empty($distrito)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE distrito = '".$distrito."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND distrito = '".$distrito."' ";
            }
        }

        if (!empty($concelho)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE concelho = '".$concelho."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND concelho = '".$concelho."' ";
            }
        }

        if (!empty($freguesia)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE freguesia = '".$freguesia."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND freguesia = '".$freguesia."' ";
            }
        }

        if (!empty($genero)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE genero = '".$genero."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND genero = '".$genero."' ";
            }
        }

        if (!empty($carta)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE carta_c = '".$carta."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND carta_c = '".$carta."' ";
            }
        }

        if (!empty($covid)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE covid = '".$covid."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND covid = '".$covid."' ";
            }
        }

        if (!empty($area_interesse)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Area
                                    WHERE area = '".$area_interesse."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Area
                                    WHERE area = '".$area_interesse."') ";
            }
        }

        if (!empty($populacao_alvo)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Populacao_Alvo
                                    WHERE populacao_alvo = '".$populacao_alvo."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Populacao_Alvo
                                    WHERE populacao_alvo = '".$populacao_alvo."') ";
            }
        }

        if (!empty($disponibilidade_dia) and 
        !empty($disponibilidade_hora) and
        !empty($disponibilidade_duracao)) {

            $intervalo = intval($disponibilidade_hora) + intval($disponibilidade_duracao);

            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Disponibilidade
                                    WHERE dia = '".$disponibilidade_dia."'
                                        AND hora >= ".$disponibilidade_hora."
                                        AND hora <= ".$intervalo.") ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Disponibilidade
                                    WHERE dia = '".$disponibilidade_dia."'
                                        AND hora >= ".$disponibilidade_hora."
                                        AND hora <= ".$intervalo.") ";
            }
        }

        $queryVoluntario .= "ORDER BY nome_voluntario ";

        return free_query($queryVoluntario);
        
    }

    function adminVol() {

        $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                    , distrito, freguesia, telefone, cc, carta_c, covid, email
                    FROM Voluntario
                    ORDER BY nome_voluntario;";
        
        return free_query($queryVoluntario);

    }

    function AreaVolAdmin($id) {
        return areas_voluntario($id);
    }

    function PopulacaoVolAdmin($id) {
        return populacao_voluntario($id);
    }

    function DispoVolAdmin($id) {
        return disponibilidade_voluntario($id);
    }
    

?>