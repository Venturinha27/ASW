
<?php
    ob_start();
    session_start();
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

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
<link rel="stylesheet" href="../CSS/AdminA.css">
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
            <div id="acaoDiv" class='w3-white w3-circle'>
                <a href="Admin.php"><i class="fa fa-hands-helping" id="acaoIcon"></i></a>
                <h5 id="acaoP">Ações</p>
            </div>
        </div>
    </div>

    <div class="w3-container w3-small">
        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method="post" id="filtrar">
                <div id="esq">
                    <label><b>Instituição</b></label>
                    <input type="text" class="w3-input" name="instituicao" placeholder="Instituição"/>
                    <br>
                    <label><b>Titulo</b></label>
                    <input type="text" class="w3-input" name="titulo" placeholder="Titulo" name="titulo"/>
                    <br>
                    <label><b>Distrito:</b></label>
                    <select class="w3-input" name="distrito" id="distrito" size="1">
                        <option value="" disabled selected>Selecione o seu Distrito:</option>
                    </select> 
                    <br>
                    <label><b>Concelho:</b></label>
                    <select class="w3-input" name="concelho" id="concelho" size="1">
                        <option value="" disabled selected>Selecione o seu Concelho:</option>
                    </select> 
                    <br>
                    <label><b>Freguesia:</b></label>
                    <select class="w3-input" name="freguesia" id="freguesia" size="1">
                        <option value="" disabled selected>Selecione a sua Freguesia:</option>
                    </select>  
                    <br>
                    <label><b>Áreas de interesse:</b></label>
                    <select class="w3-input" name="area-interesse">
                        <option value="" disabled selected>Selecione as suas áreas de interesse</option>
                        <option value="Ação social">Ação social</option>
                        <option value="Educação">Educação</option>
                        <option value="Saúde">Saúde</option>
                    </select>
                </div>
                <div id="dir">
                    <label><b>População-alvo:</b></label>
                    <select class="w3-input" name="populacao-alvo">
                        <option value="" disabled selected>Selecione a sua população-alvo</option>
                        <option value="Indiferente">Indiferente</option>
                        <option value="Crianças">Crianças</option>
                        <option value="Jovens">Jovens</option>
                        <option value="Idosos">Idosos</option>
                        <option value="Grávidas">Grávidas</option>
                        <option value="Pessoas em situação de dependência (ex. acamados)">Pessoas em situação de dependência (ex. acamados)</option>
                        <option value="Pessoas sem-abrigo">Pessoas sem-abrigo</option>
                        <option value="Pessoas com deficiência">Pessoas com deficiência</option>
                    </select>
                    <br>
                    <label><b>Função:</b></label>
                    <select class="w3-input" name="funcao">
                        <option value="" disabled selected>Selecione a função</option>
                        <option value="Entrega ao Domicilio de bens não alimentares">Entrega ao Domicilio</option>
                        <option value="Entrega de Bens Alimentares">Entrega de Bens Alimentares</option>
                        <option value="Prestação de Cuidados Básicos">Prestação de Cuidados Básicos</option>
                        <option value="Apoio a Lares">Apoio a Lares</option>
                        <option value="Cozinhar">Cozinhar</option>
                        <option value="Limpar">Limpar</option>
                        <option value="Apoio à infância e à Juventude">Apoio à infância e à Juventude</option>
                        <option value="Apoio Social a familias Carenciadas">Apoio Social a familias Carenciadas</option>
                        <option value="Apoios à angariação de bens para Animais de Companhia">Apoios à angariação de bens para Animais de Companhia</option>
                    </select>
                    <br>
                    <label><b>Num. vagas</b></label>
                    <select class="w3-input" name="numvagas">
                        <option value="" disabled selected>Num. vagas</option>
                        <option value="0 a 10">0 a 10</option>
                        <option value="11 a 20">11 a 20</option>
                        <option value="21 a 30">21 a 30</option>
                        <option value="31 a 40">31 a 40</option>
                        <option value="41 a 50">41 a 50</option>
                        <option value="51 a 60">51 a 60</option>
                        <option value="61 a 70">61 a 70</option>
                        <option value="71 a 80">71 a 80</option>
                        <option value="81+">81+</option>
                    </select>
                    <br>
                    <label><b>Data:</b></label>
                        <input type="date" class="w3-input" name="disponibilidade-dia" placeholder="Data (AAAA-MM-DD)"/>
                    <br>
                    <label><b>Ativa/Inativa:</b></label>
                        <select class="w3-input" name="ativa">
                            <option value="" disabled selected>Ativa/Inativa</option>
                            <option value="Ativa">Ativa</option>
                            <option value="Inativa">Inativa</option>
                        </select>
                </div>
                <input class="w3-button" id="procura" type="submit" value="Procura"/>
            </form>
</div>

<?php

    if (!empty($_POST)){


        $instituicao = $_POST['instituicao'];
        $titulo = $_POST['titulo'];
        $distrito = $_POST['distrito'];
        $concelho = $_POST['concelho'];
        $freguesia = $_POST['freguesia'];
        $area_interesse = $_POST['area-interesse'];
        $populacao_alvo = $_POST['populacao-alvo'];
        $funcao = $_POST['funcao'];
        $numvagas = $_POST['numvagas'];
        $disponibilidade_dia = $_POST['disponibilidade-dia'];
        $ativa = $_POST['ativa'];

        include "../Controller/AdminAController.php";

        $resultAcao = adminA($instituicao, $titulo, $distrito, $concelho, $freguesia, $area_interesse, $populacao_alvo, $funcao, $numvagas, $disponibilidade_dia, $ativa);

        
    } else {
        include "../Controller/AdminAController.php";
        
        $resultAcao = adminAF();
        
    }

    

    
    
    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-green w3-pale-green w3-small resultado'>";
    echo "<p>Encontrou ".count($resultAcao)." resultado(s) para a pesquisa.</p>";
    echo "</div>";

    
    if (count($resultAcao) > 0) {

        echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='todosVol'>
            <tr class='w3-green'>
                <th>Instituição</th>
                <th>Titulo Ação</th>
                <th>Distrito</th>
                <th>Concelho</th>
                <th>Freguesia</th>
                <th>Função</th>
                <th>Área interesse</th>
                <th>População alvo</th>
                <th>Num. vagas</th>
                <th>Dia</th>
                <th>Hora</th>
                <th>Duração</th>
                <th>Ativa/Inativa</th>
            </tr>";
        
        foreach ($resultAcao as $row){
            echo "
            <tr>
                <td>".$row['nome_instituicao']."</td>
                <td>".$row['titulo']."</td>
                <td>".$row['distrito']."</td>
                <td>".$row['concelho']."</td>
                <td>".$row['freguesia']."</td>
                <td>".$row['funcao']."</td>
                <td>".$row['area_interesse']."</td>
                <td>".$row['populacao_alvo']."</td>
                <td>".$row['num_vagas']."</td>
                <td>".$row['dia']."</td>
                <td>".$row['hora']."</td>
                <td>".$row['duracao']."</td>
                <td>".$row['ativa']."</td>
            </tr>
            ";
        }
        echo "</table><br><br><br>";
    }
    
?>

</body>
