<?php
require_once "lib/nusoap.php";

$idvol = $_REQUEST['idvol'];
$utilizador = $_REQUEST['utilizador'];
$password = $_REQUEST['password'];
$idacao = $_REQUEST['idacao'];

if ($idvol and $utilizador and $password and $idacao) {

    $client = new nusoap_client(
        'http://appserver-01.alunos.di.fc.ul.pt/~asw013/ASW/NuSOAP/ws_volCandAcao.php'
    );
    $error = $client->getError();
    $result = $client->call('vol_cand_acao', array('idVol' => $idvol,
                                                    'utilizador' => $utilizador,
                                                    'password' => $password,
                                                    'idAcao' => $idacao));	
    
    //handle errors
    if ($client->fault)
    {
        echo $result;
    }
    else {    $error = $client->getError();		 //handle errors

        echo $result; 

    }

} else {
    echo "Não aceite";
}

?>