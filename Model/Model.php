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

    function emails_utilizadores() {

        include "openconn.php";

        $queryEmailU = "SELECT V.email
                    FROM Voluntario V
                    UNION
                    SELECT I.email
                    FROM Instituicao I";    

        $resultEmailU = $conn->query($queryEmailU);

        if (!($resultEmailU)) {
            mysqli_close($conn);
            return "Utilizador não existe";
        }

        mysqli_close($conn);

        return $resultEmailU;
    }

    function ccs_voluntarios() {

        include "openconn.php";

        $sqlCC = "SELECT cc
                    FROM Voluntario";  

        $resultCC = $conn->query($sqlCC);

        if (!($resultCC)) {
            mysqli_close($conn);
            return "Utilizador não existe";
        }

        mysqli_close($conn);

        return $resultCC;
    }

    function inserir_utilizador($id, $tipo) {

        include "openconn.php";

        $inserirU = "insert into Utilizador
                    values ('".$id."' , '".$tipo."')";
        
        $resU = mysqli_query($conn, $inserirU);

        if (!($resU)) {
            mysqli_close($conn);
            return "Não foi possivel registar utilizador.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function inserir_voluntario($id, $nomeProprio, $Email, $Password, $telefone, $dataNascimento, $CC, $bio, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $avatar) {

        include "openconn.php";

        $inserirV = "insert into Voluntario
            values ('".$id."' , '".$nomeProprio."' , '".$dataNascimento."' , '".$genero."' , '"
            .$avatar."' , '".$bio."' , '".$concelho."' , '".$distrito."' , '".$freguesia."' , ".$telefone." , '"
            .$CC."' , '".$carta."' , '".$covid."' , '".$Email."' , '".password_hash($Password, PASSWORD_DEFAULT)."')";

        $resV = mysqli_query($conn, $inserirV);

        if (!($resV)) {
            mysqli_close($conn);
            return "Não foi possivel registar voluntário.";
        }

        mysqli_close($conn);

        return TRUE;

    }

?>