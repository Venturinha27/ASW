<?php

    ob_start();
    session_start();

    $versugestoes = $_REQUEST['versugestoes'];

    if ($versugestoes) {

        $loggedid = $_SESSION['loggedid'];
        $loggedtype = $_SESSION['loggedtype'];

        $sugestoes = sugestoesLogged($loggedid, $loggedtype);

        if (count($sugestoes) == 0) {
            echo "<h6 class='w3-center w3-small'><b>Não existem sugestões para si de momento.</b></h6>";
        }

        if ($versugestoes == 'open') {
            $max = count($sugestoes);
        }
        if ($versugestoes == 'closed') {
            if (count($sugestoes) > 2) {
                $max = 2;
            } else {
                $max = count($sugestoes);
            }
        }

        for ($x = 0; $x < $max; $x++) {
            echo "<div class='sugestao w3-container w3-border-top w3-border-bottom'>
                        <img src='../".$sugestoes[$x]['foto']."' alt='Avatar' class='w3-left w3-circle'>
                        <h6 class='nomeS w3-small'><b>".$sugestoes[$x]['nome']."</b></h6>
                        <p class='sugestaoTxt w3-tiny'>".$sugestoes[$x]['tipo']."</p>
                        <button class='w3-button w3-small w3-indigo' onclick='seguirSug(".json_encode($sugestoes[$x]['id']).")'><i class='fas fa-user-plus'></i> Seguir</button>
                    </div>";
        }
    
    }

    function sugestoesLogged($id, $type) {

        include_once "../Model/Model.php";

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

            if ($segue->num_rows == 0 and $id != $user['id']) {

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

                if ($loggeddistrito == $userdistrito) {
                    $classificacao = $classificacao + 10;
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
?>