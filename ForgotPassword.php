<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Esqueceu a Palavra-Passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="CSS/EsqPass.css" type="text/css">
    <script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
</head>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.html" class="w3-bar-item w3-button w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" placeholder="Procura...">
        
        <a href="Login.html" class="w3-bar-item w3-button w3-blue w3-hover-blue w3-right w3-mobile"><i class="fa fa-user-circle"></i></a>
        <a href="Voluntarios.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.html" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>    
    </div>
</header>

<body>

    <div id="BrancoDiv" class="w3-container">

        <h2>Esqueci-me da Palavra-Passe</h2>

        <br>

    </div>

    <form id="registertext" action="ForgotPassword.php" method="post">
        <div id="Esqueci">
            <input type="text" class="w3-input" id="Email" placeholder="E-mail" name="Email" required>

            <input type="text" class="w3-input" id="telefone" placeholder="Telefone/Telemóvel" name="telefone" required>

            <input type="password" class="w3-input" id="novaPassword" placeholder="Nova Palavra-Passe" name="novaPassword" required>
            
            <input type="password" class="w3-input" id="confCassword" placeholder="Confirme a Palavra-Passe" name="confPassword" required>

            <input id="submit" type="submit" name="" value="Confirmar" href="Login.html">
        
            <?php
                include "openconn.php";


                if (!empty($_POST)){
                    $novaPassword = $_POST['novaPassword'];
                    $confPassword = $_POST['confPassword'];
                    $email = $_POST['Email'];
                    
                    $pegaEmailV = mysql_query("SELECT * FROM Voluntario WHERE email = '$email'");
                    $resultVoluntario = $conn->query($pegaEmailV);
                    
                    $pegaEmailI = mysql_query("SELECT * FROM instituicao WHERE email = '$email'");
                    $resultInstituicao = $conn->query($pegaEmailI);

                    if ($novaPassword == $confPassword){
                        if( $resultVoluntario->num_rows > 0 ) { // se retorna resultado
                            $query = mysql_query("UPDATE Voluntario SET password1 ='$_POST['novaPassword']' WHERE email = '$email'"  );
                          } else {
                            echo 'Não existe nenhum utilizador registado!';
                        }
                        if( $resultInstituicao->num_rows > 0 ) { // se retorna resultado
                            $query2 = mysql_query("UPDATE instituicao SET password2 ='$_POST['novaPassword']' WHERE email = '$email'"  );
                          } else {
                            echo 'Não existe nenhum utilizador registado!';
                        }

                    } else{
                        echo "As palavras-passes não coincidem"
                    }
                    
        
            ?>
        
        </div>
    </form>

    <div id="VolDiv" class="w3-container">

        <h3>Esqueceu-se da sua Palavra-Passe?</h3>

        <hr>

        <h5>Damos-lhe algumas dicas para a sua nova Palavra-Passe:</h5>

        <hr>

        <p>- Usar letras maíusculas;</p>
        <p>- Usar um ou mais números;</p>
        <p>- Usar uma palavra ou data que se lembre sempre;</p>
        <p>- Não use caracteres especiais.</p>

        <hr>

        <h4>Esperemos ter ajudado!</h4>

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
                <a href="Sobre.html"><li>Sobre</li></a>
                <br>
                <a href="#"><li>Publicações</li></a>
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

</body>
</html>