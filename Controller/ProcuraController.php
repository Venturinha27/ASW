<?php

// get the q parameter from URL
$q = $_REQUEST["q"];

include "../Model/Model.php";

if (isset($q)){

    $prods = "";

    $all_instituicoes = procura_instituicoes();
    $all_voluntarios = procura_voluntarios();
    $all_acoes = procura_acoes();

    $resultados = array();
    while ($rowi = $all_instituicoes->fetch_array()) {
        array_push($rowi, "<i class='fa fa-building'></i> Instituição");
        array_push($resultados, $rowi);
    }

    while ($rowv = $all_voluntarios->fetch_array()) {
        array_push($rowv, "<i class='fa fa-male'></i> Voluntário");
        array_push($resultados, $rowv);
    }

    while ($rowa = $all_acoes->fetch_array()) {
        array_push($rowa, "<i class='fa fa-hands-helping'></i> Ação");
        array_push($resultados, $rowa);
    }
            
    $hint = "";
    // lookup all hints from array if $q is different from "" 
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        foreach($resultados as $resultado) {
            if (stristr($q, substr($resultado[1], 0, $len))) {
                if ($resultado[3] == "<i class='fa fa-building'></i> Instituição"){
                    $hint .= "<button type='submit' value='".$resultado[0]."' name='verInstituicao' id='".$resultado[0]."' class='w3-button w3-white'> <img class='ProcuraImg w3-left w3-circle' src='../".$resultado[2]."'> <p><b>".$resultado[1]."</b> <br> <span class='w3-small'>".$resultado[3]."</span></button>";
                }
                if ($resultado[3] == "<i class='fa fa-male'></i> Voluntário"){
                    $hint .= "<button type='submit' value='".$resultado[0]."' name='verVoluntario' id='".$resultado[0]."' class='w3-button w3-white'> <img class='ProcuraImg w3-left w3-circle' src='../".$resultado[2]."'> <p><b>".$resultado[1]."</b> <br> <span class='w3-small'>".$resultado[3]."</span></button>";
                }
                if ($resultado[3] == "<i class='fa fa-hands-helping'></i> Ação"){
                    $hint .= "<button type='submit' value='".$resultado[0]."' name='verAcao' id='".$resultado[0]."' class='w3-button w3-white'> <img class='ProcuraImg w3-left w3-circle' src='../".$resultado[2]."'> <p><b>".$resultado[1]."</b> <br> <span class='w3-small'>".$resultado[3]."</span></button>";
                }
                
            }
        }
    }

    // Output "Nenhum resultado encontrado" if no hint was found or output correct values 
    echo $hint === "" ? "Nenhum resultado encontrado" : $hint;

}




function nomeVoluntarioProcura($id) {

    $nome = nome_voluntario($id);
    if ($vol = $nome->fetch_assoc()){
        return $vol['nome_voluntario'];
    }

}

function nomeInstituicaoProcura($id) {

    $nome = nome_instituicao($id);
    if ($ins = $nome->fetch_assoc()){
        return $ins['nome_instituicao'];
    }
    
}

function nomeAcaoProcura($id) {

    $nome = nome_acao($id);
    if ($acao = $nome->fetch_assoc()){
        return $acao['titulo'];
    }
    
}
?>