
<?php
    session_start();
    ob_start();

    include_once "../Controller/EditarPerfilController.php";
    
?>
<!DOCTYPE html>
<html>
<title>Editar Perfil</title>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
<link rel='stylesheet' href='../CSS/EditarPerfilC.css'>
<script src='https://kit.fontawesome.com/91ccf300f9.js' crossorigin='anonymous'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JavaScript/EditarPerfilJS.js"></script>
<script src="../JavaScript/DCF.js"></script>
<script src="../JavaScript/DCF2.js"></script>  
<link rel="stylesheet" href="../CSS/ProcuraC.css">
<script src="../JavaScript/ProcuraJS.js"></script>
<link rel="stylesheet" href="../CSS/NotificacoesC.css">
<script src="../JavaScript/NotificacoesJS.js"></script>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.php" class="w3-bar-item w3-button w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" onkeyup="showHint(this.value)" placeholder="Procura...">
        
        <?php

            include "../Controller/HeaderController.php";
            include "../Controller/SessionController.php";
            
            if (!isset($_SESSION['logged'])) {
                echo "<a href='Login.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'><i class='fa fa-user-circle'></i></a>";
            } else {
                $foto = "../" . loggedHeader();

                echo "<div class='w3-dropdown-hover w3-right w3-mobile'>
                    <button class='w3-button w3-hover-blue'>
                        <img alt='Avatar' class='w3-circle' id='foto' src='$foto' style='width:26px; height: 26px;'/>
                    </button>
                    <div id='toprightdiv' class='w3-dropdown-content w3-bar-block w3-card-4 w3-left w3-small' style='right:0%; z-index: 100; width:10%;'>
                        
                        <div id='notificacoesdiv' class='hidden'></div>

                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='selfopenP' name='selfopen' class='w3-bar-item w3-button'><i class='fas fa-user-circle'></i> Ver perfil</button>
                        </form>

                        <button onclick='showNotificacoes()' class='w3-bar-item w3-button'><i class='fas fa-bell'></i> Notificações</button>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='selfopenE' name='selfopen' class='w3-bar-item w3-button'><i class='fas fa-user-edit'></i> Editar perfil</button>
                        </form>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='terminarS' name='terminarS' class='w3-bar-item w3-button w3-white w3-text-red'><i class='fas fa-sign-out-alt'></i> Terminar sessão</button>
                        </form>

                    </div>
                </div>";
            }

            if ($_POST['terminarS']){
                TerminarSessao();
                if ($_SESSION['loggedid'] == $_SESSION['openid']) {
                    header("Location: HomePage.php");
                } else {
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                
            }

            if ($_POST['selfopen']){
                SelfOpen();
                if ($_POST['selfopen'] == "selfopenP"){
                    header("Location: Perfil.php");
                } else {
                    header("Location: EditarPerfil.php");
                }
            }
        ?>
        <a href="Voluntarios.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.php" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

    <div id="topSugestaoDiv" class="w3-block hidden">

    </div>

</header>

<body>

<div id='BrancoDiv' class='w3-container'>

    <h2><b>Editar Perfil</b></h2>

    <br>

    <?php

        $loggedtype = $_SESSION['loggedtype'];
        $logged = $_SESSION['logged'];
        $loggedid = $_SESSION['loggedid'];
        $opentype = $_SESSION['opentype'];
        $open = $_SESSION['open'];
        $openid = $_SESSION['openid'];

        if ($loggedtype == 'voluntario'){
            echo "<div id='editarPerfilVoluntario'></div>";
            echo "<div id='erroEditarPerfilVol'></div>";
        } else {
            echo "<div id='editarPerfilInstituicao'></div>";
            echo "<div id='erroEditarPerfilIns'></div>";
        }

    ?>

</div>

<?php

        $loggedtype = $_SESSION['loggedtype'];
        $logged = $_SESSION['logged'];
        $loggedid = $_SESSION['loggedid'];
        $opentype = $_SESSION['opentype'];
        $open = $_SESSION['open'];
        $openid = $_SESSION['openid'];

        if ($loggedtype == 'voluntario'){
            echo "<div id='editarPreferenciasVoluntario'></div>";
        } else {
            echo "<div id='editarPreferenciasInstituicao'></div>";
        }

    ?>


<?php


        if (isset($_POST['CriarAcao'])) {
            include_once "TestInput.php";

            $id_instituicao = $_SESSION['loggedid'];
            $id_acao = uniqid();;
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

            inserirAcaoE($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao);
        }
    

?>


</body>

<footer>
    <div id='EndDiv'>
    
        <ul id='endContactosL'>
            <li>Tel.: 93-77-tira-tira-mete-mete</li>
            <li>Mail: VoluntárioCOVID19@mail.com</li>
            <li>Morada: Rua D. Francisco, nº 92, Amadora city</li>
        </ul>
    

        <div class='vl'></div>

        <ul id='endPaginas1'>
            <a href='Sobre.php'><li>Sobre</li></a>
            <br>
            <a href='Publicacoes.php'><li>Publicações</li></a>
            <br>
            <a href='Covid19.php'><li>COVID-19</li></a>
        </ul>
        <ul id='endPaginas2'>
            <a href='Instituicoes.php'><li>Instituições</li></a>
            <br>
            <a href='Voluntarios.php'><li>Voluntários</li></a>
        </ul>

        <p id='endD'>Todos os direitos reservados a Gonçalo Ventura, Margarida Rodrigues, Renato Ramires e Tiago Teodoro</p>
    </div>
</footer>