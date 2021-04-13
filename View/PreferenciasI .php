<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Ação de Voluntariado</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/PreferenciasI.css" type="text/css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/PreferenciasI.js"></script>
<script src="../JavaScript/DCF.js"></script>
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

        <h2>Adicione ações à sua instituição</h2>

        <br>

    <div id="registertext">
                
            <hr>

            <label>Ações promovidas pela instituição:</label>
            <div id="acoes">
                <div id="addacao">
                    <h4 class="w3-button w3-block w3-center w3-indigo">Adiciona ação</h4>
                </div>

                <?php

                    include "openconn.php";

                    $instituicao = $_SESSION['logged'];
                    
                    $sqlNome = "SELECT id_instituicao, id_acao, titulo, distrito, concelho, freguesia, funcao, 
                                area_interesse, populacao_alvo, num_vagas, dia, hora, duracao
                                FROM Acao
                                WHERE id_instituicao = '".$_SESSION['loggedid']."';";

                    $resultN = $conn->query($sqlNome);
                    
                    if (!($resultN)) {
                        echo "Erro: search failed" . $query . "<br>" . mysqli_error($conn);
                    }              

                    if ($resultN->num_rows > 0) {

                        while ($row = $resultN->fetch_assoc()){

                            echo "<div class='w3-card-4'>
                                        <header class='w3-container'>
                                            <h3>".$instituicao."</h3>
                                        </header>

                                        <div class='w3-container'>
                                            <h5>".$row['titulo']."</h5>
                                            <hr>
                                            <p>Distrito: ".$row['distrito']." <i class='fa fa-deviantart'></i> Concelho: ".$row['concelho']." <i class='fa fa-deviantart'></i> Freguesia: ".$row['freguesia']."</p>
                                            <p>Função: ".$row['funcao']." <i class='fa fa-deviantart'></i> Área de interesse: ".$row['area_interesse']."</p>
                                            <p>População-alvo: ".$row['populacao_alvo']." <i class='fa fa-deviantart'></i> Nº de vagas: ".$row['num_vagas']."</p>
                                            <p>Data: ".$row['dia'].", ás ".$row['hora'].":00, durante ".$row['duracao']." horas</p>
                                        </div>

                                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                            <button class='w3-button w3-block w3-hover-red' type='submit' value='".$row['id_acao']."' name='removeAcao'>
                                                Eliminar ação
                                            </button>
                                        </form>
                                </div>";
                        }
                    } else {
                        echo "<p class='w3-display-middle'>Ainda não tem ações :(</p>";
                    }
                        /*
                        

                        </div>*/

                    mysqli_close($conn);
                ?>
                
            </div>

            <a href="Perfil.php"><button class="submitr w3-round-xxlarge">Avançar</button></a>

        </div>

    <form id="acaoform" class="w3-container hidden" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <header class="w3-container w3-indigo">
                <h3>Nova ação</h3>

                <button class="w3-button w3-display-topright w3-large w3-hover-indigo" id="closeActionForm">X</button>
            </header>
            <br>

            <input type="text" class="w3-input" id="tituloAcao" placeholder="Titulo da ação" name="titulo" required>

            <hr>

            <div id="esq">

                <label>Áreas de interesse:</label>
                    <select class="w3-select sel" name="area-interesse" required>
                        <option value="" disabled selected>Selecione as suas áreas de interesse</option>
                        <option value="Ação social">Ação social</option>
                        <option value="Educação">Educação</option>
                        <option value="Saúde">Saúde</option>
                    </select>
                    
                <hr>
                
                <label>População-alvo:</label>
                    <select class="w3-select sel" name="populacao-alvo" required>
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

                <hr>
                
                <label>Função: </label>
                    <select class="w3-select sel" name="funcao" required>
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

                <hr>

                <label>Número de Vagas:</label>
                    <input type="number" id="nVagas" name="vagas" min="1" max="1000" required>

            </div>

            <div id="dir">
            
                <label>Distrito:</label>
                <select class="w3-select sel" name="distrito" id="distrito" required>
                    <option value="" disabled selected>Selecione o seu Distrito:</option>
                </select> 

                <hr>
                
                <label>Concelho:</label>
                <select class="w3-select sel" name="concelho" id="concelho" required>
                    <option value="" disabled selected>Selecione o seu Concelho:</option>
                </select>
                
                <hr>
                
                <label>Freguesia:</label>
                <select class="w3-select sel" name="freguesia" id="freguesia" required>
                    <option value="" disabled selected>Selecione a sua Freguesia:</option>
                </select> 
                
                <hr>
                
                <label>Disponibilidade:</label>
                    <select class="w3-select disponibilidade" name="disponibilidade-dia" required>
                        <option value="" disabled selected>Dia</option>
                        <option value="Segunda">Segunda</option>
                        <option value="Terça">Terça</option>
                        <option value="Quarta">Quarta</option>
                        <option value="Quinta">Quinta</option>
                        <option value="Sexta">Sexta</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                        
                    </select>
                    <select class="w3-select disponibilidade" name="disponibilidade-hora" required>
                        <option value="" disabled selected>Hora</option>
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
                    <select class="w3-select disponibilidade" name="disponibilidade-duracao" required>
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
                
                <hr>

            </div>

            <input class="w3-button w3-indigo" id="submit" type="submit" value="Criar ação">

    </form>

    <?php
        include "openconn.php";
        include "TestInput.php";

        $id_acao = uniqid();
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

        if (isset($_POST['titulo'])) {

            $instituicao = $_SESSION['logged'];
            $id_instituicao = $_SESSION['loggedid'];

            $query = "insert into Acao
                        values ('".$id_instituicao."' , '".$id_acao."' , '".$titulo."' , '".$distrito."' , '".$concelho."' , '"
                        .$freguesia."' , '".$funcao."' , '".$area_interesse."' , '".$populacao_alvo."' , ".$vagas." , '"
                        .$dia."' , ".$hora." , ".$duracao.")";

            $res = mysqli_query($conn, $query);
            
            if ($res) {
                echo "<p> Parabens conseguiste :) </p>";
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
            }
        }

        if (!empty($_POST['removeAcao'])){
            $rAcao = test_input($_POST['removeAcao']);

            $removeAcao = "DELETE FROM Acao
                        WHERE id_acao = '".$rAcao."';";

            $resrAcao = mysqli_query($conn, $removeAcao);
            
            if ($resrAcao) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
        mysqli_close($conn);
    ?>
    
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

</body>
</html>