<?php

    function registo_instituicao($id ,$nomeInstituicao, $telefone , $morada , $distrito , $concelho ,$freguesia , $email ,$bio , $nomeRepresentante , $emailRepresentante , $password, $avatar , $website) {

        $emails = emails_utilizadores();

        if (filter_var($email, FILTER_VALIDATE_EMAIL) ){
            if (filter_var($emailRepresentante, FILTER_VALIDATE_EMAIL) ){
                if (strlen((string)$telefone) == 9){
                    if (strlen((string)$password) > 6){
                        if ($emails->num_rows > 0) {
                            while ($rowE = $emails->fetch_assoc()){
                                if ($rowE[0] == $email){
                                    $msgErro = "<p class='erro'> E-mail já existe </p>";
                                }
                            }
                        }
                    } else {
                        $msgErro = "<p class='erro'> Password deve ter, pelo menos, 7 caracteres. </p>";
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
        
        if (isset($msgErro)){
            return $msgErro;
        }

        $inserirU = inserir_utilizador($id, 'instituicao');
        
        if ($inserirU == TRUE) {

            $inserirI = inserir_instituicao($id ,$nomeInstituicao, $telefone , $morada , $distrito , $concelho ,$freguesia , $email ,$bio , $nomeRepresentante , $emailRepresentante , $password, $avatar , $website);

            if ($inserirI == TRUE) {
                $_SESSION['loggedtype'] = "instituicao";
                $_SESSION['logged'] = $nomeInstituicao;
                $_SESSION['loggedid'] = $id;
                $_SESSION['opentype'] = "instituicao";
                $_SESSION['open'] = $nomeInstituicao;
                $_SESSION['openid'] = $id;
                header("Location: ../View/PreferenciasI.php");
            } else {
                echo "<p class='erro'> ".$inserirI." </p>";
            }
            
        } else {
            echo "<p class='erro'> ".$inserirU." </p>";
        }
    
    }


?>