
<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>
<title>Sobre</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/Covid19C.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../CSS/ProcuraC.css">
<script src="../JavaScript/ProcuraJS.js"></script>
<link rel="stylesheet" href="../CSS/NotificacoesC.css">
<script src="../JavaScript/NotificacoesJS.js"></script>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.php" class="w3-bar-item w3-button w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" onkeyup="showHint(this.value)" placeholder="Procura...">
        
        <?php

            include "../Controller/HeaderController.php";
            include "../Controller/SessionController.php";
            
            if (!isset($_SESSION['logged'])) {
                echo "<a href='Login.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'><i class='fa fa-user-circle'></i></a>";
            } else {
                $foto = "../" . loggedHeader();

                echo "<div class='w3-dropdown-hover w3-right w3-mobile'>
                    <button class='w3-button w3-hover-blue'>
                        <img alt='Avatar' class='w3-circle' id='foto' src='$foto' style='width:26px; height: 26px;'/>
                    </button>
                    <div id='toprightdiv' class='w3-dropdown-content w3-bar-block w3-card-4 w3-left w3-small' style='right:0%; z-index: 100; width:10%;'>
                        
                        <div id='notificacoesdiv' class='hidden'></div>

                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='selfopenP' name='selfopen' class='w3-bar-item w3-button'><i class='fas fa-user-circle'></i> Ver perfil</button>
                        </form>

                        <button onclick='showNotificacoes()' id='notificacoesnumber' class='w3-bar-item w3-button'><i class='fas fa-bell'></i> Notificações</button>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='selfopenE' name='selfopen' class='w3-bar-item w3-button'><i class='fas fa-user-edit'></i> Editar perfil</button>
                        </form>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='terminarS' name='terminarS' class='w3-bar-item w3-button w3-white w3-text-red'><i class='fas fa-sign-out-alt'></i> Terminar sessão</button>
                        </form>

                    </div>
                </div>";
            }

            if ($_POST['terminarS']){
                TerminarSessao();
                echo "<meta http-equiv='refresh' content='0'>";
            }

            if ($_POST['selfopen']){
                SelfOpen();
                if ($_POST['selfopen'] == "selfopenP"){
                    header("Location: Perfil.php");
                } else {
                    header("Location: EditarPerfil.php");
                }
            }
        ?>
        
        <a href="Voluntarios.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>  
        <a href="Covid19.php" class="w3-bar-item w3-button w3-blue w3-hover-blue w3-right w3-mobile">COVID-19</a> 
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

    <div id="topSugestaoDiv" class="w3-block hidden">

    </div>

</header>

