<?php

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
                    $_SESSION['loggedtype'] = "voluntario";
                    $_SESSION['logged'] = $nomeProprio;
                    $_SESSION['loggedid'] = $id;
                    $_SESSION['opentype'] = "voluntario";
                    $_SESSION['open'] = $nomeProprio;
                    $_SESSION['openid'] = $id;
                    header("Location: ../View/PreferenciasV.php");
                } else {
                    echo "<p class='erro'> ".$inserirV." </p>";
                }
                
            } else {
                echo "<p class='erro'> ".$inserirU." </p>";
            }

    }

?>