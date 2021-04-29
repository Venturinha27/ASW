
<?php
    ob_start();
    session_start();

    if ($_SESSION['loggedtype'] != "admin") {
        header("Location: LoginA.php");
    }
?>
<!DOCTYPE html>
<html>
<title>Administradores</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/AdminA.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/DCF.js"></script>
<script src="../JavaScript/AdminA.js"></script>

<body>
    <div id="Div">
        <br>
        <h1 class="w3-center" id="informacoesP">Informações Sobre:</h1>
        <div id="Options">
            <div id="voluntarioDiv">
                <a href="AdminV.php"><i class="fa fa-male" id="voluntarioIcon"></i></a>
                <h5 id="voluntarioP">Voluntários</p>
            </div>
            <div id="instituicaoDiv">
                <a href="AdminI.php"><i class="fa fa-building" id="instituicaoIcon"></i></a>
                <h5 id="instituicaoP">Instituições</p>
            </div>
            <div id="acaoDiv">
                <a href="Admin.php"><i class="fa fa-hands-helping" id="acaoIcon"></i></a>
                <h5 id="acaoP">Ações</p>
            </div>
        </div>
    </div>

    <div class="w3-container w3-small">
        <div id="filtrar">
                <div id="esq">
                    <label><b>Instituição</b></label>
                    <input type="text" class="w3-input" name="instituicao" placeholder="Instituição" id="instituicao"/>
                    <br>
                    <label><b>Titulo</b></label>
                    <input type="text" class="w3-input" name="titulo" placeholder="Titulo" name="titulo" id="titulo"/>
                    <br>
                    <label><b>Distrito:</b></label>
                    <select class="w3-input" name="distrito" id="distrito" size="1">
                        <option value="" disabled selected>Selecione o seu Distrito:</option>
                    </select> 
                    <br>
                    <label><b>Concelho:</b></label>
                    <select class="w3-input" name="concelho" id="concelho" size="1">
                        <option value="" disabled selected>Selecione o seu Concelho:</option>
                    </select> 
                    <br>
                    <label><b>Freguesia:</b></label>
                    <select class="w3-input" name="freguesia" id="freguesia" size="1">
                        <option value="" disabled selected>Selecione a sua Freguesia:</option>
                    </select>  
                    <br>
                    <label><b>Áreas de interesse:</b></label>
                    <select class="w3-input" name="area-interesse" id="area-interesse">
                        <option value="" disabled selected>Selecione as suas áreas de interesse</option>
                        <option value="Ação social">Ação social</option>
                        <option value="Educação">Educação</option>
                        <option value="Saúde">Saúde</option>
                    </select>
                </div>
                <div id="dir">
                    <label><b>População-alvo:</b></label>
                    <select class="w3-input" name="populacao-alvo" id="populacao-alvo">
                        <option value="" disabled selected>Selecione a sua população-alvo</option>
                        <option value="Indiferente">Indiferente</option>
                        <option value="Crianças">Crianças</option>
                        <option value="Jovens">Jovens</option>
                        <option value="Idosos">Idosos</option>
                        <option value="Grávidas">Grávidas</option>
                        <option value="Pessoas em situação de dependência (ex. acamados)">Pessoas em situação de dependência (ex. acamados)</option>
                        <option value="Pessoas sem-abrigo">Pessoas sem-abrigo</option>
                        <option value="Pessoas com deficiência">Pessoas com deficiência</option>
                    </select>
                    <br>
                    <label><b>Função:</b></label>
                    <select class="w3-input" name="funcao" id="funcao">
                        <option value="" disabled selected>Selecione a função</option>
                        <option value="Entrega ao Domicilio de bens não alimentares">Entrega ao Domicilio</option>
                        <option value="Entrega de Bens Alimentares">Entrega de Bens Alimentares</option>
                        <option value="Prestação de Cuidados Básicos">Prestação de Cuidados Básicos</option>
                        <option value="Apoio a Lares">Apoio a Lares</option>
                        <option value="Cozinhar">Cozinhar</option>
                        <option value="Limpar">Limpar</option>
                        <option value="Apoio à infância e à Juventude">Apoio à infância e à Juventude</option>
                        <option value="Apoio Social a familias Carenciadas">Apoio Social a familias Carenciadas</option>
                        <option value="Apoios à angariação de bens para Animais de Companhia">Apoios à angariação de bens para Animais de Companhia</option>
                    </select>
                    <br>
                    <label><b>Num. vagas</b></label>
                    <select class="w3-input" name="numvagas" id="numvagas">
                        <option value="" disabled selected>Num. vagas</option>
                        <option value="0 a 10">0 a 10</option>
                        <option value="11 a 20">11 a 20</option>
                        <option value="21 a 30">21 a 30</option>
                        <option value="31 a 40">31 a 40</option>
                        <option value="41 a 50">41 a 50</option>
                        <option value="51 a 60">51 a 60</option>
                        <option value="61 a 70">61 a 70</option>
                        <option value="71 a 80">71 a 80</option>
                        <option value="81+">81+</option>
                    </select>
                    <br>
                    <label><b>Data:</b></label>
                        <input type="date" class="w3-input" name="disponibilidade-dia" placeholder="Data (AAAA-MM-DD)" id="data"/>
                    <br>
                    <label><b>Ativa/Inativa:</b></label>
                        <select class="w3-input" name="ativa" id="ativa">
                            <option value="" disabled selected>Ativa/Inativa</option>
                            <option value="Ativa">Ativa</option>
                            <option value="Inativa">Inativa</option>
                        </select>
                </div>
                <input class="w3-button" id="limpaprocura" onclick="LimparProcura()" type="submit" value="Limpar"/>
                <input class="w3-button" id="procura" onclick="showAcoes()" type="submit" value="Procura"/>
            </div>
</div>

<div id="resultadosAcoes"></div>

</body>
