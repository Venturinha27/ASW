<?php

require_once "lib/nusoap.php";
include "../Model/Model.php";

function info_acao_vol($id)
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

    
    $result = array();

    while ($a = $resultA->fetch_assoc()) {
        $acaof = array();
        $acaof['distrito'] = $a['distrito'];
        $acaof['concelho'] = $a['concelho'];
        $acaof['freguesia'] = $a['freguesia'];
        $acaof['funcao'] = $a['funcao'];
        $acaof['area_interesse'] = $a['area_interesse'];
        $acaof['populacao_alvo'] = $a['populacao_alvo'];
        $acaof['dia'] = $a['dia'];
        $acaof['hora'] = $a['hora'];
        $acaof['duracao'] = $a['duracao'];
        array_push($result, $acaof);
    }

	return $result;

}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');


$server->wsdl->addComplexType('notaryConnectionData','complexType','struct','all','',
        array(
            'distrito' => array('name' => 'distrito', 'type' =>'xsd:string'),
            'concelho' => array('name' => 'concelho', 'type' =>'xsd:string'),
            'freguesia' => array('name' => 'freguesia', 'type' =>'xsd:string'),
            'funcao' => array('name' => 'funcao', 'type' =>'xsd:string'),
            'area_interesse' => array('name' => 'area_interesse', 'type' =>'xsd:string'),
            'populacao_alvo' => array('name' => 'populacao_alvo', 'type' =>'xsd:string'),
            'dia' => array('name' => 'dia', 'type' =>'xsd:string'),
            'hora' => array('name' => 'hora', 'type' =>'xsd:string'),
            'duracao' => array('name' => 'duracao', 'type' =>'xsd:string')
        )
);


$server->wsdl->addComplexType('notaryConnectionArray','complexType','array','','SOAP-ENC:Array',
        array(),
        array(
            array(
                'ref' => 'SOAP-ENC:arrayType',
                'wsdl:arrayType' => 'tns:notaryConnectionData[]'
            )
        )
);

$server->register("info_acao_vol", // nome metodo
array('id' => 'xsd:string'), // input
array('return' => 'tns:notaryConnectionArray'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#info_acao_vol', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>