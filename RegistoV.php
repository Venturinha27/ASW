<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Registo Voluntário</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="CSS/RegistoV.css" type="text/css">
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

        <h2>Registo do Voluntário</h2>

        <br>

    <form id="registertext" action="RegistoV.php" method="post">
        <div id="divEsq">
            <input type="text" class="w3-input" id="nomeProprio" placeholder="Nome Completo" name="nomeProprio" required />

            <input type="text" class="w3-input" id="E-mail" placeholder="E-mail" name="E-mail"required/>

            <input type="password" class="w3-input" id="Password" placeholder="Palavra-Passe" name="Password"required/>

            <input type="text" class="w3-input" id="telefone" placeholder="Telemóvel/Telefone" name="telefone"required/>

            <input type="date" class="w3-input" id="dataNascimento" placeholder="Data de Nascimento" name="dataNascimento" required/>

            <input type="text" class="w3-input" id="CC" placeholder="Cartão de Cidadão" name="CC"required/>

            <label>Fotografia de Perfil </label>
            <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">

        </div>
        <div id="divDir">

            <input type="text" class="w3-input" id="distrito" placeholder="Distrito" name="distrito"required/>

            <input type="text" class="w3-input" id="concelho" placeholder="Concelho" name="concelho"required/>

            <input type="text" class="w3-input" id="freguesia" placeholder="Freguesia" name="freguesia"required/>

            <label>Género</label>
            <select class="w3-select" name="genero">
                <option value="" disabled selected>Selecione o seu género</option>
                <option value="homem">Homem</option>
                <option value="mulher">Mulher</option>
                <option value="outro">Prefiro não dizer</option>
            </select>

            <label>Carta de Condução</label>
            <select class="w3-select" name="carta">
                <option value="" disabled selected>Selecione se tem carta de condução</option>
                <option value="sim">Sim</option>
                <option value="nao">Não</option>
            </select>

            <label>Já esteve infetado com o Covid-19?</label>
            <select class="w3-select" name="covid">
                <option value="" disabled selected>Selecione se já esteve infetado</option>
                <option value="sim">Sim</option>
                <option value="nao">Não</option>
            </select>

            <input id="submit" type="submit" name="" value="Registar" href="InformacoesV.html">
            
            <?php
                include "openconn.php";

                if ($_POST['nomeProprio'] != ''){

                    $id = uniqid();
                    $nomeProprio = $_POST['nomeProprio']; 
                    $Email = $_POST['E-mail'];                       #unique
                    $Password = $_POST['Password'];
                    $telefone = $_POST['telefone'];
                    $dataNascimento = $_POST['dataNascimento'];
                    $CC = $_POST['CC'];                              #unique
                    $avatar = $_POST['avatar']; 
                    $distrito = $_POST['distrito'];
                    $concelho = $_POST['concelho'];
                    $freguesia = $_POST['freguesia'];
                    $genero = $_POST['genero'];
                    $carta = $_POST['carta']; 
                    $covid = $_POST['covid'];

                    $check = 0;

                    $sqlNome = "SELECT nome_voluntario, email
                                FROM Voluntario";    

                    $resultN = $conn->query($sqlNome);

                    if ($resultN->num_rows > 0) {

                        while ($row = $resultN->fetch_assoc()){
                            echo "<p class='w3-blue w3-center'>".$row['nomeProprio']." </p>";
                            echo "<p class='w3-blue w3-center'> $nomeProprio </p>";
                            if ($row["nome_instituicao"] != $nomeProprio and $row["email"] != $email){
                                if (filter_var($Email, FILTER_VALIDATE_EMAIL) ){
                                    $check = 1;
                                } else {
                                    echo "<p class='w3-red w3-center'> Insira um e-mail válido </p>";
                                }
                            } else {
                                echo "<p class='w3-red w3-center'> Username ou email já existe </p>";
                            }
                        }
                    } else {
                        echo "<p class='w3-green w3-center'>".$row['nome_instituicao']." </p>";
                        $check = 1;
                    }

                    echo "<p class='w3-green w3-center'>".$check." </p>";

                    if ($check == 1){

                        $query1 = "insert into Utilizador
                                values ('".$id."' , 'voluntario')";
                        
                        $res1 = mysqli_query($conn, $query1);
                        
                        if ($res1) {
                        } else {
                            echo "<p class='w3-red w3-center'> Algo deu ruim :( </p>";
                        }


                        $query = "insert into Voluntario
                                values ('".$id."' , '".$nomeProprio."' , ".$Email." , '".$Password."' , '"
                                .$telefone."' , '".$dataNascimento."' , '".$CC."' , '".$avatar."' , '".$distrito."' , '"
                                .$concelho."' , '".$freguesia."' , '".$genero."' , '".$carta."' , '".$covid."')";
                        
                        $res = mysqli_query($conn, $query);
                        
                        if ($res) {
                            $_SESSION['loggedtype'] = "voluntario";
                            $_SESSION['logged'] = $nomeProprio;
                            header("Location: PreferenciasV.php");
                        } else {
                            echo "<p class='w3-red w3-center'> Algo correu mal :( </p>";
                        }

                        mysqli_close($conn);
                }
                }
            
            ?>
            
            
            
            
            <p id="home">Já tem conta? Efetue aqui o seu <a href="Login.html" id="login">Login</a></p>

        </div> 
        
    </form>
    </div>

    <div id="VolDiv" class="w3-container">

        <h3>Como posso contribuir?</h3>

        <hr>

        <h5>O que é um voluntário?</h5>

        <p>É o indivíduo que de forma livre, desinteressada e responsável se compromete, de acordo com as suas aptidões próprias e no seu tempo livre, a realizar ações de voluntariado no âmbito de uma organização promotora.
            A qualidade de voluntário/a não pode, de qualquer forma, decorrer de relação de trabalho subordinado ou autónomo ou de qualquer relação de conteúdo patrimonial com a organização promotora, sem prejuízo de regimes especiais constantes da Lei.</p>

        <hr>

        <h5>Ser voluntário/a é:</h5>

        <p>- Assumir um compromisso com a organização promotora de voluntariado;</p>
        <p>- Desenvolver ações de voluntariado em prol dos indivíduos, famílias e comunidade;</p>
        <p>- Comprometer-se, de acordo com as suas aptidões e no seu tempo livre;</p>

        <hr>

        <h4>Vem ajudar!</h4>

    </div>
    
    

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