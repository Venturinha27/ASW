
<?php
    ob_start();
    session_start();

    include "../Controller/PerfilController.php";
?>

<!DOCTYPE html>
<html>
<title>Perfil</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/PerfilC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/PerfilJS.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

                        <button onclick='showNotificacoes()' id='notificacoesnumber' class='w3-bar-item w3-button'><i class='fas fa-bell'></i> Notificações</button>
                        
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

<?php

    $loggedtype = $_SESSION['loggedtype'];
    $logged = $_SESSION['logged'];
    $loggedid = $_SESSION['loggedid'];
    $opentype = $_SESSION['opentype'];
    $open = $_SESSION['open'];
    $openid = $_SESSION['openid'];

    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # -- VOLUNTARIO -------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------



    if ($opentype == 'voluntario'){

        # -- TABLE VOLUNTARIO ---------------------------------------------------
        
        $resultVoluntario = openVoluntario($openid);

        $id = $resultVoluntario['id'];
        $nome_voluntario = $resultVoluntario['nome_voluntario'];
        $foto = $resultVoluntario['foto'];
        $bio = $resultVoluntario['bio'];
        $data_nascimento = $resultVoluntario['data_nascimento'];
        $genero = $resultVoluntario['genero'];
        $concelho = $resultVoluntario['concelho'];
        $distrito = $resultVoluntario['distrito'];
        $freguesia = $resultVoluntario['freguesia'];
        $telefone = $resultVoluntario['telefone'];
        $cc = $resultVoluntario['cc'];
        $carta_c = $resultVoluntario['carta_c'];
        $covid = $resultVoluntario['covid'];
        $email = $resultVoluntario['email'];

        # -- PREFERENCIAS VOLUNTARIO ---------------------------------------------------
        
        echo "
            <div id='AzulDiv' >

            <img alt='Avatar' class='w3-left w3-circle' src='../$foto' />
                
                <h5>".$nome_voluntario."</h5>
                <div id='divNPubSeg'></div>
                <br>
                <p>".$bio."</p>

                ";
                
                if ($openid == $loggedid){
                    echo "
                    <a href='EditarPerfil.php'><button class='w3-button' id='EditarPerfil'>
                        <i class='fas fa-user-edit'></i> Editar perfil
                    </button></a>

                    <a href='Login.php'><button class='w3-button' id='TerminarSessao'>
                        <i class='fas fa-sign-out-alt'></i> Terminar sessão
                    </button></a>";
                } else {
                    echo "
                        <a><button class='w3-button' id='EnviarMensagem' onclick='showConversa(".json_encode($loggedid).", ".json_encode($openid).")'>
                            <i class='fas fa-paper-plane'></i> Enviar Mensagem
                        </button></a>
                        
                        <div id='seguirDiv'>
                        </div>";
                }
                
            echo "</div>";

            
        echo"<div id='BodyDiv'>
                <div id='MenuBody'>
                    <a href='Perfil.php'><button class='w3-button w3-indigo' id='Perfil'>
                        Perfil
                    </button></a>

                    <a href='PerfilFeed.php'><button class='w3-button w3-white w3-hover-indigo' id='Feed'>
                        Publicações
                    </button></a>

                    <a href='PerfilAtividades.php'><button class='w3-button w3-white w3-hover-indigo' id='Atividades'>
                        Ações
                    </button></a>
                </div>
                <div class='w3-container'>
                    <p><b>Data de nascimento:</b> $data_nascimento | <b>Género:</b> $genero</p>
                    <p><b>Distrito:</b> $distrito | <b>Concelho:</b> $concelho | <b>Freguesia:</b> $freguesia</p>
                    <p><b>Tel.:</b> $telefone | <b>E-mail:</b> $email</p>
                    <p><b>Já teve covid-19?</b> $covid | <b>Tem carta de condução?</b> $carta_c</p>
                    <hr>
                    <h6><b>Áreas de interesse:</b></h6>";

                    $areas = AreasVoluntario($openid);
                    
                    if (!($areas)) {
                        echo "Não tem áreas de interesse.";
                    }              

                    if ($areas->num_rows > 0) {
                        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
                        echo "<ul class='w3-ul w3-center'>";                                    
                        while ($row = $areas->fetch_assoc()){
                            echo "<li>".$row['area']."</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    }

                    echo "<hr>
                    <h6><b>População-alvo:</b></h6>";

                    $populacaoAlvo = PopulacaoVoluntario($openid);
                
                    if (!($populacaoAlvo)) {
                        echo "Não tem população-alvo.";
                    }              

                    if ($populacaoAlvo->num_rows > 0) {
                        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
                        echo "<ul class='w3-ul w3-center'>"; 
                        while ($row = $populacaoAlvo->fetch_assoc()){
                            echo "<li>".$row['populacao_alvo']."</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    }

                    echo"<hr>
                    <h6><b>Disponibilidade:</b></h6>";

                    $disponibilidade = DisponibilidadeVoluntario($openid);

                    if (!($disponibilidade)) {
                        echo "Não tem disponibilidade.";
                    }              

                    if ($disponibilidade->num_rows > 0) {
                        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
                        echo "<ul class='w3-ul w3-center'>"; 
                        while ($row = $disponibilidade->fetch_assoc()){
                            echo "<li>".$row['dia'].", ás ".$row['hora'].":00, durante ".$row['duracao']." horas.</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    }

                echo "</div>";

        if ($loggedtype == 'instituicao') {
                echo "<br>
                    <button type='button' id='openConvida' class='w3-button w3-block w3-center w3-round-xxlarge w3-indigo w3-hover-blue cand'>Convidar este voluntário para uma ação</button>
                <br>";

                echo "<div id='convidaVol' class='hidden'>";
                echo "</div>";
        }

        echo "</div>";
    }

    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # --------------- INSTITICAO ------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------

    if ($opentype == 'instituicao'){

        $resultInstituicao = openInstituicao($openid);

        # -- TABLE INSTITUICAO ---------------------------------------------------              

        $id = $resultInstituicao['id'];
        $nome_instituicao = $resultInstituicao['nome_instituicao'];
        $telefone = $resultInstituicao['telefone'];
        $morada = $resultInstituicao['morada'];
        $distrito = $resultInstituicao['distrito'];
        $concelho = $resultInstituicao['concelho'];
        $freguesia = $resultInstituicao['freguesia'];
        $email = $resultInstituicao['email'];
        $bio = $resultInstituicao['bio'];
        $nome_representante = $resultInstituicao['nome_representante'];
        $email_representante = $resultInstituicao['email_representante'];
        $foto = $resultInstituicao['foto'];
        $website = $resultInstituicao['website'];

        # -- PREFERENCIAS INSTITUICAO ---------------------------------------------------
        
        echo "
            <div id='AzulDiv' >
        
                <img alt='Avatar' class='w3-left w3-circle' src='../$foto' />       
                
                <h5>".$nome_instituicao."</h5>
                <div id='divNPubSeg'></div>
                <br>
                <p>".$bio."</p>

                ";
                
                if ($openid == $loggedid){
                    echo "
                    <a href='EditarPerfil.php'><button class='w3-button' id='EditarPerfil'>
                        <i class='fas fa-user-edit'></i> Editar perfil
                    </button></a>

                    <a href='Login.php'><button class='w3-button' id='TerminarSessao'>
                        <i class='fas fa-sign-out-alt'></i> Terminar sessão
                    </button></a>";
                } else {
                    echo "
                        <a><button class='w3-button' id='EnviarMensagem' onclick='showConversa(".json_encode($loggedid).", ".json_encode($openid).")'>
                            <i class='fas fa-paper-plane'></i> Enviar Mensagem
                        </button></a>
        
                        <div id='seguirDiv'>
                        </div>";
                }
                
            echo "</div>";

            
         echo"<div id='BodyDiv'>
                <div id='MenuBody'>
                    <a href='Perfil.php'><button class='w3-button w3-indigo' id='Perfil'>
                        Perfil
                    </button></a>

                    <a href='PerfilFeed.php'><button class='w3-button w3-white w3-hover-indigo' id='Feed'>
                        Publicações
                    </button></a>

                    <a href='PerfilAtividades.php'><button class='w3-button w3-white w3-hover-indigo' id='Atividades'>
                        Ações
                    </button></a>
                </div>
                
                <div class='w3-container'>
                    <p><b>Tel.:</b> $telefone | <b>E-mail:</b> $email | <b>Website:</b> $website</p>
                    <p><b>Distrito:</b> $distrito | <b>Concelho:</b> $concelho | <b>Freguesia:</b> $freguesia</p>
                    <p><b>Morada:</b> $morada</p>
                    <p><b>Representante:</b> $nome_representante | <b>E-mail representante:</b> $email_representante</p>
                </div>
            </div>";
    }

    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # --------------------- ACAO ------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------

    if ($opentype == 'acao'){

        $resultAcao = openAcao($openid);

        # -- TABLE ACAO ---------------------------------------------------  
        
        "SELECT I.id, I.nome_instituicao, I.foto, A.id_acao, A.titulo, A.distrito,
                    A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                    A.num_vagas, A.dia, A.hora, A.duracao
                    FROM Instituicao I, Acao A
                    WHERE I.id = A.id_instituicao 
                    AND A.id_acao = '".$id."'";

        $id_instituicao = $resultAcao['id'];
        $nome_instituicao = $resultAcao['nome_instituicao'];
        $foto = $resultAcao['foto'];
        $id_acao = $resultAcao['id_acao'];
        $titulo = $resultAcao['titulo'];
        $distrito = $resultAcao['distrito'];
        $concelho = $resultAcao['concelho'];
        $freguesia = $resultAcao['freguesia'];
        $funcao = $resultAcao['funcao'];
        $area_interesse = $resultAcao['area_interesse'];
        $populacao_alvo = $resultAcao['populacao_alvo'];
        $num_vagas = $resultAcao['num_vagas'];
        $dia = $resultAcao['dia'];
        $hora = $resultAcao['hora'];
        $duracao = $resultAcao['duracao'];

        # -- PREFERENCIAS ACAO ---------------------------------------------------
        
        echo "
            <div id='AzulDiv' >
        
                <img alt='Avatar' class='w3-left w3-circle' src='../$foto' />       
                
                <h5>".$titulo."</h5>
                <br>
                <br>
                <p>Promovido pela instituição <b>".$nome_instituicao."</b>.</p>

            ";
            
            if ($id_instituicao == $loggedid){
                echo "
                <a href='EditarPerfil.php'><button class='w3-button' id='EditarPerfil'>
                    <i class='fas fa-user-edit'></i> Editar perfil
                </button></a>

                <a href='Login.php'><button class='w3-button' id='TerminarSessao'>
                    <i class='fas fa-sign-out-alt'></i> Terminar sessão
                </button></a>";
            } 
            
        echo "</div>";

            
         echo"<div id='BodyDiv'>
                <div id='MenuBody'>
                    <a href='Perfil.php'><button class='w3-button w3-indigo' id='Perfil'>
                        Perfil
                    </button></a>

                    <a href='PerfilFeed.php'><button class='w3-button w3-white w3-hover-indigo' id='Feed'>
                        Candidatos
                    </button></a>

                    <a href='PerfilAtividades.php'><button class='w3-button w3-white w3-hover-indigo' id='Atividades'>
                        Participantes
                    </button></a>
                </div>
                <div class='w3-container'>
                    <p><b>Função:</b> $funcao | <b>Área de interesse:</b> $area_interesse | <b>População-alvo:</b> $populacao_alvo</p>
                    <p><b>Distrito:</b> $distrito | <b>Concelho:</b> $concelho | <b>Freguesia:</b> $freguesia</p>
                    <p><b>Número de vagas:</b> $num_vagas | <b>Data:</b> $dia, ás $hora horas, duante $duracao horas.</p>

                    <div id='candidatarDiv'></div>
                </div>";

        echo "</div>";
                
        echo "</div>";       
    }

?>

<?php
        include "../Controller/PedidosController.php";

        if (isset($_SESSION['logged'])){

            echo "<div id='PedDiv'>
            <header class='w3-container w3-indigo w3-round'>
                <h3><i class='fas fa-bars'></i> &nbsp<b>Pedidos</b></h3>
            </header>
            <div id='Ped'>
            </div>
            <button type='button' id='vermaisped' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Mais</button>
            </div>";
        }
        
?>

<?php

        if (isset($_SESSION['logged'])){
            echo "<div id='SugDiv'>
                <header class='w3-container w3-indigo w3-round'>
                    <h3><i class='fas fa-lightbulb'></i> &nbsp<b>Sugestões</b></h3>
                </header>
                <div id='Sug'>
                </div>
                <button id='vermaissug' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Mais</button>
            </div>";
        }
?>

<?php

        if (isset($_SESSION['logged'])){

            echo "<div id='MsgDiv'>
                <header class='w3-container w3-indigo w3-round'>
                    <h3><i class='fas fa-inbox'></i> &nbsp<b>Mensagens</b> </h3>
                </header>
                <div id='Msg'>";
                echo "</div>
                <button id='vermaismsg' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Mais</button>
                
            </div>";

        }
?>

</body>
