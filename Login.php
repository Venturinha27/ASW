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
        <form id="login" class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="w3-container w3-indigo">
                <h1 class="w3-center"><i class="fa fa-user-circle"></i></h1>
            </div>
            <br><br>
            <input class="w3-input w3-large" id="username" type="text" placeholder="Nome de utilizador ou e-mail" name="username" required>
            <br><br>
            <input class="w3-input w3-large" id="userpw" type="password" placeholder="Password"  name="password" required>
            <br><br>
            <input class="w3-large w3-indigo" id="submit" type="submit" name="" value="Entrar" href="HomePage.html">
            
            <?php

                // estabelecer ligação com a base de dados
                include "openconn.php";
                include "TestInput.php";

                if  (!empty($_POST)) {
                
                    // receber o pedido de login com segurança
                    $username = test_input($_POST['username']); #mysql_real_escape_string
                    $password = test_input($_POST['password']); #sha1

                    // verificar o utilizador em questão (pretendemos obter uma única linha de registos)
                    $loginquery = "SELECT I.id, I.nome_instituicao, I.email, I.password2
                                    FROM Instituicao I
                                    UNION
                                    SELECT V.id, V.nome_voluntario, V.email, V.password1
                                    FROM Voluntario V";

                    $resultLogin = $conn->query($loginquery);

                    if (!($resultLogin)) {
                        $erroG = "Algo correu mal.";
                        echo "<p class='w3-red w3-small'>$erroG</p>";
                    }

                    if ($resultLogin->num_rows > 0) {
                        $userExiste = 0;
                        while ($row = $resultLogin->fetch_array()) {
                            if (($row[1] == $username or $row[2] == $username) and ($password == $row[3])){

                                $tipoquery = "SELECT tipo, id
                                    FROM Utilizador
                                    WHERE id = '" . $row[0] . "'";

                                $resultTipo = $conn->query($tipoquery);

                                if (!($resultTipo)) {
                                    $erroG = "Algo correu mal.";
                                    echo "<p class='w3-red w3-small'>$erroG</p>";
                                }

                                if ($rowT = $resultTipo->fetch_array()) {
                                    if ($rowT[0] == 'voluntario'){
                                        $_SESSION['loggedtype'] = "voluntario";
                                        
                                        $_SESSION['opentype'] = "voluntario";
                                        
                                    } else {
                                        $_SESSION['loggedtype'] = "instituicao";
                                        $_SESSION['opentype'] = "instituicao";
                                    }
                                    $_SESSION['logged'] = $row[1];
                                    $_SESSION['loggedid'] = $row[0];
                                    $_SESSION['open'] = $row[1];
                                    $_SESSION['openid'] = $row[0];
                                    header("Location: Perfil.php");
                                }
                                
                            }
                            if ($row[1] == $username or $row[2] == $username) {
                                $userExiste = 1;
                            }
                        }
                        
                        if ($userExiste == 1) {
                            $erroP = "Password errada.";
                            echo "<p class='w3-red w3-small'>$erroP</p>";
                        } else {
                            $erroU = "Utilizador não existe.";
                            echo "<p class='w3-red w3-small'>$erroU</p>";
                        }
                        
                    } else {
                        $erroU = "Utilizador não existe.";
                        echo "<p class='w3-red w3-small'>$erroU</p>";
                    }
                }
                mysqli_close($conn);

            ?>
            
            <br>
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