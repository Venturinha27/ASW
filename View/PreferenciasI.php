
<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Ação de Voluntariado</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/PreferenciasI.css" type="text/css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JavaScript/PreferenciasI.js"></script>
<script src="../JavaScript/DCF.js"></script>
<link rel="stylesheet" href="../CSS/ProcuraC.css">
<script src="../JavaScript/ProcuraJS.js"></script>
</head>


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

                <div id="showingAcoes"></div>
                
            </div>

            <a href="Perfil.php"><button class="submitr w3-round-xxlarge">Avançar</button></a>

        </div>

    <form id="acaoform" class="w3-container w3-card hidden" method="post">

            <header class="w3-container w3-indigo">
                <h3>Nova ação</h3>

                <button class="w3-button w3-display-topright w3-large w3-hover-indigo" id="closeActionForm">X</button>
            </header>
            <br>

            <input type="text" class="w3-input" id="tituloAcao" placeholder="Titulo da ação" name="titulo" required>

            <hr>

            <div id="esq">

                <label>Áreas de interesse:</label>
                    <select class="w3-select sel" name="area-interesse" id="areaacao" required>
                        <option value="" disabled selected>Selecione as suas áreas de interesse</option>
                        <option value="Ação social">Ação social</option>
                        <option value="Educação">Educação</option>
                        <option value="Saúde">Saúde</option>
                    </select>
                    
                <hr>
                
                <label>População-alvo:</label>
                    <select class="w3-select sel" name="populacao-alvo" id="populacaoacao" required>
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
                    <select class="w3-select sel" name="funcao" id="funcaoacao" required>
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

                <label>Número de Vagas:</label>
                    <input type="number" id="nVagas" name="vagas" min="1" max="1000" required>

                <hr>

                <label>Distrito:</label>
                <select class="w3-select sel" name="distrito" id="distrito" required>
                    <option value="" disabled selected>Selecione o seu Distrito:</option>
                </select> 

            </div>

            <div id="dir">
                
                <label>Concelho:</label>
                <select class="w3-select sel" name="concelho" id="concelho" required>
                    <option value="" disabled selected>Selecione o seu Concelho:</option>
                </select>
                
                <hr>
                
                <label>Freguesia:</label>
                <select class="w3-select sel" name="freguesia" id="freguesia" required>
                    <option value="" disabled selected>Selecione a sua Freguesia:</option>
                </select> 
                
                <hr>
                
                <label>Data:</label>
                    <input type="date" class="sel" id="diaacao" name="disponibilidade-dia" placeholder="Data (AAAA-MM-DD)" required/>
                        
                <hr>

                <label>Hora:</label>
                    <select class="w3-select sel" id="horaacao" name="disponibilidade-hora" required>
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

                <hr>

                <label>Duração:</label>
                    <select class="w3-select sel" id="duracaoacao" name="disponibilidade-duracao" required>
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

            <input class="w3-button w3-indigo" id="submit" type="submit" value="Criar ação">

    </form>
    
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