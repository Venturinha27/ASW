<?php

require_once "lib/nusoap.php";
include "../Model/Model.php";

function vol_cand_acao($idVol, $utilizador, $password, $idAcao)
{
    $dbhost = "appserver-01.alunos.di.fc.ul.pt";
    $dbuser = "asw013";
    $dbpass = "ventu13";
    $dbname = "asw013";
    // Cria a ligação à BD
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
     // Verifica a ligação à BD
    if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
    }

    if (!mysqli_set_charset($conn, 'utf8')) {
    die('Error ao usar utf8: ' . mysqli_error($conn));
    }

    $queryVoluntario = "SELECT password1
                        FROM Voluntario 
                        WHERE id = '".$idVol."' 
                        AND email = '".$utilizador."' ";
    
    $resultV = $conn->query($queryVoluntario);
    
    if (!($resultV)) {
        mysqli_close($conn);
        return "Não aceite";
    }

    if ($pass = $resultV->fetch_array()) {
        if (password_verify($password, $pass[0])) {
            $queryAcao = "SELECT id_instituicao 
                        FROM Acao 
                        WHERE id_acao = '".$idAcao."' ";
    
            $resultA = $conn->query($queryAcao);
            
            if (!($resultA)) {
                mysqli_close($conn);
                return "Não aceite";
            }

            if ($instituicao = $resultA->fetch_array()) {
                $idInstituicao = $instituicao[0];

                $queryP = "INSERT INTO Participou_Acao
                        VALUES ('".$idVol."', '".$idInstituicao."', '".$idAcao."')";
        
                $resultP = $conn->query($queryP);
                
                if (!($resultP)) {
                    mysqli_close($conn);
                    return "Não aceite";
                } else {
                    mysqli_close($conn);
                    return "Aceite";
                }
            } else {
                mysqli_close($conn);
                return "Não aceite";
            }

        } else {
            mysqli_close($conn);
            return "Não aceite";
        }
    } else {
        mysqli_close($conn);
        return "Não aceite";
    }
    
}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("vol_cand_acao", // nome metodo
array('idVol' => 'xsd:string',
    'utilizador' => 'xsd:string',
    'password' => 'xsd:string',
    'idAcao' => 'xsd:string'), // input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#vol_cand_acao', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>