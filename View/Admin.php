<?php
    ob_start();
    session_start();

    if ($_SESSION['loggedtype'] != "admin") {
        header("Location: LoginA.php");
    }
?>
<!DOCTYPE html>
<html>
<title>Administradores</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/Admin.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/DCF.js"></script>
<script src="../JavaScript/Admin.js"></script>

<body>
    <div id="Div">
        <br>
        <h1 class="w3-center" id="informacoesP">Informações Sobre:</h1>
        <div id="Options">
            <div id="voluntarioDiv">
                <a href="AdminV.php"><i class="fa fa-male" id="voluntarioIcon"></i></a>
                <h5 id="voluntarioP">Voluntários</p>
            </div>
            <div id="instituicaoDiv">
                <a href="AdminI.php"><i class="fa fa-building" id="instituicaoIcon"></i></a>
                <h5 id="instituicaoP">Instituições</p>
            </div>
            <div id="acaoDiv">
                <a href="AdminA.php"><i class="fa fa-hands-helping" id="acaoIcon"></i></a>
                <h5 id="acaoP">Ações</p>
            </div>
        </div>
        
    </div>

    <h1 id='todosU' class='w3-text-black'> <b>Todos utilizadores</b> </h1>

    <h1 id='todosCo' class='w3-text-black'> <b>Convites</b> </h1>

    <h1 id='todosCa' class='w3-text-black'> <b>Candidaturas</b> </h1>

    <h1 id='todosP' class='w3-text-black'> <b>Participações</b> </h1>

    <div id='todosUtilizadoresDiv'>
    </div>

    <div id='todosConvitesDiv'>
    </div>

    <div id='todasCandidaturasDiv'>
    </div>

    <div id='todasParticipacoesDiv'>
    </div>

</body>