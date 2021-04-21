<?php

    session_start();
    ob_start();

    include_once "../Model/Model.php";
    include_once "../View/TestInput.php";

    $voluntario = $_SESSION['loggedid'];

    $get_areas = $_REQUEST['get_areas'];

    if ($get_areas) {

        $areas = areasV($voluntario);
        if ($areas->num_rows > 0) {
            $result = "";
            while ($row = $areas->fetch_assoc()) {
                $result .= "<li class='liarea'>" . $row['area'] . "
                        <button class='w3-right w3-red w3-round-xxlarge' onclick='removeArea(".json_encode($row['area']).")' type='submit'>
                                <i class='fa fa-trash-alt'></i>
                            </button>
                        </li>";
            }
            echo $result;
        } else {
            echo "<p class='w3-center' id='parea'>Ainda não tem áreas de interesse.</p>";
        }
        
    }

    function areasV($id){
        return areas_voluntario($id);
    }

    $get_populacao = $_REQUEST['get_populacao'];

    if ($get_populacao) {

        $populacao = populacaoV($voluntario);
        if ($populacao->num_rows > 0) {
            $result = "";
            while ($row = $populacao->fetch_assoc()) {
                $result .= "<li class='lipopulacao'>" . $row['populacao_alvo'] . "
                        <button class='w3-right w3-red w3-round-xxlarge' onclick='removePopulacao(".json_encode($row['populacao_alvo']).")' type='submit'>
                                <i class='fa fa-trash-alt'></i>
                            </button>
                        </li>";
            }
            echo $result;
        } else {
            echo "<p class='w3-center' id='ppopulacao'>Ainda não tem nenhuma população alvo.</p>";
        }
        
    }

    function populacaoV($id){
        return populacao_voluntario($id);
    }

    $get_disponibilidade = $_REQUEST['get_disponibilidade'];

    if ($get_disponibilidade) {

        $disponibilidade = disponibilidadeV($voluntario);
        if ($disponibilidade->num_rows > 0) {
            $result = "";
            while ($row = $disponibilidade->fetch_assoc()) {
                $result .= "<li class='lidisponibilidade'> Dia: " . $row['dia'] . ", hora: ". $row['hora'] .":00, duração: ".$row['duracao']." horas.
                            <button class='w3-right w3-red w3-round-xxlarge' type='submit'
                                onclick='removeDisponibilidade(".json_encode($row['dia']).", ".json_encode($row['hora']).", ".json_encode($row['duracao']).")'>
                            <i class='fa fa-trash-alt'></i>
                            </button>
                            </li>";
            }
            echo $result;
        } else {
            echo "<p class='w3-center' id='pdisponibilidade'>Ainda não tem nenhuma disponibilidade.</p>";
        }
        
    }
    
    function disponibilidadeV($id){
        return disponibilidade_voluntario($id);
    }

    $add_area_interesse = $_REQUEST['add_area_interesse'];

    if ($add_area_interesse) {

        $area_interesse = test_input($add_area_interesse);

        $insertA = insertA($voluntario, $area_interesse);

        if ($insertA == TRUE){

            echo 'yes';
        }
    }

    function insertA($voluntario, $area_interesse){
        return insert_area($voluntario, $area_interesse);
    }

    $add_populacao_alvo = $_REQUEST['add_populacao_alvo'];

    if ($add_populacao_alvo) {

        $populacao_alvo = test_input($add_populacao_alvo);

        $insertP = insertP($voluntario, $populacao_alvo);

        if ($insertP == TRUE){

            echo 'yes';
        }
    }

    function insertP($voluntario, $populacao_alvo){
        return insert_populacao($voluntario, $populacao_alvo);
    }

    $add_dia = $_REQUEST['add_dia'];
    $add_hora = $_REQUEST['add_hora'];
    $add_duracao = $_REQUEST['add_duracao'];

    if ($add_dia and $add_hora and $add_duracao) {

        $dia = test_input($add_dia);
        $hora = test_input($add_hora);
        $duracao = test_input($add_duracao);

        $insertD = insertD($voluntario, $dia, $hora, $duracao);

        if ($insertD == TRUE){

            echo 'yes';
        }
    }

    function insertD($voluntario, $dia, $hora, $duracao){
        return insert_disponibilidade($voluntario, $dia, $hora, $duracao);
    }

    $remove_area_interesse = $_REQUEST['remove_area_interesse'];

    if ($remove_area_interesse) {

        $area_interesse = test_input($remove_area_interesse);

        $removeA = removeArea($voluntario, $area_interesse);

        if ($removeA == TRUE){
            echo 'yes';
        }
    }

    function removeArea($voluntario, $area){
        return remove_area($voluntario, $area);
    }

    $remove_populacao_alvo = $_REQUEST['remove_populacao_alvo'];

    if ($remove_populacao_alvo) {

        $populacao_alvo = test_input($remove_populacao_alvo);

        $removeP = removePopulacao($voluntario, $populacao_alvo);

        if ($removeP == TRUE){
            echo 'yes';
        }
    }

    function removePopulacao($voluntario, $populacao){
        return remove_populacao($voluntario, $populacao);
    }

    $remove_dia = $_REQUEST['remove_dia'];
    $remove_hora = $_REQUEST['remove_hora'];
    $remove_duracao = $_REQUEST['remove_duracao'];

    if ($remove_dia and $remove_hora and $remove_duracao) {

        $dia = test_input($remove_dia);
        $hora = test_input($remove_hora);
        $duracao = test_input($remove_duracao);

        $removeD = removeDisponibilidade($voluntario, $dia, $hora, $duracao);

        if ($removeD == TRUE){
            echo 'yes';
        }
    }

    function removeDisponibilidade($voluntario, $dia, $hora, $duracao){
        return remove_disponibilidade($voluntario, $dia, $hora, $duracao);
    }

?>