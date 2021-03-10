<!-- ASW -->
<?php
    session_start();

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
<link rel="stylesheet" href="CSS/PerfilC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="JavaScript/MessageJS.js"></script>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.html" class="w3-bar-item w3-button w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" placeholder="Procura...">
        
        <a href="Perfil.php" class="w3-bar-item w3-button w3-blue w3-hover-blue w3-right w3-mobile"><i class="fa fa-user-circle"></i></a>
        <a href="Voluntarios.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.html" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
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

            
         echo"<div id='BodyDiv'>
                <div id='MenuBody'>
                    <button class='w3-button w3-indigo' id='Perfil'>
                        Perfil
                    </button>

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

                    $queryVoluntarioArea = "SELECT area
                    FROM Voluntario_Area
                    WHERE id_voluntario = '".$openid."';";

                    $resultVoluntarioArea = $conn->query($queryVoluntarioArea);

                    if (!($resultVoluntarioArea)) {
                        echo "Não tem áreas de interesse.";
                    }              

                    if ($resultVoluntarioArea->num_rows > 0) {
                        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
                        echo "<ul class='w3-ul w3-center'>";                                    
                        while ($row = $resultVoluntarioArea->fetch_assoc()){
                            echo "<li>".$row['area']."</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    }

                    echo "<hr>
                    <h6><b>População-alvo:</b></h6>";
                    
                    $queryVoluntarioPopulacao = "SELECT populacao_alvo
                    FROM Voluntario_Populacao_Alvo
                    WHERE id_voluntario = '".$openid."';";

                    $resultVoluntarioPopulacao = $conn->query($queryVoluntarioPopulacao);

                    if (!($resultVoluntarioPopulacao)) {
                        echo "Não tem população-alvo.";
                    }              

                    if ($resultVoluntarioPopulacao->num_rows > 0) {
                          
                        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
                        echo "<ul class='w3-ul w3-center'>"; 
                        while ($row = $resultVoluntarioPopulacao->fetch_assoc()){
                            echo "<li>".$row['populacao_alvo']."</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    }

                    echo"<hr>
                    <h6><b>Disponibilidade:</b></h6>";

                    $queryVoluntarioDispo = "SELECT dia, hora, duracao
                    FROM Voluntario_Disponibilidade
                    WHERE id_voluntario = '".$openid."';";

                    $resultVoluntarioDispo = $conn->query($queryVoluntarioDispo);

                    if (!($resultVoluntarioDispo)) {
                        echo "Não tem disponibilidade.";
                    }              

                    if ($resultVoluntarioDispo->num_rows > 0) {
                        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
                        echo "<ul class='w3-ul w3-center'>"; 
                        while ($row = $resultVoluntarioDispo->fetch_assoc()){
                            echo "<li>".$row['dia'].", ás ".$row['hora'].":00, durante ".$row['duracao']." horas.</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    }

                echo "</div>
            </div>";
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

            
         echo"<div id='BodyDiv'>
                <div id='MenuBody'>
                    <button class='w3-button w3-indigo' id='Perfil'>
                        Perfil
                    </button>

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
    # --------------- MENSAGENS -------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------

    if ($openid == $loggedid){
        echo "
        <button id='openMensagens' class='divClosed'><i class='fas fa-comment-dots w3-left' id='openMp'></i></button>

        <div id='MessageDiv' class='w3-sidebar hidden'>

            <h3>Mensagens</h3>

            <input type='text' class='w3-bar w3-input' placeholder='Procurar conversas'>

            <div class='w3-card-2 w3-white conversa'>
                <h4>Dona Dulce</h4>
                <p>Manel João: Tão dona dulce e a familia com...</p>
            </div>

            <div class='w3-card-2 w3-white conversa'>
                <h4>Dom Manuel</h4>
                <p>Manel João: Tão Manecas e a familia com...</p>
            </div>

            <div class='w3-card-2 w3-white conversa'>
                <h4>Dona Joana</h4>
                <p>Manel João: Tão dona joana e a familia com...</p>
            </div>

            <div class='w3-card-2 w3-white conversa'>
                <h4>Zé Tartaruga</h4>
                <p>Manel João: Tão ZeTa e a familia com...</p>
            </div>

            <div class='w3-card-2 w3-white conversa'>
                <h4>Portugal Solidário</h4>
                <p>Manel João: Tão Portugal Solidário e a covid com...</p>
            </div>
        </div>";
    }

    mysqli_close($conn);

?>

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
                <a href="Sobre.html"><li>Sobre</li></a>
                <br>
                <a href="Publicacoes.html"><li>Publicações</li></a>
                <br>
                <a href="Covid19.html"><li>COVID-19</li></a>
            </ul>
            <ul id="endPaginas2">
                <a href="Instituicoes.html"><li>Instituições</li></a>
                <br>
                <a href="Voluntarios.html"><li>Voluntários</li></a>
            </ul>
    
            <p id="endD">Todos os direitos reservados a Gonçalo Ventura, Margarida Rodrigues, Renato Ramires e Tiago Teodoro</p>
        </div>
    </footer>
    -->