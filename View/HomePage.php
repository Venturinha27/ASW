
<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>
<title>Home Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/HomePageC.css">
<link rel="stylesheet" href="../CSS/ProcuraC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/HomePageJS.js"></script>
<script src="../JavaScript/ProcuraJS.js"></script>
<link rel="stylesheet" href="../CSS/NotificacoesC.css">
<script src="../JavaScript/NotificacoesJS.js"></script>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.php" class="w3-bar-item w3-button w3-blue w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

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
                echo "<meta http-equiv='refresh' content='0'>";
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
        <a href="Instituicoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>  
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a> 
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

    <div id="topSugestaoDiv" class="w3-block hidden">

    </div>

</header>

<body>

    <div id="slideDiv">
        <h1 id="h1Slide">Voluntário
            COVID-19
        </h1>
        <div id="slideContainer">
            <img class="mySlides" src="../Images/slide5.jpg">
            <img class="mySlides" src="../Images/slide4.jpg">
            <img class="mySlides" src="../Images/slide6.jpg">
        </div>
    </div>

    <div id="SobreDiv">
        <br>
        <h1 class="w3-center">O que é a VoluntárioCOVID19?</h1>
        <br>
        <p class="w3-center">A VoluntárioCOVID19 é uma instituição de âmbito nacional que tem como objetivo ajudar voluntários e instituições ou iniciativas de voluntariado a fazerem 'match' e colaborarem no combate à pandemia da COVID-19.
                             A instituição promove ainda o voluntariado em Portugal permitindo a partilha de momentos de voluntariado no seu website como objectivo de poder vir a inspirar novos individuos a experimentar esta experiência tão gratificante.
        </p>
        <br>
        <h3 class="w3-center">Descubra mais sobre nós!</p>
        <hr>
        <a href="Sobre.php">
        <button class="w3-button w3-indigo w3-hover-blue w3-round-xxlarge w3-large w3-padding-large">
            Sobre a VoluntárioCOVID19
        </button>
        </a>    
    </div>

    <div id="ContribuirDiv">
        <br>
        <h1 class="w3-center">Como posso contribuir?</h1>
        <div id="contribuirOptions">
            <div id="voluntarioDiv">
                <a href="RegistoV.php"><i class="fa fa-male" id="voluntarioIcon"></i></a>
                <h5 id="voluntarioP">Voluntário</p>
            </div>
            <div id="instituicaoDiv">
                <a href="RegistoI.php"><i class="fa fa-building" id="instituicaoIcon"></i></a>
                <h5 id="instituicaoP">Instituição</p>
            </div>
        </div>
    </div>

    <div id="DestaquesDiv">
        <br>
        <h1 class="w3-center">Destaques</h1>
        <div id="news">
            <div class="newsClass" id="new1">
                <img class="newsImg" src="../Images/slide1.png">
                <p class="newsP">Nova estirpe de COVID-19 detectada no Porto</p>
            </div>
            <div class="newsClass" id="new2">
                <img class="newsImg" src="../Images/slide2.jpg">
                <p class="newsP">Associação 'Não ao covid' procura ajuda</p>
            </div>
            <div class="newsClass" id="new3">
                <img class="newsImg" src="../Images/slide3.jpg">
                <p class="newsP">Trabalho de equipa ajuda população de aljubarrota</p>
            </div>
        </div>
        <a href="Publicacoes.php">
            <button class="w3-button w3-indigo w3-hover-blue w3-round-xxlarge w3-large w3-padding-large">
                Mais publicações
            </button>
        </a>
    </div>

</body>

<footer>
    <div id="EndDiv">
    
        <ul id="endContactosL">
            <li>Tel.: 214938000</li>
            <li>Mail: VoluntárioCOVID19@gmail.com</li>
            <li>Morada: Rua D. Francisco, nº 92, Amadora </li>
        </ul>
    

        <div class="vl"></div>

        <ul id="endPaginas1">
            <a href="Sobre.php"><li>Sobre</li></a>
            <br>
            <a href="Publicacoes.php"><li>Publicações</li></a>
            <br>
            <a href="Covid19.php"><li>COVID-19</li></a>
        </ul>
        <ul id="endPaginas2">
            <a href="Instituicoes.php"><li>Instituições</li></a>
            <br>
            <a href="Voluntarios.php"><li>Voluntários</li></a>
        </ul>

        <p id="endD">Todos os direitos reservados a Gonçalo Ventura, Margarida Rodrigues, Renato Ramires e Tiago Teodoro</p>
    </div>
</footer>