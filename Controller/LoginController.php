<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->


<?php

    include "../Model/Model.php";

    function clogin($email, $password) {

        $respostal = login_query();

        if ($respostal != "Utilizador não existe" and $respostal->num_rows > 0) {

            while ($row = $respostal->fetch_array()) {

                if ($row[2] == $email) {

                    if (password_verify($password, $row[3])){

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
                                header("Location: ../View/Perfil.php");
                            } else {
                                $erro = "Utilizador não existe";
                            }
                            
                        } else {
                            $erro = "Utilizador não existe";
                        }

                    } else {
                        $erro = "Password errada.";
                    }

                } else {
                    $erro = "Utilizador não existe";
                }
                    
            }
            
        } else {
            $erro = "Utilizador não existe";
        }

        return $erro;
        
    }
?>