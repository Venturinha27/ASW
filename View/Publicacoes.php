
<?php
    session_start();
    ob_start();

    
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);
?>

<!DOCTYPE html>
<html>
<title>Publicações</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/PublicacoesC.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JavaScript/PublicacoesJS.js"></script>
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
        <a href="Publicacoes.php" class="w3-bar-item w3-button w3-blue w3-hover-blue w3-right w3-mobile">Publicações</a>   
        <a href="Covid19.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">COVID-19</a>
        <a href="Sobre.php" class="w3-bar-item w3-button w3-hover-blue w3-right w3-mobile">Sobre</a>        
    </div>

    <div id="topSugestaoDiv" class="w3-block hidden">

    </div>
</header>

<body>
<!--<div id="BodyDiv">
    <div id="pubs">
        <div class="pubpar">
            <img src="../Images/slide2.jpg">

            <div class="divnome_par"><img src="../Images/slide7.jpg" class="w3-circle" id="avatar">
                <h6>Portugal Voluntário</h6></div>

            <div class="divcom_par">
                <p>Com: Programa Agora Nós e Padeira de Aljubarrota</p>
            </div>

            <hr>

            <div class="divtext_par">
                <p>Trabalho de equipa ajuda a vencer batalha de aljubarrota.</p>
            </div>
        </div>

        <div class="pubimpar">
            <img src="../Images/slide5.jpg">

            <div class="divnome_impar"><img src="../Images/slide6.jpg" class="w3-circle" id="avatar">
                <h6>Filipe Eduardo</h6></div>

            <div class="divcom_impar">
                <p>Com: Programa Agora Nós</p>
            </div>

            <hr>

            <div class="divtext_impar">
                <p>Entrega de bróculos à velhinha Mari Zé.</p>
            </div>
        </div>

        <div class="pubpar">
            <img src="../Images/slide4.jpg">

            <div class="divnome_par"><img src="../Images/slide5.jpg" class="w3-circle" id="avatar">
                <h6>Portugal Agora Nós</h6></div>

            <div class="divcom_par">
                <p>Com: Filipe Eduardo, D. Sebastião e Manel Jorge</p>
            </div>

            <hr>

            <div class="divtext_par">
                <p>Dona Dolores recebe drogas caseiras. Boa Dona Dolores.</p>
            </div>
        </div>

        <div class="pubimpar">
            <img src="../Images/slide3.jpg">

            <div class="divnome_impar"><img src="../Images/slide4.jpg" class="w3-circle" id="avatar">
                <h6>Eduardo Jorge</h6></div>

            <div class="divcom_impar">
                <p>Com: Maria Eduarda e João Ricardo</p>
            </div>

            <hr>

            <div class="divtext_impar">
                <p>Espalhar COVID depois de um grande dia de voluntariado.</p>
            </div>
        </div>
    </div>
</div>
-->

<button class="w3-button w3-circle w3-indigo w3-hover-blue" id="addButton">+</button>

<div id="addCardDiv">
    <div class="w3-card-4 hidden" id="addCard">

            <div class="w3-container" id="headerAdd">
            <h2>Nova publicação</h2>
            <button class="w3-button w3-hover-white" id="closeButton">X</button>
            </div>
            
            <form class="w3-container" id="containIn">
                
                <!-- <label>Com:</label>
                <input class="w3-input" type="text" name="com" id="com">
                <br> -->
                <br>
                <label>Descrição:</label>
                <input class="w3-input" type="text" name="descricao" id="descricao">
                <br>
                <br>
                <label for="img">Imagem:</label>
                <br>
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='file' id='avatar' name='avatar'/>
                <br><br>
                <input id="submit" type="submit" value="Publicar">
                
            </form>

            <div id="erroCreatePub" class="w3-text-red w3-center"></div>
            
        </div>
</div>

<div id="BodyDiv">

    

</div>


<?php

#include "../Controller/PublicacoesController.php";


/* //print_r(get_included_files()); exit();
$result = Show_Publicacoes();
echo $result; */

/* $opentype = $_SESSION['opentype'];
$openid = $_SESSION['openid'];
$nome="";

if ($opentype == 'voluntario' or $opentype == 'instituicao'){
    include "../Controller/PerfilController.php";
    
    if ($opentype == 'voluntario'){
        $vol= openVoluntario($openid);
        $nome.= $vol['nome_voluntario'];

    }else{
        $inst= openInstituicao($openid);
        $nome.= $inst['nome_instituicao'];
    }
    
    
        echo "<br>";
    
                echo "<button class='w3-button w3-circle w3-indigo w3-hover-blue' id='addButton'>+</button>";

                echo "
                <div class='w3-card-4 hidden' id='addCard'>
                
                    <div class='w3-container' id='headerAdd'>
                      <h2>Nova publicação de " .$nome. "</h2>
                      <button class='w3-button w3-hover-white' id='closeButton'>X</button>
                    </div>
                    
                    <form class='w3-container' id='containIn' action='Publicacoes.php' method='POST'>
                        
                        <label>Com:</label>
                        <input class='w3-input' type='text' id='com'>
                        <br>
                        <label>Descrição:</label>
                        <input class='w3-input' type='text' id='descricao'>
                        <br>
                        <label for='img'>Imagem:</label>
                        <br>
                        <input type='file' id='img' name='img' accept='image/*'>
                        <br><br>
                        <input id='submit' type='submit' value='Publicar'>
                        
                    </form>
                    
                </div>
                </form>";
                
                if (!empty($_POST)){

                    include "TestInput.php";
                
                    $id = "10";
                    $dono = $_SESSION['loggedid'];

                    $com = test_input($_POST['com']); 
                    $descricao = test_input($_POST['descricao']);
                    //$imagem = test_input($_POST['img']);
                    $imagem = '../Images/slide7.jpg';

                    $publication = insert_Publicacao ($id, $dono, $imagem, $descricao);
                    $identificados = inserir_identificados ($id_publicacao, $participante);
                
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                

            } */


?> 




</body>

<!-- <footer>
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
</footer> -->