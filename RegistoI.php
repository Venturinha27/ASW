<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Registo Instituição</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="CSS/RegistoI.css" type="text/css">
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

        <h2>Registo da Instituição</h2>

        <br>

    <form id="registertext" action="RegistoI.php" method="post">
        <div id="divEsq">
            <input type="text" class="w3-input" id="nomeInstituicao" placeholder="Nome da Instituição" name="nomeInstituicao" required>

            <input type="text" class="w3-input" id="telefone" placeholder="Telemóvel/Telefone" name="telefone" required>

            <input type="text" class="w3-input" id="morada" placeholder="Morada" name="morada" required>

            <input type="text" class="w3-input" id="distrito" placeholder="Distrito" name="distrito" required>
            
            <input type="text" class="w3-input" id="concelho" placeholder="Concelho" name="concelho" required>

            <input type="text" class="w3-input" id="freguesia" placeholder="Freguesia" name="freguesia" required>
            
        </div>
        <div id="divDir">
            
            <input type="text" class="w3-input" id="E-mail" placeholder="E-mail da Instituição" name="email" required>
            
            <input type="text" class="w3-input" id="website" placeholder="Website" name="website">
            
            <input type="text" class="w3-input" id="nomeRepresentante" placeholder="Nome do Representante da Instituição" name="nomeRepresentante" required>
            
            <input type="text" class="w3-input" id="emailRepresentante" placeholder="E-mail do Representante da Instituição" name="nomeInstituicao" required>
            
            <input type="password" class="w3-input" id="password" placeholder="Palavra-Passe" name="password" required>
            
            <input id="submit" type="submit" value="Registo">

            <p id="home">Já tem conta? Efetue aqui o seu <a href="Login.html" id="login">Login</a></p>
        </div>

    </form>

    <?php
        include "openconn.php";

        $nomeInstituicao = $_POST['nomeInstituicao'];
        $telefone = $_POST['telefone'];
        $morada = $_POST['morada'];
        $distrito = $_POST['distrito'];
        $concelho = $_POST['concelho'];
        $freguesia = $_POST['freguesia'];
        $email = $_POST['email'];
        $website = $_POST['website'];
        $nomeRepresentante = $_POST['nomeRepresentante'];
        $nomeInstituicao = $_POST['nomeInstituicao'];
        $password = $_POST['password'];

        echo $nomeInstituicao;
        echo $telefone;
        echo $morada;
        echo $distrito;
        echo $concelho;
        echo $freguesia;
        echo $email;
        echo $website;
        echo $nomeRepresentante;
        echo $nomeInstituicao;
        echo $password;
    ?>



    </div>

    <div id="VolDiv" class="w3-container">

        <h3>Como posso contribuir?</h3>

        <hr>

        <h5>O que são instituições de voluntariado?</h5>

        <p>As instituições de Voluntariado são um espaço de encontro entre as pessoas que expressam a sua disponibilidade e vontade para serem voluntárias e as organizações promotoras, interessadas em integrar voluntários/as nos seus projetos e coordenar o exercício da sua atividade.</p>

        <hr>

        <h5>Objetivos das instituições:</h5>

        <p>- Acolher candidaturas de pessoas interessadas em fazer Voluntariado, bem como receber solicitações de voluntários/as;</p>
        <p>- Proceder ao encaminhamento de voluntários/as para ações de Voluntariado;</p>
        <p>- Disponibilizar ao público informações sobre o Voluntariado;</p>
        <p>- Organizar ações de formação inicial para os/as voluntários/as.</p>

        <hr>

        <h4>Vem ajudar!</h4>

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