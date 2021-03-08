<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Preferências Voluntário</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="CSS/PreferenciasV.css" type="text/css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="JavaScript/PreferenciasV.js"></script>
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

        <h2>Preferências</h2>

        <br>

    <div id="registertext">

            <form action="PreferenciasV.php" method="post">
                <label>Áreas de interesse:</label>
                    <select class="w3-select sela" name="area-interesse" required>
                        <option value="" disabled selected>Selecione uma área de interesse</option>
                        <option value="Ação social">Ação social</option>
                        <option value="Educação">Educação</option>
                        <option value="Saúde">Saúde</option>
                    </select>

                <input class="w3-green w3-round-xxlarge" type="submit" value="+" name="submitA">
            </form>

            <?php
                include "openconn.php";

                $voluntario = $_SESSION['loggedid'];
                    
                $sqlArea = "SELECT area
                            FROM Voluntario_Area
                            WHERE id_voluntario = '".$voluntario."';";

                $resultA = $conn->query($sqlArea);
                
                if (!($resultA)) {
                    echo "Erro: search failed" . $query . "<br>" . mysqli_error($conn);
                }              

                if ($resultA->num_rows > 0) {

                    echo "<div class='w3-container w3-light-grey'>";                    
                    while ($row = $resultA->fetch_assoc()){
                        echo "<p class='w3-center'> -> " . $row['area'] . " </p>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='w3-container w3-light-grey'>
                            <p class='w3-center'>Ainda não tem áreas de interesse.</p>
                        </div>";
                }

                mysqli_close($conn);
            
            ?>

            <hr>
            
            <form action="PreferenciasV.php" method="post">
                <label>População-alvo:</label>
                    <select class="w3-select selp" name="populacao-alvo">
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

                <input class="w3-green w3-round-xxlarge" type="submit" value="+" name="submitP">
            </form>

            <?php
                include "openconn.php";

                $voluntario = $_SESSION['loggedid'];
                    
                $sqlPopulacao = "SELECT populacao_alvo
                            FROM Voluntario_Populacao_Alvo
                            WHERE id_voluntario = '".$voluntario."';";

                $resultP = $conn->query($sqlPopulacao);
                
                if (!($resultP)) {
                    echo "Erro: search failed" . $query . "<br>" . mysqli_error($conn);
                }              

                if ($resultP->num_rows > 0) {

                    echo "<div class='w3-container w3-light-grey'>";                    
                    while ($row = $resultP->fetch_assoc()){
                        echo "<p class='w3-center'> -> " . $row['populacao_alvo'] . " </p>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='w3-container w3-light-grey'>
                            <p class='w3-center'>Ainda não tem nenhuma população-alvo.</p>
                        </div>";
                }

                mysqli_close($conn);
            
            ?>

            <hr>
            
            <form action="PreferenciasV.php" method="post">
                <label>Disponibilidade:</label>
                    <select class="w3-select disponibilidade" name="disponibilidade-dia">
                        <option value="" disabled selected>Dia</option>
                        <option value="Segunda-feira">Segunda-feira</option>
                        <option value="Terça-feira">Terça-feira</option>
                        <option value="Quarta-feira">Quarta-feira</option>
                        <option value="Quinta-feira">Quinta-feira</option>
                        <option value="Sexta-feira">Sexta-feira</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                    <select class="w3-select disponibilidade" name="disponibilidade-hora">
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
                    <select class="w3-select disponibilidade" name="disponibilidade-duracao">
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
                
                <input class="w3-green w3-round-xxlarge" type="submit" value="+" name="submitD">
            </form>

            <?php
                include "openconn.php";

                $voluntario = $_SESSION['loggedid'];
                    
                $sqlDisponibilidade = "SELECT dia, hora, duracao
                            FROM Voluntario_Disponibilidade
                            WHERE id_voluntario = '".$voluntario."';";

                $resultD = $conn->query($sqlDisponibilidade);
                
                if (!($resultD)) {
                    echo "Erro: search failed" . $query . "<br>" . mysqli_error($conn);
                }              

                if ($resultD->num_rows > 0) {

                    echo "<div class='w3-container w3-light-grey'>";                    
                    while ($row = $resultD->fetch_assoc()){
                        echo "<p class='w3-center'> -> Dia " . $row['dia'] . "
                                                    ás ". $row['hora'] ." horas, durante "
                                                    .$row['duracao']." </p>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='w3-container w3-light-grey'>
                            <p class='w3-center'>Ainda não tem disponibilidade.</p>
                        </div>";
                }

                mysqli_close($conn);
            
            ?>

            <hr>

            <?php
                include "openconn.php";
                include "TestInput.php";

                $voluntario = $_SESSION['loggedid'];

                if ($_POST['submitA']) {
                    $area_interesse = $_POST['area-interesse'];

                    $insertArea = "insert into Voluntario_Area
                                    values ('".$voluntario."' , '".$area_interesse."')";

                    $resArea = mysqli_query($conn, $insertArea);
                    
                    if ($resArea) {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }

                if ($_POST['submitP']) {
                    $populacao_alvo = $_POST['populacao-alvo'];

                    $insertPopulacao = "insert into Voluntario_Populacao_Alvo
                                    values ('".$voluntario."' , '".$populacao_alvo."')";

                    $resPopulacao = mysqli_query($conn, $insertPopulacao);
                    
                    if ($resPopulacao) {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }

                if ($_POST['submitD']) {
                    $dia = $_POST['disponibilidade-dia'];
                    $hora = $_POST['disponibilidade-hora'];
                    $duracao = $_POST['disponibilidade-duracao'];

                    $insertDispo = "insert into Voluntario_Disponibilidade
                                    values ('".$voluntario."' , '".$dia."' ,
                                     '".$hora."' , '".$duracao."')";

                    $resDispo = mysqli_query($conn, $insertDispo);
                    
                    if ($resDispo) {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }

            ?>

            <a href="Perfil.php"><button id="avancar">Avançar</button></a>

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