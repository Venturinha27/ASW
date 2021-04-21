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

    <?php
        include "../Controller/AdminController.php";
        $todos = todosUtilizadores();

        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultado'>";
        echo "<p>Encontrou ".(count($todos))." resultado(s) para a pesquisa.</p>";
        echo "</div>";

        if (count($todos) > 0) {

            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='todosVol'>
                <tr class='w3-blue'>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Distrito</th>
                    <th>Concelho</th>
                    <th>Freguesia</th>
                    <th>Tipo</th>
                </tr>";
            
            foreach ($todos as $user) {
                echo "
                <tr>
                    <td>".$user[0]."</td>
                    <td>".$user[1]."</td>
                    <td>".$user[2]."</td>
                    <td>".$user[3]."</td>
                    <td>".$user[4]."</td>
                    <td>".$user[5]."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }

        $convites = todosConvites();

        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultadoco'>";
        echo "<p>Encontrou ".(count($convites))." resultado(s) para a pesquisa.</p>";
        echo "</div>";

        if (count($convites) > 0) {

            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='convitesT'>
                <tr class='w3-blue'>
                    <th>Voluntário</th>
                    <th>Instituição</th>
                    <th>Ação</th>
                    <th>Estado</th>
                    <th>Data</th>
                </tr>";
            
            foreach ($convites as $convite) {
                echo "
                <tr>
                    <td>".$convite[0]."</td>
                    <td>".$convite[1]."</td>
                    <td>".$convite[2]."</td>
                    <td>".$convite[3]."</td>
                    <td>".$convite[4]."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }

        $candidaturas = todasCandidaturas();

        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultadoca'>";
        echo "<p>Encontrou ".(count($candidaturas))." resultado(s) para a pesquisa.</p>";
        echo "</div>";

        if (count($candidaturas) > 0) {

            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='candidaturasT'>
                <tr class='w3-blue'>
                    <th>Voluntário</th>
                    <th>Instituição</th>
                    <th>Ação</th>
                    <th>Estado</th>
                    <th>Data</th>
                </tr>";
            
            foreach ($candidaturas as $candidatura) {
                echo "
                <tr>
                    <td>".$candidatura[0]."</td>
                    <td>".$candidatura[1]."</td>
                    <td>".$candidatura[2]."</td>
                    <td>".$candidatura[3]."</td>
                    <td>".$candidatura[4]."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }

        $participacoes = todasParticipacoes();

        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultp'>";
        echo "<p>Encontrou ".(count($participacoes))." resultado(s) para a pesquisa.</p>";
        echo "</div>";

        if (count($participacoes) > 0) {

            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='participacoesT'>
                <tr class='w3-blue'>
                    <th>Voluntário</th>
                    <th>Instituição</th>
                    <th>Ação</th>
                </tr>";
            
            foreach ($participacoes as $participacao) {
                echo "
                <tr>
                    <td>".$participacao[0]."</td>
                    <td>".$participacao[1]."</td>
                    <td>".$participacao[2]."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }

    ?>
</body>