<?php

    /* ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE); */

    include_once "../Model/Model.php";

    function registo_voluntario($id, $nomeProprio, $Email, $Password, $telefone, $dataNascimento, $CC, $bio, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $avatar) {

            $emails = emails_utilizadores();

            $ccs = ccs_voluntarios();

            if (filter_var($Email, FILTER_VALIDATE_EMAIL) ){
                if (strlen((string)$telefone) == 9){
                    if (strlen((string)$CC) == 8){
                        $datnasc = explode("-", $dataNascimento);
                        if (strlen((string)$datnasc[0]) == 4 and strlen((string)$datnasc[1]) == 2 and strlen((string)$datnasc[2]) == 2){
                            if (strlen((string)$Password) > 6){
                                if ($emails->num_rows > 0) {
                                    while ($row = $emails->fetch_assoc()){
                                        if ($row[0] == $Email){
                                            $msgErro = "<p class='erro'> E-mail já existe </p>";
                                        }
                                    }
                                }
                                if ($ccs->num_rows > 0) {
                                    while ($rowC = $ccs->fetch_assoc()){
                                        if ($rowC[0] == $CC){
                                            $msgErro = "<p class='erro'> CC já existe </p>";
                                        }
                                    }
                                }
                            } else {
                                $msgErro = "<p class='erro'> Password deve ter, pelo menos, 7 caracteres. </p>";
                            }
                        } else {
                            $msgErro = "<p class='erro'> Data de nascimento deve ser do tipo (AAAA-MM-DD). </p>";
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
            
            if (isset($msgErro)){
                return $msgErro;
            }

            $inserirU = inserir_utilizador($id, 'voluntario');

            if ($inserirU == TRUE) {

                $inserirV = inserir_voluntario($id, $nomeProprio, $Email, $Password, $telefone, $dataNascimento, $CC, $bio, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $avatar);

                if ($inserirV == TRUE) {
                    unset($_SESSION['erroVnome']);
                    unset($_SESSION['erroVemail']);
                    unset($_SESSION['erroVpassword']);
                    unset($_SESSION['erroVtelefone']);
                    unset($_SESSION['erroVnascimento']);
                    unset($_SESSION['erroVcc']);
                    unset($_SESSION['erroVgenero']);
                    unset($_SESSION['erroVbio']);
                    unset($_SESSION['erroVavatar']);
                    unset($_SESSION['erroVdistrito']);
                    unset($_SESSION['erroVconcelho']);
                    unset($_SESSION['erroVfreguesia']);
                    unset($_SESSION['erroVcarta']);
                    unset($_SESSION['erroVcovid']);
                    unset($_SESSION['msgerroV']);

                    /* ini_set('smtp_port', 465);

                    require_once '../vendor/autoload.php';

                    // Create the Transport
                    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                    ->setUsername('asw013.2021@gmail.com')
                    ->setPassword('ventu013')
                    ;

                    // Create the Mailer using your created Transport
                    $mailer = new Swift_Mailer($transport);

                    // Create a message
                    $message = (new Swift_Message('Confirme a sua conta.'))
                    ->setFrom(['asw013.2021@gmail.com' => 'VoluntárioCOVID19'])
                    ->setTo([$Email => $nomeProprio])
                    ->setBody('Bem-vindo à plataforma VoluntárioCOVID19 '.$nomeProprio.'! Para confirmar a sua conta aceda a este link: http://appserver-01.alunos.di.fc.ul.pt/~asw013/ASW/Controller/ConfirmarRegisto.php?id='.$id.'&nome='.$nomeProprio.'&tipo=voluntario')
                    ;

                    // Send the message
                    $result = $mailer->send($message); */

                    header("Location: ../Controller/ConfirmarRegisto.php");

                    $_SESSION['loggedtype'] = "voluntario";
                    $_SESSION['logged'] = $nomeProprio;
                    $_SESSION['loggedid'] = $id;
                    $_SESSION['opentype'] = "voluntario";
                    $_SESSION['open'] = $nomeProprio;
                    $_SESSION['openid'] = $id;
                    header("Location: ../View/PreferenciasV.php");
                } else {
                    return "<p class='erro'> ".$inserirV." </p>";
                }
                
            } else {
                return "<p class='erro'> ".$inserirU." </p>";
            }

    }

?>