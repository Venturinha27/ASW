<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
    ob_start();

    include "../Controller/VoluntariosController.php";
?>

<!DOCTYPE html>
<html>
<title>Voluntários</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/VoluntariosC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/VoluntariosJS.js"></script>
<script src="../JavaScript/DCF.js"></script>

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
        <a href="Voluntarios.php" class="w3-bar-item w3-button w3-blue w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>  
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a> 
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

        if (empty($_POST['verPerfil'])){
            if (!empty($_POST)){

                include "TestInput.php";

                $nome = test_input($_POST['nome']);
                $email = test_input($_POST['email']);
                $idade = test_input($_POST['idade']);
                $distrito = test_input($_POST['distrito']);
                $concelho = test_input($_POST['concelho']);
                $freguesia = test_input($_POST['freguesia']);
                $genero = test_input($_POST['genero']);
                $carta = test_input($_POST['carta']);
                $covid = test_input($_POST['covid']);
                $areaInteresse = test_input($_POST['area-interesse']);
                $populacaoAlvo = test_input($_POST['populacao-alvo']);
                $disDia = test_input($_POST['disponibilidade-dia']);
                $disHora = test_input($_POST['disponibilidade-hora']);
                $disDuracao = test_input($_POST['disponibilidade-duracao']);

                $voluntarios = searchVoluntariosFilter($nome, $email, $idade, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $areaInteresse, $populacaoAlvo, $disDia, $disHora, $disDuracao);

            } else {

                $voluntarios = searchVoluntarios();
                
            }

            // SE ESTIVER LOGGADO
            if ($voluntarios->num_rows > 0) {
                while ($row = $voluntarios->fetch_assoc()){
                    echo_voluntarios($row);
                }
            } 

            // SE NÃO ESTIVER LOGGADO
            else {
                foreach ($voluntarios as $row) {
                    echo_voluntarios($row);
                }
            }
        }

        if (!empty($_POST['verPerfil'])){

            $id = $_POST['verPerfil'];

            $nomeV = nomeVoluntario($id);

            $_SESSION['opentype'] = "voluntario";
            $_SESSION['open'] = $nomeV;
            $_SESSION['openid'] = $id;
            header("Location: Perfil.php");
        }

        function echo_voluntarios($row) {
            echo "
                <div class='w3-card-4 w3-round-xxlarge'>

                    <header class='w3-container'>
                        <h3><i class='fa fa-male'></i> &nbsp<b>Voluntário</b></h3>
                    </header>";

            if ($_SESSION['loggedtype'] == 'instituicao') {
                $acoes = CorrespondeVoluntarioAcoes($row, $_SESSION['loggedid']);

                if ($acoes != FALSE) {
                    if (count($acoes) > 1) {
                        echo "<header class='w3-container w3-green'>
                        <p>Este voluntário corresponde às suas ações ";
                    } else {
                        echo "<header class='w3-container w3-green'>
                        <p>Este voluntário corresponde à sua ação ";
                    }

                    $ultimo = count($acoes);
                    $acc = 0;
                    foreach ($acoes as $ac) {
                        $acc = $acc + 1;
                        if ($acc == $ultimo) {
                            echo "<b>$ac</b>.";
                        } else {
                            echo "<b>$ac</b>, ";
                        }
                        
                    }
                    echo "</p>
                    </header>";
                }
            }
                    
                echo "<div class='w3-container'>
                        <h5><b>".$row['nome_voluntario']."</b></h5>
                        <img src='../".$row['foto']."' alt='Avatar' class='w3-left w3-circle'>
                        <p><i class='fas fa-map-marker-alt'></i> &nbsp ".$row['concelho'].", ".$row['distrito']."</p>
                        <p><i class='fas fa-heart'></i> &nbsp ";

                $areas = areasVoluntario($row['id']);         

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


                echo "</p>
                        <p><i class='fas fa-users'></i> &nbsp ";

                $populacao = populacaoVoluntario($row['id']);

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
       
                echo "</p>";
                
                echo    "</div>
                    <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                        <button type='submit' value='".$row['id']."' name='verPerfil' class='w3-button w3-block w3-hover-blue'>Ver Perfil</button>
                    </form>
                    
                </div>";
        }

    ?>

    </div>

</body>
