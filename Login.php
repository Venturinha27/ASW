<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="CSS/LoginC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>

<header>

    

</header>
<body>
    <div id="loginbox">
        <form id="login" class="w3-container">
            <div class="w3-container w3-indigo">
                <h1 class="w3-center"><i class="fa fa-user-circle"></i></h1>
            </div>
            <br><br>
            <input class="w3-input w3-large" id="username" type="text" placeholder="Nome de utilizador ou e-mail" name="username" required>
            <br><br>
            <input class="w3-input w3-large" id="userpw" type="password" placeholder="Password"  name="password" required>
            <br><br>
            <input class="w3-large w3-indigo" id="submit" type="submit" name="" value="Entrar"  name="email"href="HomePage.html">
            <br><br>
            <a class="w3-right" href="Registo.html" id="register">Ainda não tem conta? Registe-se aqui!</a>
        
        </form>

    </div>
<?php
    include "openconn.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    

    

?>
    
    <footer>Todos os direitos reservados a Tiago Teodoro, Gonçalo Ventura, Renato Ramires e Margarida Rodrigues.</footer>

</body>
</html>