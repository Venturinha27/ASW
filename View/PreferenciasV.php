
<?php
    session_start();
    ob_start();

    include "../Controller/PreferenciasVController.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Preferências Voluntário</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/PreferenciasV.css" type="text/css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/PreferenciasV.js"></script>
<link rel="stylesheet" href="../CSS/ProcuraC.css">
<script src="../JavaScript/ProcuraJS.js"></script>
</head>

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
        <a href="Instituicoes.php" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>    
    </div>

    <div id="topSugestaoDiv" class="w3-block hidden">

    </div>
</header>

<body>

    <div id="BrancoDiv" class="w3-container">

        <h2>Preferências</h2>

        <br>

    <div id="registertext">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label><b>Áreas de interesse:</b></label>
                    <select class="w3-select sela" name="area-interesse" required>
                        <option value="" disabled selected>Selecione uma área de interesse</option>
                        <option value="Ação social">Ação social</option>
                        <option value="Educação">Educação</option>
                        <option value="Saúde">Saúde</option>
                    </select>

                <input class="w3-green w3-round-xxlarge" type="submit" value="+" name="submitA">
            </form>

            <?php

                $voluntario = $_SESSION['loggedid'];

                $areasV = areasV($voluntario);           

                if ($areasV->num_rows > 0) {
                    $checkArea = 1;
                    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
                    echo "<ul class='w3-ul w3-center'>";            
                    while ($row = $areasV->fetch_assoc()){
                        echo "<li> <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>" . $row['area'] . "
                            <button class='w3-right w3-red w3-round-xxlarge' type='submit' value='".$row['area']."' name='removeA'>
                                <i class='fa fa-trash-alt'></i>
                            </button>
                            </form> 
                        </li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                } else {
                    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>
                            <p class='w3-center'>Ainda não tem áreas de interesse.</p>
                        </div>";
                }
            
            ?>

            <hr>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label><b>População-alvo:</b></label>
                    <select class="w3-select selp" name="populacao-alvo">
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

                <input class="w3-green w3-round-xxlarge" type="submit" value="+" name="submitP">
            </form>

            <?php

                $voluntario = $_SESSION['loggedid'];

                $populacaoV = populacaoV($voluntario);             

                if ($populacaoV->num_rows > 0) {
                    $checkPopulacao = 1;
                    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
                    echo "<ul class='w3-ul w3-center'>";            
                    while ($row = $populacaoV->fetch_assoc()){
                        echo "<li> <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>" . $row['populacao_alvo'] . "
                            <button class='w3-right w3-red w3-round-xxlarge' type='submit' value='".$row['populacao_alvo']."' name='removeP'>
                                <i class='fa fa-trash-alt'></i>
                            </button>
                            </form> 
                        </li>";
                    }
                    echo "</ul>";
                    echo "</div>";

                } else {
                    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>
                            <p class='w3-center'>Ainda não tem nenhuma população-alvo.</p>
                        </div>";
                }
            
            ?>

            <hr>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label><b>Disponibilidade:</b></label>
                    <select class="w3-select disponibilidade" name="disponibilidade-dia">
                        <option value="" disabled selected>Dia</option>
                        <option value="Segunda-feira">Segunda-feira</option>
                        <option value="Terça-feira">Terça-feira</option>
                        <option value="Quarta-feira">Quarta-feira</option>
                        <option value="Quinta-feira">Quinta-feira</option>
                        <option value="Sexta-feira">Sexta-feira</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                    <select class="w3-select disponibilidade" name="disponibilidade-hora">
                        <option value="" disabled selected>Hora</option>
                        <option value="00:00">00:00</option>
                        <option value="01:00">01:00</option>
                        <option value="02:00">02:00</option>
                        <option value="03:00">03:00</option>
                        <option value="04:00">04:00</option>
                        <option value="05:00">05:00</option>
                        <option value="06:00">06:00</option>
                        <option value="07:00">07:00</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                        <option value="23:00">23:00</option>
                    </select>
                    <select class="w3-select disponibilidade" name="disponibilidade-duracao">
                        <option value="" disabled selected>Duração</option>
                        <option value="1">01:00</option>
                        <option value="2">02:00</option>
                        <option value="3">03:00</option>
                        <option value="4">04:00</option>
                        <option value="5">05:00</option>
                        <option value="6">06:00</option>
                        <option value="7">07:00</option>
                        <option value="8">08:00</option>
                    </select>
                
                <input class="w3-green w3-round-xxlarge" type="submit" value="+" name="submitD">
            </form>

            <?php

                $voluntario = $_SESSION['loggedid'];

                $disponibilidadeV = disponibilidadeV($voluntario);             

                if ($disponibilidadeV->num_rows > 0) {
                    $checkDisponibilidade = 1;
                    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
                    echo "<ul class='w3-ul w3-center'>";            
                    while ($row = $disponibilidadeV->fetch_assoc()){
                        echo "<li> <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            Dia: " . $row['dia'] . ", hora: ". $row['hora'] .":00, duração: ".$row['duracao']." horas.
                            <button class='w3-right w3-red w3-round-xxlarge' type='submit'
                                 value='".$row['dia']."/".$row['hora']."/".$row['duracao']."' 
                                 name='removeD'>
                                <i class='fa fa-trash-alt'></i>
                            </button>
                            </form> 
                        </li>";
                    }
                    echo "</ul>";
                    echo "</div>";

                } else {
                    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>
                            <p class='w3-center'>Ainda não tem disponibilidade.</p>
                        </div>";
                }
            
            ?>

            <hr>

            <?php
                include "TestInput.php";

                $voluntario = $_SESSION['loggedid'];

                if ($_POST['submitA']) {
                    $area_interesse = test_input($_POST['area-interesse']);

                    $insertA = insertA($voluntario, $area_interesse);

                    if ($insertA == TRUE){
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                    
                }

                if ($_POST['submitP']) {
                    $populacao_alvo = test_input($_POST['populacao-alvo']);

                    $insertP = insertP($voluntario, $populacao_alvo);
                    
                    if ($insertP) {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }

                if ($_POST['submitD']) {
                    $dia = test_input($_POST['disponibilidade-dia']);
                    $hora = test_input($_POST['disponibilidade-hora']);
                    $duracao = test_input($_POST['disponibilidade-duracao']);

                    $insertD = insertD($voluntario, $dia, $hora, $duracao);
                    
                    if ($insertD) {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }

                if (!empty($_POST['removeA'])){
                    $rArea = test_input($_POST['removeA']);

                    $removeArea = removeArea($voluntario, $rArea);
                    
                    if ($removeArea) {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }

                if (!empty($_POST['removeP'])){
                    $rPopulacao = test_input($_POST['removeP']);

                    $removePopulacao = removePopulacao($voluntario, $rPopulacao);
                    
                    if ($removePopulacao) {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }

                if (!empty($_POST['removeD'])){
                    $rDispo = test_input($_POST['removeD']);

                    $removeDisponibilidade = removeDisponibilidade($voluntario, $rDispo);
                    
                    if ($removeDisponibilidade) {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }

            ?>

            <?php
                if ($checkArea == 1 and $checkPopulacao == 1 and $checkDisponibilidade == 1){
                    echo "<a href='Perfil.php'><button class='w3-button w3-border w3-center' id='avancar'>Avançar</button></a>";
                } else {
                    echo "<p>Escolha, pelo menos, uma área de interesse, uma população-alvo e uma disponibilidade.</p>";
                }
            ?>
    </div>


    </div>

    <div id="VolDiv" class="w3-container">

        <h3>Como posso contribuir?</h3>

        <hr>

        <h5>O que são instituições de voluntariado?</h5>

        <p>As instituições de Voluntariado são um espaço de encontro entre as pessoas que expressam a sua disponibilidade e vontade para serem voluntárias e as organizações promotoras, interessadas em integrar voluntários/as nos seus projetos e coordenar o exercício da sua atividade.</p>

        <hr>

        <h5>Objetivos das instituições:</h5>

        <p>- Acolher candidaturas de pessoas interessadas em fazer Voluntariado, bem como receber solicitações de voluntários/as;</p>
        <p>- Proceder ao encaminhamento de voluntários/as para ações de Voluntariado;</p>
        <p>- Disponibilizar ao público informações sobre o Voluntariado;</p>
        <p>- Organizar ações de formação inicial para os/as voluntários/as.</p>

        <hr>

        <h4>Vem ajudar!</h4>

    </div>
    
<footer>
    <div id="EndDiv">
    
        <ul id="endContactosL">
            <li>Tel.: 93-77-tira-tira-mete-mete</li>
            <li>Mail: VoluntárioCOVID19@mail.com</li>
            <li>Morada: Rua D. Francisco, nº 92, Amadora city</li>
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

</body>
</html>