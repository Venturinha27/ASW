<?php

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
        } else {
            while ($notificacao = $notificacoes->fetch_assoc()) {
                echo "<div class='notificacaod'><p> ".$notificacao['texto']." </p></div>";
            }
        }
        
        echo "</div>";

        

    }
    
    if ($_REQUEST['notificacoes_vistas']) {

        $loggedid = $_SESSION['loggedid'];

        include_once "../Model/Model.php";

        $notificacoes = notificacoes_vistas($loggedid);

        echo $notificacoes;
    }

    if ($_REQUEST['notificacoes_number']) {

        $loggedid = $_SESSION['loggedid'];

        include_once "../Model/Model.php";

        $notificacoes = notificacoes_number($loggedid);

        if ($notificacoes->num_rows == 0) {
            echo "<i class='fas fa-bell'></i> Notificações";
        } else {
            if ($num = $notificacoes->fetch_array()) {
                echo "<i class='fas fa-bell'></i> Notificações <span class='w3-light-blue w3-text-black w3-padding-small w3-circle'>".$num[0]."</span>";
            }
        }
        
        
    }


?>