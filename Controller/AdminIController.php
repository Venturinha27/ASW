<?php

    include "../Model/Model.php";

    function adminInstPost($nome,$email,$distrito,$concelho,$freguesia){

        $primeiro = 0;

        $queryInstituicao = "SELECT id, nome_instituicao, telefone, morada, distrito, concelho, freguesia,
                        email, bio, nome_representante, email_representante, foto, website
                        FROM Instituicao ";

        if (!empty($nome)){
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE nome_instituicao = '".$nome."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND nome_instituicao = '".$nome."' ";
            }
        }

        if (!empty($email)) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE email = '".$email."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND email = '".$email."' ";
            }
        }

        if (!empty($distrito)) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE distrito = '".$distrito."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND distrito = '".$distrito."' ";
            }
        }

        if (!empty($concelho)) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE concelho = '".$concelho."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND concelho = '".$concelho."' ";
            }
        }

        if (!empty($freguesia)) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE freguesia = '".$freguesia."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND freguesia = '".$freguesia."' ";
            }
        }
        
        $queryInstituicao .= "ORDER BY nome_instituicao ";

        return free_query($queryInstituicao);
    }

    function adminInst(){
        $queryInstituicao = "SELECT id, nome_instituicao, telefone, morada, distrito, concelho, freguesia,
                        email, bio, nome_representante, email_representante, foto, website
                        FROM Instituicao
                        ORDER BY nome_instituicao;";
    return free_query($queryInstituicao);
    }

?>