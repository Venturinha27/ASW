<?php

    include "../Model/Querys.php";

    function clogin($email, $password) {

        $respostal = login_query();

        if ($respostal != "Utilizador não existe" and $respostal->num_rows > 0) {

            $userExiste = 0;

            while ($row = $respostal->fetch_array()) {

                if (($row[2] == $email) and password_verify($password, $row[3])){

                    $tipo = tipo_utilizador_query($row[0]);

                    if ($tipo != "Utilizador não existe") {

                        if ($rowT = $tipo->fetch_array()) {

                            if ($rowT[0] == 'voluntario'){
                                $_SESSION['loggedtype'] = "voluntario";
                                $_SESSION['opentype'] = "voluntario";
                            } else {
                                $_SESSION['loggedtype'] = "instituicao";
                                $_SESSION['opentype'] = "instituicao";
                            }

                            $_SESSION['logged'] = $row[1];
                            $_SESSION['loggedid'] = $row[0];
                            $_SESSION['open'] = $row[1];
                            $_SESSION['openid'] = $row[0];
                            header("Location: ../Perfil.php");
                        }

                    } else {
                        return "Utilizador não existe";
                    }
                    
                } else {
                    return "Password errada.";
                }

            }
            
        } else {
            return "Utilizador não existe";
        }
        
    }
?>