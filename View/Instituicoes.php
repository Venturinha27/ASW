<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->

<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>
<title>Instituições</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/InstituicoesC.css">
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
                echo "<a href='Perfil.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'><i class='fa fa-user-circle'></i></a>";
            } else {
                $foto = "../" . loggedHeader();

                echo "<div class='w3-dropdown-hover w3-right w3-mobile'>
                    <button class='w3-button w3-hover-blue'>
                        <img alt='Avatar' class='w3-circle' id='foto' src='$foto' style='width:26px; height: 26px;'/>
                    </button>
                    <div class='w3-dropdown-content w3-bar-block w3-card-4 w3-left w3-small' style='right:0%; z-index: 100; width:10%;'>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='selfopenP' name='selfopen' class='w3-bar-item w3-button'>Ver perfil</button>
                        </form>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='selfopenE' name='selfopen' class='w3-bar-item w3-button'>Editar perfil</button>
                        </form>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='terminarS' name='terminarS' class='w3-bar-item w3-button w3-white w3-text-red'>Terminar sessão</button>
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
        <a href="Instituicoes.php" class="w3-bar-item w3-button w3-blue w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

</header>

<body>

    <div id="topDiv">
        <h5>Procura instituições:</h5>
        <input type="text" class="w3-input" placeholder="Ex.: Portugal Voluntário, Programa Agora Nós, ...">
    </div>

    <h4 id="hp">Procura ações promovidas por instituições:</h4>

    <ul class="w3-ul">
        <li>Área de interesse</li>
            <select class="w3-select" name="area-de-interesse">
                <option value="" disabled selected>Selecione área de interesse</option>
                <option value="acao-social">Ação social</option>
                <option value="educacao">Educação</option>
                <option value="saude">Saúde</option>
            </select>
        <li>População-alvo</li>
            <select class="w3-select" name="populacao-alvo">
                <option value="" disabled selected>Selecione população-alvo</option>
                <option value="indiferente">Indiferente</option>
                <option value="criancas">Crianças</option>
                <option value="jovens">Jovens</option>
                <option value="idosos">Idosos</option>
                <option value="gravidas">Grávidas</option>
                <option value="dependencia">Pessoas em situação de dependência (ex. acamados)</option>
                <option value="sem-abrigo">Pessoas sem-abrigo</option>
                <option value="defeciencia">Pessoas com deficiência</option>
            </select>
        <li>Distrito</li>
            <select class="w3-select" name="distrito">
                <option value="" disabled selected>Selecione distrito</option>
                <option value="Aveiro">Aveiro</option>
                <option value="Beja">Beja</option>
                <option value="Braga">Braga</option>
                <option value="Bragança">Bragança</option>
                <option value="Castelo Branco">Castelo Branco</option>
                <option value="Coimbra">Coimbra</option>
                <option value="Évora">Évora</option>
                <option value="Faro">Faro</option>
                <option value="Guarda">Guarda</option>
                <option value="Leiria">Leiria</option>
                <option value="Lisboa">Lisboa</option>
                <option value="Portalegre">Portalegre</option>
                <option value="Porto">Porto</option>
                <option value="Santarém">Santarém</option>
                <option value="Setúbal">Setúbal</option>
                <option value="Viana do Castelo">Viana do Castelo</option>
                <option value="Vila Real">Vila Real</option>
                <option value="Viseu">Viseu</option>
                <option value="Região Autónoma Açores">Região Autónoma Açores</option>
                <option value="Região Autónoma Madeira">Região Autónoma Madeira</option>
            </select>
        <li>Concelho</li>
            <select class="w3-select" name="concelho">
                <option value="" disabled selected>Selecione concelho</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
            </select>
        <li>Freguesia</li>
            <select class="w3-select" name="freguesia">
                <option value="" disabled selected>Selecione freguesia</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
            </select>
    </ul>

    <div class="w3-card-4" id="card1">

        <header class="w3-container">
            <h3>Portugal Voluntário</h3>
        </header>
        
        <div class="w3-container">
            <h5>Compras para idosos</h5>
            <hr>
            <img src="../Images/slide7.jpg" alt="Avatar" class="w3-left w3-circle">
            <h6>Breve descrição da instituição</h6>
            <hr>
            <p>Distrito: Lisboa <i class="fa fa-deviantart"></i> Concelho: Benfica <i class="fa fa-deviantart"></i> Freguesia: São Domingos de Benfica</p>
            <p>Função: ------------- <i class="fa fa-deviantart"></i> Área de interesse: ---------------</p>
            <p>População-alvo: ---------- <i class="fa fa-deviantart"></i> Nº de vagas: ----------</p>
            <p>Período: 2 semanas <i class="fa fa-deviantart"></i> Nº de horas: 2 horas p/ dia</p>
        </div>
        
        <button class="w3-button w3-block w3-hover-blue">Ver Mais</button>
        
    </div>

    <div class="w3-card-4" id="card2">

        <header class="w3-container">
            <h3>Programa Agora Nós</h3>
        </header>
        
        <div class="w3-container">
            <h5>Distribuir comida</h5>
            <hr>
            <img src="../Images/slide7.jpg" alt="Avatar" class="w3-left w3-circle">
            <h6>Breve descrição da instituição</h6>
            <hr>
            <p>Distrito: Lisboa <i class="fa fa-deviantart"></i> Concelho: Benfica <i class="fa fa-deviantart"></i> Freguesia: São Domingos de Benfica</p>
            <p>Função: ------------- <i class="fa fa-deviantart"></i> Área de interesse: ---------------</p>
            <p>População-alvo: ---------- <i class="fa fa-deviantart"></i> Nº de vagas: ----------</p>
            <p>Período: 2 semanas <i class="fa fa-deviantart"></i> Nº de horas: 2 horas p/ dia</p>
        </div>
        
        <button class="w3-button w3-block w3-hover-blue">Ver Mais</button>
        
    </div>

    <div class="w3-card-4" id="card3">

        <header class="w3-container">
            <h3>Portugal Voluntário</h3>
        </header>
        
        <div class="w3-container">
            <h5>Apoiar o lar xd</h5>
            <hr>
            <img src="../Images/slide7.jpg" alt="Avatar" class="w3-left w3-circle">
            <h6>Breve descrição da instituição</h6>
            <hr>
            <p>Distrito: Lisboa <i class="fa fa-deviantart"></i> Concelho: Benfica <i class="fa fa-deviantart"></i> Freguesia: São Domingos de Benfica</p>
            <p>Função: ------------- <i class="fa fa-deviantart"></i> Área de interesse: ---------------</p>
            <p>População-alvo: ---------- <i class="fa fa-deviantart"></i> Nº de vagas: ----------</p>
            <p>Período: 2 semanas <i class="fa fa-deviantart"></i> Nº de horas: 2 horas p/ dia</p>
        </div>
        
        <button class="w3-button w3-block w3-hover-blue">Ver Mais</button>
        
    </div>

</body>

<footer>
    <div id="EndDiv">
    
        <ul id="endContactosL">
            <li>Tel.: 214938000</li>
            <li>Mail: VoluntárioCOVID19@gmail.com</li>
            <li>Morada: Rua D. Francisco, nº 92, Amadora</li>
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