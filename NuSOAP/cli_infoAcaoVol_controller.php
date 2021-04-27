<?php
require_once "lib/nusoap.php";

$idins = $_REQUEST['idins'];

if ($idins) {

    $client = new nusoap_client(
        'http://appserver-01.alunos.di.fc.ul.pt/~asw013/ASW/NuSOAP/ws_infoAcaoVol.php'
    );
    $error = $client->getError();
    $result = $client->call('info_acao_vol', array('id' => $idins));	//handle errors
    
    if ($client->fault)
    {
        echo "<h2> Info Ações da Instituição </h2>";
    
        echo "<table class='w3-table w3-striped w3-tiny w3-hoverable w3-middle'>
                <tr class='w3-red'>
                    <th>Distrito</th>
                    <th>Concelho</th>
                    <th>Freguesia</th>
                    <th>Função</th>
                    <th>Área de Interesse</th>
                    <th>População Alvo</th>
                    <th>Dia</th>
                    <th>Hora</th>
                    <th>Duração</th>
                </tr>
            </table>";
    }
    else {    $error = $client->getError();		 //handle errors
    
        echo "<h2> Info Ações da Instituição </h2>";
    
        echo "<table class='w3-table w3-striped w3-tiny w3-hoverable w3-middle'>
                <tr class='w3-red'>
                    <th>Distrito</th>
                    <th>Concelho</th>
                    <th>Freguesia</th>
                    <th>Função</th>
                    <th>Área de Interesse</th>
                    <th>População Alvo</th>
                    <th>Dia</th>
                    <th>Hora</th>
                    <th>Duração</th>
                </tr>";
            
            foreach($result as $res) {
                echo "
                <tr>
                    <td><p>".$res['distrito']."</p></td>
                    <td><p>".$res['concelho']."</p></td>
                    <td><p>".$res['freguesia']."</p></td>
                    <td><p>".$res['funcao']."</p></td>
                    <td><p>".$res['area_interesse']."</p></td>
                    <td><p>".$res['populacao_alvo']."</p></td>
                    <td><p>".$res['dia']."</p></td>
                    <td><p>".$res['hora']."</p></td>
                    <td><p>".$res['duracao']."</p></td>";
    
    
                echo "</tr>
                ";
            }
            echo "</table>";           
    }

} else {

    echo "<h2> Info Ações da Instituição </h2>";
    
    echo "<table class='w3-table w3-striped w3-tiny w3-hoverable w3-middle'>
            <tr class='w3-red'>
                <th>Distrito</th>
                <th>Concelho</th>
                <th>Freguesia</th>
                <th>Função</th>
                <th>Área de Interesse</th>
                <th>População Alvo</th>
                <th>Dia</th>
                <th>Hora</th>
                <th>Duração</th>
            </tr>
        </table>";

}

?>