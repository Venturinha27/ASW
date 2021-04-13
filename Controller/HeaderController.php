<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->


<?php

    include "../Model/Model.php";

    function loggedHeader(){

        $resultUtilizador = tipo_utilizador_query($_SESSION['loggedid']);

        if ($row = $resultUtilizador->fetch_assoc()){
        
            if ($row['tipo'] == "voluntario"){

                $resultFotoV = foto_voluntario($_SESSION['loggedid']);
    
                if ($rowV = $resultFotoV->fetch_assoc()){
                    $foto = $rowV['foto'];
                    return $foto;
                }

            } else {

                $resultFotoI = foto_instituicao($_SESSION['loggedid']);
    
                if ($rowI = $resultFotoI->fetch_assoc()){
                    $foto = $rowI['foto'];
                    return $foto;
                }

            }

        }

    }

?>



    

    

    

