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

    function query_acao($id) {

        include "openconn.php";

        $queryAcao = "SELECT I.id, I.nome_instituicao, I.foto, A.id_acao, A.titulo, A.distrito,
                    A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                    A.num_vagas, A.dia, A.hora, A.duracao
                    FROM Instituicao I, Acao A
                    WHERE I.id = A.id_instituicao 
                    AND A.id_acao = '".$id."'";

        $resultAcao = $conn->query($queryAcao);  

        if (!($resultAcao)) {
            mysqli_close($conn);
            return "Ação não existe.";
        }
        mysqli_close($conn);
        
        return $resultAcao;

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

    function emails_diferentes_logged($id) {

        include "openconn.php";

        $sqlEmailsD = "SELECT V.email
                    FROM Voluntario V
                    WHERE V.id <> '".$id."'
                    UNION
                    SELECT I.email
                    FROM Instituicao I
                    WHERE I.id <> '".$id."'";

        $resultEmailsD = $conn->query($sqlEmailsD);

        if (!($resultEmailsD)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultEmailsD;
    }

    function ccs_diferentes_logged($id) {

        include "openconn.php";

        $sqlCC = "SELECT cc
                    FROM Voluntario
                    WHERE V.id <> '".$id."'";  

        $resultCC = $conn->query($sqlCC);

        if (!($resultCC)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultCC;
    }

    function select_password_vol ($id){

        include "openconn.php";

        $sqlPw = "SELECT V.password1
                FROM Voluntario V
                WHERE V.id = '".$id."'";

        $resultPw = $conn->query($sqlPw);

        if (!($resultPw)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultPw;

    }

    function select_password_ins ($id){

        include "openconn.php";

        $sqlPw = "SELECT I.password2
                FROM Instituicao I
                WHERE I.id = '".$id."'";

        $resultPw = $conn->query($sqlPw);

        if (!($resultPw)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultPw;

    }

    function update_voluntario_w_password($id, $nomeProprio, $dataNascimento, $genero, $avatar, $bio, $concelho, $distrito, $freguesia, $telefone, $CC, $carta, $covid, $Email, $Password){

        include "openconn.php";

        $query = "UPDATE Voluntario
                SET id = '$id',nome_voluntario = '$nomeProprio', data_nascimento = '$dataNascimento',
                genero = '$genero', foto = '$avatar', bio = '$bio', concelho = '$concelho',
                distrito = '$distrito', freguesia = '$freguesia', telefone = '$telefone',
                cc = '$CC', carta_c = '$carta', covid = '$covid', email = '$Email',
                password1 = '$Password'
                WHERE id = '$id'"; 

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function update_voluntario($id, $nomeProprio, $dataNascimento, $genero, $avatar, $bio, $concelho,
                                 $distrito, $freguesia, $telefone, $CC, $carta, $covid, $Email){

        include "openconn.php";

        $query = "UPDATE Voluntario
                SET id = '$id',nome_voluntario = '$nomeProprio', data_nascimento = '$dataNascimento',
                genero = '$genero', foto = '$avatar', bio = '$bio', concelho = '$concelho',
                distrito = '$distrito', freguesia = '$freguesia', telefone = '$telefone',
                cc = '$CC', carta_c = '$carta', covid = '$covid', email = '$Email' 
                WHERE id = '$id'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function update_instituicao_w_password($id, $nomeInstituicao, $telefone, $morada, $distrito, $concelho, $freguesia, $email, $bio, $nomeRepresentante, $email_representante, $Password, $avatar, $website){

        include "openconn.php";

        $query = "UPDATE Instituicao
                    SET id = '$id', nome_instituicao = '$nomeInstituicao', telefone = '$telefone',
                    morada = '$morada', distrito = '$distrito', concelho = '$concelho', freguesia = '$freguesia',
                    email = '$email', bio = '$bio', nome_representante = '$nomeRepresentante',
                    email_representante = '$email_representante', password2 = '$Password', foto = '$avatar',
                    website = '$website'
                    WHERE id = '$id'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function update_instituicao($id, $nomeInstituicao, $telefone, $morada, $distrito, $concelho, $freguesia, $email, $bio, $nomeRepresentante, $email_representante, $avatar, $website){

        include "openconn.php";

        $query = "UPDATE Instituicao
                    SET id = '$id', nome_instituicao = '$nomeInstituicao', telefone = '$telefone',
                    morada = '$morada', distrito = '$distrito', concelho = '$concelho', freguesia = '$freguesia',
                    email = '$email', bio = '$bio', nome_representante = '$nomeRepresentante',
                    email_representante = '$email_representante', foto = '$avatar',
                    website = '$website'
                    WHERE id = '$id'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function update_acao($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao){

        include "openconn.php";

        $query = "UPDATE Acao
                    SET id_instituicao = '$id_instituicao', id_acao = '$id_acao', titulo = '$titulo', distrito = '$distrito', 
                    concelho = '$concelho', freguesia = '$freguesia', funcao = '$funcao', area_interesse = '$area_interesse', 
                    populacao_alvo = '$populacao_alvo', num_vagas = '$vagas', dia = '$dia', hora = '$hora', duracao = '$duracao' 
                    WHERE id_acao = '$id_acao'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function free_query($query){

        include "openconn.php";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function nome_voluntario($id){

        include "openconn.php";

        $query = "SELECT id, nome_voluntario
                FROM Voluntario
                WHERE id = '".$id."'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function nome_instituicao($id){

        include "openconn.php";

        $query = "SELECT id, nome_instituicao
                FROM Instituicao
                WHERE id = '".$id."'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function nome_acao($id) {

        include "openconn.php";

        $query = "SELECT id_acao, titulo
                FROM Acao
                WHERE id_acao = '".$id."'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function all_acoes() {

        include "openconn.php";

        $queryAcao = "SELECT I.id, I.nome_instituicao, I.foto, A.id_acao, A.titulo, A.distrito,
                    A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                    A.num_vagas, A.dia, A.hora, A.duracao
                    FROM Instituicao I, Acao A
                    WHERE I.id = A.id_instituicao";

        $resultAcao = $conn->query($queryAcao);  
        
        if (!($resultAcao)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultAcao;

    }

    function insert_candidatura($id_vol, $id_inst, $id_acao) {

        include "openconn.php";

        $inserirC = "insert into Candidatura_Acao (id_voluntario, id_instituicao, id_acao, estado, data_candidatura)
            values ('".$id_vol."' , '".$id_inst."' , '".$id_acao."' , 'Pendente' , NOW())";

        $resC = mysqli_query($conn, $inserirC);

        if (!($resC)) {
            mysqli_close($conn);
            return "Não foi possivel registar candidatura.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function query_candidaturas() {

        include "openconn.php";

        $queryCandidatura = "SELECT id_voluntario, id_instituicao, id_acao, estado, data_candidatura
                            FROM Candidatura_Acao";

        $resultCandidatura = $conn->query($queryCandidatura);  
        
        if (!($resultCandidatura)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultCandidatura;

    }

    function query_convites() {

        include "openconn.php";

        $queryConvite = "SELECT id_voluntario, id_instituicao, id_acao, estado, data_convite
                            FROM Convite_Acao";

        $resultConvite = $conn->query($queryConvite);  
        
        if (!($resultConvite)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultConvite;

    }

    function candidaturas_acao($id_acao) {

        include "openconn.php";

        $queryCandidatura = "SELECT id_voluntario, id_instituicao, id_acao, estado, data_candidatura
                            FROM Candidatura_Acao
                            WHERE id_acao = '".$id_acao."'";

        $resultCandidatura = $conn->query($queryCandidatura);  
        
        if (!($resultCandidatura)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultCandidatura;

    }

    function participa_em_acao($id_voluntario, $id_instituicao, $id_acao) {

        include "openconn.php";

        $inserirC = "insert into Participou_Acao
            values ('".$id_voluntario."' , '".$id_instituicao."' , '".$id_acao."')";

        $resC = mysqli_query($conn, $inserirC);

        if (!($resC)) {
            mysqli_close($conn);
            return "Não foi possivel registar candidatura.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function participacoes_acao($id_acao) {

        include "openconn.php";

        $queryCandidatura = "SELECT id_voluntario, id_instituicao, id_acao
                            FROM Participou_Acao
                            WHERE id_acao = '".$id_acao."'";

        $resultCandidatura = $conn->query($queryCandidatura);  
        
        if (!($resultCandidatura)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultCandidatura;

    }

    function participacoes_voluntario($id_voluntario) {

        include "openconn.php";

        $queryCandidatura = "SELECT id_voluntario, id_instituicao, id_acao
                            FROM Participou_Acao
                            WHERE id_voluntario = '".$id_voluntario."'";

        $resultCandidatura = $conn->query($queryCandidatura);  
        
        if (!($resultCandidatura)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultCandidatura;

    }

    function candidaturas_instituicao($id_instituicao) {

        include "openconn.php";

        $queryCandidatura = "SELECT id, id_voluntario, id_instituicao, id_acao, estado, data_candidatura 
                            FROM Candidatura_Acao 
                            WHERE id_instituicao = '".$id_instituicao."'";

        $resultCandidatura = $conn->query($queryCandidatura);  
        
        if (!($resultCandidatura)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultCandidatura;

    }

    function convites_instituicao($id_instituicao) {

        include "openconn.php";

        $queryConvite = "SELECT id, id_voluntario, id_instituicao, id_acao, estado, data_convite 
                            FROM Convite_Acao 
                            WHERE id_instituicao = '".$id_instituicao."'";

        $resultConvite = $conn->query($queryConvite);  
        
        if (!($resultConvite)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultConvite;

    }

    function candidaturas_voluntario($id_voluntario) {

        include "openconn.php";

        $queryCandidatura = "SELECT id, id_voluntario, id_instituicao, id_acao, estado, data_candidatura 
                            FROM Candidatura_Acao 
                            WHERE id_voluntario = '".$id_voluntario."'";

        $resultCandidatura = $conn->query($queryCandidatura);  
        
        if (!($resultCandidatura)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultCandidatura;

    }

    function convites_voluntario($id_voluntario) {

        include "openconn.php";

        $queryConvite = "SELECT id, id_voluntario, id_instituicao, id_acao, estado, data_convite 
                            FROM Convite_Acao 
                            WHERE id_voluntario = '".$id_voluntario."'";

        $resultConvite = $conn->query($queryConvite);  
        
        if (!($resultConvite)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultConvite;

    }

    function insert_convite($id_acao, $id_voluntario) {

        include "openconn.php";

        $infoacao = query_acao($id_acao);
        if ($rowa = $infoacao->fetch_assoc()) {
            $id_inst = $rowa['id'];
        }

        $inserirC = "insert into Convite_Acao (id_voluntario, id_instituicao, id_acao, estado, data_convite)
            values ('".$id_voluntario."' , '".$id_inst."' , '".$id_acao."' , 'Pendente' , NOW() )";

        $resC = mysqli_query($conn, $inserirC);

        if (!($resC)) {
            mysqli_close($conn);
            return "Não foi possivel registar convite.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function candidatura_aceite($id) {

        include "openconn.php";

        $query = "UPDATE Candidatura_Acao
                    SET estado = 'Aceite'
                    WHERE id = '".$id."' ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function aceitar_candidatura_candidato_acao($candidato, $acao) {

        include "openconn.php";

        $query = "UPDATE Candidatura_Acao
                    SET estado = 'Aceite'
                    WHERE id_voluntario = '".$candidato."' 
                    AND id_acao = '".$acao."' ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function candidatura_rejeitada($id) {

        include "openconn.php";

        $query = "UPDATE Candidatura_Acao
                    SET estado = 'Rejeitado'
                    WHERE id = '".$id."' ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function rejeitar_candidatura_candidato_acao($candidato, $acao) {

        include "openconn.php";

        $query = "UPDATE Candidatura_Acao
                    SET estado = 'Rejeitado'
                    WHERE id_voluntario = '".$candidato."' 
                    AND id_acao = '".$acao."' ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function convite_aceite($id) {

        include "openconn.php";

        $query = "UPDATE Convite_Acao
                    SET estado = 'Aceite'
                    WHERE id = '".$id."' ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function convite_rejeitado($id) {

        include "openconn.php";

        $query = "UPDATE Convite_Acao
                    SET estado = 'Rejeitado'
                    WHERE id = '".$id."' ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function all_voluntarios() {

        include "openconn.php";

        $queryVoluntario = "SELECT id, nome_voluntario, foto, bio, data_nascimento,
                            genero, concelho, distrito, freguesia, telefone, cc,
                            carta_c, covid, email, password1
                            FROM Voluntario";

        $resultVoluntario = $conn->query($queryVoluntario);  
        
        if (!($resultVoluntario)) {
            mysqli_close($conn);
            return "Não existem voluntários.";
        }

        mysqli_close($conn);

        return $resultVoluntario;

    }

    function procura_instituicoes() {

        include "openconn.php";

        $queryInstituicao = "SELECT id, nome_instituicao, foto 
                            FROM Instituicao";

        $resultInstituicao = $conn->query($queryInstituicao); 
        
        if (!($resultInstituicao)) {
            mysqli_close($conn);
            return "Não existem instituições.";
        }

        mysqli_close($conn);

        return $resultInstituicao;

    }

    function procura_voluntarios() {

        include "openconn.php";

        $queryVoluntario = "SELECT id, nome_voluntario, foto 
                            FROM Voluntario";

        $resultVoluntario = $conn->query($queryVoluntario);  
        
        if (!($resultVoluntario)) {
            mysqli_close($conn);
            return "Não existem voluntários.";
        }

        mysqli_close($conn);

        return $resultVoluntario;

    }

    function procura_acoes() {

        include "openconn.php";

        $queryAcao = "SELECT A.id_acao, A.titulo, I.foto 
                    FROM Instituicao I, Acao A
                    WHERE I.id = A.id_instituicao";

        $resultAcao = $conn->query($queryAcao);  
        
        if (!($resultAcao)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultAcao;

    }

    function inserir_instituicao($id ,$nomeInstituicao, $telefone , $morada , $distrito , $concelho ,$freguesia , $email ,$bio , $nomeRepresentante , $emailRepresentante , $password, $avatar , $website) {

        include "openconn.php";

        $inserirI = "insert into Instituicao
        values ('".$id."' , '".$nomeInstituicao."' , ".$telefone." , '".$morada."' , '"
        .$distrito."' , '".$concelho."' , '".$freguesia."' , '".$email."' , '".$bio."' , '"
        .$nomeRepresentante."' , '".$emailRepresentante."' , '".password_hash($password, PASSWORD_DEFAULT)."' , '".$avatar."' , '".$website."')";

        $resI = mysqli_query($conn, $inserirI);

        if (!($resI)) {
            mysqli_close($conn);
            return "Não foi possivel registar voluntário.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function inserir_acao($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao) {
        
        include "openconn.php";

        $query = "insert into Acao
        values ('".$id_instituicao."' , '".$id_acao."' , '".$titulo."' , '".$distrito."' , '".$concelho."' , '"
        .$freguesia."' , '".$funcao."' , '".$area_interesse."' , '".$populacao_alvo."' , ".$vagas." , '"
        .$dia."' , ".$hora." , ".$duracao.")";

        $res = mysqli_query($conn, $query);
            
        if (!$res) {
            mysqli_close($conn);
            return "erro";
        }
        
        mysqli_close($conn);

        return TRUE;

    
    }

    function remove_acao($id){
        include "openconn.php";

        $removeAcao = "DELETE FROM Acao 
                        WHERE id_acao = '".$id."'";

        $resrAcao = mysqli_query($conn, $removeAcao);
            
        if (!($resrAcao)) {
                mysqli_close($conn);
                return FALSE;
        }
        mysqli_close($conn);
        return TRUE;
    }

    function esqpass_query(){
        
        include "openconn.php";

        $passquery = "SELECT I.email, I.telefone, I.id, U.tipo 
                                    FROM Instituicao I, Utilizador U 
                                    UNION 
                                    SELECT V.email, V.telefone, V.id, U.tipo 
                                    FROM Voluntario V, Utilizador U";

        $resultPass = $conn->query($passquery);

        if (!($resultPass)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $resultPass;
    }

    function update_v($id, $novaPassword){
       
        include "openconn.php";

        $query1 = "UPDATE Voluntario 
                   SET password1 = '".password_hash($novaPassword, PASSWORD_DEFAULT)."' 
                   WHERE id = '".$id."'";

        $query = $conn->query($query1);

        if (!($query)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return TRUE;
    }

    function update_i($id, $novaPassword){

        include "openconn.php";

        $query2 = "UPDATE Instituicao 
                   SET password2 = '".password_hash($novaPassword, PASSWORD_DEFAULT)."' 
                   WHERE id = '".$id."'";

        echo $query2;

        $query = $conn->query($query2);

        if (!($query)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    function all_instituicoes() {

        include "openconn.php";

        $query = "SELECT id, nome_instituicao, telefone, morada, distrito, 
                    concelho, freguesia, email, bio, nome_representante, 
                    email_representante, foto, website, password2 
                    FROM Instituicao";

        $result = $conn->query($query);  
        
        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function query_participacoes() {

        include "openconn.php";

        $query = "SELECT id_voluntario, id_instituicao, id_acao
                            FROM Participou_Acao";

        $result = $conn->query($query);  
        
        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;

    }

    function query_candidatura($id) {

        include "openconn.php";

        $queryCandidatura = "SELECT id, id_voluntario, id_instituicao, id_acao, estado, data_candidatura
                            FROM Candidatura_Acao 
                            WHERE id = '".$id."' ";

        $resultCandidatura = $conn->query($queryCandidatura);  
        
        if (!($resultCandidatura)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultCandidatura;

    }

    function query_convite($id) {

        include "openconn.php";

        $queryConvite = "SELECT id, id_voluntario, id_instituicao, id_acao, estado, data_convite
                            FROM Convite_Acao 
                            WHERE id = '".$id."' ";

        $resultConvite = $conn->query($queryConvite);  
        
        if (!($resultConvite)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $resultConvite;

    }

    function segue($logged, $open){
       
        include "openconn.php";

        $querysegue = "SELECT seguidor, seguido
                    FROM Segue
                    WHERE seguidor = '".$logged."' 
                    AND seguido = '".$open."'";

        $results = $conn->query($querysegue);

        if (!($results)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $results;
    }

    function seguir($loggedid, $openid) {

        include "openconn.php";

        $querysegue = "INSERT INTO Segue 
                        VALUES ('".$loggedid."', '".$openid."')";

        $results = $conn->query($querysegue);

        if (!($results)) {
            mysqli_close($conn);
            return FALSE;
        }

        mysqli_close($conn);

        return TRUE;

    }

    function deixar_seguir($loggedid, $openid) {

        include "openconn.php";

        $querysegue = "DELETE FROM Segue 
                        WHERE seguidor = '".$loggedid."' 
                        AND seguido = '".$openid."' ";

        $results = $conn->query($querysegue);

        if (!($results)) {
            mysqli_close($conn);
            return FALSE;
        }

        mysqli_close($conn);

        return TRUE;

    }

    function publicacoes() {
        
        include "openconn.php";

        $sql = "SELECT id, dono, imagem, descricao, data_pub 
                FROM Publicacao 
                ORDER BY data_pub DESC";
    
        $result = $conn->query($sql);
        
        if (!($result)) {
            mysqli_close($conn);
            return "Erro no acesso à BD.";
        }

        mysqli_close($conn);

        return $result;
    
    
    }

    function numero_publicacoes_user($id){
       
        include "openconn.php";

        $query = "SELECT COUNT(*) 
                    FROM Publicacao
                    WHERE dono = '".$id."'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;
    }

    function numero_seguidores_user($id){
       
        include "openconn.php";

        $query = "SELECT COUNT(*) 
                    FROM Segue
                    WHERE seguido = '".$id."'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;
    }

    function numero_seguindo_user($id){
       
        include "openconn.php";

        $query = "SELECT COUNT(*) 
                    FROM Segue
                    WHERE seguidor = '".$id."'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;
    }

    function all_utilizadores() {

        include "openconn.php";

        $query = "SELECT id, tipo 
                    FROM Utilizador ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;

    }

    function seguidores_user($id) {
        
        include "openconn.php";

        $query = "SELECT seguidor 
                    FROM Segue
                    WHERE seguido = '".$id."'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;

    }

    function seguindo_user($id) {
        
        include "openconn.php";

        $query = "SELECT seguido 
                    FROM Segue
                    WHERE seguidor = '".$id."'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;

    }

    function mensagens_user($id) {
        
        include "openconn.php";

        $query = "SELECT id, de, para, texto, data_msg
                    FROM Mensagem
                    WHERE de = '".$id."' 
                    OR para = '".$id."' ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;

    }

    function query_conversa($own, $other) {

        include "openconn.php";

        $query = "SELECT id, de, para, texto, data_msg
                    FROM Mensagem
                    WHERE (de = '".$own."' AND para = '".$other."') 
                    OR  (para = '".$own."' AND de = '".$other."') ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;

    }

    function insert_message($own, $other, $text) {

        $date = date('Y-m-d H:m:s');

        include "openconn.php";

        $query = "insert into Mensagem (de, para, texto, data_msg)
                    values ('".$own."' , '".$other."', '".$text."', NOW())";
        
        $result = mysqli_query($conn, $query);

        if (!($result)) {
            mysqli_close($conn);
            return "Não foi possivel registar mensagem.";
        }

        mysqli_close($conn);

        return TRUE;

    }

    

    function inserir_publicacao($dono, $imagem, $descricao){
        include "openconn.php";

        $query = "insert into Publicacao  (dono, imagem, descricao, data_pub) 
                    values ( '".$dono."' , '".$imagem."', '".$descricao."', NOW())";

        $result = mysqli_query($conn, $query);

        if (!($result)) {
            mysqli_close($conn);
            return "Não foi possivel inserir a publicacao";
        }

        mysqli_close($conn);

        return $result;
    }


    function participa_publicacao($id_publicacao, $participante){

        include "openconn.php";

        $query = "insert into Participa_em_Publicacao
                    values ('".$id_publicacao."' , '".$participante."' )";

        $result = mysqli_query($conn, $query);

        if (!($result)) {
            mysqli_close($conn);
            return "Não foi possivel identificar ninguém";
        }
        
        mysqli_close($conn);
        
        return $result;
    }

    function notificacoes_user($id) {
        
        include "openconn.php";

        $query = "SELECT utilizador, texto, vista, data_not 
                    FROM Notificacoes 
                    WHERE utilizador = '".$id."' 
                    ORDER BY data_not DESC ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;

    }

    function new_notificacao($utilizador, $texto){

        include "openconn.php";

        $query = "insert into Notificacoes
                    values ('".$utilizador."' , '".$texto."' , 'Não', NOW() )";

        $result = mysqli_query($conn, $query);

        if (!($result)) {
            mysqli_close($conn);
            return "Não foi possivel notificar ninguém";
        }
        
        mysqli_close($conn);
        
        return $result;
    }

    function notificacoes_vistas($id) {
        
        include "openconn.php";

        $query = "UPDATE Notificacoes
        SET vista = 'Sim'
        WHERE utilizador = '$id'";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return FALSE;
        }

        mysqli_close($conn);

        return TRUE;

    }

    function notificacoes_number($id) {
        
        include "openconn.php";

        $query = "SELECT count(*)
                    FROM Notificacoes 
                    WHERE utilizador = '".$id."' 
                    AND vista = 'Não' ";

        $result = $conn->query($query);

        if (!($result)) {
            mysqli_close($conn);
            return "Algo deu errado.";
        }

        mysqli_close($conn);

        return $result;

    }
?>