<?php
    ob_start();
    session_start();

    if (!empty($_POST['verVoluntario'])){

        include "../Controller/ProcuraController.php";

        $id = $_POST['verVoluntario'];

        $nomeV = nomeVoluntarioProcura($id);

        $_SESSION['opentype'] = "voluntario";
        $_SESSION['open'] = $nomeV;
        $_SESSION['openid'] = $id;
        header("Location: ../View/Perfil.php");
    }

    if (!empty($_POST['verInstituicao'])){

        include "../Controller/ProcuraController.php";

        $id = $_POST['verInstituicao'];

        $nomeI = nomeInstituicaoProcura($id);

        $_SESSION['opentype'] = "instituicao";
        $_SESSION['open'] = $nomeI;
        $_SESSION['openid'] = $id;
        header("Location: ../View/Perfil.php");
    }

    if (!empty($_POST['verAcao'])){

        include "../Controller/ProcuraController.php";

        $id = $_POST['verAcao'];

        $nomeA = nomeAcaoProcura($id);

        $_SESSION['opentype'] = "acao";
        $_SESSION['open'] = $nomeA;
        $_SESSION['openid'] = $id;
        header("Location: ../View/Perfil.php");
    }
    ?>