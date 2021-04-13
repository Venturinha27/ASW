<?php

    include "../Model/Model.php";

    function esqPass($email, $telefone, $novaPassword, $confPassword){

        $resposta = esqpass_query();
        echo"updateI1";

        while ($row = $resposta->fetch_array()){
            if ($email == $row[0] and $telefone == $row[1]){
                if ($novaPassword == $confPassword) {
                    if ($row[3] == 'voluntario'){
                        $query = updateV();
                    } else {
                        $query = updateI();
                    }
                    
                    $novaPass = $conn->query($query);

                    echo"updateI2";

                    if ($novaPass) {
                        header("Location: Login.php");
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