<?php

    function login_query() {

        include "openconn.php";

        $loginquery = "SELECT I.id, I.nome_instituicao, I.email, I.password2
                            FROM Instituicao I
                            UNION
                            SELECT V.id, V.nome_voluntario, V.email, V.password1
                            FROM Voluntario V";

        $resultLogin = $conn->query($loginquery);

        if (!($resultLogin)) {
            mysqli_close($conn);
            return "Utilizador não existe";
        }

        mysqli_close($conn);

        return $resultLogin;

    }

    function tipo_utilizador_query($userid) {

        include "openconn.php";

        $tipoquery = "SELECT tipo, id
            FROM Utilizador
            WHERE id = '" . $userid . "'";

        $resultTipo = $conn->query($tipoquery);

        if (!($resultTipo)) {
            mysqli_close($conn);
            return "Utilizador não existe";
        }

        mysqli_close($conn);

        return $resultTipo;

    }

    function foto_voluntario($userid) {

        include "openconn.php";

        $queryFotoV = "SELECT id, foto
                    FROM Voluntario
                    WHERE id = '".$userid."';";
    
        $resultFotoV = $conn->query($queryFotoV);

        if (!($resultFotoV)) {
            mysqli_close($conn);
            return "Utilizador não existe";
        }

        mysqli_close($conn);

        return $resultFotoV;

    }

    function foto_instituicao($userid) {

        include "openconn.php";

        $queryFotoI = "SELECT id, foto
                    FROM Instituicao
                    WHERE id = '".$userid."';";
    
        $resultFotoI = $conn->query($queryFotoI);

        if (!($resultFotoI)) {
            mysqli_close($conn);
            return "Utilizador não existe";
        }

        mysqli_close($conn);

        return $resultFotoI;

    }

?>