<?php

    function openVoluntario($id) {

        $voluntario = query_voluntario($id);
        if ($row = $voluntario->fetch_assoc()){
            return $row;
        }

    }

    function areasV($id){
        return areas_voluntario($id);
    }

    function populacaoV($id){
        return populacao_voluntario($id);
    }

    function disponibilidadeV($id){
        return disponibilidade_voluntario($id);
    }

    function insertA($voluntario, $area_interesse){
        return insert_area($voluntario, $area_interesse);
    }

    function insertP($voluntario, $populacao_alvo){
        return insert_populacao($voluntario, $populacao_alvo);
    }

    function insertD($voluntario, $dia, $hora, $duracao){
        return insert_disponibilidade($voluntario, $dia, $hora, $duracao);
    }

    function removeArea($voluntario, $area){
        return remove_area($voluntario, $area);
    }

    function removePopulacao($voluntario, $populacao){
        return remove_populacao($voluntario, $populacao);
    }

    function removeDisponibilidade($voluntario, $disponibilidade){
        $dis = explode("/", $disponibilidade);
        $dia = $dis[0];
        $hora = $dis[1];
        $duracao = $dis[2];

        return remove_disponibilidade($voluntario, $dia, $hora, $duracao);
    }

    function updateVoluntario($id, $nomeProprio, $Email, $PasswordA, $PasswordN, $telefone, $dataNascimento, $CC, $bio, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $avatar) {

        $emailsDif = emails_diferentes_logged($id);

        $ccsDif = ccs_diferentes_logged($id);

        unset($msgErro);

        if (filter_var($Email, FILTER_VALIDATE_EMAIL) ){
            if (strlen((string)$telefone) == 9){
                if (strlen((string)$CC) == 8){
                    if ($emailsDif->num_rows > 0) {
                        while ($row = $emailsDif->fetch_assoc()){
                            if ($row[0] == $Email){
                                $msgErro = "<p class='erro'> E-mail já existe </p>";
                            }
                        }
                    }
                    if ($ccsDif->num_rows > 0) {
                        while ($rowC = $ccsDif->fetch_assoc()){
                            if ($rowC[0] == $CC){
                                $msgErro = "<p class='erro'> CC já existe </p>";
                            }
                        }
                    }
                } else {
                    $msgErro = "<p class='erro'> Insira um cc válido </p>";
                }
            } else {
                $msgErro = "<p class='erro'> Insira um numero de tel. válido </p>";
            }
        } else {
            $msgErro = "<p class='erro'> Insira um e-mail válido </p>";
        }

        if (!empty($PasswordA) and !empty($PasswordN)){
            $resultPw = select_password_vol($id);
            if ($rowPw = $resultPw->fetch_array()){
                if (password_verify($PasswordA, $rowPw[0])){
                    if (strlen((string)$PasswordN) > 6){
                        $Password = password_hash($PasswordN, PASSWORD_DEFAULT);
                    } else {
                        $msgErro = "<p class='erro'> Nova password deve ter pelo menos 7 carácteres </p>";
                    }
                } else {
                    $msgErro = "<p class='erro'> Password antiga não corresponde </p>";
                }
            }
        }
        
        if (isset($msgErro)){
            return $msgErro;
        }

        if (isset($Password)){

            $res = update_voluntario_w_password($id, $nomeProprio, $dataNascimento, $genero, $avatar, $bio, $concelho, $distrito, $freguesia, $telefone, $CC, $carta, $covid, $Email, $Password);

        } else {
            
            $res = update_voluntario($id, $nomeProprio, $dataNascimento, $genero, $avatar, $bio, $concelho, $distrito, $freguesia, $telefone, $CC, $carta, $covid, $Email);

        }
        
        if ($res) {
            $_SESSION['loggedtype'] = "voluntario";
            $_SESSION['logged'] = $nomeProprio;
            $_SESSION['loggedid'] = $id;
            $_SESSION['opentype'] = "voluntario";
            $_SESSION['open'] = $nomeProprio;
            $_SESSION['openid'] = $id;
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            return "<h1 class='erro'> Algo deu errado. </h1>";
        }
        
    }

    function openInstituicao($id) {

        $instituicao = query_instituicao($id);
        if ($row = $instituicao->fetch_assoc()){
            return $row;
        }

    }

    function updateInstituicao($id, $nomeInstituicao, $telefone, $morada, $distrito, $concelho, $freguesia, $email, $nomeRepresentante, $emailRepresentante, $PasswordA, $PasswordN, $bio, $website, $avatar) {

        $emailsDif = emails_diferentes_logged($id);

        unset($msgErro);

        if (filter_var($email, FILTER_VALIDATE_EMAIL) ){
            if (filter_var($emailRepresentante, FILTER_VALIDATE_EMAIL) ){
                if (strlen((string)$telefone) == 9){
                    if ($emailsDif->num_rows > 0) {
                        while ($rowE = $emailsDif->fetch_assoc()){
                            if ($rowE[0] == $email){
                                $msgErro = "<p class='erro'> E-mail já existe </p>";
                            }
                        }
                    }
                } else {
                    $msgErro = "<p class='erro'> Insira um numero de tel. válido </p>";
                }
            } else {
                $msgErro = "<p class='erro'> Insira um e-mail do representante válido </p>";
            }
        } else {
            $msgErro = "<p class='erro'> Insira um e-mail válido </p>";
        }
        if (!empty($PasswordA) and !empty($PasswordN)){
            
            $resultPw = select_password_ins($id);
            if ($rowPw = $resultPw->fetch_array()){
                if (password_verify($PasswordA, $rowPw[0])){
                    if (strlen((string)$PasswordN) > 6){
                        $Password = password_hash($PasswordN, PASSWORD_DEFAULT);
                    } else {
                        $msgErro = "<p class='erro'> Nova password deve ter pelo menos 7 carácteres </p>";
                    }
                } else {
                    $msgErro = "<p class='erro'> Password antiga não corresponde </p>";
                }
            }
        }
        
        if (isset($msgErro)){
            return $msgErro;
        }

        if (isset($Password)){
            $res = update_instituicao_w_password($id, $nomeInstituicao, $telefone, $morada, $distrito, $concelho, $freguesia, $email, $bio, $nomeRepresentante, $emailRepresentante, $Password, $avatar, $website);
        } else {
            $res = update_instituicao($id, $nomeInstituicao, $telefone, $morada, $distrito, $concelho, $freguesia, $email, $bio, $nomeRepresentante, $emailRepresentante, $avatar, $website);
        }
        
        if ($res) {
            $_SESSION['loggedtype'] = "instituicao";
            $_SESSION['logged'] = $nomeInstituicao;
            $_SESSION['loggedid'] = $id;
            $_SESSION['opentype'] = "instituicao";
            $_SESSION['open'] = $nomeInstituicao;
            $_SESSION['openid'] = $id;
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            return "<h1 class='erro'> Algo deu errado. </h1>";
        }
    }
?>