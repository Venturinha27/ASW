<!-- ASW -->
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
<link rel="stylesheet" href="CSS/AdminA.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="JavaScript/DCF.js"></script>

<!--
<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.php" class="w3-bar-item w3-button  w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" placeholder="Procura...">
        
        <a href="Perfil.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile w3-ambar"><i class="fa fa-user-circle"></i></a>
        <a href="Voluntarios.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

</header>
-->

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
                    <label><b>Instituição</b></label>
                    <input type="text" class="w3-input" name="instituicao" placeholder="Instituição"/>
                    <br>
                    <label><b>Titulo</b></label>
                    <input type="text" class="w3-input" name="titulo" placeholder="Titulo" name="titulo"/>
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
                </div>
                <div id="dir">
                    <label><b>Áreas de interesse:</b></label>
                    <select class="w3-input" name="area-interesse">
                        <option value="" disabled selected>Selecione as suas áreas de interesse</option>
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
                    <label><b>Função:</b></label>
                    <select class="w3-input" name="funcao">
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
                    <select class="w3-input" name="numvagas">
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

        $queryAcao = "SELECT I.id, I.nome_instituicao, A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao ";

        if (!empty($_POST['instituicao'])){
            $queryAcao .= "AND I.nome_instituicao = '".$_POST['instituicao']."' ";
        }

        if (!empty($_POST['titulo'])) {
            $queryAcao .= "AND A.titulo = '".$_POST['titulo']."' ";
        }

        if (!empty($_POST['distrito'])) {
            $queryAcao .= "AND A.distrito = '".$_POST['distrito']."' ";
        }

        if (!empty($_POST['concelho'])) {
            $queryAcao .= "AND A.concelho = '".$_POST['concelho']."' ";
        }

        if (!empty($_POST['freguesia'])) {
            $queryAcao .= "AND A.freguesia = '".$_POST['freguesia']."' ";
        }

        if (!empty($_POST['area-interesse'])) {
            $queryAcao .= "AND A.area_interesse = '".$_POST['area-interesse']."' ";
        }

        if (!empty($_POST['populacao-alvo'])) {
            $queryAcao .= "AND A.populacao_alvo = '".$_POST['populacao-alvo']."' ";
        }

        if (!empty($_POST['funcao'])) {
            $queryAcao .= "AND A.funcao = '".$_POST['funcao']."' ";
        }

        if (!empty($_POST['numvagas'])) {
            
            if ($_POST['numvagas'] == "0 a 10"){
                $queryAcao .= "AND A.num_vagas >= 0 AND A.num_vagas <= 10 ";
            }
            if ($_POST['numvagas'] == "11 a 20"){
                $queryAcao .= "AND A.num_vagas >= 11 AND A.num_vagas <= 20 ";
            }
            if ($_POST['numvagas'] == "21 a 30"){
                $queryAcao .= "AND A.num_vagas >= 21 AND A.num_vagas <= 30 ";
            }
            if ($_POST['numvagas'] == "31 a 40"){
                $queryAcao .= "AND A.num_vagas >= 31 AND A.num_vagas <= 40 ";
            }
            if ($_POST['numvagas'] == "41 a 50"){
                $queryAcao .= "AND A.num_vagas >= 41 AND A.num_vagas <= 50 ";
            }
            if ($_POST['numvagas'] == "51 a 60"){
                $queryAcao .= "AND A.num_vagas >= 51 AND A.num_vagas <= 60 ";
            }
            if ($_POST['numvagas'] == "61 a 70"){
                $queryAcao .= "AND A.num_vagas >= 61 AND A.num_vagas <= 70 ";
            }
            if ($_POST['numvagas'] == "71 a 80"){
                $queryAcao .= "AND A.num_vagas >= 71 AND A.num_vagas <= 80 ";
            }
            if ($_POST['numvagas'] == "81+"){
                $queryAcao .= "AND A.num_vagas >= 81 ";
            }
            
        }

        if (!empty($_POST['disponibilidade-dia']) and 
        !empty($_POST['disponibilidade-hora']) and
        !empty($_POST['disponibilidade-duracao'])) {

            $intervalo = intval($_POST['disponibilidade-hora']) + intval($_POST['disponibilidade-duracao']);

            $queryAcao .= "AND A.dia = '".$_POST['disponibilidade-dia']."'
                            AND A.hora >= ".$_POST['disponibilidade-hora']."
                            AND A.hora <= ".$intervalo." ";
        }

        $queryAcao .= "ORDER BY I.nome_instituicao ";
        
    } else {
        $queryAcao = "SELECT I.id, I.nome_instituicao, A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao
                        ORDER BY I.nome_instituicao";
    }

    #echo "<h1 class='entrou'>".$queryAcao."</h1>";

    $resultAcao = $conn->query($queryAcao);

    if (!($resultAcao)) {
        echo "Erro: search failed" . mysqli_error($conn);
    }       
    
    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-green w3-pale-green w3-small resultado'>";
    echo "<p>Encontrou ".($resultAcao->num_rows)." resultado(s) para a pesquisa.</p>";
    echo "</div>";

    
    if ($resultAcao->num_rows > 0) {

        echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='todosVol'>
            <tr class='w3-green'>
                <th>Instituição</th>
                <th>Titulo Ação</th>
                <th>Distrito</th>
                <th>Concelho</th>
                <th>Freguesia</th>
                <th>Função</th>
                <th>Área interesse</th>
                <th>População alvo</th>
                <th>Num. vagas</th>
                <th>Dia</th>
                <th>Hora</th>
                <th>Duração</th>
            </tr>";
        
        while ($row = $resultAcao->fetch_assoc()){
            echo "
            <tr>
                <td>".$row['nome_instituicao']."</td>
                <td>".$row['titulo']."</td>
                <td>".$row['distrito']."</td>
                <td>".$row['concelho']."</td>
                <td>".$row['freguesia']."</td>
                <td>".$row['funcao']."</td>
                <td>".$row['area_interesse']."</td>
                <td>".$row['populacao_alvo']."</td>
                <td>".$row['num_vagas']."</td>
                <td>".$row['dia']."</td>
                <td>".$row['hora']."</td>
                <td>".$row['duracao']."</td>
            </tr>
            ";
        }
        echo "</table><br><br><br>";
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