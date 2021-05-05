<?php

    session_start();
    ob_start();

    include_once "../Model/Model.php";

    function AcoesPreferenciasI($instituicao){
        return acoes_instituicao($instituicao);

    }

    function inserirAcao($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao){
        return inserir_acao($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao);
    }

    function removeAcao($id){
        return remove_acao($id);
    }

    function PreferenciasINomeIns($id) {
        if ($row = nome_instituicao($id)->fetch_assoc()){
            return $row['nome_instituicao'];
        }
    }

    $show_acoes = $_REQUEST['show_acoes'];

    if ($show_acoes) {

        $instituicao = $_SESSION['loggedid'];

        $a = AcoesPreferenciasI($instituicao);

        $nomeInstituicao = PreferenciasINomeIns($instituicao);         

        if ($a->num_rows > 0) {

            while ($row = $a->fetch_assoc()){

                echo "<div class='w3-card-4'>
                            <header class='w3-container'>
                                <h3>".$nomeInstituicao."</h3>
                            </header>

                            <div class='w3-container'>
                                <h5>".$row['titulo']."</h5>
                                <hr>
                                <p><b>Distrito:</b> ".$row['distrito']." | <b>Concelho:</b> ".$row['concelho']." | <b>Freguesia:</b> ".$row['freguesia']."</p>
                                <p><b>Função:</b> ".$row['funcao']." | <b>Área de interesse:</b> ".$row['area_interesse']."</p>
                                <p><b>População-alvo:</b> ".$row['populacao_alvo']." | <b>Nº de vagas:</b> ".$row['num_vagas']."</p>
                                <p><b>Data:</b> ".$row['dia'].", ás ".$row['hora'].":00, durante ".$row['duracao']." horas</p>
                            </div>

                            <div>
                                <button class='w3-button w3-block w3-hover-red' onclick='removeAcao(".json_encode($row['id_acao']).")' type='submit' value='".$row['id_acao']."' name='removeAcao'>
                                    Eliminar ação
                                </button>
                            </div>
                    </div>";
            }
        } else {
            echo "<p class='w3-display-middle'>Ainda não tem ações :(</p>";
        }
    }

    if (isset($_POST['titulo'])) {

        include_once "../View/TestInput.php";

        $id_acao = uniqid();
        $titulo = test_input($_POST['titulo']); 
        $area_interesse = test_input($_POST['area-interesse']);
        $populacao_alvo = test_input($_POST['populacao-alvo']);
        $funcao = test_input($_POST['funcao']); 
        $distrito = test_input($_POST['distrito']);
        $concelho = test_input($_POST['concelho']);
        $freguesia = test_input($_POST['freguesia']);
        $vagas = test_input($_POST['vagas']); 
        $dia = test_input($_POST['disponibilidade-dia']);
        $hora = test_input($_POST['disponibilidade-hora']);
        $duracao = test_input($_POST['disponibilidade-duracao']);
        
        $instituicao = $_SESSION['logged'];
        $id_instituicao = $_SESSION['loggedid'];

        $res = inserirAcao($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao);
        if ($res) {
            echo "Inseriu.";
        }
    } 

    if (isset($_REQUEST['remove_acao'])) {
        include_once "../View/TestInput.php";

        $rAcao = test_input($_REQUEST['remove_acao']);

        $resrAcao = removeAcao($rAcao);
        if ($resrAcao) {
            echo "Removido.";
        }
    }
?>