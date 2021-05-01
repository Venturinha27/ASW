<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    ob_start();
    session_start();

    if ($_REQUEST['notificacoes']) {

        $loggedid = $_SESSION['loggedid'];

        echo "<header class='w3-container w3-indigo'>
        <h6><b>Notificações</b></h6>
        <button onclick='hideNotificacoes()' class='w3-button'>X</button>
        </header>";

        include_once "../Model/Model.php";

        $notificacoes = notificacoes_user($loggedid);

        echo "<div class='notificacoesddiv'>";
        if ($notificacoes->num_rows == 0) {
            echo "<div class='notificacaod'><p> Ainda não tem notificações. </p></div>";
        }
        while ($notificacao = $notificacoes->fetch_assoc()) {
            echo "<div class='notificacaod'><p> ".$notificacao['texto']." </p></div>";
        }
        echo "</div>";

        

    }
    


?>