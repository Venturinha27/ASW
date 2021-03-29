<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
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
<script src="JavaScript/VoluntariosJS.js"></script>

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
    </div>

    <h2 id="hp" class='w3-center'><b>Procura voluntários</b></h2>

    <button id='filterb' class='w3-button w3-center w3-indigo'><i class="fas fa-filter"></i> &nbsp Filtrar &nbsp <i class="fas fa-angle-down"></i></button>

    <div class="w3-container w3-small hidden" id='divFiltrar'>
        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method="post" id="filtrar">
                <div id="esq">
                    <label><b>Nome</b></label>
                    <input type="text" class="w3-input" name="nome" placeholder="Nome" name="nome"/>
                    <br>
                    <label><b>Idade</b></label>
                    <select class="w3-input" name="idade">
                        <option value="" disabled selected>Idade</option>
                        <option value="10 aos 20">10 aos 20</option>
                        <option value="21 aos 30">21 aos 30</option>
                        <option value="31 aos 40">31 aos 40</option>
                        <option value="41 aos 50">41 aos 50</option>
                        <option value="51 aos 60">51 aos 60</option>
                        <option value="61 aos 70">61 aos 70</option>
                        <option value="71 aos 80">71 aos 80</option>
                        <option value="81+">81+</option>
                    </select>
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
                    <label><b>Género</b></label>
                    <select class="w3-input" name="genero">
                        <option value="" disabled selected>Género</option>
                        <option value="Homem">Homem</option>
                        <option value="Mulher">Mulher</option>
                        <option value="Prefiro não dizer">Prefiro não dizer</option>
                    </select>
                </div>
                <div id="dir">
                    <label><b>Email</b></label>
                    <input type="text" class="w3-input" name="email" placeholder="Email" name="email"/>
                    <br>
                    <label><b>Carta de Condução</b></label>
                    <select class="w3-input" name="carta">
                        <option value="" disabled selected>Carta de condução</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                    <br>
                    <label><b>Já esteve infetado com o Covid-19?</b></label>
                    <select class="w3-input" name="covid">
                        <option value="" disabled selected>Esteve infetado</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                    <br>
                    <label><b>Áreas de interesse:</b></label>
                    <select class="w3-input" name="area-interesse">
                        <option value="" disabled selected>Área de interesse</option>
                        <option value="Ação social">Ação social</option>
                        <option value="Educação">Educação</option>
                        <option value="Saúde">Saúde</option>
                    </select>
                    <br>
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
                    <label><b>Disponibilidade:</b></label>
                    <br>
                    <select class="w3-input dis" name="disponibilidade-dia">
                        <option value="" disabled selected>Dia</option>
                        <option value="Segunda-feira">Segunda-feira</option>
                        <option value="Terça-feira">Terça-feira</option>
                        <option value="Quarta-feira">Quarta-feira</option>
                        <option value="Quinta-feira">Quinta-feira</option>
                        <option value="Sexta-feira">Sexta-feira</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                    <select class="w3-input dis" name="disponibilidade-hora">
                        <option value="" disabled selected>Hora</option>
                        <option value="00:00">00:00</option>
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
                    <select class="w3-input dis" name="disponibilidade-duracao">
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
                    
                </div>
                <input class="w3-button" id="procura" type="submit" value="Procura"/>
            </form>
    </div>

    <div id="VolDiv">

    <?php

        include "openconn.php"; 

        if (!empty($_POST)){

            $primeiro = 0;

            $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                                , distrito, freguesia, telefone, cc, carta_c, covid, email, foto
                                FROM Voluntario ";

            if (!empty($_POST['nome'])){
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE nome_voluntario = '".$_POST['nome']."' ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND nome_voluntario = '".$_POST['nome']."' ";
                }
            }

            if (!empty($_POST['email'])) {
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE email = '".$_POST['email']."' ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND email = '".$_POST['email']."' ";
                }
            }

            if (!empty($_POST['idade'])) {
                
                if ($_POST['idade'] == "10 aos 20") {
                    $time1 = strtotime("-10 years", time());
                    $date1 = date("Y-m-d", $time1);
                    $time2 = strtotime("-20 years", time());
                    $date2 = date("Y-m-d", $time2);
                }
                if ($_POST['idade'] == "21 aos 30") {
                    $time1 = strtotime("-20 years", time());
                    $date1 = date("Y-m-d", $time1);
                    $time2 = strtotime("-30 years", time());
                    $date2 = date("Y-m-d", $time2);
                }
                if ($_POST['idade'] == "31 aos 40") {
                    $time1 = strtotime("-30 years", time());
                    $date1 = date("Y-m-d", $time1);
                    $time2 = strtotime("-40 years", time());
                    $date2 = date("Y-m-d", $time2);
                }
                if ($_POST['idade'] == "41 aos 50") {
                    $time1 = strtotime("-40 years", time());
                    $date1 = date("Y-m-d", $time1);
                    $time2 = strtotime("-50 years", time());
                    $date2 = date("Y-m-d", $time2);
                }
                if ($_POST['idade'] == "51 aos 60") {
                    $time1 = strtotime("-50 years", time());
                    $date1 = date("Y-m-d", $time1);
                    $time2 = strtotime("-60 years", time());
                    $date2 = date("Y-m-d", $time2);
                }
                if ($_POST['idade'] == "61 aos 70") {
                    $time1 = strtotime("-60 years", time());
                    $date1 = date("Y-m-d", $time1);
                    $time2 = strtotime("-70 years", time());
                    $date2 = date("Y-m-d", $time2);
                }
                if ($_POST['idade'] == "71 aos 80") {
                    $time1 = strtotime("-70 years", time());
                    $date1 = date("Y-m-d", $time1);
                    $time2 = strtotime("-80 years", time());
                    $date2 = date("Y-m-d", $time2);
                }
                if ($_POST['idade'] == "81+") {
                    $time1 = strtotime("-80 years", time());
                    $date1 = date("Y-m-d", $time1);
                    $time2 = strtotime("-150 years", time());
                    $date2 = date("Y-m-d", $time2);
                }
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
                }
            }

            if (!empty($_POST['distrito'])) {
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE distrito = '".$_POST['distrito']."' ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND distrito = '".$_POST['distrito']."' ";
                }
            }

            if (!empty($_POST['concelho'])) {
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE concelho = '".$_POST['concelho']."' ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND concelho = '".$_POST['concelho']."' ";
                }
            }

            if (!empty($_POST['freguesia'])) {
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE freguesia = '".$_POST['freguesia']."' ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND freguesia = '".$_POST['freguesia']."' ";
                }
            }

            if (!empty($_POST['genero'])) {
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE genero = '".$_POST['genero']."' ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND genero = '".$_POST['genero']."' ";
                }
            }

            if (!empty($_POST['carta'])) {
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE carta_c = '".$_POST['carta']."' ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND carta_c = '".$_POST['carta']."' ";
                }
            }

            if (!empty($_POST['covid'])) {
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE covid = '".$_POST['covid']."' ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND covid = '".$_POST['covid']."' ";
                }
            }

            if (!empty($_POST['area-interesse'])) {
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                        FROM Voluntario_Area
                                        WHERE area = '".$_POST['area-interesse']."') ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                        FROM Voluntario_Area
                                        WHERE area = '".$_POST['area-interesse']."') ";
                }
            }

            if (!empty($_POST['populacao-alvo'])) {
                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                        FROM Voluntario_Populacao_Alvo
                                        WHERE populacao_alvo = '".$_POST['populacao-alvo']."') ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                        FROM Voluntario_Populacao_Alvo
                                        WHERE populacao_alvo = '".$_POST['populacao-alvo']."') ";
                }
            }

            if (!empty($_POST['disponibilidade-dia']) and 
            !empty($_POST['disponibilidade-hora']) and
            !empty($_POST['disponibilidade-duracao'])) {

                $intervalo = intval($_POST['disponibilidade-hora']) + intval($_POST['disponibilidade-duracao']);

                if ($primeiro == 0){
                    $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                        FROM Voluntario_Disponibilidade
                                        WHERE dia = '".$_POST['disponibilidade-dia']."'
                                            AND hora >= ".$_POST['disponibilidade-hora']."
                                            AND hora <= ".$intervalo.") ";
                    $primeiro = 1;
                } else {
                    $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                        FROM Voluntario_Disponibilidade
                                        WHERE dia = '".$_POST['disponibilidade-dia']."'
                                            AND hora >= ".$_POST['disponibilidade-hora']."
                                            AND hora <= ".$intervalo.") ";
                }
            }

            $queryVoluntario .= "ORDER BY nome_voluntario ";
            
        } else {
            $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                        , distrito, freguesia, telefone, cc, carta_c, covid, email, foto
                        FROM Voluntario
                        ORDER BY nome_voluntario;";
        }

        $resultVoluntario = $conn->query($queryVoluntario);

        if (!($resultVoluntario)) {
            echo "Erro: search failed" . mysqli_error($conn);
        }     

        if ($resultVoluntario->num_rows > 0) {
            
            while ($row = $resultVoluntario->fetch_assoc()){

                echo "
                <div class='w3-card-4 w3-round-xxlarge'>

                    <header class='w3-container'>
                        <h3><i class='fa fa-male'></i> &nbsp<b>Voluntário</b></h3>
                    </header>
                    
                    <div class='w3-container'>
                        <h5><b>".$row['nome_voluntario']."</b></h5>
                        <img src='".$row['foto']."' alt='Avatar' class='w3-left w3-circle'>
                        <p><i class='fas fa-map-marker-alt'></i> &nbsp ".$row['concelho'].", ".$row['distrito']."</p>
                        <p><i class='fas fa-heart'></i> &nbsp ";

                $queryArea = "SELECT id_voluntario, area
                FROM Voluntario_Area
                WHERE id_voluntario = '".$row['id']."'";

                $resultArea = $conn->query($queryArea);            

                if ($resultArea->num_rows > 0) {
                    
                    $areas = array();
                    while ($rowA = $resultArea->fetch_assoc()){
                        array_push($areas, $rowA['area']);
                    }

                    $ultimo = count($areas);

                    $c = 0;
                    foreach ($areas as $are) {
                        $c = $c + 1;
                        if ($c == $ultimo){
                            echo "$are";
                        } else {
                            echo "$are, ";
                        }
                    }

                }

                echo "</p>
                        <p><i class='fas fa-users'></i> &nbsp ";

                $queryPopulacao = "SELECT id_voluntario, populacao_alvo
                FROM Voluntario_Populacao_Alvo
                WHERE id_voluntario = '".$row['id']."'";

                $resultPopulacao = $conn->query($queryPopulacao);            

                if ($resultPopulacao->num_rows > 0) {
                    $populacao = array();
                    while ($rowP = $resultPopulacao->fetch_assoc()){
                        array_push($populacao, $rowP['populacao_alvo']);
                    }

                    $ultimo = count($populacao);

                    $c = 0;
                    foreach ($populacao as $pop) {
                        $c = $c + 1;
                        if ($c == $ultimo){
                            echo "$pop";
                        } else {
                            echo "$pop, ";
                        }
                    }
                }

                        
                echo "</p>";
                //         <p><b>Disponibilidade</b>: ";

                // $queryDispo = "SELECT id_voluntario, dia, hora, duracao
                //         FROM Voluntario_Disponibilidade
                //         WHERE id_voluntario = '".$row['id']."'";

                // $resultDispo = $conn->query($queryDispo);            

                // if ($resultDispo->num_rows > 0) {
                //     echo "<ul class='w3-small'>";
                //     while ($rowD = $resultDispo->fetch_assoc()){
                //         echo "<li> ".$rowD['dia'].", ás ".$rowD['hora'].":00, durante ".$rowD['duracao']." horas</li>";
                //     }
                //     echo "</ul>";
                // }
                        
                       
                //    echo "</p>
                echo    "</div>
                    <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                        <button type='submit' value='".$row['id']."' name='verPerfil' class='w3-button w3-block w3-hover-blue'>Ver Perfil</button>
                    </form>
                    
                </div>";
            }
        }

        if (!empty($_POST['verPerfil'])){
            $id = $_POST['verPerfil'];

            $queryVol = "SELECT id, nome_voluntario
                FROM Voluntario
                WHERE id = '".$id."'";

            $resultV = $conn->query($queryVol);

            if ($rowV = $resultV->fetch_assoc()) {
                $nomeV = $rowV['nome_voluntario'];
            }

            $_SESSION['opentype'] = "voluntario";
            $_SESSION['open'] = $nomeV;
            $_SESSION['openid'] = $id;
            header("Location: Perfil.php");
        }

    ?>

    </div>



    <!--

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

    -->
</body>

<!--
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
-->