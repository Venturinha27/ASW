<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    session_start();
    ob_start();

    if (!isset($_SESSION['logged'])) {
        header('Location: Login.php');
    }

    include "../Controller/EditarPerfilController.php";
    
?>
<!DOCTYPE html>
<html>
<title>Editar Perfil</title>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
<link rel='stylesheet' href='../CSS/EditarPerfilC.css'>
<script src='https://kit.fontawesome.com/91ccf300f9.js' crossorigin='anonymous'></script>
<script src="../JavaScript/DCF.js"></script>

<header>
    <div class='w3-bar w3-large' id='navigation'>
        <a href='HomePage.php' class='w3-bar-item w3-button w3-hover-blue w3-mobile'>VoluntárioCOVID19</a>

        <input type='text' class='w3-bar-item w3-input' placeholder='Procura...'>
        
        <?php

            include "../Controller/HeaderController.php";
            include "../Controller/SessionController.php";
            
            if (!isset($_SESSION['logged'])) {
                echo "<a href='Perfil.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'><i class='fa fa-user-circle'></i></a>";
            } else {
                
                $foto = "../" . loggedHeader();

                echo "<div class='w3-dropdown-hover w3-right w3-mobile'>
                    <button class='w3-button w3-hover-blue'>
                        <img alt='Avatar' class='w3-circle' id='foto' src='$foto' style='width:26px; height: 26px;'/>
                    </button>
                    <div class='w3-dropdown-content w3-bar-block w3-card-4 w3-left w3-small' style='right:0%; z-index: 100; width:10%;'>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='selfopenP' name='selfopen' class='w3-bar-item w3-button'>Ver perfil</button>
                        </form>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='selfopenE' name='selfopen' class='w3-bar-item w3-button'>Editar perfil</button>
                        </form>
                        
                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                            <button type='submit' value='terminarS' name='terminarS' class='w3-bar-item w3-button w3-white w3-text-red'>Terminar sessão</button>
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
        <a href='Voluntarios.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'>Voluntários</a>
        <a href='Instituicoes.php' class='w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile'>Instituições</a>
        <a href='Covid19.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'>COVID-19</a>
        <a href='Publicacoes.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'>Publicações</a>   
        <a href='Sobre.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'>Sobre</a>        
    </div>

</header>

<body>

<div id='BrancoDiv' class='w3-container'>

    <h2><b>Editar Perfil</b></h2>

    <br>

    <form id='registertext' enctype='multipart/form-data' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method='post'>

<?php

    include "TestInput.php";

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

    if ($loggedtype == 'voluntario'){

        # ERRO
        $queryVoluntario = openVoluntario($loggedid);

        $nome_voluntario = $queryVoluntario['nome_voluntario'];
        $foto = $queryVoluntario['foto'];
        $bio = $queryVoluntario['bio'];
        $data_nascimento = $queryVoluntario['data_nascimento'];
        $genero = $queryVoluntario['genero'];
        $concelho = $queryVoluntario['concelho'];
        $distrito = $queryVoluntario['distrito'];
        $freguesia = $queryVoluntario['freguesia'];
        $telefone = $queryVoluntario['telefone'];
        $cc = $queryVoluntario['cc'];
        $carta_c = $queryVoluntario['carta_c'];
        $covid = $queryVoluntario['covid'];
        $email = $queryVoluntario['email'];
        $password = $queryVoluntario['password1'];


        echo "
            <div id='divEsq'>
                <label> <b>Nome Completo</b> </label>
                <input type='text' value='$nome_voluntario' class='w3-input' id='nomeProprio' placeholder='Nome Completo' name='nomeProprio' required />

                <label> <b>E-mail</b> </label>
                <input type='text' value='$email' class='w3-input' id='E-mail' placeholder='E-mail' name='E-mail' required/>

                <label> <b>Palavra-Passe Antiga</b> </label>
                <input type='password' class='w3-input' id='PasswordA' name='PasswordA'/>

                <label> <b>Palavra-Passe Nova</b> </label>
                <input type='password' class='w3-input' id='PasswordN' name='PasswordN'/>

                <label> <b>Telemóvel/Telefone</b> </label>
                <input type='text' value='$telefone' class='w3-input' id='telefone' placeholder='Telemóvel/Telefone' name='telefone'required/>

                <label> <b>Data de Nascimento</b> </label>
                <input type='date' value='$data_nascimento' class='w3-input' id='dataNascimento' placeholder='Data de Nascimento' name='dataNascimento' required/>

                <label> <b>Cartão de Cidadão</b> </label>
                <input type='text' value='$cc' class='w3-input' id='CC' placeholder='Cartão de Cidadão' name='CC'required/>

                <label> <b>Biografia</b> </label>
                <textarea type='text' class='w3-input' id='bio' placeholder='Escreva algo sobre si...' name='bio' rows='3' maxlength='240' required>$bio</textarea>

            </div>
            <div id='divDir'>

                <label> <b>Fotografia de Perfil</b> </label> <br><br>
                <img alt='Avatar' class='w3-circle' id='foto' src='../$foto' />
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='file' id='avatar' name='avatar'/>  <!--accept='image/png, image/jpeg'-->
                <br><br>

                <label> <b>Distrito:</b> </label>
                <select class='w3-input' name='distrito' id='distrito' size='1' required>
                    <option value='$distrito' name='$distrito' selected>$distrito</option>
                </select> 
                
                <label> <b>Concelho:</b> </label>
                <select class='w3-input' name='concelho' id='concelho' size='1' required>
                    <option value='$concelho' name='$concelho' selected>$concelho</option>
                </select> 
                
                <label> <b>Freguesia:</b> </label>
                <select class='w3-input' name='freguesia' id='freguesia' size='1' required>
                    <option value='$freguesia' name='$freguesia' selected>$freguesia</option>
                </select> 
            
                <label> <b>Género</b> </label>
                <select class='w3-input' name='genero'>
                    <option value='' disabled>Selecione o seu género</option>
                    ";
                    if ($genero == 'Homem'){
                        echo "<option value='Homem' selected>Homem</option>
                        <option value='Mulher'>Mulher</option>
                        <option value='Prefiro não dizer'>Prefiro não dizer</option>";
                    }
                    if ($genero == 'Mulher'){
                        echo "<option value='Homem'>Homem</option>
                        <option value='Mulher' selected>Mulher</option>
                        <option value='Prefiro não dizer'>Prefiro não dizer</option>";
                    }
                    if ($genero == 'Prefiro não dizer'){
                        echo "<option value='Homem'>Homem</option>
                        <option value='Mulher'>Mulher</option>
                        <option value='Prefiro não dizer' selected>Prefiro não dizer</option>";
                    }
                
                echo"
                </select>

                <label> <b>Carta de Condução</b> </label>
                <select class='w3-input' name='carta'>
                    <option value='' disabled>Selecione se tem carta de condução</option>
                    ";
                    if ($carta_c == 'Sim'){
                        echo "<option value='Sim' selected>Sim</option>
                        <option value='Não'>Não</option>";
                    }
                    if ($carta_c == 'Não'){
                        echo "<option value='Sim'>Sim</option>
                        <option value='Não' selected>Não</option>";
                    }
                
                echo"    
                </select>

                <label> <b>Já esteve infetado com o Covid-19?</b> </label>
                <select class='w3-input' name='covid'>
                    <option value='' disabled>Selecione se já esteve infetado</option>
                    ";
                    if ($covid == 'Sim'){
                        echo "<option value='Sim' selected>Sim</option>
                        <option value='Não'>Não</option>";
                    }
                    if ($covid == 'Não'){
                        echo "<option value='Sim'>Sim</option>
                        <option value='Não' selected>Não</option>";
                    }
                echo"
                </select>

            </div>

            <input id='submitV' class='w3-button w3-indigo w3-hover-blue' type='submit' name='editarPerfilV' value='Submeter'>
        </form>
        </div>";

        echo "<div id='PreferenciasDiv' class='w3-container'>

        <h2><b>Editar Preferências</b></h2>

        <br>

        <div id='preftext'>";

        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>
                <label><b>Áreas de interesse:</b></label>
                    <select class='w3-select sela' name='area-interesse' required>
                        <option value='' disabled selected>Selecione uma área de interesse</option>
                        <option value='Ação social'>Ação social</option>
                        <option value='Educação'>Educação</option>
                        <option value='Saúde'>Saúde</option>
                    </select>

                <input class='w3-green w3-round-xxlarge' type='submit' value='+' name='submitA'>
            </form>
            ";

        $voluntario = $_SESSION['loggedid'];
            
        $resultA = areasV($voluntario);     

        if ($resultA->num_rows > 0) {

            $checkArea = 1;
            echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
            echo "<ul class='w3-ul w3-center'>";            
            while ($row = $resultA->fetch_assoc()){
                echo "<li> <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>" . $row['area'] . "
                    <button class='w3-right w3-red w3-round-xxlarge' type='submit' value='".$row['area']."' name='removeA'>
                        <i class='fa fa-trash-alt'></i>
                    </button>
                    </form> 
                </li>";
            }
            echo "</ul>";
            echo "</div>";
        } else {
            echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>
                    <p class='w3-center'>Ainda não tem áreas de interesse.</p>
                </div>";
        }

        echo "<hr>";
        
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>
            <label><b>População-alvo:</b></label>
                <select class='w3-select selp' name='populacao-alvo'>
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

            <input class='w3-green w3-round-xxlarge' type='submit' value='+' name='submitP'>
        </form>";


        $voluntario = $_SESSION['loggedid'];
            
        $resultP = populacaoV($voluntario);

        if ($resultP->num_rows > 0) {

            $checkPopulacao = 1;

            echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
            echo "<ul class='w3-ul w3-center'>";            
            while ($row = $resultP->fetch_assoc()){
                echo "<li> <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>" . $row['populacao_alvo'] . "
                    <button class='w3-right w3-red w3-round-xxlarge' type='submit' value='".$row['populacao_alvo']."' name='removeP'>
                        <i class='fa fa-trash-alt'></i>
                    </button>
                    </form> 
                </li>";
            }
            echo "</ul>";
            echo "</div>";

        } else {
            echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>
                    <p class='w3-center'>Ainda não tem nenhuma população-alvo.</p>
                </div>";
        }

        echo "<hr>";
        
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>
            <label><b>Disponibilidade:</b></label>
                <select class='w3-select disponibilidade' name='disponibilidade-dia'>
                    <option value='' disabled selected>Dia</option>
                    <option value='Segunda-feira'>Segunda-feira</option>
                    <option value='Terça-feira'>Terça-feira</option>
                    <option value='Quarta-feira'>Quarta-feira</option>
                    <option value='Quinta-feira'>Quinta-feira</option>
                    <option value='Sexta-feira'>Sexta-feira</option>
                    <option value='Sábado'>Sábado</option>
                    <option value='Domingo'>Domingo</option>
                </select>
                <select class='w3-select disponibilidade' name='disponibilidade-hora'>
                    <option value='' disabled selected>Hora</option>
                    <option value='00:00'>00:00</option>
                    <option value='01:00'>01:00</option>
                    <option value='02:00'>02:00</option>
                    <option value='03:00'>03:00</option>
                    <option value='04:00'>04:00</option>
                    <option value='05:00'>05:00</option>
                    <option value='06:00'>06:00</option>
                    <option value='07:00'>07:00</option>
                    <option value='08:00'>08:00</option>
                    <option value='09:00'>09:00</option>
                    <option value='10:00'>10:00</option>
                    <option value='11:00'>11:00</option>
                    <option value='12:00'>12:00</option>
                    <option value='13:00'>13:00</option>
                    <option value='14:00'>14:00</option>
                    <option value='15:00'>15:00</option>
                    <option value='16:00'>16:00</option>
                    <option value='17:00'>17:00</option>
                    <option value='18:00'>18:00</option>
                    <option value='19:00'>19:00</option>
                    <option value='20:00'>20:00</option>
                    <option value='21:00'>21:00</option>
                    <option value='22:00'>22:00</option>
                    <option value='23:00'>23:00</option>
                </select>
                <select class='w3-select disponibilidade' name='disponibilidade-duracao'>
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
            
            <input class='w3-green w3-round-xxlarge' type='submit' value='+' name='submitD'>
        </form>";

        
        $voluntario = $_SESSION['loggedid'];
            
        $resultD = disponibilidadeV($voluntario);

        if ($resultD->num_rows > 0) {

            $checkDisponibilidade = 1;

            echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
            echo "<ul class='w3-ul w3-center'>";            
            while ($row = $resultD->fetch_assoc()){
                echo "<li> <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                    Dia: " . $row['dia'] . ", hora: ". $row['hora'] .":00, duração: ".$row['duracao']." horas.
                    <button class='w3-right w3-red w3-round-xxlarge' type='submit'
                            value='".$row['dia']."/".$row['hora']."/".$row['duracao']."' 
                            name='removeD'>
                        <i class='fa fa-trash-alt'></i>
                    </button>
                    </form> 
                </li>";
            }
            echo "</ul>";
            echo "</div>";

        } else {
            echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>
                    <p class='w3-center'>Ainda não tem disponibilidade.</p>
                </div>";
        }

        echo "<hr>";

        $voluntario = $_SESSION['loggedid'];

        if ($_POST['submitA']) {
            $area_interesse = test_input($_POST['area-interesse']);

            $resArea = insertA($voluntario, $area_interesse);
            
            if ($resArea) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if ($_POST['submitP']) {
            $populacao_alvo = test_input($_POST['populacao-alvo']);

            $resPopulacao = insertP($voluntario, $populacao_alvo);
            
            if ($resPopulacao) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if ($_POST['submitD']) {
            $dia = test_input($_POST['disponibilidade-dia']);
            $hora = test_input($_POST['disponibilidade-hora']);
            $duracao = test_input($_POST['disponibilidade-duracao']);

            $resDispo = insertD($voluntario, $dia, $hora, $duracao);
            
            if ($resDispo) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if (!empty($_POST['removeA'])){
            $rArea = test_input($_POST['removeA']);

            $resrArea = removeArea($voluntario, $rArea);
            
            if ($resrArea) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if (!empty($_POST['removeP'])){
            $rPopulacao = test_input($_POST['removeP']);

            $resrPopulacao = removePopulacao($voluntario, $rPopulacao);
            
            if ($resrPopulacao) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if (!empty($_POST['removeD'])){
            $rDispo = test_input($_POST['removeD']);

            $resrDispo = removeDisponibilidade($voluntario, $rDispo);
            
            if ($resrDispo) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
        
        echo "</div>
        </div>";

    } 
?>

<?php
        if (!empty($_POST['editarPerfilV'])){

            $id = $loggedid;
            $nomeProprio = test_input($_POST['nomeProprio']); 
            $Email = test_input($_POST['E-mail']);                       #unique
            $PasswordA = test_input($_POST['PasswordA']);
            $PasswordN = test_input($_POST['PasswordN']);
            $telefone = test_input($_POST['telefone']);
            $dataNascimento = test_input($_POST['dataNascimento']);
            $CC = test_input($_POST['CC']);                              #unique
            $bio = test_input($_POST['bio']); 
            $distrito = test_input($_POST['distrito']);
            $concelho = test_input($_POST['concelho']);
            $freguesia = test_input($_POST['freguesia']);
            $genero = test_input($_POST['genero']);
            $carta = test_input($_POST['carta']); 
            $covid = test_input($_POST['covid']);

            include "../Controller/InputPhotoController.php";

            $avatar = test_photo();

            if ($avatar == 'Nenhuma imagem enviada.') {
                $avatar = $foto;
            }

            if (substr($avatar,0,6) == "Images") {

                $updateV = updateVoluntario($id, $nomeProprio, $Email, $PasswordA, $PasswordN, $telefone, $dataNascimento, $CC, $bio, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $avatar);

                echo $updateV;

            } else {
                // Erro no input da fotografia
                echo "<p class='erro'> ". $avatar ." </p>";
            }

        }
?>




<?php

    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # -- INSTITUICAO -------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------

    if ($loggedtype == 'instituicao'){

        $instituicao = openInstituicao($loggedid);

        $id = $instituicao['id'];
        $nome_instituicao = $instituicao['nome_instituicao'];
        $telefone = $instituicao['telefone'];
        $morada = $instituicao['morada'];
        $concelho = $instituicao['concelho'];
        $distrito = $instituicao['distrito'];
        $freguesia = $instituicao['freguesia'];
        $email = $instituicao['email'];
        $bio = $instituicao['bio'];
        $nome_representante = $instituicao['nome_representante'];
        $email_representante = $instituicao['email_representante'];
        $password2 = $instituicao['password2'];
        $foto = $instituicao['foto'];
        $website = $instituicao['website'];

        echo "
            <div id='divEsq'>
                <label> <b>Nome da Instituição</b> </label>
                <input type='text' value='$nome_instituicao' class='w3-input' id='nomeInstituicao' placeholder='Nome da Instituição' name='nomeInstituicao' required>

                <label> <b>Telemóvel/Telefone</b> </label>
                <input type='text' value='$telefone' class='w3-input' id='telefone' placeholder='Telemóvel/Telefone' name='telefone' required>

                <label> <b>E-mail da Instituição</b> </label>
                <input type='text' value='$email' class='w3-input' id='E-mail' placeholder='E-mail da Instituição' name='email' required>

                <label> <b>Palavra-Passe Antiga</b> </label>
                <input type='password' class='w3-input' id='PasswordA' name='PasswordA'/>

                <label> <b>Palavra-Passe Nova</b> </label>
                <input type='password' class='w3-input' id='PasswordN' name='PasswordN'/>
                
                <label> <b>Website</b> </label>
                <input type='text' value='$website' class='w3-input' id='website' placeholder='Website' name='website'>

                <label> <b>Biografia</b> </label>
                <textarea type='text' class='w3-input' id='biografia' placeholder='Escreva uma pequena bio sobre a instituição...' name='bio' rows='3' maxlength='240' required>$bio</textarea>
            </div>
            <div id='divDir'>
                        
                <label> <b>Fotografia de Perfil</b> </label> <br><br>
                <img alt='Avatar' class='w3-circle' id='foto' src='../$foto' />
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='file' id='avatar' name='avatar'>
                <br><br>

                <label> <b>Morada</b> </label>
                <input type='text' value='$morada' class='w3-input' id='morada' placeholder='Morada' name='morada' required>

                <label> <b>Distrito:</b> </label>
                <select class='w3-input' name='distrito' id='distrito' size='1' required>
                    <option value='$distrito' name='$distrito' selected>$distrito</option>
                </select> 
                
                <label> <b>Concelho:</b> </label>
                <select class='w3-input' name='concelho' id='concelho' size='1' required>
                    <option value='$concelho' name='$concelho' selected>$concelho</option>
                </select> 
                
                <label> <b>Freguesia:</b> </label>
                <select class='w3-input' name='freguesia' id='freguesia' size='1' required>
                    <option value='$freguesia' name='$freguesia' selected>$freguesia</option>
                </select> 
                
                <label> <b>Nome do Representante da Instituição</b> </label>
                <input type='text' value='$nome_representante' class='w3-input' id='nomeRepresentante' placeholder='Nome do Representante da Instituição' name='nomeRepresentante' required>
                
                <label> <b>E-mail do Representante da Instituição</b> </label>
                <input type='text' value='$email_representante' class='w3-input' id='emailRepresentante' placeholder='E-mail do Representante da Instituição' name='emailRepresentante' required>
                
            </div>

            <input id='submitI' class='w3-button w3-indigo w3-hover-blue' type='submit' name='editarPerfilI' value='Submeter'>

        </form>
    </div>"; 
    }

    if (!empty($_POST['editarPerfilI'])){

        $id = $loggedid;
        $nomeInstituicao = test_input($_POST['nomeInstituicao']); #unique
        $telefone = test_input($_POST['telefone']);
        $morada = test_input($_POST['morada']);
        $distrito = test_input($_POST['distrito']);
        $concelho = test_input($_POST['concelho']);
        $freguesia = test_input($_POST['freguesia']);
        $email = test_input($_POST['email']); #unique
        $nomeRepresentante = test_input($_POST['nomeRepresentante']);
        $emailRepresentante = test_input($_POST['emailRepresentante']);
        $PasswordA = test_input($_POST['PasswordA']);
        $PasswordN = test_input($_POST['PasswordN']);
        $bio = test_input($_POST['bio']);
        $website = test_input($_POST['website']); # pode ser null

        include "../Controller/InputPhotoController.php";

        $instituicao = openInstituicao($loggedid);
        $fotografia = $instituicao['foto'];

        $avatar = test_photo();

        if ($avatar == 'Nenhuma imagem enviada.') {
            $avatar = $fotografia;
        }

        if (substr($avatar,0,6) == "Images") {

            $updateI = updateInstituicao($id, $nomeInstituicao, $telefone, $morada, $distrito, $concelho, $freguesia, $email, $nomeRepresentante, $emailRepresentante, $PasswordA, $PasswordN, $bio, $website, $avatar);
            echo $updateI;

        } else {
            // Erro no input da fotografia
            echo "<p class='erro'> ". $avatar ." </p>";
        }
    }

?>


</body>

<footer>
    <div id='EndDiv'>
    
        <ul id='endContactosL'>
            <li>Tel.: 93-77-tira-tira-mete-mete</li>
            <li>Mail: VoluntárioCOVID19@mail.com</li>
            <li>Morada: Rua D. Francisco, nº 92, Amadora city</li>
        </ul>
    

        <div class='vl'></div>

        <ul id='endPaginas1'>
            <a href='Sobre.php'><li>Sobre</li></a>
            <br>
            <a href='Publicacoes.php'><li>Publicações</li></a>
            <br>
            <a href='Covid19.php'><li>COVID-19</li></a>
        </ul>
        <ul id='endPaginas2'>
            <a href='Instituicoes.php'><li>Instituições</li></a>
            <br>
            <a href='Voluntarios.php'><li>Voluntários</li></a>
        </ul>

        <p id='endD'>Todos os direitos reservados a Gonçalo Ventura, Margarida Rodrigues, Renato Ramires e Tiago Teodoro</p>
    </div>
</footer>