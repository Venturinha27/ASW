<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
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
<link rel="stylesheet" href="../CSS/AdminV.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/DCF.js"></script>

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
                <a href="AdminA.php"><i class="fa fa-hands-helping" id="acaoIcon"></i></a>
                <h5 id="acaoP">Ações</p>
            </div>
        </div>
        <!--
        <form action="admin.php" method="post" id="procura" class="w3-container">
            <input class="w3-input w3-border w3-light-grey"type="text" name="search" placeholder="Digite algo: Concelho/Freguesia/Idade/Nome"/>
            <input id="botao" type="submit" value= "PROCURAR"/>
        </form>-->
    </div>

    <div class="w3-container w3-small">
        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method="post" id="filtrar">
                <div id="esq">
                    <label><b>Nome</b></label>
                    <input type="text" class="w3-input" name="nome" placeholder="Nome" name="nome"/>
                    <br>
                    <label><b>Idade</b></label>
                    <select class="w3-input" name="idade">
                        <option value="" disabled selected>Idade</option>
                        <option value="10 aos 20">10 aos 20</option>
                        <option value="21 aos 30">21 aos 30</option>
                        <option value="31 aos 40">31 aos 40</option>
                        <option value="41 aos 50">41 aos 50</option>
                        <option value="51 aos 60">51 aos 60</option>
                        <option value="61 aos 70">61 aos 70</option>
                        <option value="71 aos 80">71 aos 80</option>
                        <option value="81+">81+</option>
                    </select>
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
                    <label><b>Género</b></label>
                    <select class="w3-input" name="genero">
                        <option value="" disabled selected>Género</option>
                        <option value="Homem">Homem</option>
                        <option value="Mulher">Mulher</option>
                        <option value="Prefiro não dizer">Prefiro não dizer</option>
                    </select>
                </div>
                <div id="dir">
                    <label><b>Email</b></label>
                    <input type="text" class="w3-input" name="email" placeholder="Email" name="email"/>
                    <br>
                    <label><b>Carta de Condução</b></label>
                    <select class="w3-input" name="carta">
                        <option value="" disabled selected>Carta de condução</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                    <br>
                    <label><b>Já esteve infetado com o Covid-19?</b></label>
                    <select class="w3-input" name="covid">
                        <option value="" disabled selected>Esteve infetado</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                    <br>
                    <label><b>Áreas de interesse:</b></label>
                    <select class="w3-input" name="area-interesse">
                        <option value="" disabled selected>Área de interesse</option>
                        <option value="Ação social">Ação social</option>
                        <option value="Educação">Educação</option>
                        <option value="Saúde">Saúde</option>
                    </select>
                    <br>
                    <label><b>População-alvo:</b></label>
                    <select class="w3-input" name="populacao-alvo">
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
                    <label><b>Disponibilidade:</b></label>
                    <br>
                    <select class="w3-input dis" name="disponibilidade-dia">
                        <option value="" disabled selected>Dia</option>
                        <option value="Segunda-feira">Segunda-feira</option>
                        <option value="Terça-feira">Terça-feira</option>
                        <option value="Quarta-feira">Quarta-feira</option>
                        <option value="Quinta-feira">Quinta-feira</option>
                        <option value="Sexta-feira">Sexta-feira</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                    <select class="w3-input dis" name="disponibilidade-hora">
                        <option value="" disabled selected>Hora</option>
                        <option value="00:00">00:00</option>
                        <option value="1">01:00</option>
                        <option value="2">02:00</option>
                        <option value="3">03:00</option>
                        <option value="4">04:00</option>
                        <option value="5">05:00</option>
                        <option value="6">06:00</option>
                        <option value="7">07:00</option>
                        <option value="8">08:00</option>
                        <option value="9">09:00</option>
                        <option value="10">10:00</option>
                        <option value="11">11:00</option>
                        <option value="12">12:00</option>
                        <option value="13">13:00</option>
                        <option value="14">14:00</option>
                        <option value="15">15:00</option>
                        <option value="16">16:00</option>
                        <option value="17">17:00</option>
                        <option value="18">18:00</option>
                        <option value="19">19:00</option>
                        <option value="20">20:00</option>
                        <option value="21">21:00</option>
                        <option value="22">22:00</option>
                        <option value="23">23:00</option>
                    </select>
                    <select class="w3-input dis" name="disponibilidade-duracao">
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
                    
                </div>
                <input class="w3-button" id="procura" type="submit" value="Procura"/>
            </form>