<body>

    <div id="topDiv">
    </div>

    <div id="SobreDiv">
        <br><br>
        <h1 class="w3-center">O que é a COVID19?</h1>
        <br>
        <hr>
        <br><br>
        <p>O novo coronavírus, designado SARS-CoV-2, foi identificado pela primeira vez em dezembro de 2019 na China, na cidade de Wuhan. Este novo agente nunca tinha sido identificado anteriormente em seres humanos. A fonte da infeção é ainda desconhecida.</p>
        <br>
        <p>Ainda está em investigação a via de transmissão. A transmissão pessoa a pessoa foi confirmada e já existe infeção em vários países e em pessoas que não tinham visitado o mercado de Wuhan. A investigação prossegue.</p>
        <br><br>
        <p><i class="fa fa-virus"></i></p>
        <br><br>
    </div>

    <div id="SintomasDiv">
        <br><br>
        <h1 class="w3-center">Sinais e Sintomas</h1>
        <br>
        <hr>
        <br><br>
        <p>Os sinais e sintomas da COVID-19 variam em gravidade, desde a ausência de sintomas (sendo assintomáticos) até febre (temperatura ≥ 38.0ºC), tosse, dor de garganta, cansaço e dores musculares e, nos casos mais graves, pneumonia grave, síndrome respiratória aguda grave, septicémia, choque sético e eventual morte.</p>
        <br>
        <p>Os dados mostram que o agravamento da situação clínica pode ocorrer rapidamente, geralmente durante a segunda semana da doença.</p>
        <br>
        <p>Recentemente, foi também verificada anosmia (perda do olfato) e em alguns casos a perda do paladar, como sintoma da COVID-19. Existem evidências da Coreia do Sul, China e Itália de que doentes com COVID-19 desenvolveram perda parcial ou total do olfato, em alguns casos na ausência de outros sintomas.</p>
        <br><br>
        <p><i class="fa fa-virus"></i></p>
        <br><br>
    </div>

    <div id="ImunidadeDiv">
        <br><br>
        <h1 class="w3-center">As pessoas que têm a doença ficam imunes?</h1>
        <br>
        <hr>
        <br><br>
        <p>De acordo com a evidência científica disponível à data, ainda não é possível confirmar se as pessoas infetadas com o SARS-CoV-2 desenvolvem imunidade protetora. O organismo humano pode ir ganhando anticorpos após a infeção e desenvolvimento da doença.
            </p>
        <br><br>
        <p><i class="fa fa-virus"></i></p>
        <br><br>
    </div>

    <div id="TransmissaoDiv">
        <br><br>
        <h1 class="w3-center">Como se transmite?</h1>
        <br>
        <hr>
        <br><br>
        <p>A COVID-19 transmite-se pessoa-a-pessoa por contacto próximo com pessoas infetadas pelo SARS-CoV-2 (transmissão direta), ou através do contacto com superfícies e objetos contaminados (transmissão indireta).</p>
        <br>
        <p>A transmissão por contacto próximo ocorre principalmente através de gotículas que contêm partículas virais que são libertadas pelo nariz ou boca de pessoas infetadas, quando tossem ou espirram, e que podem atingir diretamente a boca, nariz e olhos de quem estiver próximo.</p>
        <br>
        <p>As gotículas podem depositar-se nos objetos ou superfícies que rodeiam a pessoa infetada e, desta forma, infetar outras pessoas quando tocam com as mãos nestes objetos ou superfícies, tocando depois nos seus olhos, nariz ou boca.</p>
        <br>
        <p>Existem também evidências sugerindo que a transmissão pode ocorrer de uma pessoa infetada cerca de dois dias antes de manifestar sintomas.</p>
        <br><br>
        <p><i class="fa fa-virus"></i></p>
        <br><br>
    </div>

    <div id="RiscoDiv">
        <br><br>
        <h1 class="w3-center">Quem está em risco de contrair COVID-19?</h1>
        <br>
        <hr>
        <br><br>
        <p>O vírus não tem nacionalidade, idade ou género, por isso todos corremos o risco de contrair a COVID-19.
            Ainda assim, as pessoas que correm maior risco de doença grave por COVID-19 são os idosos e pessoas com doenças crónicas (ex.: doenças cardíacas e doenças pulmonares).</p>
        <br><br>
        <p><i class="fa fa-virus"></i></p>
        <br><br>
    </div>

    <div id="PrevencaoDiv">
        <br><br>
        <h1 class="w3-center">Quais as medidas de prevenção?</h1>
        <br>
        <hr>
        <br><br>
        <p>Duas das medidas mais efetivas são a higiene das mãos e a etiqueta respiratória.</p>
        <br>
        <p>A higiene das mãos deve ser feita várias vezes ao longo do dia, antes e depois de comer, de ir à casa de banho, ao chegar a casa ou ao trabalho, ou sempre que se justifique. Deve lavar as mãos com água e sabão durante pelo menos 20 segundos, esfregando sequencialmente as palmas, dorso, cada um dos dedos e o pulso, secando-as bem no final. Caso não tenha acesso a água e sabão, desinfete as mãos com solução à base de álcool com 70% de concentração. Não se esqueça de remover anéis, pulseiras, relógios, ou outros objetos, antes da lavagem das mãos. Estes adereços deverão também ser higienizados após a sua utilização.</p>
        <br>
        <p>A etiqueta respiratória são medidas a aplicar para evitar transmitir gotículas respiratórias: quando tossir ou espirrar, proteja o nariz e a boca com um lenço descartável ou com o antebraço. Após a utilização do lenço descartável, deite-o imediatamente no lixo. De seguida lave de imediato, as mãos. Caso tenha utilizado o braço, lave-o, ou à camisola, assim que possível.</p>
        <br><br>
        <p><i class="fa fa-virus"></i></p>
        <br><br>
    </div>

    <div id="SaibaMaisDiv">
        <br><br>
        <p>Saiba mais em:</p>
        <a href="https://covid19.min-saude.pt" >
        <button class="w3-button w3-indigo w3-hover-blue w3-round-xxlarge w3-large w3-padding-large">
            covid19.min-saude.pt
        </button>
        </a>
        
    
            
        <br><br>
    </div>


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