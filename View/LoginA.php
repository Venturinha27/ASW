

<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/LoginAC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>

<header>
</header>

<body>
    <div id="loginbox">
        <form id="login" class="w3-container"  action="LoginA.php" method="post">
            <div class="w3-container" id="div">
                <h1 class="w3-center"><i class="fa fa-user-circle"></i></h1>
            </div>
            <br><br>
            <input class="w3-input w3-large" id="username" type="text" placeholder="Nome de utilizador" name="username" required>
            <br><br>
            <input class="w3-input w3-large" id="userpw" type="password" placeholder="Password"  name="password" required>
            <br><br>
            <input class="w3-large " id="submit" type="submit" name="" value="Entrar"  name="email"href="HomePage.html">
            <br><br>
            <a class="w3-right" href="RegistoA.php" id="register">Ainda não tem conta? Registe-se aqui!</a>
        
        </form>

    </div>
<?php

     // estabelecer ligação com a base de dados
     include "../Model/openconn.php";
                
     include "TestInput.php";

     if  (!empty($_POST)) {
     
         // receber o pedido de login com segurança
         $username = test_input($_POST['username']); #mysql_real_escape_string
         $password = test_input($_POST['password']); #sha1
     
         // verificar o utilizador em questão (pretendemos obter uma única linha de registos)
         $loginquery = "SELECT username, passwordA
                         FROM Admins
                         WHERE username = '". $username ."' 
                             AND passwordA = '" . $password . "';";

         $resultLogin = $conn->query($loginquery);

         if (!($resultLogin)) {
             echo "Erro: insert failed" . $loginquery . "<br>" . mysqli_error($conn);
         }

         if ($resultLogin->num_rows == 1) {
             if ($row = $resultLogin->fetch_assoc()) {
                 // o utilizador está correctamente validado
                 // guardamos as suas informações numa sessão
                 $_SESSION['loggedtype'] = "admin";
                 $_SESSION['logged'] = $row['username'];
                 header("Location: Admin.php");
             } else {
                 echo "<p>Utilizador ou password invalidos.</p>";
             }
         } else {
             // falhou o login
             echo "<p>Utilizador ou password invalidos.</p>";
         }
         
     }

     mysqli_close($conn);

 ?>
    
    <footer>Todos os direitos reservados a Tiago Teodoro, Gonçalo Ventura, Renato Ramires e Margarida Rodrigues.</footer>

</body>
</html>