<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
    ob_start();

    if (!isset($_SESSION['logged'])) {
        header("Location: Login.php");
    }

    include "../Controller/PerfilController.php";
?>
<!DOCTYPE html>
<html>
<title>Perfil</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/PerfilFeedC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<!-- <script src="JavaScript/MessageJS.js"></script> -->

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
        <a href="Instituicoes.php" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
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
                <br>
                <h6>0 <b>Publicações</b> &nbsp &nbsp &nbsp 0 <b>Seguidores</b> &nbsp &nbsp &nbsp 0 <b>Seguindo</b></h6>
                <br>
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
                <br>
                <h6>0 <b>Publicações</b> &nbsp &nbsp &nbsp 0 <b>Seguidores</b> &nbsp &nbsp &nbsp 0 <b>Seguindo</b></h6>
                <br>
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


    <div id="BodyDiv">
        <div id="MenuBody">
            <a href="Perfil.php"><button class="w3-button w3-white w3-hover-indigo" id="Perfil">
                Perfil
            </button></a>

            <button class="w3-button w3-indigo" id="Feed">
                Publicações
            </button>

            <a href="PerfilAtividades.php"><button class="w3-button w3-white w3-hover-indigo" id="Atividades">
                Ações
            </button></a>
        </div>

        <div id="pubs">
            <!--
            <div class="pubpar" id="primeiraPub">
                <img src="Images/slide2.jpg">
            
                <div class="divnome_par"><img src="Images/voluntario.jpg" class="w3-circle" id="avatar">
                    <h6>Manel João</h6></div>
            
                <div class="divcom_par">
                    <p>Com: Programa Agora Nós e Padeira de Aljubarrota</p>
                </div>
            
                <hr>
            
                <div class="divtext_par">
                    <p>Trabalho de equipa ajuda a vencer batalha de aljubarrota.</p>
                </div>
            </div>
            
            <div class="pubimpar">
                <img src="Images/slide5.jpg">
            
                <div class="divnome_impar"><img src="Images/voluntario.jpg" class="w3-circle" id="avatar">
                    <h6>Manel João</h6></div>
            
                <div class="divcom_impar">
                    <p>Com: Programa Agora Nós</p>
                </div>
            
                <hr>
            
                <div class="divtext_impar">
                    <p>Entrega de bróculos à velhinha Mari Zé.</p>
                </div>
            </div>
            
            <div class="pubpar">
                <img src="Images/slide4.jpg">
            
                <div class="divnome_par"><img src="Images/voluntario.jpg" class="w3-circle" id="avatar">
                    <h6>Manel João</h6></div>
            
                <div class="divcom_par">
                    <p>Com: Filipe Eduardo, D. Sebastião e Manel Jorge</p>
                </div>
            
                <hr>
            
                <div class="divtext_par">
                    <p>Dona Dolores recebe drogas caseiras. Boa Dona Dolores.</p>
                </div>
            </div>

            <div class="pubimpar">
                <img src="Images/slide5.jpg">
            
                <div class="divnome_impar"><img src="Images/voluntario.jpg" class="w3-circle" id="avatar">
                    <h6>Manel João</h6></div>
            
                <div class="divcom_impar">
                    <p>Com: Programa Agora Nós</p>
                </div>
            
                <hr>
            
                <div class="divtext_impar">
                    <p>Entrega de bróculos à velhinha Mari Zé.</p>
                </div>
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