</div>

<?php
    include "openconn.php"; 

    if (!empty($_POST)){

        $primeiro = 0;

        $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                            , distrito, freguesia, telefone, cc, carta_c, covid, email
                            FROM Voluntario ";

        if (!empty($_POST['nome'])){
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE nome_voluntario = '".$_POST['nome']."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND nome_voluntario = '".$_POST['nome']."' ";
            }
        }

        if (!empty($_POST['email'])) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE email = '".$_POST['email']."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND email = '".$_POST['email']."' ";
            }
        }

        if (!empty($_POST['idade'])) {
            
            if ($_POST['idade'] == "10 aos 20") {
                $time1 = strtotime("-10 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-20 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($_POST['idade'] == "21 aos 30") {
                $time1 = strtotime("-20 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-30 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($_POST['idade'] == "31 aos 40") {
                $time1 = strtotime("-30 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-40 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($_POST['idade'] == "41 aos 50") {
                $time1 = strtotime("-40 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-50 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($_POST['idade'] == "51 aos 60") {
                $time1 = strtotime("-50 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-60 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($_POST['idade'] == "61 aos 70") {
                $time1 = strtotime("-60 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-70 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($_POST['idade'] == "71 aos 80") {
                $time1 = strtotime("-70 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-80 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($_POST['idade'] == "81+") {
                $time1 = strtotime("-80 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-150 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
            }
        }

        if (!empty($_POST['distrito'])) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE distrito = '".$_POST['distrito']."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND distrito = '".$_POST['distrito']."' ";
            }
        }

        if (!empty($_POST['concelho'])) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE concelho = '".$_POST['concelho']."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND concelho = '".$_POST['concelho']."' ";
            }
        }

        if (!empty($_POST['freguesia'])) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE freguesia = '".$_POST['freguesia']."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND freguesia = '".$_POST['freguesia']."' ";
            }
        }

        if (!empty($_POST['genero'])) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE genero = '".$_POST['genero']."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND genero = '".$_POST['genero']."' ";
            }
        }

        if (!empty($_POST['carta'])) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE carta_c = '".$_POST['carta']."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND carta_c = '".$_POST['carta']."' ";
            }
        }

        if (!empty($_POST['covid'])) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE covid = '".$_POST['covid']."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND covid = '".$_POST['covid']."' ";
            }
        }

        if (!empty($_POST['area-interesse'])) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Area
                                    WHERE area = '".$_POST['area-interesse']."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Area
                                    WHERE area = '".$_POST['area-interesse']."') ";
            }
        }

        if (!empty($_POST['populacao-alvo'])) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Populacao_Alvo
                                    WHERE populacao_alvo = '".$_POST['populacao-alvo']."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Populacao_Alvo
                                    WHERE populacao_alvo = '".$_POST['populacao-alvo']."') ";
            }
        }

        if (!empty($_POST['disponibilidade-dia']) and 
        !empty($_POST['disponibilidade-hora']) and
        !empty($_POST['disponibilidade-duracao'])) {

            $intervalo = intval($_POST['disponibilidade-hora']) + intval($_POST['disponibilidade-duracao']);

            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Disponibilidade
                                    WHERE dia = '".$_POST['disponibilidade-dia']."'
                                        AND hora >= ".$_POST['disponibilidade-hora']."
                                        AND hora <= ".$intervalo.") ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Disponibilidade
                                    WHERE dia = '".$_POST['disponibilidade-dia']."'
                                        AND hora >= ".$_POST['disponibilidade-hora']."
                                        AND hora <= ".$intervalo.") ";
            }
        }

        $queryVoluntario .= "ORDER BY nome_voluntario ";
        
        #echo "<h1 class='entrou'>".$queryVoluntario."</h1>";

        #echo "<h1 class='entrou'>".$queryVoluntario."</h1>";
        
        #echo "<h1 class='entrou'>".$today."</h1>";
        #echo "<h1 class='entrou'>".$_POST['idade']."</h1>";
        #echo "<h1 class='entrou'>".$_POST['distrito']."</h1>";
        #echo "<h1 class='entrou'>".$_POST['concelho']."</h1>";
        #echo "<h1 class='entrou'>".$_POST['freguesia']."</h1>";
        #echo "<h1 class='entrou'>".$_POST['genero']."</h1>";
        #echo "<h1 class='entrou'>".$_POST['carta']."</h1>";
        #echo "<h1 class='entrou'>".$_POST['covid']."</h1>";
    } else {
        $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                    , distrito, freguesia, telefone, cc, carta_c, covid, email
                    FROM Voluntario
                    ORDER BY nome_voluntario;";
    }

    $resultVoluntario = $conn->query($queryVoluntario);

    if (!($resultVoluntario)) {
        echo "Erro: search failed" . mysqli_error($conn);
    }     
    
    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-red w3-pale-red w3-small resultado'>";
    echo "<p>Encontrou ".($resultVoluntario->num_rows)." resultado(s) para a pesquisa.</p>";
    echo "</div>";

    if ($resultVoluntario->num_rows > 0) {

        echo "<table class='w3-table w3-striped w3-tiny w3-hoverable w3-middle' id='todosVol'>
            <tr class='w3-red'>
                <th>Nome</th>
                <th>Bio</th>
                <th>Data Nascimento</th>
                <th>Género</th>
                <th>Distrito</th>
                <th>Concelho</th>
                <th>Freguesia</th>
                <th>Tel.</th>
                <th>CC</th>
                <th>Carta C.</th>
                <th>Covid</th>
                <th>Email</th>
                <th>Áreas Interesse</th>
                <th>População Alvo</th>
                <th>Disponibilidade</th>
            </tr>";
        
        while ($row = $resultVoluntario->fetch_assoc()){
            echo "
            <tr>
                <td><p>".$row['nome_voluntario']."</p></td>
                <td><p>".$row['bio']."</p></td>
                <td><p>".$row['data_nascimento']."</p></td>
                <td><p>".$row['genero']."</p></td>
                <td><p>".$row['distrito']."</p></td>
                <td><p>".$row['concelho']."</p></td>
                <td><p>".$row['freguesia']."</p></td>
                <td><p>".$row['telefone']."</p></td>
                <td><p>".$row['cc']."</p></td>
                <td><p>".$row['carta_c']."</p></td>
                <td><p>".$row['covid']."</p></td>
                <td><p>".$row['email']."</p></td>";

                $queryArea = "SELECT id_voluntario, area
                    FROM Voluntario_Area
                    WHERE id_voluntario = '".$row['id']."'";

                $resultArea = $conn->query($queryArea);            

                echo "<td>";
                if ($resultArea->num_rows > 0) {
                    while ($rowA = $resultArea->fetch_assoc()){
                        echo "<p>" . $rowA['area'] . "</p>";
                    }
                }
                echo "</td>";

                $queryPopulacao = "SELECT id_voluntario, populacao_alvo
                    FROM Voluntario_Populacao_Alvo
                    WHERE id_voluntario = '".$row['id']."'";

                $resultPopulacao = $conn->query($queryPopulacao);            

                echo "<td>";
                if ($resultPopulacao->num_rows > 0) {
                    while ($rowP = $resultPopulacao->fetch_assoc()){
                        echo "<p>" . $rowP['populacao_alvo'] . "</p>";
                    }
                }
                echo "</td>";

                $queryDispo = "SELECT id_voluntario, dia, hora, duracao
                    FROM Voluntario_Disponibilidade
                    WHERE id_voluntario = '".$row['id']."'";

                $resultDispo = $conn->query($queryDispo);            

                echo "<td>";
                if ($resultDispo->num_rows > 0) {
                    while ($rowD = $resultDispo->fetch_assoc()){
                        echo "<p>" . $rowD['dia'] . ", às ". $rowD['hora'] .", durante ". $rowD['duracao'] ." horas.</p>";
                    }
                }
                echo "</td>";

            echo "</tr>
            ";
        }
        echo "</table>";
    }
?>

</body>
<!--
<footer>
    <div id="EndDiv">
    
        <ul id="endContactosL">
            <li>Tel.: 214938000</li>
            <li>Mail: VoluntárioCOVID19@gmail.com</li>
            <li>Morada: Rua D. Francisco, nº 92, Amadora </li>
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
-->