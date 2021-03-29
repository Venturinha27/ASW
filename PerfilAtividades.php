<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
    ob_start();

    if (!isset($_SESSION['logged'])) {
        header("Location: Login.php");
    }
?>
<!DOCTYPE html>
<html>
<title>Perfil</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="CSS/PerfilAtividadesC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<!-- <script src="JavaScript/MessageJS.js"></script> -->

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
        <a href="Voluntarios.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.php" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

</header>

<body>

    <?php

        include "openconn.php";

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
            $queryHeaderVoluntario = "SELECT foto, bio, data_nascimento, genero, concelho
                                , distrito, freguesia, telefone, carta_c, covid, email
                                FROM Voluntario
                                WHERE id = '".$openid."';";

            $resultHeaderVoluntario = $conn->query($queryHeaderVoluntario);

            

            if (!($resultHeaderVoluntario)) {
                echo "Erro: search failed" . mysqli_error($conn);
            }              


            
            if ($row = $resultHeaderVoluntario->fetch_assoc()){
                $foto = $row['foto'];
                $bio = $row['bio'];
                $data_nascimento = $row['data_nascimento'];
                $genero = $row['genero'];
                $concelho = $row['concelho'];
                $distrito = $row['distrito'];
                $freguesia = $row['freguesia'];
                $telefone = $row['telefone'];
                $carta_c = $row['carta_c'];
                $covid = $row['covid'];
                $email = $row['email'];
            }

            # -- PREFERENCIAS VOLUNTARIO ---------------------------------------------------
            
            
            echo "
                <div id='AzulDiv' >

                <img alt='Avatar' class='w3-left w3-circle' src='$foto' />
                    
                    <h5>".$open."</h5>
                    <hr>
                    <h6>0 <b>Publicações</b> &nbsp &nbsp &nbsp 0 <b>Seguidores</b> &nbsp &nbsp &nbsp 0 <b>Seguindo</b></h6>
                    <hr>
                    <p>".$bio."</p>

                    ";
                    
                    if ($openid == $loggedid){
                        echo "
                        <a href='EditarPerfil.php'><button class='w3-button' id='EditarPerfil'>
                            Editar perfil
                        </button></a>

                        <a href='Login.php'><button class='w3-button' id='TerminarSessao'>
                            Terminar sessão
                        </button></a>";
                    } else {
                        echo "
                        <a><button class='w3-button' id='EnviarMensagem'>
                            Enviar Mensagem
                        </button></a>

                        <a href='Login.php'><button class='w3-button' id='Seguir'>
                            Seguir
                        </button></a>";
                    }
                    
                echo "</div>";

        }


        # ---------------------------------------------------------------------------------------
        # ---------------------------------------------------------------------------------------
        # --------------- INSTITICAO ------------------------------------------------------------
        # ---------------------------------------------------------------------------------------
        # ---------------------------------------------------------------------------------------

        if ($opentype == 'instituicao'){

            # -- TABLE INSTITUICAO ---------------------------------------------------
            $queryHeaderInstituicao = "SELECT telefone, morada, distrito, concelho, freguesia,
                                email, bio, nome_representante, email_representante, foto, website
                                FROM Instituicao
                                WHERE id = '".$openid."';";

            $resultHeaderInstituicao = $conn->query($queryHeaderInstituicao);

            

            if (!($resultHeaderInstituicao)) {
                echo "Erro: search failed" . mysqli_error($conn);
            }              


            
            if ($row = $resultHeaderInstituicao->fetch_assoc()){
                $telefone = $row['telefone'];
                $morada = $row['morada'];
                $distrito = $row['distrito'];
                $concelho = $row['concelho'];
                $freguesia = $row['freguesia'];
                $email = $row['email'];
                $bio = $row['bio'];
                $nome_representante = $row['nome_representante'];
                $email_representante = $row['email_representante'];
                $foto = $row['foto'];
                $website = $row['website'];
            }

            # -- PREFERENCIAS INSTITUICAO ---------------------------------------------------
            
            #<img src='$foto' alt='Avatar' class='w3-left w3-circle' >
            
            echo "
                <div id='AzulDiv' >
            
                    <img alt='Avatar' class='w3-left w3-circle' src='$foto' />       
                    
                    <h5>".$open."</h5>
                    <hr>
                    <h6>0 <b>Publicações</b> &nbsp &nbsp &nbsp 0 <b>Seguidores</b> &nbsp &nbsp &nbsp 0 <b>Seguindo</b></h6>
                    <hr>
                    <p>".$bio."</p>

                    ";
                    
                    if ($openid == $loggedid){
                        echo "
                        <a href='EditarPerfil.php'><button class='w3-button' id='EditarPerfil'>
                            Editar perfil
                        </button></a>

                        <a href='Login.php'><button class='w3-button' id='TerminarSessao'>
                            Terminar sessão
                        </button></a>";
                    } else {
                        echo "
                        <a><button class='w3-button' id='EnviarMensagem'>
                            Enviar Mensagem
                        </button></a>

                        <a href='Login.php'><button class='w3-button' id='Seguir'>
                            Seguir
                        </button></a>";
                    }
                    
                echo "</div>";

        }

    ?>

