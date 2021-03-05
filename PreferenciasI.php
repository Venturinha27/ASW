<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Ação de Voluntariado</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="CSS/PreferenciasI.css" type="text/css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="JavaScript/PreferenciasI.js"></script>
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

        <h2>Adicione ações à sua instituição</h2>

        <br>

    <div id="registertext">
                
            <hr>

            <label>Ações promovidas pela instituição:</label>
            <div id="acoes">
                <div id="addacao">
                    <h4 class="w3-button w3-block w3-center w3-indigo">Adiciona ação</h4>
                </div>

                <?php

                    include "openconn.php";

                    $instituicao = $_SESSION['logged'];
                    
                    $sqlNome = "SELECT id_instituicao, id_acao, titulo, distrito, concelho, freguesia, funcao, 
                                area_interesse, populacao_alvo, num_vagas, dia, hora, semana, duracao
                                FROM Acao
                                WHERE id_instituicao = '".$_SESSION['loggedid']."';";

                    $resultN = $conn->query($sqlNome);
                    
                    if (!($resultN)) {
                        echo "Erro: search failed" . $query . "<br>" . mysqli_error($conn);
                    }              

                    if ($resultN->num_rows > 0) {

                        while ($row = $resultN->fetch_assoc()){

                            echo "<div class='w3-card-4'>
                                        <header class='w3-container'>
                                            <h3>".$instituicao."</h3>
                                        </header>

                                        <div class='w3-container'>
                                            <h5>".$row['titulo']."</h5>
                                            <hr>
                                            <p>Distrito: ".$row['distrito']." <i class='fa fa-deviantart'></i> Concelho: ".$row['concelho']." <i class='fa fa-deviantart'></i> Freguesia: ".$row['freguesia']."</p>
                                            <p>Função: ".$row['funcao']." <i class='fa fa-deviantart'></i> Área de interesse: ".$row['area_interesse']."</p>
                                            <p>População-alvo: ".$row['populacao_alvo']." <i class='fa fa-deviantart'></i> Nº de vagas: ".$row['num_vagas']."</p>
                                            <p>Data: ".$row['dia'].", ás ".$row['hora'].":00, durante ".$row['duracao']." horas</p>
                                        </div>
                                </div>";
                        }
                    } else {
                        echo "<h3 class='w3-center'>Ainda não tem ações :(</h3>";
                    }
                        /*
                        

                        </div>*/

                    mysqli_close($conn);
                ?>
                
            </div>

            <a href="Perfil.html"><button class="submitr w3-round-xxlarge">Avançar</button></a>

        </div>

    <form id="acaoform" class="w3-container hidden" action="PreferenciasI.php" method="post">

            <header class="w3-container w3-indigo">
                <h3>Nova ação</h3>
            </header>
            <br>

            <input type="text" class="w3-input" id="tituloAcao" placeholder="Titulo da ação" name="titulo" required>

            <hr>

            <label>Áreas de interesse:</label>
                <select class="w3-select sel" name="area-interesse" required>
                    <option value="" disabled selected>Selecione as suas áreas de interesse</option>
                    <option value="Ação social">Ação social</option>
                    <option value="Educação">Educação</option>
                    <option value="Saúde">Saúde</option>
                </select>
                
            <hr>
            
            <label>População-alvo:</label>
                <select class="w3-select sel" name="populacao-alvo" required>
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

            <hr>
            
            <label>Função: </label>
                <select class="w3-select sel" name="funcao" required>
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

            <hr>
            
            <label>Distrito:</label>
                <select class="w3-select sel" name="distrito" required>
                    <option value="" disabled selected>Selecione distrito</option>
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
            
            <hr>

            <label>Concelho: </label>
                <select class="w3-select sel" name="concelho" required>
                    <option value="" disabled selected>Selecione concelho</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>

            <hr>


            <label>Freguesia:</label>
                <select class="w3-select sel" name="freguesia" required>
                    <option value="" disabled selected>Selecione freguesia</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            
            <hr>

            <label>Número de Vagas:</label>
                <input type="number" id="nVagas" name="vagas" min="1" max="1000" required>
            
            <hr>
            
            <label>Disponibilidade:</label>
                <select class="w3-select disponibilidade" name="disponibilidade-dia" required>
                    <option value="" disabled selected>Dia</option>
                    <option value="Segunda">Segunda</option>
                    <option value="Terça">Terça</option>
                    <option value="Quarta">Quarta</option>
                    <option value="Quinta">Quinta</option>
                    <option value="Sexta">Sexta</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                    
                </select>
                <select class="w3-select disponibilidade" name="disponibilidade-hora" required>
                    <option value="" disabled selected>Hora</option>
                    <option value="0">00:00</option>
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
                <select class="w3-select disponibilidade" name="disponibilidade-duracao" required>
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
                <select class="w3-select disponibilidade" name="disponibilidade-semana" required>
                    <option value="" disabled selected>Semana</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            
            <hr>
            
            <label>Número de Horas Total do Voluntariado:</label>
                <input type="number" id="nHoras" name="horas" min="1" max="1000" required>
            
            <hr>
    

            <input class="w3-blue" id="submit" type="submit" value="Criar ação">

    </form>

    <?php
        include "openconn.php";

        $id_acao = uniqid();
        $titulo = $_POST['titulo']; 
        $area_interesse = $_POST['area-interesse'];
        $populacao_alvo = $_POST['populacao-alvo'];
        $funcao = $_POST['funcao']; 
        $distrito = $_POST['distrito'];
        $concelho = $_POST['concelho'];
        $freguesia = $_POST['freguesia'];
        $vagas = $_POST['vagas']; 
        $dia = $_POST['disponibilidade-dia'];
        $hora = $_POST['disponibilidade-hora'];
        $duracao = $_POST['disponibilidade-duracao'];
        $semana = $_POST['disponibilidade-semana'];
        $horas = $_POST['horas'];

        if ($titulo != "") {

            $instituicao = $_SESSION['logged'];
            $id_instituicao = $_SESSION['loggedid'];

            $query = "insert into Acao
                        values ('".$id_instituicao."' , '".$id_acao."' , '".$titulo."' , '".$distrito."' , '".$concelho."' , '"
                        .$freguesia."' , '".$funcao."' , '".$area_interesse."' , '".$populacao_alvo."' , ".$vagas." , '"
                        .$dia."' , ".$hora." , ".$semana." , ".$duracao.")";

            $res = mysqli_query($conn, $query);
            
            if ($res) {
                echo "<p> Parabens conseguiste :) </p>";
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
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
            <li>Tel.: 214938000</li>
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