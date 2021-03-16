<!-- ASW -->
<?php
    session_start();
    ob_start();

    if (!isset($_SESSION['logged'])) {
        header('Location: Login.php');
    }

?>
<!DOCTYPE html>
<html>
<title>Editar Perfil</title>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
<link rel='stylesheet' href='CSS/EditarPerfilC.css'>
<script src='https://kit.fontawesome.com/91ccf300f9.js' crossorigin='anonymous'></script>
<script src="JavaScript/DCF.js"></script>

<header>
    <div class='w3-bar w3-large' id='navigation'>
        <a href='HomePage.php' class='w3-bar-item w3-button w3-hover-blue w3-mobile'>VoluntárioCOVID19</a>

        <input type='text' class='w3-bar-item w3-input' placeholder='Procura...'>
        
        <?php
            include 'openconn.php';

            if (!isset($_SESSION['logged'])) {
                echo "<a href='Perfil.php' class='w3-bar-item w3-button w3-hover-blue w3-right w3-mobile'><i class='fa fa-user-circle'></i></a>";
            } else {
                $queryUtilizador = "SELECT id, tipo 
                            FROM Utilizador 
                            WHERE id = '".$_SESSION['loggedid']."';";

                $resultUtilizador = $conn->query($queryUtilizador);

                if ($row = $resultUtilizador->fetch_assoc()){
                    
                    if ($row['tipo'] == "voluntario"){
                        $queryVoluntario = "SELECT id, foto
                            FROM Voluntario
                            WHERE id = '".$_SESSION['loggedid']."';";

                        $resultVoluntario = $conn->query($queryVoluntario);

                        if ($rowV = $resultVoluntario->fetch_assoc()){
                            $foto = $rowV['foto'];
                        }
                    } else {
                        $queryInstituicao = "SELECT id, foto
                            FROM Instituicao
                            WHERE id = '".$_SESSION['loggedid']."';";

                        $resultInstituicao = $conn->query($queryInstituicao);

                        if ($rowI = $resultInstituicao->fetch_assoc()){
                            $foto = $rowI['foto'];
                        }
                    }
                }

                echo "<div class='w3-dropdown-hover w3-right w3-mobile'>
                        <button class='w3-button w3-hover-blue'>
                            <img alt='Avatar' class='w3-circle' id='foto' src='$foto' style='width:26px; height: 26px;'/>
                        </button>
                        <div class='w3-dropdown-content w3-bar-block w3-card-4 w3-left w3-small' style='right:0%; z-index: 100; width:10%;'>
                            <a href='Perfil.php' class='w3-bar-item w3-button'>Ver perfil</a>
                            <a href='EditarPerfil.php' class='w3-bar-item w3-button'>Editar perfil</a>
                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                <button type='submit' value='terminarS' name='terminarS' class='w3-bar-item w3-button w3-white w3-text-red'>Terminar sessão</button>
                            </form>
                        </div>
                    </div>";
            }

            if ($_POST['terminarS']){
                unset ($_SESSION['loggedtype']);
                unset ($_SESSION['logged']);
                unset ($_SESSION['loggedid']);
                unset ($_SESSION['opentype']);
                unset ($_SESSION['open']);
                unset ($_SESSION['openid']);
                echo "<meta http-equiv='refresh' content='0'>";
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

<?php

    include 'openconn.php';
    include "TestInput.php";

    $loggedtype = $_SESSION['loggedtype'];
    $logged = $_SESSION['logged'];
    $loggedid = $_SESSION['loggedid'];
    $opentype = $_SESSION['opentype'];
    $open = $_SESSION['open'];
    $openid = $_SESSION['openid'];

?>

<div id='BrancoDiv' class='w3-container'>

    <h2><b>Editar Perfil</b></h2>

    <br>

    <form id='registertext' enctype='multipart/form-data' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method='post'>

<?php

    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # -- VOLUNTARIO -------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------
    # ---------------------------------------------------------------------------------------

    if ($loggedtype == 'voluntario'){

        $queryVoluntario = "SELECT id, nome_voluntario, foto, bio, data_nascimento, genero, concelho
                            , distrito, freguesia, telefone, cc, carta_c, covid, email, password1
                            FROM Voluntario
                            WHERE id = '".$loggedid."';";

        $resultVoluntario = $conn->query($queryVoluntario);

        if (!($resultVoluntario)) {
            echo "Erro: search failed" . mysqli_error($conn);
        }              

        if ($row = $resultVoluntario->fetch_assoc()){
            $nome_voluntario = $row['nome_voluntario'];
            $foto = $row['foto'];
            $bio = $row['bio'];
            $data_nascimento = $row['data_nascimento'];
            $genero = $row['genero'];
            $concelho = $row['concelho'];
            $distrito = $row['distrito'];
            $freguesia = $row['freguesia'];
            $telefone = $row['telefone'];
            $cc = $row['cc'];
            $carta_c = $row['carta_c'];
            $covid = $row['covid'];
            $email = $row['email'];
            $password = $row['password1'];
        }


        echo "
            <div id='divEsq'>
                <label> <b>Nome Completo</b> </label>
                <input type='text' value='$nome_voluntario' class='w3-input' id='nomeProprio' placeholder='Nome Completo' name='nomeProprio' required />

                <label> <b>E-mail</b> </label>
                <input type='text' value='$email' class='w3-input' id='E-mail' placeholder='E-mail' name='E-mail' required/>

                <label> <b>Palavra-Passe</b> </label>
                <input type='text' value='$password' class='w3-input' id='Password' placeholder='Palavra-Passe' name='Password'required/>

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
                <img alt='Avatar' class='w3-circle' id='foto' src='$foto' />
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='file' id='avatar' name='avatar'/>  <!--accept='image/png, image/jpeg'-->
                <br><br>

                <label>Distrito:</label>
                <select class='w3-input' name='distrito' id='distrito' size='1' required>
                    <option value='$distrito' name='$distrito' selected>$distrito</option>
                </select> 
                
                <label>Concelho:</label>
                <select class='w3-input' name='concelho' id='concelho' size='1' required>
                    <option value='$concelho' name='$concelho' selected>$concelho</option>
                </select> 
                
                <label>Freguesia:</label>
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
            
        $sqlArea = "SELECT area
                    FROM Voluntario_Area
                    WHERE id_voluntario = '".$voluntario."';";

        $resultA = $conn->query($sqlArea);
            
        if (!($resultA)) {
            echo "Erro: search failed" . $query . "<br>" . mysqli_error($conn);
        }              

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
            
        $sqlPopulacao = "SELECT populacao_alvo
                    FROM Voluntario_Populacao_Alvo
                    WHERE id_voluntario = '".$voluntario."';";

        $resultP = $conn->query($sqlPopulacao);
        
        if (!($resultP)) {
            echo "Erro: search failed" . $query . "<br>" . mysqli_error($conn);
        }              

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
            
        $sqlDisponibilidade = "SELECT dia, hora, duracao
                    FROM Voluntario_Disponibilidade
                    WHERE id_voluntario = '".$voluntario."';";

        $resultD = $conn->query($sqlDisponibilidade);
        
        if (!($resultD)) {
            echo "Erro: search failed" . $query . "<br>" . mysqli_error($conn);
        }              

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

            $insertArea = "insert into Voluntario_Area
                            values ('".$voluntario."' , '".$area_interesse."')";

            $resArea = mysqli_query($conn, $insertArea);
            
            if ($resArea) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if ($_POST['submitP']) {
            $populacao_alvo = test_input($_POST['populacao-alvo']);

            $insertPopulacao = "insert into Voluntario_Populacao_Alvo
                            values ('".$voluntario."' , '".$populacao_alvo."')";

            echo $insertPopulacao;

            $resPopulacao = mysqli_query($conn, $insertPopulacao);
            
            if ($resPopulacao) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if ($_POST['submitD']) {
            $dia = test_input($_POST['disponibilidade-dia']);
            $hora = test_input($_POST['disponibilidade-hora']);
            $duracao = test_input($_POST['disponibilidade-duracao']);

            $insertDispo = "insert into Voluntario_Disponibilidade
                            values ('".$voluntario."' , '".$dia."' ,
                                '".$hora."' , '".$duracao."')";

            $resDispo = mysqli_query($conn, $insertDispo);
            
            if ($resDispo) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if (!empty($_POST['removeA'])){
            $rArea = test_input($_POST['removeA']);

            $removeArea = "DELETE FROM Voluntario_Area
                        WHERE id_voluntario = '".$voluntario."' 
                        AND area = '".$rArea."';";

            $resrArea = mysqli_query($conn, $removeArea);
            
            if ($resrArea) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if (!empty($_POST['removeP'])){
            $rPopulacao = test_input($_POST['removeP']);

            $removePopulacao = "DELETE FROM Voluntario_Populacao_Alvo
                        WHERE id_voluntario = '".$voluntario."' 
                        AND populacao_alvo = '".$rPopulacao."';";

            $resrPopulacao = mysqli_query($conn, $removePopulacao);
            
            if ($resrPopulacao) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if (!empty($_POST['removeD'])){
            $rDispo = test_input($_POST['removeD']);

            $rDis = explode("/", $rDispo);
            $rDia = $rDis[0];
            $rHora = $rDis[1];
            $rDuracao = $rDis[2];

            $removeDispo = "DELETE FROM Voluntario_Disponibilidade
                        WHERE id_voluntario = '".$voluntario."' 
                        AND dia = '".$rDia."'
                        AND hora = '".$rHora."'
                        AND duracao = '".$rDuracao."';";

            $resrDispo = mysqli_query($conn, $removeDispo);
            
            if ($resrDispo) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
        
        echo "</div>
        </div>";
        
   
?>




<?php
            if (!empty($_POST['editarPerfilV'])){

                $id = $loggedid;
                $nomeProprio = test_input($_POST['nomeProprio']); 
                $Email = test_input($_POST['E-mail']);                       #unique
                $Password = test_input($_POST['Password']);
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

                $erro = 0;

                if (($_FILES['avatar']['tmp_name']) != ''){

                    try {

                        // Previne erros (podem ser ataques informaticos mas nao so).
                        if (
                            !isset($_FILES['avatar']['error']) ||
                            is_array($_FILES['avatar']['error'])
                        ) {
                            throw new RuntimeException('Imagem inválida.');
                        }

                        // Verifica o valor do erro
                        switch ($_FILES['avatar']['error']) {
                            case UPLOAD_ERR_OK:
                                break;
                            case UPLOAD_ERR_NO_FILE:
                                throw new RuntimeException('Nenhuma imagem enviada.');
                            case UPLOAD_ERR_INI_SIZE:
                            case UPLOAD_ERR_FORM_SIZE:
                                throw new RuntimeException('Imagem demasiado grande.');
                            default:
                                throw new RuntimeException('Imagem inválida.');
                        }

                        // Verifica se o tamanho limite nao foi ultrapassado
                        if ($_FILES['avatar']['size'] > 10000000) {
                            throw new RuntimeException('Imagem demasiado grande.');
                        }

                        // Verifica o tipo do ficheiro
                        $finfo = new finfo(FILEINFO_MIME_TYPE);
                        if (false === $ext = array_search(
                            $finfo->file($_FILES['avatar']['tmp_name']),
                            array(
                                'jpg' => 'image/jpeg',
                                'png' => 'image/png',
                                'gif' => 'image/gif',
                            ),
                            true
                        )) {
                            throw new RuntimeException('Formato da imagem inválido.');
                        }

                        $avatar = 'Images/'.sha1_file($_FILES['avatar']['tmp_name']).'.'.$ext;

                        // Obtem um nome unico para guardar a fotografia no servidor.
                        if (!move_uploaded_file(
                            $_FILES['avatar']['tmp_name'],
                            sprintf('Images/%s.%s',
                                sha1_file($_FILES['avatar']['tmp_name']),
                                $ext
                            )
                        )) {
                            throw new RuntimeException('Não foi possivel carregar a imagem.');
                        }

                    } catch (RuntimeException $e) {

                        echo "<p class='erro'>".$e->getMessage()."</p>";
                        $erro = 1;
                        
                    }

                } else {
                    $avatar = $foto;
                }

                if ($erro == 0){
                    $check = 0;

                    $sqlNome = "SELECT V.email
                                FROM Voluntario V
                                WHERE V.id != '".$loggedid."'
                                UNION
                                SELECT I.email
                                FROM Instituicao I
                                WHERE I.id <> '".$loggedid."'";    

                    $resultN = $conn->query($sqlNome);


                    $sqlCC = "SELECT cc
                                FROM Voluntario
                                WHERE V.id <> '".$loggedid."'";  

                    $resultCC = $conn->query($sqlCC);

                    unset($msgErro);

                    if (filter_var($Email, FILTER_VALIDATE_EMAIL) ){
                        if (strlen((string)$telefone) == 9){
                            if (strlen((string)$CC) == 8){
                                if (strlen((string)$Password) > 6){
                                    if ($resultN->num_rows > 0) {
                                        while ($row = $resultN->fetch_assoc()){
                                            if ($row[0] == $Email){
                                                $msgErro = "<p class='erro'> E-mail já existe </p>";
                                            }
                                        }
                                    }
                                    if ($resultCC->num_rows > 0) {
                                        while ($rowC = $resultCC->fetch_assoc()){
                                            if ($rowC[0] == $CC){
                                                $msgErro = "<p class='erro'> CC já existe </p>";
                                            }
                                        }
                                    }
                                } else {
                                    $msgErro = "<p class='erro'> Password deve ter, pelo menos, 7 caracteres. </p>";
                                }
                            } else {
                                $msgErro = "<p class='erro'> Insira um cc válido </p>";
                            }
                        } else {
                            $msgErro = "<p class='erro'> Insira um numero de tel. válido </p>";
                        }
                    } else {
                        $msgErro = "<p class='erro'> Insira um e-mail válido </p>";
                    }
                    
                    echo $msgErro;

                    if (!isset($msgErro)){
                        
                        $query = "UPDATE Voluntario
                                SET id = '$id',nome_voluntario = '$nomeProprio', data_nascimento = '$dataNascimento',
                                genero = '$genero', foto = '$avatar', bio = '$bio', concelho = '$concelho',
                                distrito = '$distrito', freguesia = '$freguesia', telefone = '$telefone',
                                cc = '$CC', carta_c = '$carta', covid = '$covid', email = '$Email',
                                password1 = '$Password'
                                WHERE id = '$loggedid'";
                        
                        $res = mysqli_query($conn, $query);
                        
                        if ($res) {
                            $_SESSION['loggedtype'] = "voluntario";
                            $_SESSION['logged'] = $nomeProprio;
                            $_SESSION['loggedid'] = $id;
                            $_SESSION['opentype'] = "voluntario";
                            $_SESSION['open'] = $nomeProprio;
                            $_SESSION['openid'] = $id;
                            echo "<meta http-equiv='refresh' content='0'>";
                        } else {
                            echo "<h1 class='erro'> Algo deu errado. </h1>";
                        }
                        
                    }
                }
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

        $queryInstituicao = "SELECT id, nome_instituicao, telefone, morada, concelho, distrito, 
                            freguesia, email, bio, nome_representante, email_representante, password2, foto,
                            website
                            FROM Instituicao
                            WHERE id = '".$loggedid."';";

        $resultInstituicao = $conn->query($queryInstituicao);

        if (!($resultInstituicao)) {
            echo "Erro: search failed" . mysqli_error($conn);
        }              

        if ($row = $resultInstituicao->fetch_assoc()){

            $id = $row['id'];
            $nome_instituicao = $row['nome_instituicao'];
            $telefone = $row['telefone'];
            $morada = $row['morada'];
            $concelho = $row['concelho'];
            $distrito = $row['distrito'];
            $freguesia = $row['freguesia'];
            $email = $row['email'];
            $bio = $row['bio'];
            $nome_representante = $row['nome_representante'];
            $email_representante = $row['email_representante'];
            $password2 = $row['password2'];
            $foto = $row['foto'];
            $website = $row['website'];
        }


        echo "
            <div id='divEsq'>
                <label> <b>Nome da Instituição</b> </label>
                <input type='text' value='$nome_instituicao' class='w3-input' id='nomeInstituicao' placeholder='Nome da Instituição' name='nomeInstituicao' required>

                <label> <b>Telemóvel/Telefone</b> </label>
                <input type='text' value='$telefone' class='w3-input' id='telefone' placeholder='Telemóvel/Telefone' name='telefone' required>

                <label> <b>E-mail da Instituição</b> </label>
                <input type='text' value='$email' class='w3-input' id='E-mail' placeholder='E-mail da Instituição' name='email' required>

                <label> <b>Palavra-Passe</b> </label>
                <input type='text' value='$password2' class='w3-input' id='password' placeholder='Palavra-Passe' name='password' required>
                
                <label> <b>Website</b> </label>
                <input type='text' value='$website' class='w3-input' id='website' placeholder='Website' name='website'>

                <label> <b>Biografia</b> </label>
                <textarea type='text' class='w3-input' id='biografia' placeholder='Escreva uma pequena bio sobre a instituição...' name='bio' rows='3' maxlength='240' required>$bio</textarea>
            </div>
            <div id='divDir'>
                        
                <label> <b>Fotografia de Perfil</b> </label> <br><br>
                <img alt='Avatar' class='w3-circle' id='foto' src='$foto' />
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='file' id='avatar' name='avatar'>
                <br><br>

                <label> <b>Morada</b> </label>
                <input type='text' value='$morada' class='w3-input' id='morada' placeholder='Morada' name='morada' required>

                <label>Distrito:</label>
                <select class='w3-input' name='distrito' id='distrito' size='1' required>
                    <option value='$distrito' name='$distrito' selected>$distrito</option>
                </select> 
                
                <label>Concelho:</label>
                <select class='w3-input' name='concelho' id='concelho' size='1' required>
                    <option value='$concelho' name='$concelho' selected>$concelho</option>
                </select> 
                
                <label>Freguesia:</label>
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
?>






<?php

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
                $password = test_input($_POST['password']);
                $bio = test_input($_POST['bio']);
                $website = test_input($_POST['website']); # pode ser null

                $erro = 0;

                if (($_FILES['avatar']['tmp_name']) != ''){

                    try {

                        // Previne erros (podem ser ataques informaticos mas nao so).
                        if (
                            !isset($_FILES['avatar']['error']) ||
                            is_array($_FILES['avatar']['error'])
                        ) {
                            throw new RuntimeException('Imagem inválida.');
                        }

                        // Verifica o valor do erro
                        switch ($_FILES['avatar']['error']) {
                            case UPLOAD_ERR_OK:
                                break;
                            case UPLOAD_ERR_NO_FILE:
                                throw new RuntimeException('Nenhuma imagem enviada.');
                            case UPLOAD_ERR_INI_SIZE:
                            case UPLOAD_ERR_FORM_SIZE:
                                throw new RuntimeException('Imagem demasiado grande.');
                            default:
                                throw new RuntimeException('Imagem inválida.');
                        }

                        // Verifica se o tamanho limite nao foi ultrapassado
                        if ($_FILES['avatar']['size'] > 10000000) {
                            throw new RuntimeException('Imagem demasiado grande.');
                        }

                        // Verifica o tipo do ficheiro
                        $finfo = new finfo(FILEINFO_MIME_TYPE);
                        if (false === $ext = array_search(
                            $finfo->file($_FILES['avatar']['tmp_name']),
                            array(
                                'jpg' => 'image/jpeg',
                                'png' => 'image/png',
                                'gif' => 'image/gif',
                            ),
                            true
                        )) {
                            throw new RuntimeException('Formato da imagem inválido.');
                        }

                        $avatar = 'Images/'.sha1_file($_FILES['avatar']['tmp_name']).'.'.$ext;

                        // Obtem um nome unico para guardar a fotografia no servidor.
                        if (!move_uploaded_file(
                            $_FILES['avatar']['tmp_name'],
                            sprintf('Images/%s.%s',
                                sha1_file($_FILES['avatar']['tmp_name']),
                                $ext
                            )
                        )) {
                            throw new RuntimeException('Não foi possivel carregar a imagem.');
                        }

                    } catch (RuntimeException $e) {

                        echo "<p class='erro'>".$e->getMessage()."</p>";
                        $erro = 1;
                        
                    }

                } else {
                    $avatar = $foto;
                }

                if ($erro == 0){
                    $sqlEmail = "SELECT email
                                    FROM Instituicao";    

                    $resultE = $conn->query($sqlEmail);

                    unset($msgErro);

                    if (filter_var($email, FILTER_VALIDATE_EMAIL) ){
                        if (filter_var($emailRepresentante, FILTER_VALIDATE_EMAIL) ){
                            if (strlen((string)$telefone) == 9){
                                if (strlen((string)$password) > 6){
                                    if ($resultE->num_rows > 0) {
                                        while ($rowE = $resultE->fetch_assoc()){
                                            if ($rowE[0] == $email){
                                                $msgErro = "<p class='erro'> E-mail já existe </p>";
                                            }
                                        }
                                    }
                                } else {
                                    $msgErro = "<p class='erro'> Password deve ter, pelo menos, 7 caracteres. </p>";
                                }
                            } else {
                                $msgErro = "<p class='erro'> Insira um numero de tel. válido </p>";
                            }
                        } else {
                            $msgErro = "<p class='erro'> Insira um e-mail do representante válido </p>";
                        }
                    } else {
                        $msgErro = "<p class='erro'> Insira um e-mail válido </p>";
                    }
                    
                    echo $msgErro;

                    if (!isset($msgErro)){
                        
                        $query = "UPDATE Instituicao
                                SET id = '$id', nome_instituicao = '$nomeInstituicao', telefone = '$telefone',
                                morada = '$morada', distrito = '$distrito', concelho = '$concelho', freguesia = '$freguesia',
                                email = '$email', bio = '$bio', nome_representante = '$nomeRepresentante',
                                email_representante = '$email_representante', password2 = '$password', foto = '$avatar',
                                website = '$website'
                                WHERE id = '$loggedid'";
                        
                        $res = mysqli_query($conn, $query);
                        
                        if ($res) {
                            $_SESSION['loggedtype'] = "instituicao";
                            $_SESSION['logged'] = $nomeInstituicao;
                            $_SESSION['loggedid'] = $id;
                            $_SESSION['opentype'] = "instituicao";
                            $_SESSION['open'] = $nomeInstituicao;
                            $_SESSION['openid'] = $id;
                            echo "<meta http-equiv='refresh' content='0'>";
                        } else {
                            echo "<h1 class='erro'> Algo deu errado. </h1>";
                        }
                        
                    }
                }
            }
                
    }

?>


<!--
    <div id='BrancoDiv' class='w3-container'>

        <h2>Editar Perfil</h2>

        <br>

        <h3 class='w3-left-align'>Foto de Perfil:</h3>
       
        <div id='fotoPerfil'>
            <h1></h1> Foto do utilizador
        </div>

        <form id='dados1'>
            <label> Nome Completo:</label>
            <input type='text' class='w3-input' >
            <br>
            <label> E-mail:</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Distrito:</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Concelho:</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Freguesia:</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Data de Nascimento:</label>
            <input type='text' class='w3-input' >
            <br>
        </form>
        <form id='dados2'>
            <label>Palavra-Passe:</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Género:</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Cartão do Cidadão:</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Carta de Condução (S / N):</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Covid (S / N):</label>
            <input type='text' class='w3-input' >
 
        </form>
    </div>

    <div id='DesDiv' class='w3-container'>

        <h2>Editar Descrição</h2>

        <form id='dadose'>
            <br>
            <label> Biografia: </label>
            <input type='text' class='w3-input' >
            <br>
            <label> Área de Interesse: </label>
            <input type='text' class='w3-input' >
            <br>
            <label>População alvo:</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Disponibilidade (dia da semana):</label>
            <input type='text' class='w3-input' >
            <br>
            <label>Disponibilidade (perído do dia):</label>    
            <input type='text' class='w3-input' >
            <br>
            <label>Disponibilidade (número de horas):</label>
            <input type='text' class='w3-input' >
        
        </form>
    </div>
 -->


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