<!-- ASW -->
<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<title>Administradores</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="CSS/AdminC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>

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
                    <input type="text" class="w3-input" name="instituicao" placeholder="Instituição"/>
                    <br>
                    <input type="text" class="w3-input" name="titulo" placeholder="Titulo" name="titulo"/>
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
                    <label><b>Distrito</b></label>
                    <select class="w3-input" name="distrito">
                        <option value="" disabled selected>Distrito</option>
                        <option value="Aveiro">Aveiro</option>
                        <option value="Beja">Beja</option>
                        <option value="Braga">Braga</option>
                        <option value="Bragança">Bragança</option>
                        <option value="Castelo Branco">Castelo Branco</option>
                        <option value="Coimbra">Coimbra</option>
                        <option value="Évora">Évora</option>
                        <option value="Faro">Faro</option>
                        <option value="Guarda">Guarda</option>
                        <option value="Leiria">Leiria</option>
                        <option value="Lisboa">Lisboa</option>
                        <option value="Portalegre">Portalegre</option>
                        <option value="Porto">Porto</option>
                        <option value="Santarém">Santarém</option>
                        <option value="Setúbal">Setúbal</option>
                        <option value="Viana do Castelo">Viana do Castelo</option>
                        <option value="Vila Real">Vila Real</option>
                        <option value="Viseu">Viseu</option>
                        <option value="Região Autónoma Açores">Região Autónoma Açores</option>
                        <option value="Região Autónoma Madeira">Região Autónoma Madeira</option>
                    </select>
                    <br>
                    <label><b>Concelho</b></label>
                    <select class="w3-input" name="concelho">
                        <option value="" disabled selected>Concelho</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div id="dir">
                    <label><b>Freguesia</b></label>
                    <select class="w3-input" name="freguesia">
                        <option value="" disabled selected>Freguesia</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <br>
                    <label><b>Género</b></label>
                    <select class="w3-input" name="genero">
                        <option value="" disabled selected>Género</option>
                        <option value="Homem">Homem</option>
                        <option value="Mulher">Mulher</option>
                        <option value="Prefiro não dizer">Prefiro não dizer</option>
                    </select>
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
                </div>
                <input class="w3-button" id="procura" type="submit" value="Procura"/>
            </form>
</div>

<?php
    include "openconn.php";

    $queryAcao = "SELECT I.id, I.nome_instituicao, A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao
                        ORDER BY I.nome_instituicao";

    $resultAcao = $conn->query($queryAcao);

    if (!($resultAcao)) {
        echo "Erro: search failed" . mysqli_error($conn);
    }              

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
    if ($resultAcao->num_rows > 0) {
        
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
    }
    echo "</table><br><br><br>";
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
-->