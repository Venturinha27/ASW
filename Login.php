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
<link rel="stylesheet" href="CSS/LoginC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>

<header>

    

</header>
<body>
    <div id="loginbox">
        <form id="login" class="w3-container" action="Login.php" method="post">
            <div class="w3-container w3-indigo">
                <h1 class="w3-center"><i class="fa fa-user-circle"></i></h1>
            </div>
            <br><br>
            <input class="w3-input w3-large" id="username" type="text" placeholder="Nome de utilizador ou e-mail" name="username" required>
            <br><br>
            <input class="w3-input w3-large" id="userpw" type="password" placeholder="Password"  name="password" required>
            <br><br>
            <input class="w3-large w3-indigo" id="submit" type="submit" name="" value="Entrar"  name="email"href="HomePage.html">
            <?php

                // estabelecer ligação com a base de dados
                include "openconn.php";
                
                include "TestInput.php";

                if  (!empty($_POST)) {
                
                    // receber o pedido de login com segurança
                    $username = test_input($_POST['username']); #mysql_real_escape_string
                    $password = test_input($_POST['password']); #sha1
                    $email = test_input($_POST["email"]);
                
                    // verificar o utilizador em questão (pretendemos obter uma única linha de registos)
                    $loginquery = "SELECT id, nome_instituicao, email, password2
                                    FROM Instituicao
                                    WHERE (nome_instituicao = '". $username ."' OR email = '" . $username ."')
                                        AND password2 = '" . $password . "';";

                    $resultLogin = $conn->query($loginquery);

                    if (!($resultLogin)) {
                        echo "Erro: insert failed" . $loginquery . "<br>" . mysqli_error($conn);
                    }

                    if ($resultLogin->num_rows == 1) {
                        if ($row = $resultLogin->fetch_assoc()) {
                            // o utilizador está correctamente validado
                            // guardamos as suas informações numa sessão
                            $_SESSION['loggedtype'] = "instituicao";
                            $_SESSION['logged'] = $row['nome_instituicao'];
                            $_SESSION['loggedid'] = $row['id'];
                            $_SESSION['opentype'] = "instituicao";
                            $_SESSION['open'] = $row['nome_instituicao'];
                            $_SESSION['openid'] = $row['id'];
                            header("Location: Perfil.php");
                        } else {
                            echo "<p>Utilizador ou password invalidos.</p>";
                        }
                    } else {
                        // falhou o login
                        echo "<p>Utilizador ou password invalidos.</p>";
                    }
                    
                    $loginVquery = "SELECT id, nome_voluntario, email, password1
                                    FROM Voluntario
                                    WHERE (nome_voluntario = '" . $username . "' OR email = '" . $username ."')
                                        AND password1 = '" . $password . "'";

                    $resultLoginV = $conn->query($loginVquery);

                    if (!($resultLoginV)) {
                        echo "Erro: insert failed" . $loginVquery . "<br>" . mysqli_error($conn);
                    }

                    if ($resultLoginV->num_rows == 1) {
                        if ($row = $resultLoginV->fetch_assoc()) {
                            // o utilizador está correctamente validado
                            // guardamos as suas informações numa sessão
                            $_SESSION['loggedtype'] = "voluntario";
                            $_SESSION['logged'] = $row['nome_voluntario'];
                            $_SESSION['loggedid'] = $row['id'];
                            $_SESSION['opentype'] = "voluntario";
                            $_SESSION['open'] = $row['nome_voluntario'];
                            $_SESSION['openid'] = $row['id'];
                            header("Location: Perfil.php");
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
            
            <br><br>
            <p class="w3-center">Ainda não tem conta?</p>
            <p class="w3-center">
                <a href="RegistoV.php">Registe-se como voluntário</a>
                |
                <a href="RegistoI.php">Registe-se como instituição</a>
            </p>
        
        </form>

    </div>
    
    <footer>Todos os direitos reservados a Tiago Teodoro, Gonçalo Ventura, Renato Ramires e Margarida Rodrigues.</footer>

</body>
</html>