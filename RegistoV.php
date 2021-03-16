<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
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
<link rel="stylesheet" href="CSS/RegistoV.css" type="text/css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="JavaScript/DCF.js"></script>
</head>

<header>
    <div class="w3-bar w3-large" id="navigation">
        <a href="HomePage.php" class="w3-bar-item w3-button w3-hover-blue w3-mobile">VoluntárioCOVID19</a>

        <input type="text" class="w3-bar-item w3-input" placeholder="Procura...">
        
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
        <a href="Voluntarios.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Voluntários</a>
        <a href="Instituicoes.php" class="w3-bar-item w3-button  w3-hover-blue w3-right w3-mobile">Instituições</a>
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>    
    </div>
</header>

<body>

    <div id="BrancoDiv" class="w3-container">

        <h2>Registo do Voluntário</h2>

        <br>

    <form id="registertext" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div id="divEsq">
            <input type="text" class="w3-input" id="nomeProprio" placeholder="Nome Completo" name="nomeProprio" required />

            <input type="text" class="w3-input" id="E-mail" placeholder="E-mail" name="E-mail"required/>

            <input type="password" class="w3-input" id="Password" placeholder="Palavra-Passe" name="Password"required/>

            <input type="text" class="w3-input" id="telefone" placeholder="Telemóvel/Telefone" name="telefone"required/>

            <input type="date" class="w3-input" id="dataNascimento" placeholder="Data de Nascimento" name="dataNascimento" required/>

            <input type="text" class="w3-input" id="CC" placeholder="Cartão de Cidadão" name="CC"required/>

            <textarea type="text" class="w3-input" id="nomeInstituicao" placeholder="Escreva algo sobre si..." name="bio" rows="3" maxlength="240" required></textarea>

        </div>
        <div id="divDir">

            <label>Fotografia de Perfil </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
            <input type="file" id="avatar" name="avatar" />  <!--accept="image/png, image/jpeg"-->

            <!--<input type="text" class="w3-input" id="distrito" placeholder="Distrito" name="distrito"required/>

            <input type="text" class="w3-input" id="concelho" placeholder="Concelho" name="concelho"required/>

            <input type="text" class="w3-input" id="freguesia" placeholder="Freguesia" name="freguesia"required/>
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

            <label>Género</label>
            <select class="w3-input" name="genero">
                <option value="" disabled selected>Selecione o seu género</option>
                <option value="Homem">Homem</option>
                <option value="Mulher">Mulher</option>
                <option value="Prefiro não dizer">Prefiro não dizer</option>
            </select>

            <label>Carta de Condução</label>
            <select class="w3-input" name="carta">
                <option value="" disabled selected>Selecione se tem carta de condução</option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>

            <label>Já esteve infetado com o Covid-19?</label>
            <select class="w3-input" name="covid">
                <option value="" disabled selected>Selecione se já esteve infetado</option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>

        <input id="submit" type="submit" name="" value="Registar" href="InformacoesV.php">
        
        <?php
            include "openconn.php";

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
                    $check = 0;

                    $sqlNome = "SELECT V.email
                                FROM Voluntario V
                                UNION
                                SELECT I.email
                                FROM Instituicao I";    

                    $resultN = $conn->query($sqlNome);


                    $sqlCC = "SELECT cc
                                FROM Voluntario";  

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

                        $query1 = "insert into Utilizador
                                values ('".$id."' , 'voluntario')";
                        
                        $res1 = mysqli_query($conn, $query1);
                        
                        if ($res1) {
                        } else {
                            echo "<p class='erro'> Algo deu errado. </p>";
                        }
                        
                        $query = "insert into Voluntario
                                values ('".$id."' , '".$nomeProprio."' , '".$dataNascimento."' , '".$genero."' , '"
                                .$avatar."' , '".$bio."' , '".$concelho."' , '".$distrito."' , '".$freguesia."' , ".$telefone." , '"
                                .$CC."' , '".$carta."' , '".$covid."' , '".$Email."' , '".$Password."')";
                        
                        $res = mysqli_query($conn, $query);
                        
                        if ($res) {
                            $_SESSION['loggedtype'] = "voluntario";
                            $_SESSION['logged'] = $nomeProprio;
                            $_SESSION['loggedid'] = $id;
                            $_SESSION['opentype'] = "voluntario";
                            $_SESSION['open'] = $nomeProprio;
                            $_SESSION['openid'] = $id;
                            header("Location: PreferenciasV.php");
                        } else {
                            echo "<p class='erro'> Algo deu errado. </p>";
                        }
                        
                    }
                }
                
            mysqli_close($conn);
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