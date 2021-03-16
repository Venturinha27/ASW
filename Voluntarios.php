<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>
<title>Voluntários</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="CSS/VoluntariosC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src=></script>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.php" class="w3-bar-item w3-button w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" placeholder="Procura...">
        
        <?php
            include 'openconn.php';

            if (!isset($_SESSION['logged'])) {
                echo "<a href='Perfil.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'><i class='fa fa-user-circle'></i></a>";
            } else {
                $queryUtilizador = "SELECT id, tipo 
                            FROM Utilizador 
                            WHERE id = '".$_SESSION['loggedid']."';";

                $resultUtilizador = $conn->query($queryUtilizador);

                if ($row = $resultUtilizador->fetch_assoc()){
                    
                    if ($row['tipo'] == "voluntario"){
                        $queryVoluntario = "SELECT id, foto
                            FROM Voluntario
                            WHERE id = '".$_SESSION['loggedid']."';";

                        $resultVoluntario = $conn->query($queryVoluntario);

                        if ($rowV = $resultVoluntario->fetch_assoc()){
                            $foto = $rowV['foto'];
                        }
                    } else {
                        $queryInstituicao = "SELECT id, foto
                            FROM Instituicao
                            WHERE id = '".$_SESSION['loggedid']."';";

                        $resultInstituicao = $conn->query($queryInstituicao);

                        if ($rowI = $resultInstituicao->fetch_assoc()){
                            $foto = $rowI['foto'];
                        }
                    }
                }

                echo "<div class='w3-dropdown-hover w3-right w3-mobile'>
                        <button class='w3-button w3-hover-blue'>
                            <img alt='Avatar' class='w3-circle' id='foto' src='$foto' style='width:26px; height: 26px;'/>
                        </button>
                        <div class='w3-dropdown-content w3-bar-block w3-card-4 w3-left w3-small' style='right:0%; z-index: 100; width:10%;'>
                            <a href='Perfil.php' class='w3-bar-item w3-button'>Ver perfil</a>
                            <a href='EditarPerfil.php' class='w3-bar-item w3-button'>Editar perfil</a>
                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                <button type='submit' value='terminarS' name='terminarS' class='w3-bar-item w3-button w3-white w3-text-red'>Terminar sessão</button>
                            </form>
                        </div>
                    </div>";
            }

            if ($_POST['terminarS']){
                unset ($_SESSION['loggedtype']);
                unset ($_SESSION['logged']);
                unset ($_SESSION['loggedid']);
                unset ($_SESSION['opentype']);
                unset ($_SESSION['open']);
                unset ($_SESSION['openid']);
                echo "<meta http-equiv='refresh' content='0'>";
            }
        ?>
        <a href="Voluntarios.php" class="w3-bar-item w3-button w3-blue w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

</header>

<body>

    <div id="topDiv">
        <h5>Procura voluntários:</h5>
        <input type="text" class="w3-input" placeholder="Ex.: João Miguel, Amanda Silva, ...">
    </div>

    <h4 id="hp">Procura voluntários:</h4>

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
        <li>Disponibilidade dia</li>
            <select class="w3-select" name="disponibilidade-dia">
                <option value="" disabled selected>Selecione dia de disponibilidade</option>
                <option value="segunda">Segunda-feira</option>
                <option value="terca">Terça-feira</option>
                <option value="quarta">Quarta-feira</option>
                <option value="quinta">Quinta-feira</option>
                <option value="sexta">Sexta-feira</option>
                <option value="sabado">Sábado</option>
                <option value="domingo">Domingo</option>
            </select>
        <li>Disponibilidade a partir de hora</li>
            <select class="w3-select" name="disponibilidade-p-hora">
                <option value="" disabled selected>Selecione hora de disponibilidade</option>
                <option value="0">00:00</option>
                <option value="1">01:00</option>
                <option value="2">02:00</option>
                <option value="3">03:00</option>
                <option value="4">04:00</option>
                <option value="5">05:00</option>
                <option value="6">06:00</option>
                <option value="7">07:00</option>
                <option value="8">08:00</option>
                <option value="9">09:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>
                <option value="13">13:00</option>
                <option value="14">14:00</option>
                <option value="15">15:00</option>
                <option value="16">16:00</option>
                <option value="17">17:00</option>
                <option value="18">18:00</option>
                <option value="19">19:00</option>
                <option value="20">20:00</option>
                <option value="21">21:00</option>
                <option value="22">22:00</option>
                <option value="23">23:00</option>
            </select>
        <li>Disponibilidade por quantas horas</li>
            <select class="w3-select" name="disponibilidade-p-dia">
                <option value="" disabled selected>Selecione o nº de horas p/ dia</option>
                <option value="1">01:00</option>
                <option value="2">02:00</option>
                <option value="3">03:00</option>
                <option value="4">04:00</option>
                <option value="5">05:00</option>
                <option value="6">06:00</option>
                <option value="7">07:00</option>
                <option value="8">08:00</option>
            </select>
    </ul>

    <div class="w3-card-4" id="card1">

        <header class="w3-container">
            <h3>Voluntário</h3>
        </header>
        
        <div class="w3-container">
            <h5>Manel João</h5>
            <hr>
            <img src="Images/voluntario.jpg" alt="Avatar" class="w3-left w3-circle">
            <h6>Breve descrição do voluntário</h6>
            <hr>
            <p>Área de interesse: Educação | Saúde <i class="fa fa-deviantart"></i> População-alvo: Idosos</p>
            <p>Disponibilidade: Terça, ás 18:00, durante 2 horas</p>
            <p>Disponibilidade: Sábado, ás 8:00, durante 8 horas</p>
        </div>
        
        <button class="w3-button w3-block w3-hover-blue">Ver Mais</button>
        
    </div>

    <div class="w3-card-4" id="card2">

        <header class="w3-container">
            <h3>Voluntário</h3>
        </header>
        
        <div class="w3-container">
            <h5>Cláudio Joaquim</h5>
            <hr>
            <img src="Images/voluntario.jpg" alt="Avatar" class="w3-left w3-circle">
            <h6>Breve descrição do voluntário</h6>
            <hr>
            <p>Área de interesse: Educação | Saúde <i class="fa fa-deviantart"></i> População-alvo: Idosos</p>
            <p>Disponibilidade: Terça, ás 18:00, durante 2 horas</p>
            <p>Disponibilidade: Sábado, ás 8:00, durante 8 horas</p>
        </div>
        
        <button class="w3-button w3-block w3-hover-blue">Ver Mais</button>
        
    </div>

    <div class="w3-card-4" id="card3">

        <header class="w3-container">
            <h3>Voluntário</h3>
        </header>
        
        <div class="w3-container">
            <h5>Maria Albuquerque</h5>
            <hr>
            <img src="Images/voluntario.jpg" alt="Avatar" class="w3-left w3-circle">
            <h6>Breve descrição do voluntário</h6>
            <hr>
            <p>Área de interesse: Educação | Saúde <i class="fa fa-deviantart"></i> População-alvo: Idosos</p>
            <p>Disponibilidade: Terça, ás 18:00, durante 2 horas</p>
            <p>Disponibilidade: Sábado, ás 8:00, durante 8 horas</p>
        </div>
        
        <button class="w3-button w3-block w3-hover-blue">Ver Mais</button>
        
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