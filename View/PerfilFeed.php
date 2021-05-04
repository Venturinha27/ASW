
<?php
    session_start();
    ob_start();

    include "../Controller/PerfilController.php";
?>
<!DOCTYPE html>
<html>
<title>Perfil</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/PerfilFeedC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/PerfilJS.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="../CSS/ProcuraC.css">
<script src="../JavaScript/ProcuraJS.js"></script>
<script src="../JavaScript/PerfilFeedJS.js"></script>
<script src="../JavaScript/DCF.js"></script>
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
                if ($_SESSION['loggedid'] == $_SESSION['openid']) {
                    header("Location: HomePage.php");
                } else {
                    echo "<meta http-equiv='refresh' content='0'>";
                }
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
        <a href="Instituicoes.php" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

    <div id="topSugestaoDiv" class="w3-block hidden">

    </div>

</header>

<body>

    <?php

    $loggedtype = $_SESSION['loggedtype'];
    $logged = $_SESSION['logged'];
    $loggedid = $_SESSION['loggedid'];
    $opentype = $_SESSION['opentype'];
    $open = $_SESSION['open'];
    $openid = $_SESSION['openid'];

    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # -- VOLUNTARIO -------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------

    if ($opentype == 'voluntario'){

        # -- TABLE VOLUNTARIO ---------------------------------------------------
        
        $resultVoluntario = openVoluntario($openid);

        $id = $resultVoluntario['id'];
        $nome_voluntario = $resultVoluntario['nome_voluntario'];
        $foto = $resultVoluntario['foto'];
        $bio = $resultVoluntario['bio'];
        $data_nascimento = $resultVoluntario['data_nascimento'];
        $genero = $resultVoluntario['genero'];
        $concelho = $resultVoluntario['concelho'];
        $distrito = $resultVoluntario['distrito'];
        $freguesia = $resultVoluntario['freguesia'];
        $telefone = $resultVoluntario['telefone'];
        $cc = $resultVoluntario['cc'];
        $carta_c = $resultVoluntario['carta_c'];
        $covid = $resultVoluntario['covid'];
        $email = $resultVoluntario['email'];

        # -- PREFERENCIAS VOLUNTARIO ---------------------------------------------------
        
        echo "
            <div id='AzulDiv' >

            <img alt='Avatar' class='w3-left w3-circle' src='../$foto' />
                
                <h5>".$nome_voluntario."</h5>
                <div id='divNPubSeg'></div>
                <br>
                <p>".$bio."</p>
        ";
                
        if ($openid == $loggedid){
            echo "
            <a href='EditarPerfil.php'><button class='w3-button' id='EditarPerfil'>
                <i class='fas fa-user-edit'></i> Editar perfil
            </button></a>

            <a href='Login.php'><button class='w3-button' id='TerminarSessao'>
                <i class='fas fa-sign-out-alt'></i> Terminar sessão
            </button></a>";
        } else {
            echo "
                <a><button class='w3-button' id='EnviarMensagem'>
                    <i class='fas fa-paper-plane'></i> Enviar Mensagem
                </button></a>

                <div id='seguirDiv'>
                        </div>";
        }
                
        echo "</div>";

    }


    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # --------------- INSTITICAO ------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------

    if ($opentype == 'instituicao'){

        $resultInstituicao = openInstituicao($openid);

        # -- TABLE INSTITUICAO ---------------------------------------------------              

        $id = $resultInstituicao['id'];
        $nome_instituicao = $resultInstituicao['nome_instituicao'];
        $telefone = $resultInstituicao['telefone'];
        $morada = $resultInstituicao['morada'];
        $distrito = $resultInstituicao['distrito'];
        $concelho = $resultInstituicao['concelho'];
        $freguesia = $resultInstituicao['freguesia'];
        $email = $resultInstituicao['email'];
        $bio = $resultInstituicao['bio'];
        $nome_representante = $resultInstituicao['nome_representante'];
        $email_representante = $resultInstituicao['email_representante'];
        $foto = $resultInstituicao['foto'];
        $website = $resultInstituicao['website'];

        # -- PREFERENCIAS INSTITUICAO ---------------------------------------------------
        
        echo "
            <div id='AzulDiv' >
        
                <img alt='Avatar' class='w3-left w3-circle' src='../$foto' />       
                
                <h5>".$nome_instituicao."</h5>
                <div id='divNPubSeg'></div>
                <br>
                <p>".$bio."</p>
        ";
                
        if ($openid == $loggedid){
            echo "
            <a href='EditarPerfil.php'><button class='w3-button' id='EditarPerfil'>
                <i class='fas fa-user-edit'></i> Editar perfil
            </button></a>

            <a href='Login.php'><button class='w3-button' id='TerminarSessao'>
                <i class='fas fa-sign-out-alt'></i> Terminar sessão
            </button></a>";
        } else {
            echo "
                <a><button class='w3-button' id='EnviarMensagem'>
                    <i class='fas fa-paper-plane'></i> Enviar Mensagem
                </button></a>

                <div id='seguirDiv'>
                </div>";
        }
                
        echo "</div>";

    }

    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # --------------------- ACAO ------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------

    if ($opentype == 'acao'){

        $resultAcao = openAcao($openid);

        # -- TABLE ACAO ---------------------------------------------------  
        
        "SELECT I.id, I.nome_instituicao, I.foto, A.id_acao, A.titulo, A.distrito,
                    A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                    A.num_vagas, A.dia, A.hora, A.duracao
                    FROM Instituicao I, Acao A
                    WHERE I.id = A.id_instituicao 
                    AND A.id_acao = '".$id."'";

        $id_instituicao = $resultAcao['id'];
        $nome_instituicao = $resultAcao['nome_instituicao'];
        $foto = $resultAcao['foto'];
        $id_acao = $resultAcao['id_acao'];
        $titulo = $resultAcao['titulo'];
        $distrito = $resultAcao['distrito'];
        $concelho = $resultAcao['concelho'];
        $freguesia = $resultAcao['freguesia'];
        $funcao = $resultAcao['funcao'];
        $area_interesse = $resultAcao['area_interesse'];
        $populacao_alvo = $resultAcao['populacao_alvo'];
        $num_vagas = $resultAcao['num_vagas'];
        $dia = $resultAcao['dia'];
        $hora = $resultAcao['hora'];
        $duracao = $resultAcao['duracao'];

        # -- PREFERENCIAS ACAO ---------------------------------------------------
        
        echo "
            <div id='AzulDiv' >
        
                <img alt='Avatar' class='w3-left w3-circle' src='../$foto' />       
                
                <h5>".$titulo."</h5>
                <br>
                <br>
                <p>Promovido pela instituição <b>".$nome_instituicao."</b>.</p>

                ";
                
                if ($id_instituicao == $loggedid){
                    echo "
                    <a href='EditarPerfil.php'><button class='w3-button' id='EditarPerfil'>
                        <i class='fas fa-user-edit'></i> Editar perfil
                    </button></a>

                    <a href='Login.php'><button class='w3-button' id='TerminarSessao'>
                        <i class='fas fa-sign-out-alt'></i> Terminar sessão
                    </button></a>";
                } 
                
            echo "</div>";
            
    }

    ?>

    <?php
        if ($opentype == 'acao'){
            echo"<div id='BodyDiv'>
            <div id='MenuBody'>
                <a href='Perfil.php'><button class='w3-button w3-white w3-hover-indigo' id='Perfil'>
                    Perfil
                </button></a>

                <a href='PerfilFeed.php'><button class='w3-button w3-indigo' id='Feed'>
                    Candidatos
                </button></a>

                <a href='PerfilAtividades.php'><button class='w3-button w3-white w3-hover-indigo' id='Atividades'>
                    Participantes
                </button></a>
            </div>";
        } else {
            echo"<div id='BodyDiv'>
            <div id='MenuBody'>
                <a href='Perfil.php'><button class='w3-button w3-white w3-hover-indigo' id='Perfil'>
                    Perfil
                </button></a>

                <a href='PerfilFeed.php'><button class='w3-button w3-indigo' id='Feed'>
                    Publicações
                </button></a>

                <a href='PerfilAtividades.php'><button class='w3-button w3-white w3-hover-indigo' id='Atividades'>
                    Ações
                </button></a>
            </div>";
        }
    ?>

    <?php
        if ($opentype == 'acao'){

            echo "<div id='VolDiv'>";

            echo "<header class='w3-container'>
                        <h5><b>Candidaturas: </b></h5>
                    </header>";

            echo "<button id='filterb' class='w3-button w3-center w3-indigo'><i class='fas fa-filter'></i> &nbsp Filtrar &nbsp <i class='fas fa-angle-down'></i></button>";

            echo "<div class='w3-container w3-small hidden' id='divFiltrar'>
                        <div id='filtrar'>
                                <div id='esq'>
                                    <label><b>Nome</b></label>
                                    <input type='text' class='w3-input' name='nome' placeholder='Nome' name='nome' id='nome'/>
                                    <br>
                                    <label><b>Idade</b></label>
                                    <select class='w3-input' name='idade' id='idade'>
                                        <option value='' disabled selected>Idade</option>
                                        <option value='10 aos 20'>10 aos 20</option>
                                        <option value='21 aos 30'>21 aos 30</option>
                                        <option value='31 aos 40'>31 aos 40</option>
                                        <option value='41 aos 50'>41 aos 50</option>
                                        <option value='51 aos 60'>51 aos 60</option>
                                        <option value='61 aos 70'>61 aos 70</option>
                                        <option value='71 aos 80'>71 aos 80</option>
                                        <option value='81+'>81+</option>
                                    </select>
                                    <br>
                                    <label><b>Distrito:</b></label>
                                    <select class='w3-input' name='distrito' id='distrito' size='1'>
                                        <option value='' disabled selected>Selecione o seu Distrito:</option>
                                    </select> 
                                    <br>
                                    <label><b>Concelho:</b></label>
                                    <select class='w3-input' name='concelho' id='concelho' size='1'>
                                        <option value='' disabled selected>Selecione o seu Concelho:</option>
                                    </select> 
                                    <br>
                                    <label><b>Freguesia:</b></label>
                                    <select class='w3-input' name='freguesia' id='freguesia' size='1'>
                                        <option value='' disabled selected>Selecione a sua Freguesia:</option>
                                    </select> 
                                    <br>
                                    <label><b>Género</b></label>
                                    <select class='w3-input' name='genero' id='genero'>
                                        <option value='' disabled selected>Género</option>
                                        <option value='Homem'>Homem</option>
                                        <option value='Mulher'>Mulher</option>
                                        <option value='Prefiro não dizer'>Prefiro não dizer</option>
                                    </select>
                                </div>
                                <div id='dir'>
                                    <label><b>Email</b></label>
                                    <input type='text' class='w3-input' name='email' placeholder='Email' name='email' id='email'/>
                                    <br>
                                    <label><b>Carta de Condução</b></label>
                                    <select class='w3-input' name='carta' id='carta'>
                                        <option value='' disabled selected>Carta de condução</option>
                                        <option value='Sim'>Sim</option>
                                        <option value='Não'>Não</option>
                                    </select>
                                    <br>
                                    <label><b>Já esteve infetado com o Covid-19?</b></label>
                                    <select class='w3-input' name='covid' id='covid'>
                                        <option value='' disabled selected>Esteve infetado</option>
                                        <option value='Sim'>Sim</option>
                                        <option value='Não'>Não</option>
                                    </select>
                                    <br>
                                    <label><b>Áreas de interesse:</b></label>
                                    <select class='w3-input' name='area-interesse' id='area-interesse'>
                                        <option value='' disabled selected>Área de interesse</option>
                                        <option value='Ação social'>Ação social</option>
                                        <option value='Educação'>Educação</option>
                                        <option value='Saúde'>Saúde</option>
                                    </select>
                                    <br>
                                    <label><b>População-alvo:</b></label>
                                    <select class='w3-input' name='populacao-alvo' id='populacao-alvo'>
                                        <option value='' disabled selected>Selecione a sua população-alvo</option>
                                        <option value='Indiferente'>Indiferente</option>
                                        <option value='Crianças'>Crianças</option>
                                        <option value='Jovens'>Jovens</option>
                                        <option value='Idosos'>Idosos</option>
                                        <option value='Grávidas'>Grávidas</option>
                                        <option value='Pessoas em situação de dependência (ex. acamados)'>Pessoas em situação de dependência (ex. acamados)</option>
                                        <option value='Pessoas sem-abrigo'>Pessoas sem-abrigo</option>
                                        <option value='Pessoas com deficiência'>Pessoas com deficiência</option>
                                    </select>
                                    <br>
                                    <label><b>Disponibilidade:</b></label>
                                    <br>
                                    <select class='w3-input dis' name='disponibilidade-dia' id='dia'>
                                        <option value='' disabled selected>Dia</option>
                                        <option value='Segunda-feira'>Segunda-feira</option>
                                        <option value='Terça-feira'>Terça-feira</option>
                                        <option value='Quarta-feira'>Quarta-feira</option>
                                        <option value='Quinta-feira'>Quinta-feira</option>
                                        <option value='Sexta-feira'>Sexta-feira</option>
                                        <option value='Sábado'>Sábado</option>
                                        <option value='Domingo'>Domingo</option>
                                    </select>
                                    <select class='w3-input dis' name='disponibilidade-hora' id='hora'>
                                        <option value='' disabled selected>Hora</option>
                                        <option value='00:00'>00:00</option>
                                        <option value='1'>01:00</option>
                                        <option value='2'>02:00</option>
                                        <option value='3'>03:00</option>
                                        <option value='4'>04:00</option>
                                        <option value='5'>05:00</option>
                                        <option value='6'>06:00</option>
                                        <option value='7'>07:00</option>
                                        <option value='8'>08:00</option>
                                        <option value='9'>09:00</option>
                                        <option value='10'>10:00</option>
                                        <option value='11'>11:00</option>
                                        <option value='12'>12:00</option>
                                        <option value='13'>13:00</option>
                                        <option value='14'>14:00</option>
                                        <option value='15'>15:00</option>
                                        <option value='16'>16:00</option>
                                        <option value='17'>17:00</option>
                                        <option value='18'>18:00</option>
                                        <option value='19'>19:00</option>
                                        <option value='20'>20:00</option>
                                        <option value='21'>21:00</option>
                                        <option value='22'>22:00</option>
                                        <option value='23'>23:00</option>
                                    </select>
                                    <select class='w3-input dis' name='disponibilidade-duracao' id='duracao'>
                                        <option value='' disabled selected>Duração</option>
                                        <option value='1'>01:00</option>
                                        <option value='2'>02:00</option>
                                        <option value='3'>03:00</option>
                                        <option value='4'>04:00</option>
                                        <option value='5'>05:00</option>
                                        <option value='6'>06:00</option>
                                        <option value='7'>07:00</option>
                                        <option value='8'>08:00</option>
                                    </select>
                                    
                                </div>
                                <input class='w3-button w3-indigo' onclick='procuraCandidaturas()' id='procura' type='submit' name='Procura' value='Procura'/>
                            </div>
                    </div>";

            echo "<div id='resultCandidaturas'></div>";

            echo "<br>";

            echo "<header class='w3-container'>
                        <h5><b>Voluntários que correspondem à ação: </b></h5>
                    </header>";

            echo "<div id='resultCorrespondentes'></div>";

            echo "</div>";

            echo "<br></div></div>";
        } else {
            echo "<div id='PubDiv'></div>";
        }

    ?>
    

    </div>

    <?php

        include "../Controller/PedidosController.php";

        if (isset($_SESSION['logged'])){

            echo "<div id='PedDiv'>
            <header class='w3-container w3-indigo w3-round'>
                <h3><i class='fas fa-bars'></i> &nbsp<b>Pedidos</b></h3>
            </header>
            <div id='Ped'>
            </div>
            <button type='button' id='vermaisped' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Mais</button>
            </div>";
        }
        
        ?>

<?php

    if (isset($_SESSION['logged'])){
        echo "<div id='SugDiv'>
            <header class='w3-container w3-indigo w3-round'>
                <h3><i class='fas fa-lightbulb'></i> &nbsp<b>Sugestões</b></h3>
            </header>
            <div id='Sug'>
            </div>
            <button id='vermaissug' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Mais</button>
        </div>";
    }
?>

<?php

    if (isset($_SESSION['logged'])){

        echo "<div id='MsgDiv'>
            <header class='w3-container w3-indigo w3-round'>
                <h3><i class='fas fa-inbox'></i> &nbsp<b>Mensagens</b> </h3>
            </header>
            <div id='Msg'>";
            echo "</div>
            <button id='vermaismsg' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Mais</button>
            
        </div>";

    }
?>

    </body>
