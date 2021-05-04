<?php

    session_start();
    ob_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    function openVoluntario($id) {
        
        $voluntario = query_voluntario($id);
        if ($row = $voluntario->fetch_assoc()){
            return $row;
        }

    }

    function areasV($id){
        return areas_voluntario($id);
    }

    function populacaoV($id){
        return populacao_voluntario($id);
    }

    function disponibilidadeV($id){
        return disponibilidade_voluntario($id);
    }

    function insertA($voluntario, $area_interesse){
        return insert_area($voluntario, $area_interesse);
    }

    function insertP($voluntario, $populacao_alvo){
        return insert_populacao($voluntario, $populacao_alvo);
    }

    function insertD($voluntario, $dia, $hora, $duracao){
        return insert_disponibilidade($voluntario, $dia, $hora, $duracao);
    }

    function removeArea($voluntario, $area){
        return remove_area($voluntario, $area);
    }

    function removePopulacao($voluntario, $populacao){
        return remove_populacao($voluntario, $populacao);
    }

    function removeDisponibilidade($voluntario, $dia, $hora, $duracao){

        return remove_disponibilidade($voluntario, $dia, $hora, $duracao);
    }

    function updateVoluntario($id, $nomeProprio, $Email, $PasswordA, $PasswordN, $telefone, $dataNascimento, $CC, $bio, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $avatar) {

        $emailsDif = emails_diferentes_logged($id);

        $ccsDif = ccs_diferentes_logged($id);

        unset($msgErro);

        if (filter_var($Email, FILTER_VALIDATE_EMAIL) ){
            if (strlen((string)$telefone) == 9){
                if (strlen((string)$CC) == 8){
                    if ($emailsDif->num_rows > 0) {
                        while ($row = $emailsDif->fetch_assoc()){
                            if ($row[0] == $Email){
                                $msgErro = "<p class='erro'> E-mail já existe </p>";
                            }
                        }
                    }
                    if ($ccsDif->num_rows > 0) {
                        while ($rowC = $ccsDif->fetch_assoc()){
                            if ($rowC[0] == $CC){
                                $msgErro = "<p class='erro'> CC já existe </p>";
                            }
                        }
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

        if (!empty($PasswordA) and !empty($PasswordN)){
            $resultPw = select_password_vol($id);
            if ($rowPw = $resultPw->fetch_array()){
                if (password_verify($PasswordA, $rowPw[0])){
                    if (strlen((string)$PasswordN) > 6){
                        $Password = password_hash($PasswordN, PASSWORD_DEFAULT);
                    } else {
                        $msgErro = "<p class='erro'> Nova password deve ter pelo menos 7 carácteres </p>";
                    }
                } else {
                    $msgErro = "<p class='erro'> Password antiga não corresponde </p>";
                }
            }
        }
        
        if (isset($msgErro)){
            return $msgErro;
        }

        if (isset($Password)){

            $res = update_voluntario_w_password($id, $nomeProprio, $dataNascimento, $genero, $avatar, $bio, $concelho, $distrito, $freguesia, $telefone, $CC, $carta, $covid, $Email, $Password);

        } else {
            
            $res = update_voluntario($id, $nomeProprio, $dataNascimento, $genero, $avatar, $bio, $concelho, $distrito, $freguesia, $telefone, $CC, $carta, $covid, $Email);

        }
        
        if ($res) {
            $_SESSION['loggedtype'] = "voluntario";
            $_SESSION['logged'] = $nomeProprio;
            $_SESSION['loggedid'] = $id;
            $_SESSION['opentype'] = "voluntario";
            $_SESSION['open'] = $nomeProprio;
            $_SESSION['openid'] = $id;
            return "Updated.";
        } else {
            return "<h1 class='erro'> Algo deu errado. </h1>";
        }
        
    }

    function openInstituicao($id) {

        $instituicao = query_instituicao($id);
        if ($row = $instituicao->fetch_assoc()){
            return $row;
        }

    }

    function updateInstituicao($id, $nomeInstituicao, $telefone, $morada, $distrito, $concelho, $freguesia, $email, $nomeRepresentante, $emailRepresentante, $PasswordA, $PasswordN, $bio, $website, $avatar) {

        $emailsDif = emails_diferentes_logged($id);

        unset($msgErro);

        if (filter_var($email, FILTER_VALIDATE_EMAIL) ){
            if (filter_var($emailRepresentante, FILTER_VALIDATE_EMAIL) ){
                if (strlen((string)$telefone) == 9){
                    if ($emailsDif->num_rows > 0) {
                        while ($rowE = $emailsDif->fetch_assoc()){
                            if ($rowE[0] == $email){
                                $msgErro = "<p class='erro'> E-mail já existe </p>";
                            }
                        }
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
        if (!empty($PasswordA) and !empty($PasswordN)){
            
            $resultPw = select_password_ins($id);
            if ($rowPw = $resultPw->fetch_array()){
                if (password_verify($PasswordA, $rowPw[0])){
                    if (strlen((string)$PasswordN) > 6){
                        $Password = password_hash($PasswordN, PASSWORD_DEFAULT);
                    } else {
                        $msgErro = "<p class='erro'> Nova password deve ter pelo menos 7 carácteres </p>";
                    }
                } else {
                    $msgErro = "<p class='erro'> Password antiga não corresponde </p>";
                }
            }
        }
        
        if (isset($msgErro)){
            return $msgErro;
        }

        if (isset($Password)){
            $res = update_instituicao_w_password($id, $nomeInstituicao, $telefone, $morada, $distrito, $concelho, $freguesia, $email, $bio, $nomeRepresentante, $emailRepresentante, $Password, $avatar, $website);
        } else {
            $res = update_instituicao($id, $nomeInstituicao, $telefone, $morada, $distrito, $concelho, $freguesia, $email, $bio, $nomeRepresentante, $emailRepresentante, $avatar, $website);
        }
        
        if ($res) {
            $_SESSION['loggedtype'] = "instituicao";
            $_SESSION['logged'] = $nomeInstituicao;
            $_SESSION['loggedid'] = $id;
            $_SESSION['opentype'] = "instituicao";
            $_SESSION['open'] = $nomeInstituicao;
            $_SESSION['openid'] = $id;
            echo "Updated.";
        } else {
            return "<h1 class='erro'> Algo deu errado. </h1>";
        }
    }

    function openAcao($id_acao) {
        return query_acao($id_acao);
    }

    function inserirAcaoE($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao){
        inserir_acao($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao);
    }

    function updateAcaoE($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao){
        update_acao($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao);
        echo "<meta http-equiv='refresh' content='0'>";
    }

    function removeAcaoE($id){
        remove_acao($id);
    }

    $show_editar_perfil_voluntario = $_REQUEST['show_editar_perfil_voluntario'];

    if ($show_editar_perfil_voluntario) {

        include_once "../Model/Model.php";

        $loggedid = $_SESSION['loggedid'];

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
        <form id='registertext' enctype='multipart/form-data'>
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
    }

    $show_editar_preferencias_voluntario = $_REQUEST['show_editar_preferencias_voluntario'];

    if ($show_editar_preferencias_voluntario) {

        $loggedid = $_SESSION['loggedid'];

        include_once "../Model/Model.php";
        
        echo "<div id='PreferenciasDiv' class='w3-container'>

        <h2><b>Editar Preferências</b></h2>

        <br>

        <div id='preftext'>";

        echo "<div id='areasform'>
                <label><b>Áreas de interesse:</b></label>
                    <select class='w3-select sela' name='area-interesse' id='sel-area-interesse' required>
                        <option value='' disabled selected>Selecione uma área de interesse</option>
                        <option value='Ação social'>Ação social</option>
                        <option value='Educação'>Educação</option>
                        <option value='Saúde'>Saúde</option>
                    </select>

                <input class='w3-green w3-round-xxlarge' type='submit' value='+' name='submitA' onclick='addArea()'>
            </div>
            ";

        $voluntario = $_SESSION['loggedid'];
            
        $resultA = areasV($voluntario);     

        if ($resultA->num_rows > 0) {

            $checkArea = 1;
            echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
            echo "<ul class='w3-ul w3-center'>";            
            while ($row = $resultA->fetch_assoc()){
                echo "<li> <div>" . $row['area'] . "
                    <button class='w3-right w3-red w3-round-xxlarge' onclick='removeArea(".json_encode($row['area']).")' type='submit' value='".$row['area']."' name='removeA'>
                        <i class='fa fa-trash-alt'></i>
                    </button>
                    </div> 
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
        
        echo "<div id='populacaoform'>
            <label><b>População-alvo:</b></label>
                <select class='w3-select selp' name='populacao-alvo' id='sel-populacao'>
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

            <input class='w3-green w3-round-xxlarge' type='submit' value='+' name='submitP' onclick='addPopulacao()'>
        </div>";


        $voluntario = $_SESSION['loggedid'];
            
        $resultP = populacaoV($voluntario);

        if ($resultP->num_rows > 0) {

            $checkPopulacao = 1;

            echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
            echo "<ul class='w3-ul w3-center'>";            
            while ($row = $resultP->fetch_assoc()){
                echo "<li> <div>" . $row['populacao_alvo'] . "
                    <button class='w3-right w3-red w3-round-xxlarge' onclick='removePopulacao(".json_encode($row['populacao_alvo']).")' type='submit' value='".$row['populacao_alvo']."' name='removeP'>
                        <i class='fa fa-trash-alt'></i>
                    </button>
                    </div> 
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
        
        echo "<div id='disponibilidadeform'>
            <label><b>Disponibilidade:</b></label>
                <select class='w3-select disponibilidade' name='disponibilidade-dia' id='sel-dia'>
                    <option value='' disabled selected>Dia</option>
                    <option value='Segunda-feira'>Segunda-feira</option>
                    <option value='Terça-feira'>Terça-feira</option>
                    <option value='Quarta-feira'>Quarta-feira</option>
                    <option value='Quinta-feira'>Quinta-feira</option>
                    <option value='Sexta-feira'>Sexta-feira</option>
                    <option value='Sábado'>Sábado</option>
                    <option value='Domingo'>Domingo</option>
                </select>
                <select class='w3-select disponibilidade' name='disponibilidade-hora' id='sel-hora'>
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
                <select class='w3-select disponibilidade' name='disponibilidade-duracao' id='sel-duracao'>
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
            
            <input class='w3-green w3-round-xxlarge' type='submit' value='+' name='submitD' onclick='addDisponibilidade()'>
        </div>";

        
        $voluntario = $_SESSION['loggedid'];
            
        $resultD = disponibilidadeV($voluntario);

        if ($resultD->num_rows > 0) {

            $checkDisponibilidade = 1;

            echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue'>";   
            echo "<ul class='w3-ul w3-center'>";            
            while ($row = $resultD->fetch_assoc()){
                echo "<li> <div>
                    Dia: " . $row['dia'] . ", hora: ". $row['hora'] .":00, duração: ".$row['duracao']." horas.
                    <button class='w3-right w3-red w3-round-xxlarge' type='submit'
                            onclick='removeDisponibilidade(".json_encode($row['dia']).", ".json_encode($row['hora']).", ".json_encode($row['duracao']).")'
                            value='".$row['dia']."/".$row['hora']."/".$row['duracao']."' 
                            name='removeD'>
                        <i class='fa fa-trash-alt'></i>
                    </button>
                    </div> 
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
    }

    if (!empty($_POST['nomeProprio'])){

        include_once "../Model/Model.php";
        $loggedid = $_SESSION['loggedid'];
        $queryVoluntario = openVoluntario($loggedid);
        $foto = $queryVoluntario['foto'];

        include_once "../View/TestInput.php";

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

        include_once "InputPhotoController.php";

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

    $add_area_interesse = $_REQUEST['add_area_interesse'];

    if ($add_area_interesse) {

        include_once "../Model/Model.php";
        include_once "../View/TestInput.php";

        $voluntario = $_SESSION['loggedid'];

        $area_interesse = test_input($add_area_interesse);

        $insertA = insertA($voluntario, $area_interesse);

        if ($insertA == TRUE){

            echo 'yes';
        }
    }

    $add_populacao_alvo = $_REQUEST['add_populacao_alvo'];

    if ($add_populacao_alvo) {

        include_once "../Model/Model.php";
        include_once "../View/TestInput.php";

        $voluntario = $_SESSION['loggedid'];

        $populacao_alvo = test_input($add_populacao_alvo);

        $insertP = insertP($voluntario, $populacao_alvo);

        if ($insertP == TRUE){
            echo 'yes';
        }
    }

    $add_dia = $_REQUEST['add_dia'];
    $add_hora = $_REQUEST['add_hora'];
    $add_duracao = $_REQUEST['add_duracao'];

    if ($add_dia and $add_hora and $add_duracao) {

        include_once "../Model/Model.php";
        include_once "../View/TestInput.php";

        $voluntario = $_SESSION['loggedid'];

        $dia = test_input($add_dia);
        $hora = test_input($add_hora);
        $duracao = test_input($add_duracao);

        $insertD = insertD($voluntario, $dia, $hora, $duracao);

        if ($insertD == TRUE){

            echo 'yes';
        }
    } 

    $remove_area_interesse = $_REQUEST['remove_area_interesse'];

    if ($remove_area_interesse) {

        include_once "../Model/Model.php";
        include_once "../View/TestInput.php";

        $voluntario = $_SESSION['loggedid'];

        $area_interesse = test_input($remove_area_interesse);

        $removeA = removeArea($voluntario, $area_interesse);

        if ($removeA == TRUE){
            echo 'yes';
        }
    }

    $remove_populacao_alvo = $_REQUEST['remove_populacao_alvo'];

    if ($remove_populacao_alvo) {

        include_once "../Model/Model.php";
        include_once "../View/TestInput.php";

        $voluntario = $_SESSION['loggedid'];

        $populacao_alvo = test_input($remove_populacao_alvo);

        $removeP = removePopulacao($voluntario, $populacao_alvo);

        if ($removeP == TRUE){
            echo 'yes';
        }
    }

    $remove_dia = $_REQUEST['remove_dia'];
    $remove_hora = $_REQUEST['remove_hora'];
    $remove_duracao = $_REQUEST['remove_duracao'];

    if ($remove_dia and $remove_hora and $remove_duracao) {

        include_once "../Model/Model.php";
        include_once "../View/TestInput.php";

        $voluntario = $_SESSION['loggedid'];

        $dia = test_input($remove_dia);
        $hora = test_input($remove_hora);
        $duracao = test_input($remove_duracao);

        $removeD = removeDisponibilidade($voluntario, $dia, $hora, $duracao);

        if ($removeD == TRUE){
            echo 'yes';
        }
    }

    $show_editar_perfil_instituicao = $_REQUEST['show_editar_perfil_instituicao'];

    if ($show_editar_perfil_instituicao) {

        include_once "../Model/Model.php";

        $loggedid = $_SESSION['loggedid'];

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
        <form id='registertext' enctype='multipart/form-data'>
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

    $show_editar_preferencias_instituicao = $_REQUEST['show_editar_preferencias_instituicao'];

    if ($show_editar_preferencias_instituicao) {
        echo "<div id='PreferenciasIDiv' class='w3-container'>

        <h2><b>Editar Preferências</b></h2>

        <div id='prefitext'>

        <div id='addacao'>
            <button class='w3-button w3-block w3-indigo w3-hover-white' type='submit' value='add' name='adicionaAcao'>
                Adiciona ação
            </button>
        </div>

        <label>Ações promovidas pela instituição:</label>";

        include_once "../Controller/PreferenciasIController.php";

        $instituicao = $_SESSION['loggedid'];

        $a = AcoesPreferenciasI($instituicao);

        $nomeInstituicao = PreferenciasINomeIns($instituicao);         

        if ($a->num_rows > 0) {

            while ($row = $a->fetch_assoc()){

                echo "<div class='w3-card-4'>
                            <header class='w3-container'>
                                <h3>".$nomeInstituicao."</h3>
                            </header>

                            <div class='w3-container w3-left'>
                                <h5>".$row['titulo']."</h5>
                                <hr>
                                <p><b>Distrito:</b> ".$row['distrito']." | <b>Concelho:</b> ".$row['concelho']." | <b>Freguesia:</b> ".$row['freguesia']."</p>
                                <p><b>Função:</b> ".$row['funcao']." | <b>Área de interesse:</b> ".$row['area_interesse']."</p>
                                <p><b>População-alvo:</b> ".$row['populacao_alvo']." | <b>Nº de vagas:</b> ".$row['num_vagas']."</p>
                                <p><b>Data:</b> ".$row['dia'].", ás ".$row['hora'].":00, durante ".$row['duracao']." horas</p>
                            </div>

                            <div>
                                <button class='w3-button w3-block w3-hover-red' type='submit' value='".$row['id_acao']."' name='removeAcao' disabled>
                                    Eliminar ação
                                </button>
                            </div>
                    </div>";
            }
        } else {
            echo "<p class='w3-display-middle'>Ainda não tem ações :(</p>";
        }

        echo "</div>
        </div>";

        echo "<form id='acaoform' class='w3-container w3-card hidden' method='post'>";
            
            echo " <header class='w3-container w3-indigo'>
                        <h3>Nova ação</h3>

                        <button class='w3-button w3-display-topright w3-large w3-hover-indigo' id='closeActionForm'>X</button>
                        </header>
                        <br>

                        <input type='text' class='w3-input' id='tituloAcao' placeholder='Titulo da ação' name='titulo' required>

                        <hr>

                        <div id='divEsqI'>

                            <label>Áreas de interesse:</label>
                                <select class='w3-select sel' name='area-interesse' required>
                                    <option value='' disabled selected>Selecione as suas áreas de interesse</option>
                                    <option value='Ação social'>Ação social</option>
                                    <option value='Educação'>Educação</option>
                                    <option value='Saúde'>Saúde</option>
                                </select>
                                
                            <hr>
                            
                            <label>População-alvo:</label>
                                <select class='w3-select sel' name='populacao-alvo' required>
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

                            <hr>
                            
                            <label>Função: </label>
                                <select class='w3-select sel' name='funcao' required>
                                    <option value='' disabled selected>Selecione a função</option>
                                    <option value='Entrega ao Domicilio de bens não alimentares'>Entrega ao Domicilio</option>
                                    <option value='Entrega de Bens Alimentares'>Entrega de Bens Alimentares</option>
                                    <option value='Prestação de Cuidados Básicos'>Prestação de Cuidados Básicos</option>
                                    <option value='Apoio a Lares'>Apoio a Lares</option>
                                    <option value='Cozinhar'>Cozinhar</option>
                                    <option value='Limpar'>Limpar</option>
                                    <option value='Apoio à infância e à Juventude'>Apoio à infância e à Juventude</option>
                                    <option value='Apoio Social a familias Carenciadas'>Apoio Social a familias Carenciadas</option>
                                    <option value='Apoios à angariação de bens para Animais de Companhia'>Apoios à angariação de bens para Animais de Companhia</option>

                                </select>

                            <hr>

                            <label>Número de Vagas:</label>
                                <input type='number' id='nVagas' name='vagas' min='1' max='1000' required>

                            <hr>

                            <label>Distrito:</label>
                            <select class='w3-select sel' name='distrito' id='distrito2' required>
                                <option value='' disabled selected>Selecione o seu Distrito:</option>
                            </select> 

                        </div>

                        <div id='divDirI'>
                            
                            <label>Concelho:</label>
                            <select class='w3-select sel' name='concelho' id='concelho2' required>
                                <option value='' disabled selected>Selecione o seu Concelho:</option>
                            </select>
                            
                            <hr>
                            
                            <label>Freguesia:</label>
                            <select class='w3-select sel' name='freguesia' id='freguesia2' required>
                                <option value='' disabled selected>Selecione a sua Freguesia:</option>
                            </select> 
                            
                            <hr>
                            
                            <label>Data:</label>
                                <input type='date' class='sel' name='disponibilidade-dia' placeholder='Data (AAAA-MM-DD)' required/>
                                    
                            <hr>

                            <label>Hora:</label>
                                <select class='w3-select sel' name='disponibilidade-hora' required>
                                    <option value='' disabled selected>Hora</option>
                                    <option value='0'>00:00</option>
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

                            <hr>

                            <label>Duração:</label>
                                <select class='w3-select sel' name='disponibilidade-duracao' required>
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

                        <button class='w3-button w3-indigo' id='submitIP' type='submit' name='CriarAcao' value='CriarAcao'>Criar ação</button>

                </form>";
    } 

    if (!empty($_POST['nomeInstituicao'])){

        include_once "../Model/Model.php";
        include_once "../View/TestInput.php";
        $loggedid = $_SESSION['loggedid'];

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

        include_once "../Controller/InputPhotoController.php";

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

    if (isset($_POST['disponibilidade-dia'])) {
        include_once "../View/TestInput.php";
        include_once "../Model/Model.php";

        $id_instituicao = $_SESSION['loggedid'];
        $id_acao = uniqid();;
        $titulo = test_input($_POST['titulo']); 
        $area_interesse = test_input($_POST['area-interesse']);
        $populacao_alvo = test_input($_POST['populacao-alvo']);
        $funcao = test_input($_POST['funcao']); 
        $distrito = test_input($_POST['distrito']);
        $concelho = test_input($_POST['concelho']);
        $freguesia = test_input($_POST['freguesia']);
        $vagas = test_input($_POST['vagas']); 
        $dia = test_input($_POST['disponibilidade-dia']);
        $hora = test_input($_POST['disponibilidade-hora']);
        $duracao = test_input($_POST['disponibilidade-duracao']);

        inserirAcaoE($id_instituicao, $id_acao, $titulo, $distrito, $concelho, $freguesia, $funcao, $area_interesse, $populacao_alvo, $vagas, $dia, $hora, $duracao);

        echo "Inseriu.";
    }


?>