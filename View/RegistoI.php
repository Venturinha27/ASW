<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
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
<script src="../JavaScript/DCF.js"></script>
</head>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.php" class="w3-bar-item w3-button w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" placeholder="Procura...">
        
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
        <a href="Voluntarios.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.php" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>    
    </div>
</header>

<body>

    <div id="BrancoDiv" class="w3-container">

        <h2>Registo da Instituição</h2>

        <br>

    <form id="registertext" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div id="divEsq">
            <input type="text" class="w3-input" id="nomeInstituicao" placeholder="Nome da Instituição" name="nomeInstituicao" required>

            <input type="text" class="w3-input" id="telefone" placeholder="Telemóvel/Telefone" name="telefone" required>

            <input type="text" class="w3-input" id="E-mail" placeholder="E-mail da Instituição" name="email" required>

            <input type="password" class="w3-input" id="password" placeholder="Palavra-Passe" name="password" required>
            
            <input type="text" class="w3-input" id="website" placeholder="Website" name="website">

            <textarea type="text" class="w3-input" id="biografia" placeholder="Escreva uma pequena bio sobre a instituição..." name="bio" rows="3" maxlength="240" required></textarea>
        </div>
        <div id="divDir">
                
            <label>Fotografia de Perfil</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
            <input type="file" id="avatar" name="avatar">

            <input type="text" class="w3-input" id="morada" placeholder="Morada" name="morada" required>

            <!--<input type="text" class="w3-input" id="distrito" placeholder="Distrito" name="distrito" required>

            <input type="text" class="w3-input" id="concelho" placeholder="Concelho" name="concelho" required>

            <input type="text" class="w3-input" id="freguesia" placeholder="Freguesia" name="freguesia" required>
            -->

            <label>Distrito:</label>
            <select class="w3-input" name="distrito" id="distrito" size="1" required>
                <option value="" disabled selected>Selecione o seu Distrito:</option>
            </select> 
            
            <label>Concelho:</label>
            <select class="w3-input" name="concelho" id="concelho" size="1" required>
                <option value="" disabled selected>Selecione o seu Concelho:</option>
            </select> 
            
            <label>Freguesia:</label>
            <select class="w3-input" name="freguesia" id="freguesia" size="1" required>
                <option value="" disabled selected>Selecione a sua Freguesia:</option>
            </select> 

            <input type="text" class="w3-input" id="nomeRepresentante" placeholder="Nome do Representante da Instituição" name="nomeRepresentante" required>
            
            <input type="text" class="w3-input" id="emailRepresentante" placeholder="E-mail do Representante da Instituição" name="emailRepresentante" required>
            
            <input id="submit" type="submit" value="Registo">

            <?php
                include "openconn.php";
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
                    
                    $erro = 0;

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

                            $query1 = "insert into Utilizador
                                    values ('".$id."' , 'instituicao')";
                            
                            $res1 = mysqli_query($conn, $query1);
                            
                            if ($res1) {
                            } else {
                                echo "<p class='erro'> Algo deu ruim :( </p>";
                            }


                            $query = "insert into Instituicao
                                    values ('".$id."' , '".$nomeInstituicao."' , ".$telefone." , '".$morada."' , '"
                                    .$distrito."' , '".$concelho."' , '".$freguesia."' , '".$email."' , '".$bio."' , '"
                                    .$nomeRepresentante."' , '".$emailRepresentante."' , '".password_hash($password, PASSWORD_DEFAULT)."' , '".$avatar."' , '".$website."')";
                            
                            $res = mysqli_query($conn, $query);
                            
                            if ($res) {
                                $_SESSION['loggedtype'] = "instituicao";
                                $_SESSION['logged'] = $nomeInstituicao;
                                $_SESSION['loggedid'] = $id;
                                $_SESSION['opentype'] = "instituicao";
                                $_SESSION['open'] = $nomeInstituicao;
                                $_SESSION['openid'] = $id;
                                header("Location: PreferenciasI.php");
                            } else {
                                echo "<p class='erro'> Algo correu mal :( </p>";
                            }
                    }

                    mysqli_close($conn);
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