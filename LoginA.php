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
<link rel="stylesheet" href="CSS/LoginAC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>

<header>

    

</header>
<body>
    <div id="loginbox">
        <form id="login" class="w3-container">
            <div class="w3-container" id="div">
                <h1 class="w3-center"><i class="fa fa-user-circle"></i></h1>
            </div>
            <br><br>
            <input class="w3-input w3-large" id="username" type="text" placeholder="Nome de utilizador ou e-mail" name="username" required>
            <br><br>
            <input class="w3-input w3-large" id="userpw" type="password" placeholder="Password"  name="password" required>
            <br><br>
            <input class="w3-large " id="submit" type="submit" name="" value="Entrar"  name="email"href="HomePage.html">
            <br><br>
            <a class="w3-right" href="Registo.html" id="register">Ainda não tem conta? Registe-se aqui!</a>
        
        </form>

    </div>
<?php


    if (!empty($_POST)) {
 
        // estabelecer ligação com a base de dados
        include "openconn.php";
     
        // receber o pedido de login com segurança
        $username = mysql_real_escape_string($_POST['username']);
        $password = sha1($_POST['password']);
        $email = $_POST["email"];
     
        // verificar o utilizador em questão (pretendemos obter uma única linha de registos)
        $login = mysql_query("SELECT nome_instituicao, email, password2 FROM Instituicao WHERE (nome_instituicao = '$username' OR email = '$username')  AND password2 = '$password'");
        $loginV = mysql_query("SELECT nome_voluntario, email, password1 FROM Voluntario WHERE (nome_voluntario = '$username' OR email = '$username')  AND password1 = '$password'");
        if ($login && mysql_num_rows($login) == 1) {
     
            // o utilizador está correctamente validado
            // guardamos as suas informações numa sessão
            $_SESSION['nome_instituicao'] = mysql_result($login, 0, 0);
            echo "<p>Sessao iniciada com sucesso como {$_SESSION['nome_instituicao']}</p>";
            header("Location: HomePage.html");
        } else {
     
            // falhou o login
            echo "<p>Utilizador ou password invalidos. <a href=\"Login.php\">Tente novamente</a></p>";
        }
        if ($loginV && mysql_num_rows($loginV) == 1) {
     
            // o utilizador está correctamente validado
            // guardamos as suas informações numa sessão
            $_SESSION['nome_voluntario'] = mysql_result($loginV, 0, 0);
            echo "<p>Sessao iniciada com sucesso como {$_SESSION['nome_voluntario']}</p>";
            header("Location: HomePage.html");
            
        } else {
     
            // falhou o login
            echo "<p>Utilizador ou password invalidos. <a href=\"Login.php\">Tente novamente</a></p>";
        }
    }

    

?>
    
    <footer>Todos os direitos reservados a Tiago Teodoro, Gonçalo Ventura, Renato Ramires e Margarida Rodrigues.</footer>

</body>
</html>