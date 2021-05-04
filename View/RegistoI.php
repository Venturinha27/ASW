
<?php
    session_start();
    ob_start();

?>

<!DOCTYPE html>
<html lang="pt">

<head>
<meta charset="utf-8">
<title>Registo Instituição</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/RegistoI.css" type="text/css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/RegistoIJS.js"></script>
<script src="../JavaScript/DCF.js"></script>
<link rel="stylesheet" href="../CSS/ProcuraC.css">
<script src="../JavaScript/ProcuraJS.js"></script>
</head>


<body>

    <div id="BrancoDiv" class="w3-container">

        <h2>Registo da Instituição</h2>

        <br>

    <?php

        $nomeErro = $_SESSION['erroInome'];
        $emailErro = $_SESSION['erroIemail'];
        $passwordErro = $_SESSION['erroIpassword'];
        $telefoneErro = $_SESSION['erroItelefone'];
        $websiteErro = $_SESSION['erroIwebsite'];
        $moradaErro = $_SESSION['erroImorada'];
        $biografiaErro = $_SESSION['erroIbiografia'];
        $avatarErro = $_SESSION['erroIavatar'];
        $distritoErro = $_SESSION['erroIdistrito'];
        $concelhoErro = $_SESSION['erroIconcelho'];
        $freguesiaErro = $_SESSION['erroIfreguesia'];
        $nomeRepErro = $_SESSION['erroInomeRep'];
        $emailRepErro = $_SESSION['erroIemailRep'];

        echo "<form id='registertext' enctype='multipart/form-data' action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>
            <div id='divEsq'>
                <input type='text' value='$nomeErro' class='w3-input' id='nomeInstituicao' placeholder='Nome da Instituição' name='nomeInstituicao' required>

                <input type='text' value='$telefoneErro' class='w3-input' id='telefone' placeholder='Telemóvel/Telefone' name='telefone' required>

                <input type='text' value='$emailErro' class='w3-input' id='E-mail' placeholder='E-mail da Instituição' name='email' required>

                <input type='password' value='$passwordErro' class='w3-input' id='password' placeholder='Palavra-Passe' name='password' required>
                
                <input type='text' value='$websiteErro' class='w3-input' id='website' placeholder='Website' name='website'>

                <input type='text' value='$moradaErro' class='w3-input' id='morada' placeholder='Morada' name='morada' required>

                <textarea type='text' value='$biografiaErro' class='w3-input' id='biografia' placeholder='Escreva uma pequena bio sobre a instituição...' name='bio' rows='3' maxlength='240' required></textarea>
                
            </div>
            <div id='divDir'>
                    
                <label>Fotografia de Perfil</label> &nbsp";
                if (isset($avatarErro)) {
                    echo "<img alt='Avatar' class='w3-circle' id='foto' src='../$avatarErro' />";
                }
                echo "<input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='file' id='avatar' name='avatar'>            

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

                <input type='text' value='$nomeRepErro' class='w3-input' id='nomeRepresentante' placeholder='Nome do Representante da Instituição' name='nomeRepresentante' required>
                
                <input type='text' value='$emailRepErro' class='w3-input' id='emailRepresentante' placeholder='E-mail do Representante da Instituição' name='emailRepresentante' required>
                
                <input id='submit' type='submit' value='Registo'>";

                echo $_SESSION['msgerroI'];

                    echo "<p id='home'>Já tem conta? Efetue aqui o seu <a href='Login.php' id='login'>Login</a></p>
                </div>

        </form>";
    ?>

    <?php
        include "../Controller/RegistoIController.php";            
        include "TestInput.php";
        

        if (!empty($_POST)){

            $id = uniqid();
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

            $_SESSION['erroInome'] = $nomeInstituicao;
            $_SESSION['erroIemail'] = $email;
            $_SESSION['erroIpassword'] = $password;
            $_SESSION['erroItelefone'] = $telefone;
            $_SESSION['erroIwebsite'] = $website;
            $_SESSION['erroImorada'] = $morada;
            $_SESSION['erroIbiografia'] = $bio;
            $_SESSION['erroIdistrito'] = $distrito;
            $_SESSION['erroIconcelho'] = $concelho;
            $_SESSION['erroIfreguesia'] = $freguesia;
            $_SESSION['erroInomeRep'] = $nomeRepresentante;
            $_SESSION['erroIemailRep'] = $emailRepresentante;

            include "../Controller/InputPhotoController.php";

            $avatar = test_photo();
            echo "<p class='erro'> ". $avatar ." </p>";

            if ($avatar == 'Nenhuma imagem enviada.') {
                $avatar = $_SESSION['erroIavatar'];
            } else {
                $_SESSION['erroIavatar'] = $avatar;
            }

            if (substr($avatar,0,6) == "Images") {

                $registoI = registo_instituicao($id ,$nomeInstituicao, $telefone , $morada , $distrito , $concelho ,$freguesia , $email ,$bio , $nomeRepresentante , $emailRepresentante , $password, $avatar , $website);

                echo "<meta http-equiv='refresh' content='0'>";
                $_SESSION['msgerroI'] = $registoI;

            } else {
                echo "<meta http-equiv='refresh' content='0'>";
                // Erro no input da fotografia
                $_SESSION['msgerroI'] = "<p class='erro'> ". $avatar ." </p>";
            }
        
        }
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
            <li>Tel.: 214938000 </li>
            <li>Mail: VoluntárioCOVID19@gmail.com</li>
            <li>Morada: Rua D. Francisco, nº 92, Amadora </li>
        </ul>
    

        <div class="vl"></div>

        <ul id="endPaginas1">
            <a href="Sobre.php"><li>Sobre</li></a>
            <br>
            <a href="#"><li>Publicações</li></a>
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