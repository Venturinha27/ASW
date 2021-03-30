<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/LoginC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>

<header>
</header>

<body>
    <div id="loginbox">
        <form id="login" class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="w3-container w3-indigo">
                <h1 class="w3-center"><i class="fa fa-user-circle"></i></h1>
            </div>
            <br><br>
            <input class="w3-input w3-large" id="username" type="text" placeholder="E-mail" name="email" required>
            <br><br>
            <input class="w3-input w3-large" id="userpw" type="password" placeholder="Password"  name="password" required>
            <br><br>
            <input class="w3-large w3-indigo" id="submit" type="submit" name="" value="Entrar" href="HomePage.html">
            
            <?php

                if  (!empty($_POST)) {

                    // testar o input do utilizador
                    include "TestInput.php";

                    //incluir controlador
                    include "../Controller/LoginController.php";

                    // receber o pedido de login com segurança
                    $email = test_input($_POST['email']); #mysql_real_escape_string
                    $password = test_input($_POST['password']); #sha1

                    $resultc = clogin($email, $password);

                    echo "<p class='w3-text-red w3-center'><b>$resultc</u></b>";

                }

            ?>
            
            <p class="w3-center">Ainda não tem conta?</p>
            <p class="w3-center">
                <a href="RegistoV.php">Registe-se como voluntário</a>
                |
                <a href="RegistoI.php">Registe-se como instituição</a>
            </p>

            <a href="EsqPass.php"><p class="w3-center">Esqueceu-se da sua palavra-passe?</p></a>
        
        </form>

    </div>
    
    <footer>Todos os direitos reservados a Tiago Teodoro, Gonçalo Ventura, Renato Ramires e Margarida Rodrigues.</footer>

</body>
</html>