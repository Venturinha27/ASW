<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->

<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>
<title>Sobre</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/SobreC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src=></script>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.php" class="w3-bar-item w3-button w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" placeholder="Procura...">
        
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
                    <div class='w3-dropdown-content w3-bar-block w3-card-4 w3-left w3-small' style='right:0%; z-index: 100; width:10%;'>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='selfopenP' name='selfopen' class='w3-bar-item w3-button'><i class='fas fa-user-circle'></i> Ver perfil</button>
                        </form>

                        <button class='w3-bar-item w3-button'><i class='fas fa-bell'></i> Notificações</button>
                        
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
        <a href="Sobre.php" class="w3-bar-item w3-button w3-blue w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

</header>

<body>

    <div id="topDiv">
    </div>

    <div id="SobreDiv">
        <br><br>
        <h1 class="w3-center">Sobre a VoluntárioCOVID19</h1>
        <br>
        <hr>
        <br><br>
        <p>A VoluntárioCOVID19 é uma instituição de âmbito nacional que tem como objetivo ajudar voluntários e instituições ou iniciativas de voluntariado a fazerem 'match' e colaborarem no combate à pandemia da COVID-19.
            A instituição promove ainda o voluntariado em Portugal permitindo a partilha de momentos de voluntariado no seu website como objectivo de poder vir a inspirar novos individuos a experimentar esta experiência tão gratificante.</p>
        <br><br>
        <p><i class="fa fa-bullseye"></i></p>
        <br><br>
    </div>

    <div id="DestinaDiv">
        <br><br>
        <h1 class="w3-center">A quem se destina a VoluntárioCOVID19?</h1>
        <br>
        <hr>
        <br><br>
        <p>A plataforma destina-se a todos os indivíduos interessados em realizar uma ação de voluntariado, às instituições que organizam e promovem ações de voluntariado acreditadas e necessárias na ajuda ao combate da pandemia.</p>
        <br><br>
        <p><i class="fa fa-bullseye"></i></p>
        <br><br>
    </div>

    <div id="FuncionaDiv">
        <br><br>
        <h1 class="w3-center">Como funciona a VoluntárioCOVID19?</h1>
        <br>
        <hr>
        <br><br>
        <p>Pretende-se através da inscrição de voluntários/as e ações/instituições de voluntariado encorajar o contacto e promover a participação e a visibilidade do trabalho de voluntariado no combate à pandemia da COVID-19.
            Adicionalmente, com processos mais céleres, garantir o total cumprimento dos requisitos legais previstos na Lei de Bases do Voluntariado e respetiva regulamentação, valorizando um voluntariado mais qualificado, responsável e dinâmico.
            </p>
        <br><br>
        <p><i class="fa fa-bullseye"></i></p>
        <br><br>
    </div>

    <div id="InformacoesDiv">
        <br><br>
        <h1 class="w3-center">Mais informações sobre a VoluntárioCOVID19</h1>
        <br>
        <hr>
        <br><br>
        <p>Para mais informações sobre a VoluntárioCOVID19 não hesite em ligar para 93-77-tira-tira-mete-mete ou contactar-nos por e-mail electrónico em VoluntárioCOVID19@mail.com.
            Para atendimento presencial poderá visitar-nos em Rua D. Francisco, nº 92, Amadora city.
            </p>
        <br><br>
        <p><i class="fa fa-bullseye"></i></p>
        <br><br>
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