<!--
    <div id="AzulDiv" >

        <img src="Images/voluntario.jpg" alt="Avatar" class="w3-left w3-circle">

        <h5>Manel João</h5>
        <hr>
        <h6>27 publicações <i class="fa fa-deviantart"></i> 13 seguidores <i class="fa fa-deviantart"></i> 17 seguindo</h6>
        <hr>
        <p>Olá sou o Manel João e estou como sou no alta definição</p>

        <a href="EditarPerfil.php"><button class="w3-button" id="EditarPerfil">
            Editar perfil
        </button></a>

        <a href="Login.php"><button class="w3-button" id="TerminarSessao">
            Terminar sessão
        </button></a>
    </div>
    -->


    <div id="BodyDiv">
        <div id="MenuBody">
            <a href="Perfil.php"><button class="w3-button w3-white w3-hover-indigo" id="Perfil">
                Perfil
            </button></a>

            <a href="PerfilFeed.php"><button class="w3-button w3-white w3-hover-indigo" id="Feed">
                Publicações
            </button></a>

            <button class="w3-button w3-indigo" id="Atividades">
                Ações
            </button>
        </div>

        <div id="AtividadesDiv">

            <?php
                if ($opentype == 'instituicao'){
                    
                    $sqlNome = "SELECT id_instituicao, id_acao, titulo, distrito, concelho, freguesia, funcao, 
                                area_interesse, populacao_alvo, num_vagas, dia, hora, duracao
                                FROM Acao
                                WHERE id_instituicao = '".$openid."';";

                    $resultN = $conn->query($sqlNome);

                    $sqlImg = "SELECT id, foto
                                FROM Instituicao
                                WHERE id = '".$openid."';";

                    $resultImg = $conn->query($sqlImg);

                    if ($rowI = $resultImg->fetch_assoc()){
                        $ava = $rowI['foto'];
                    }
                    
                    if (!($resultN)) {
                        echo "Erro: search failed" . $query . "<br>" . mysqli_error($conn);
                    }              

                    if ($resultN->num_rows > 0) {

                        while ($row = $resultN->fetch_assoc()){

                            echo "<div class='w3-card-4'>

                                    <header class='w3-container'>
                                        <h3>$open</h3>
                                    </header>
                                    
                                    <div class='w3-container'>
                                        <h5>".$row['titulo']."</h5>
                                        <hr>
                                        <img src='$ava' alt='Avatar' class='w3-left w3-circle'>
                                        
                                        <p><b>Distrito:</b> ".$row['distrito']." | <b>Concelho:</b> ".$row['concelho']." | <b>Freguesia:</b> ".$row['freguesia']."</p>
                                        <p><b>Função:</b> ".$row['funcao']." | <b>Área de interesse:</b> ".$row['area_interesse']."</p>
                                        <p><b>População-alvo:</b> ".$row['populacao_alvo']." | <b>Nº de vagas:</b> ".$row['num_vagas']."</p>
                                        <p><b>Data:</b> ".$row['dia'].", ás ".$row['hora'].":00, durante ".$row['duracao']." horas.</p>
                                    </div>
                                    
                                    <button class='w3-button w3-block w3-hover-blue'>Ver Mais</button>
                                    
                                </div>";
                        }
                    }
                }
            ?>
            <!--
            <div class="w3-card-4" id="card1">

                <header class="w3-container">
                    <h3>Portugal Voluntário</h3>
                </header>
                
                <div class="w3-container">
                    <h5>Compras para idosos</h5>
                    <hr>
                    <img src="Images/slide7.jpg" alt="Avatar" class="w3-left w3-circle">
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
                    <img src="Images/slide7.jpg" alt="Avatar" class="w3-left w3-circle">
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
                    <img src="Images/slide7.jpg" alt="Avatar" class="w3-left w3-circle">
                    <h6>Breve descrição da instituição</h6>
                    <hr>
                    <p>Distrito: Lisboa <i class="fa fa-deviantart"></i> Concelho: Benfica <i class="fa fa-deviantart"></i> Freguesia: São Domingos de Benfica</p>
                    <p>Função: ------------- <i class="fa fa-deviantart"></i> Área de interesse: ---------------</p>
                    <p>População-alvo: ---------- <i class="fa fa-deviantart"></i> Nº de vagas: ----------</p>
                    <p>Período: 2 semanas <i class="fa fa-deviantart"></i> Nº de horas: 2 horas p/ dia</p>
                </div>
                
                <button class="w3-button w3-block w3-hover-blue">Ver Mais</button>
                
            </div>
            -->
            
        </div>

    </div>

    <!--
    <button id="openMensagens" class="divClosed"><i class="fas fa-comment-dots w3-left" id="openMp"></i></button>

    <div id="MessageDiv" class="w3-sidebar hidden">

        <h3>Mensagens</h3>

        <input type="text" class="w3-bar w3-input" placeholder="Procurar conversas">

        <div class="w3-card-2 w3-white conversa">
            <h4>Dona Dulce</h4>
            <p>Manel João: Tão dona dulce e a familia com...</p>
        </div>

        <div class="w3-card-2 w3-white conversa">
            <h4>Dom Manuel</h4>
            <p>Manel João: Tão Manecas e a familia com...</p>
        </div>

        <div class="w3-card-2 w3-white conversa">
            <h4>Dona Joana</h4>
            <p>Manel João: Tão dona joana e a familia com...</p>
        </div>

        <div class="w3-card-2 w3-white conversa">
            <h4>Zé Tartaruga</h4>
            <p>Manel João: Tão ZeTa e a familia com...</p>
        </div>

        <div class="w3-card-2 w3-white conversa">
            <h4>Portugal Solidário</h4>
            <p>Manel João: Tão Portugal Solidário e a covid com...</p>
        </div>
    </div>
    -->

        <div id='SugDiv'>
                <header class='w3-container w3-indigo w3-round'>
                    <h3><i class="fas fa-lightbulb"></i> &nbsp<b>Sugestões</b></h3>
                </header>
                <div id='Sug'>
                    <div class='sugestao w3-container w3-border-top w3-border-bottom'>
                        <h6 class='nomeS w3-small'><b>Manuel</b></h6>
                        <p class='sugestaoTxt w3-tiny'>Utilizador</p>
                    </div>
                    
                    <div class='sugestao w3-container w3-border-top w3-border-bottom'>
                        <h6 class='nomeS w3-small'><b>AjudaAi</b></h6>
                        <p class='sugestaoTxt w3-tiny'>Instituicao</p>
                    </div>
                    
                    <div class='sugestao w3-container w3-border-top w3-border-bottom'>
                        <h6 class='nomeS w3-small'><b>Ajuda Lx</b></h6>
                        <p class='sugestaoTxt w3-tiny'>Acao</p>
                    </div>
                    <button class="w3-button w3-block w3-indigo w3-small w3-round">Ver Mais</button>
                </div>
            </div>

            <div id='MsgDiv'>
                <header class='w3-container w3-indigo w3-round'>
                    <h3><i class="fas fa-inbox"></i> &nbsp<b>Mensagens</b></h3>
                </header>
                <div id='Msg'>
                    <div class='conversa w3-container w3-border-top w3-border-bottom'>
                        <h6 class='nomeM w3-small'><b>Manuel</b></h6>
                        <p class='mensagemTxt w3-tiny'>Eai manecas</p>
                    </div>
                    
                    <div class='conversa w3-container w3-border-top w3-border-bottom'>
                        <h6 class='nomeM w3-small'><b>Manuel</b></h6>
                        <p class='mensagemTxt w3-tiny'>Eai manecas</p>
                    </div>
                    
                    <div class='conversa w3-container w3-border-top w3-border-bottom'>
                        <h6 class='nomeM w3-small'><b>Manuel</b></h6>
                        <p class='mensagemTxt w3-tiny'>Eai manecas</p>
                    </div>
                    <button class="w3-button w3-block w3-indigo w3-small w3-round">Ver Mais</button>
                </div>
                
            </div>


    </body>

<!--
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
-->