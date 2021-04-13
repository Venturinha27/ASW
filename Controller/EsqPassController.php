<?php

    include_once "../Model/Model.php";

    function esqPass($email, $telefone, $novaPassword, $confPassword){

        $resposta = esqpass_query();

        while ($row = $resposta->fetch_array()){
            if ($email == $row[0] and $telefone == $row[1]){
                if ($novaPassword == $confPassword) {
                    if ($row[3] == 'voluntario'){
                        $query = update_v($row[2], $novaPassword);
                    } else {
                        $query = update_i($row[2], $novaPassword);
                    }

                    if ($query) {
                     #   header("Location: Login.php");
                    }
                } else {
                    echo "<p class='erro'> Passwords não coincidem <p>";
                }
            } else {
                echo "<p class='erro'> Email e telefone não correspondem <p>";
            }
        }
    }

?>