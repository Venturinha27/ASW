<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->

<?php
    ob_start();
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Esqueceu a Palavra-Passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../CSS/EsqPass.css" type="text/css">
    <script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
</head>

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
        <a href="Voluntarios.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.php" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a> 
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>  
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>    
    </div>
</header>

<body>

    <div id="BrancoDiv" class="w3-container">

        <br>

        <h2>Recuperar a palavra-passe</h2>

        <br>

    </div>

    <form id="registertext" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div id="Esqueci">
            <input type="text" class="w3-input" id="Email" placeholder="E-mail" name="Email" required>

            <input type="text" class="w3-input" id="telefone" placeholder="Telefone/Telemóvel" name="telefone" required>

            <input type="password" class="w3-input" id="novaPassword" placeholder="Nova Palavra-Passe" name="novaPassword" required>
            
            <input type="password" class="w3-input" id="confCassword" placeholder="Confirme a Palavra-Passe" name="confPassword" required>

            <input id="submit" type="submit" name="" value="Confirmar">
        
            <?php
                include "openconn.php";

                include "TestInput.php";

                if (!empty($_POST)){

                    $email = test_input($_POST['Email']);                       #unique
                    $telefone = test_input($_POST['telefone']);                              #unique
                    $novaPassword = test_input($_POST['novaPassword']);
                    $confPassword = test_input($_POST['confPassword']);

                    $passquery = "SELECT I.email, I.telefone, I.id, U.tipo
                                    FROM Instituicao I, Utilizador U 
                                    UNION
                                    SELECT V.email, V.telefone, V.id, U.tipo
                                    FROM Voluntario V, Utilizador U";

                    $resultPass = $conn->query($passquery);

                    while ($row = $resultPass->fetch_array()){
                        if ($email == $row[0] and $telefone == $row[1]){
                            if ($novaPassword == $confPassword) {
                                if ($row[3] == 'voluntario'){
                                    $query = "UPDATE Voluntario 
                                    SET password1 = '".password_hash($novaPassword, PASSWORD_DEFAULT)."' 
                                    WHERE id = '".$row[2]."'";
                                } else {
                                    $query = "UPDATE Instituicao 
                                    SET password2 = '".password_hash($novaPassword, PASSWORD_DEFAULT)."' 
                                    WHERE id = '".$row[2]."'";
                                }
                                
                                $novaPass = $conn->query($query);

                                if ($novaPass) {
                                    header("Location: Login.php");
                                }
                            } else {
                                echo "<p class='erro'> Passwords não coincidem <p>";
                            }
                        } else {
                            echo "<p class='erro'> Email e telefone não correspondem <p>";
                        }
                    }

                }  
        
            ?>
        
        </div>
    </form>

    <div id="VolDiv" class="w3-container">

        <br>
        <h3>Esqueceu-se da sua &nbsp&nbsp Palavra-Passe?</h3>
        <br>
        <hr>
        <h5>Torne a sua nova palavra-passe mais segura:</h5>
        <hr>
        <br>
        <p>- Utilize letras maíusculas;</p>
        <p>- Utilize um ou mais números;</p>
        <p>- Utilize uma palavra ou data que se lembre sempre;</p>
        <p>- Não utilize caracteres especiais.</p>
        <br>
        <hr>
        <br>
        <h4>Esperamos ter ajudado!</h4>

    </div>

    <footer>
        <div id="EndDiv">
        
            <ul id="endContactosL">
                <li>Tel.: 214938000 </li>
                <li>Mail: VoluntárioCOVID19@gmail.com</li>
                <li>Morada: Rua D. Francisco, nº 92, Amadora </li>
            </ul>
        
    
            <div class="vl"></div>
    
            <ul id="endPaginas1">
                <a href="Sobre.php"><li>Sobre</li></a>
                <br>
                <a href="#"><li>Publicações</li></a>
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