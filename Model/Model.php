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

    function areas_voluntario($id){

        include "openconn.php";

        $sqlArea = "SELECT area
                    FROM Voluntario_Area
                    WHERE id_voluntario = '".$id."';";

        $resultA = $conn->query($sqlArea);

        if (!($resultA)) {
            mysqli_close($conn);
            return "Ainda não tem áreas de interesse..";
        }

        mysqli_close($conn);

        return $resultA;

    }

    function populacao_voluntario($id){

        include "openconn.php";

        $sqlPopulacao = "SELECT populacao_alvo
                    FROM Voluntario_Populacao_Alvo
                    WHERE id_voluntario = '".$id."';";

        $resultP = $conn->query($sqlPopulacao);

        if (!($resultP)) {
            mysqli_close($conn);
            return "Ainda não tem nenhuma população-alvo.";
        }

        mysqli_close($conn);

        return $resultP;

    }

    function disponibilidade_voluntario($id){

        include "openconn.php";

        $sqlDisponibilidade = "SELECT dia, hora, duracao
                                FROM Voluntario_Disponibilidade
                                WHERE id_voluntario = '".$id."';";

        $resultD = $conn->query($sqlDisponibilidade);

        if (!($resultD)) {
            mysqli_close($conn);
            return "Ainda não tem disponibilidade.";
        }

        mysqli_close($conn);

        return $resultD;

    }

    function insert_area($voluntario, $area_interesse) {

        include "openconn.php";

        $insertArea = "insert into Voluntario_Area
                        values ('".$voluntario."' , '".$area_interesse."')";

        $resArea = mysqli_query($conn, $insertArea);

        if (!($resArea)) {
            mysqli_close($conn);
            return FALSE;
        }

        mysqli_close($conn);
        return TRUE;

    }

    function insert_populacao($voluntario, $populacao_alvo) {

        include "openconn.php";

        $insertPopulacao = "insert into Voluntario_Populacao_Alvo
                        values ('".$voluntario."' , '".$populacao_alvo."')";

        $resPopulacao = mysqli_query($conn, $insertPopulacao);

        if (!($resPopulacao)) {
            mysqli_close($conn);
            return FALSE;
        }

        mysqli_close($conn);
        return TRUE;

    }

    function insert_disponibilidade($voluntario, $dia, $hora, $duracao) {

        include "openconn.php";

        $insertDispo = "insert into Voluntario_Disponibilidade
                        values ('".$voluntario."' , '".$dia."' ,
                            '".$hora."' , '".$duracao."')";

        $resDispo = mysqli_query($conn, $insertDispo);

        if (!($resDispo)) {
            mysqli_close($conn);
            return FALSE;
        }

        mysqli_close($conn);
        return TRUE;

    }

    function remove_area($voluntario, $area) {

        include "openconn.php";

        $removeArea = "DELETE FROM Voluntario_Area
                    WHERE id_voluntario = '".$voluntario."' 
                    AND area = '".$area."';";

        $resrArea = mysqli_query($conn, $removeArea);

        if (!($resrArea)) {
            mysqli_close($conn);
            return FALSE;
        }

        mysqli_close($conn);
        return TRUE;

    }

    function remove_populacao($voluntario, $populacao){

        include "openconn.php";

        $removePopulacao = "DELETE FROM Voluntario_Populacao_Alvo
                            WHERE id_voluntario = '".$voluntario."' 
                            AND populacao_alvo = '".$populacao."';";

        $resrPopulacao = mysqli_query($conn, $removePopulacao);

        if (!($resrPopulacao)) {
            mysqli_close($conn);
            return FALSE;
        }

        mysqli_close($conn);
        return TRUE;

    }

    function remove_disponibilidade($voluntario, $dia, $hora, $duracao){

        include "openconn.php";

        $removeDispo = "DELETE FROM Voluntario_Disponibilidade
                        WHERE id_voluntario = '".$voluntario."' 
                        AND dia = '".$dia."'
                        AND hora = '".$hora."'
                        AND duracao = '".$duracao."';";

        $resrDispo = mysqli_query($conn, $removeDispo);

        if (!($resrDispo)) {
            mysqli_close($conn);
            return FALSE;
        }

        mysqli_close($conn);
        return TRUE;

    }

    function query_voluntario($id) {

        include "openconn.php";

        $queryVoluntario = "SELECT id, nome_voluntario, foto, bio, data_nascimento,
                             genero, concelho, distrito, freguesia, telefone, cc,
                             carta_c, covid, email, password1
                            FROM Voluntario
                            WHERE id = '".$id."';";

        $resultVoluntario = $conn->query($queryVoluntario);  
        
        if (!($resultVoluntario)) {
            mysqli_close($conn);
            return "Voluntário não existe.";
        }

        mysqli_close($conn);

        return $resultVoluntario;
    }

    function query_instituicao($id) {

        include "openconn.php";

        $queryInstituicao = "SELECT id, nome_instituicao, telefone, morada, distrito,
                             concelho, freguesia, email, bio, nome_representante,
                             email_representante, foto, website, password2
                            FROM Instituicao
                            WHERE id = '".$id."';";

        $resultInstituicao = $conn->query($queryInstituicao); 
        
        if (!($resultInstituicao)) {
            mysqli_close($conn);
            return "Instituição não existe.";
        }

        mysqli_close($conn);

        return $resultInstituicao;
    }

    function acoes_instituicao($id) {

        include "openconn.php";

        $queryAcoes = "SELECT id_instituicao, id_acao, titulo, distrito, concelho, freguesia, funcao, 
                    area_interesse, populacao_alvo, num_vagas, dia, hora, duracao
                    FROM Acao
                    WHERE id_instituicao = '".$id."';";

        $resultA = $conn->query($queryAcoes);
        
        if (!($resultA)) {
            mysqli_close($conn);
            return "Instituição não tem ações.";
        }

        mysqli_close($conn);

        return $resultA;

    }


?>