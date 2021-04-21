
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    session_start();
    ob_start();
    
    include "../Controller/PreferenciasVController.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Preferências Voluntário</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/PreferenciasV.css" type="text/css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/PreferenciasV.js"></script>
<link rel="stylesheet" href="../CSS/ProcuraC.css">
<script src="../JavaScript/ProcuraJS.js"></script>
</head>

<body>

    <div id="BrancoDiv" class="w3-container">

        <h2>Preferências</h2>

        <br>

    <div id="registertext">

            <label><b>Áreas de interesse:</b></label>
            <select class="w3-select sela" id="sel-area-interesse" name="area-interesse" required>
                <option value="" disabled selected>Selecione uma área de interesse</option>
                <option value="Ação social">Ação social</option>
                <option value="Educação">Educação</option>
                <option value="Saúde">Saúde</option>
            </select>

            <input class="w3-green w3-round-xxlarge" onclick="addArea()" type="submit" value="+" name="submitA">

            <?php     

                echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>
                <ul class='w3-ul w3-center' id='ularea'></ul>
                </div>";
            
            ?>

            <hr>
            
            <label><b>População-alvo:</b></label>
                <select class="w3-select selp" id="sel-populacao" name="populacao-alvo" required>
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

                <input class="w3-green w3-round-xxlarge" onclick="addPopulacao()" type="submit" value="+" name="submitP">
            </form>

            <?php

                echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>
                <ul class='w3-ul w3-center' id='ulpopulacao'></ul>
                </div>";
            
            ?>

            <hr>
            
            <label><b>Disponibilidade:</b></label>
                <select class="w3-select disponibilidade" id="sel-dia" name="disponibilidade-dia" required>
                    <option value="" disabled selected>Dia</option>
                    <option value="Segunda-feira">Segunda-feira</option>
                    <option value="Terça-feira">Terça-feira</option>
                    <option value="Quarta-feira">Quarta-feira</option>
                    <option value="Quinta-feira">Quinta-feira</option>
                    <option value="Sexta-feira">Sexta-feira</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                </select>
                <select class="w3-select disponibilidade" id="sel-hora" name="disponibilidade-hora" required>
                    <option value="" disabled selected>Hora</option>
                    <option value="00:00">00:00</option>
                    <option value="01:00">01:00</option>
                    <option value="02:00">02:00</option>
                    <option value="03:00">03:00</option>
                    <option value="04:00">04:00</option>
                    <option value="05:00">05:00</option>
                    <option value="06:00">06:00</option>
                    <option value="07:00">07:00</option>
                    <option value="08:00">08:00</option>
                    <option value="09:00">09:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                    <option value="21:00">21:00</option>
                    <option value="22:00">22:00</option>
                    <option value="23:00">23:00</option>
                </select>
                <select class="w3-select disponibilidade" id="sel-duracao" name="disponibilidade-duracao" required>
                    <option value="" disabled selected>Duração</option>
                    <option value="1">01:00</option>
                    <option value="2">02:00</option>
                    <option value="3">03:00</option>
                    <option value="4">04:00</option>
                    <option value="5">05:00</option>
                    <option value="6">06:00</option>
                    <option value="7">07:00</option>
                    <option value="8">08:00</option>
                </select>
                
                <input class="w3-green w3-round-xxlarge" onclick="addDisponibilidade()" type="submit" value="+" name="submitD">
            </form>

            <?php

                echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>
                <ul class='w3-ul w3-center' id='uldisponibilidade'></ul>
                </div>";
            
            ?>

            <hr>

            <div id="avancardiv"></div>
    </div>


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
            <li>Tel.: 93-77-tira-tira-mete-mete</li>
            <li>Mail: VoluntárioCOVID19@mail.com</li>
            <li>Morada: Rua D. Francisco, nº 92, Amadora city</li>
        </ul>
    

        <div class="vl"></div>

        <ul id="endPaginas1">
            <a href="Sobre.php"><li>Sobre</li></a>
            <br>
            <a href="Publicacoes.php"><li>Publicações</li></a>
            <br>
            <a href="Covid19.php"><li>COVID-19</li></a>
        </ul>
        <ul id="endPaginas2">
            <a href="Instituicoes.php"><li>Instituições</li></a>
            <br>
            <a href="Voluntarios.php"><li>Voluntários</li></a>
        </ul>

        <p id="endD">Todos os direitos reservados a Gonçalo Ventura, Margarida Rodrigues, Renato Ramires e Tiago Teodoro</p>
    </div>
</footer>

</body>
</html>