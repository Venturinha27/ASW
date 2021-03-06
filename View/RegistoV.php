
<?php
    ob_start();
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Registo Voluntário</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/RegistoV.css" type="text/css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/DCF.js"></script>
<link rel="stylesheet" href="../CSS/ProcuraC.css">
<script src="../JavaScript/ProcuraJS.js"></script>
</head>

<body>

    <div id="BrancoDiv" class="w3-container">

        <h2>Registo do Voluntário</h2>

        <br>

    <?php

        $nomeErro = $_SESSION['erroVnome'];
        $emailErro = $_SESSION['erroVemail'];
        $passwordErro = $_SESSION['erroVpassword'];
        $telefoneErro = $_SESSION['erroVtelefone'];
        $nascimentoErro = $_SESSION['erroVnascimento'];
        $ccErro = $_SESSION['erroVcc'];
        $generoErro = $_SESSION['erroVgenero'];
        $bioErro = $_SESSION['erroVbio'];
        $avatarErro = $_SESSION['erroVavatar'];
        $distritoErro = $_SESSION['erroVdistrito'];
        $concelhoErro = $_SESSION['erroVconcelho'];
        $freguesiaErro = $_SESSION['erroVfreguesia'];
        $cartaErro = $_SESSION['erroVcarta'];
        $covidErro = $_SESSION['erroVcovid'];

        echo "<form id='registertext' enctype='multipart/form-data' action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
            <div id='divEsq'>
                <input type='text' value='$nomeErro' class='w3-input' id='nomeProprio' placeholder='Nome Completo' name='nomeProprio' required />

                <input type='text' value='$emailErro' class='w3-input' id='E-mail' placeholder='E-mail' name='E-mail'required/>

                <input type='password' value='$passwordErro' class='w3-input' id='Password' placeholder='Palavra-Passe' name='Password'required/>

                <input type='text' value='$telefoneErro' class='w3-input' id='telefone' placeholder='Telemóvel/Telefone' name='telefone'required/>

                <input type='date' value='$nascimentoErro' class='w3-input' id='dataNascimento' placeholder='Data de Nascimento (AAAA-MM-DD)' name='dataNascimento' required/>

                <input type='text' value='$ccErro' class='w3-input' id='CC' placeholder='Cartão de Cidadão' name='CC'required/>

                <label>Género</label>
                <select class='w3-input' name='genero'>";
                    if (isset($generoErro)) {
                        echo "<option value='$generoErro' selected>$generoErro</option>";
                    } else {
                        echo "<option value='' disabled selected>Selecione o seu género</option>";
                    }
                echo "
                    <option value='Homem'>Homem</option>
                    <option value='Mulher'>Mulher</option>
                    <option value='Prefiro não dizer'>Prefiro não dizer</option>
                </select>

                <textarea type='text' value='$bioErro' class='w3-input' id='nomeInstituicao' placeholder='Escreva algo sobre si...' name='bio' rows='3' maxlength='240' required>$bioErro</textarea>

            </div>
            <div id='divDir'>

                <label>Fotografia de Perfil </label> &nbsp";
                if (isset($avatarErro)) {
                    echo "<img alt='Avatar' class='w3-circle' id='foto' src='../$avatarErro' />";
                }
                echo "<input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='file' id='avatar' name='avatar'/>

                <label>Distrito:</label>
                <select class='w3-input' name='distrito' id='distrito' size='1' required>";
                    if (isset($distritoErro)) {
                        echo "<option value='$distritoErro' selected>$distritoErro</option>";
                    } else {
                        echo "<option value='' disabled selected>Selecione o seu Distrito:</option>";
                    }
                echo "</select> 
                
                <label>Concelho:</label>
                <select class='w3-input' name='concelho' id='concelho' size='1' required>";
                    if (isset($concelhoErro)) {
                        echo "<option value='$concelhoErro' selected>$concelhoErro</option>";
                    } else {
                        echo "<option value='' disabled selected>Selecione o seu Concelho:</option>";
                    }   
                echo "</select> 
                
                <label>Freguesia:</label>
                <select class='w3-input' name='freguesia' id='freguesia' size='1' required>";
                    if (isset($freguesiaErro)) {
                        echo "<option value='$freguesiaErro' selected>$freguesiaErro</option>";
                    } else {
                        echo "<option value='' disabled selected>Selecione a sua Freguesia:</option>";
                    }  
                echo "</select> 

                <label>Carta de Condução</label>
                <select class='w3-input' name='carta'>";
                    if (isset($cartaErro)) {
                        echo "<option value='$cartaErro' selected>$cartaErro</option>";
                    } else {
                        echo "<option value='' disabled selected>Selecione se tem carta de condução</option>";
                    }
                    echo "<option value='Sim'>Sim</option>
                    <option value='Não'>Não</option>
                </select>

                <label>Já esteve infetado com o Covid-19?</label>
                <select class='w3-input' name='covid'>";
                    if (isset($covidErro)) {
                        echo "<option value='$covidErro' selected>$covidErro</option>";
                    } else {
                        echo "<option value='' disabled selected>Selecione se já esteve infetado</option>";
                    }
                    echo "<option value='Sim'>Sim</option>
                    <option value='Não'>Não</option>
                </select>

            <input id='submit' type='submit' name='' value='Registar'>";

            echo $_SESSION['msgerroV'];

    ?>
        
        <?php

            include "../Controller/RegistoVController.php";            
            include "TestInput.php";

            if (!empty($_POST)){

                $id = uniqid();
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

                $_SESSION['erroVnome'] = $nomeProprio;
                $_SESSION['erroVemail'] = $Email;
                $_SESSION['erroVpassword'] = $Password;
                $_SESSION['erroVtelefone'] = $telefone;
                $_SESSION['erroVnascimento'] = $dataNascimento;
                $_SESSION['erroVcc'] = $CC;
                $_SESSION['erroVgenero'] = $genero;
                $_SESSION['erroVbio'] = $bio;
                $_SESSION['erroVdistrito'] = $distrito;
                $_SESSION['erroVconcelho'] = $concelho;
                $_SESSION['erroVfreguesia'] = $freguesia;
                $_SESSION['erroVcarta'] = $carta;
                $_SESSION['erroVcovid'] = $covid;

                include "../Controller/InputPhotoController.php";

                $avatar = test_photo();

                if ($avatar == 'Nenhuma imagem enviada.') {
                    $avatar = $_SESSION['erroVavatar'];
                } else {
                    $_SESSION['erroVavatar'] = $avatar;
                }

                if (substr($avatar,0,6) == "Images") {

                    $registoV = registo_voluntario($id, $nomeProprio, $Email, $Password, $telefone, $dataNascimento, $CC, $bio, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $avatar);

                    echo "<meta http-equiv='refresh' content='0'>";
                    $_SESSION['msgerroV'] = $registoV;

                } else {

                    echo "<meta http-equiv='refresh' content='0'>";
                    // Erro no input da fotografia
                    $_SESSION['msgerroV'] = "<p class='erro'> ". $avatar ." </p>";
                }

            }
        
        ?>  

        <p id="home">Já tem conta? Efetue aqui o seu <a href="Login.php" id="login">Login</a></p>

        </div> 
        
    </form>
    </div>

    <div id="VolDiv" class="w3-container">

        <h3>Como posso contribuir?</h3>

        <hr>

        <h5>O que é um voluntário?</h5>

        <p>É o indivíduo que de forma livre, desinteressada e responsável se compromete, de acordo com as suas aptidões próprias e no seu tempo livre, a realizar ações de voluntariado no âmbito de uma organização promotora.
            A qualidade de voluntário/a não pode, de qualquer forma, decorrer de relação de trabalho subordinado ou autónomo ou de qualquer relação de conteúdo patrimonial com a organização promotora, sem prejuízo de regimes especiais constantes da Lei.</p>

        <hr>

        <h5>Ser voluntário/a é:</h5>

        <p>- Assumir um compromisso com a organização promotora de voluntariado;</p>
        <p>- Desenvolver ações de voluntariado em prol dos indivíduos, famílias e comunidade;</p>
        <p>- Comprometer-se, de acordo com as suas aptidões e no seu tempo livre;</p>

        <hr>

        <h4>Vem ajudar!</h4>

    </div>
    
    

    <footer>
        <div id="EndDiv">
        
            <ul id="endContactosL">
                <li>Tel.: 93-77-tira-tira-mete-mete</li>
                <li>Mail: VoluntárioCOVID19@mail.com</li>
                <li>Morada: Rua D. Francisco, nº 92, Amadora city</li>
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