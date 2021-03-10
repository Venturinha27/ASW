<!DOCTYPE html>
<html>
<title>Administradores</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="AdminC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="JavaScript/HomePageJS.js"></script>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.html" class="w3-bar-item w3-button  w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" placeholder="Procura...">
        
        <a href="Perfil.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile w3-ambar"><i class="fa fa-user-circle"></i></a>
        <a href="Voluntarios.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.html" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

</header>

<body>
    <div id="Div">
        <br>
        <h1 class="w3-center" id="informacoesP">Informações Sobre:</h1>
        <div id="Options">
            <div id="voluntarioDiv">
                <a href="#"><i class="fa fa-male" id="voluntarioIcon"></i></a>
                <h5 id="voluntarioP">Voluntário</p>
            </div>
            <div id="instituicaoDiv">
                <a href="#"><i class="fa fa-building" id="instituicaoIcon"></i></a>
                <h5 id="instituicaoP">Instituição</p>
            </div>
            <div id="todosDiv">
                <a href="#"><i class="fa fa-eye" id="todosIcon"></i></a>
                <h5 id="TodosP">Todos</p>
            </div>
        </div>
        <form action="admin.php" method="post" id="procura" class="w3-container">
            <input class="w3-input w3-border w3-light-grey"type="text" name="search" placeholder="Digite algo: Concelho/Freguesia/Idade/Nome"/>
            <input id="botao" type="submit" value= "PROCURAR"/>
        </form>
    </div>

<?php
    echo "goncalo";
?>

</body>

<footer>
    <div id="EndDiv">
    
        <ul id="endContactosL">
            <li>Tel.: 214938000</li>
            <li>Mail: VoluntárioCOVID19@gmail.com</li>
            <li>Morada: Rua D. Francisco, nº 92, Amadora </li>
        </ul>
    

        <div class="vl"></div>

        <ul id="endPaginas1">
            <a href="Sobre.html"><li>Sobre</li></a>
            <br>
            <a href="Publicacoes.html"><li>Publicações</li></a>
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