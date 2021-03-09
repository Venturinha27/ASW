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

    if ($opentype == 'voluntario'){

        # -- HEADER VOLUNTARIO ---------------------------------------------------
        $queryHeaderVoluntario = "SELECT foto, bio
                            FROM Voluntario
                            WHERE id = '".$openid."';";

        $resultHeaderVoluntario = $conn->query($queryHeaderVoluntario);

        

        if (!($resultHeaderVoluntario)) {
            echo "Erro: search failed" . mysqli_error($conn);
        }              

       
        
        if ($row = $resultHeaderVoluntario->fetch_assoc()){
            $foto = $row['foto'];
            $bio = $row['bio'];

        }

        #<img src='".$foto."' alt='Avatar' class='w3-left w3-circle'>
        echo $foto;
        
        echo "
            <div id='AzulDiv' >

                <img src='$foto' alt='Avatar' class='w3-left w3-circle'>
                
                <h5>".$open."</h5>
                <hr>
                <h6>0 publicações <i class='fa fa-deviantart'></i> 0 seguidores <i class='fa fa-deviantart'></i> 0 seguindo</h6>
                <hr>
                <p>".$bio."</p>

                <a href='EditarPerfil.html'><button class='w3-button' id='EditarPerfil'>
                    Editar perfil
                </button></a>

                <a href='Login.html'><button class='w3-button' id='TerminarSessao'>
                    Terminar sessão
                </button></a>
            </div>

            
            <div id='BodyDiv'>
                <div id='MenuBody'>
                    <button class='w3-button w3-indigo' id='Perfil'>
                        Perfil
                    </button>

                    <a href='PerfilFeed.html'><button class='w3-button w3-white w3-hover-indigo' id='Feed'>
                        Feed
                    </button></a>

                    <a href='PerfilAtividades.html'><button class='w3-button w3-white w3-hover-indigo' id='Atividades'>
                        Atividades
                    </button></a>
                </div>
                <div class='w3-container'>
                    <p>Área de interesse: Educação | Saúde</p>
                    <hr>
                    <p>População-alvo: Idosos</p>
                    <hr>
                    <p>Disponibilidade: Terça, ás 18:00, durante 2 horas</p>
                    <p>Disponibilidade: Sábado, ás 8:00, durante 8 horas</p>
                </div>
            </div>

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
            </div>
        ";
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