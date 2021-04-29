<?php

    include "../Model/Model.php";

    $show_instituicoes = $_REQUEST['show_instituicoes'];

    if ($show_instituicoes) {

        $nome = $_REQUEST['nome'];
        $email = $_REQUEST['email'];
        $distrito = $_REQUEST['distrito'];
        $concelho = $_REQUEST['concelho'];
        $freguesia = $_REQUEST['freguesia'];
        $order = $_REQUEST['order'];
        $variable = $_REQUEST['variable'];

        if ($nome or $email or $distrito or $concelho or $freguesia){
            
            $resultInstituicao = adminInstPost($nome,$email,$distrito,$concelho,$freguesia, $order, $variable); 
            
        } else {
    
            $resultInstituicao = adminInst($order, $variable);
            
        }
        
        /* ta certo daqui pa baixo*/ 
        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultado'>";
        echo "<p>Encontrou ".($resultInstituicao->num_rows)." resultado(s) para a pesquisa.</p>";
        echo "</div>";
    
        if ($resultInstituicao->num_rows > 0) {
    
            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='todosVol'>
                <tr class='w3-blue'>";
                    if ($order == 'desc') {
                        $ordericon = "<i class='fas fa-sort-down'></i>";
                        $othero = 'asc';
                    } else {
                        $ordericon = "<i class='fas fa-sort-up'></i>";
                        $othero = 'desc';
                    }

                    if ($variable == 'nome') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('nome').")'>Nome $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('nome').")'>Nome</th>";
                    }

                    if ($variable == 'tel') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('tel').")'>Tel. $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('tel').")'>Tel.</th>";
                    }

                    if ($variable == 'morada') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('morada').")'>Morada $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('morada').")'>Morada</th>";
                    }

                    if ($variable == 'distrito') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('distrito').")'>Distrito $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('distrito').")'>Distrito</th>";
                    }

                    if ($variable == 'concelho') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('concelho').")'>Concelho $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('concelho').")'>Concelho</th>";
                    }

                    if ($variable == 'freguesia') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('freguesia').")'>Freguesia $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('freguesia').")'>Freguesia</th>";
                    }

                    if ($variable == 'email') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('email').")'>Email $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('email').")'>Email</th>";
                    }

                    if ($variable == 'bio') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('bio').")'>Bio $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('bio').")'>Bio</th>";
                    }

                    if ($variable == 'nomerep') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('nomerep').")'>Nome Rep. $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('nomerep').")'>Nome Rep.</th>";
                    }

                    if ($variable == 'emailrep') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('emailrep').")'>Email Rep. $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('emailrep').")'>Email Rep.</th>";
                    }
                    
                    if ($variable == 'website') {
                        echo "<th onclick='showInstituicoes(".json_encode($othero).", ".json_encode('website').")'>Website $ordericon</th>";
                    } else {
                        echo "<th onclick='showInstituicoes(".json_encode('asc').", ".json_encode('website').")'>Website</th>";
                    }
                    
                echo "</tr>";
            
            while ($row = $resultInstituicao->fetch_assoc()){
                echo "
                <tr>
                    <td>".$row['nome_instituicao']."</td>
                    <td>".$row['telefone']."</td>
                    <td>".$row['morada']."</td>
                    <td>".$row['distrito']."</td>
                    <td>".$row['concelho']."</td>
                    <td>".$row['freguesia']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['bio']."</td>
                    <td>".$row['nome_representante']."</td>
                    <td>".$row['email_representante']."</td>
                    <td>".$row['website']."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }

    }

    function adminInstPost($nome,$email,$distrito,$concelho,$freguesia, $order, $variable){

        $primeiro = 0;

        $queryInstituicao = "SELECT id, nome_instituicao, telefone, morada, distrito, concelho, freguesia,
                        email, bio, nome_representante, email_representante, foto, website
                        FROM Instituicao ";

        if (!empty($nome)){
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE nome_instituicao LIKE '".$nome."%' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND nome_instituicao LIKE '".$nome."%' ";
            }
        }

        if (!empty($email)) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE email LIKE '".$email."%' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND email LIKE '".$email."%' ";
            }
        }

        if (!empty($distrito)) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE distrito = '".$distrito."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND distrito = '".$distrito."' ";
            }
        }

        if (!empty($concelho)) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE concelho = '".$concelho."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND concelho = '".$concelho."' ";
            }
        }

        if (!empty($freguesia)) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE freguesia = '".$freguesia."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND freguesia = '".$freguesia."' ";
            }
        }
        
        if ($variable == 'nome') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY nome_instituicao DESC ";
            } else {
                $queryInstituicao .= "ORDER BY nome_instituicao ASC ";
            }
        }

        if ($variable == 'tel') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY telefone DESC ";
            } else {
                $queryInstituicao .= "ORDER BY telefone ASC ";
            }
        }

        if ($variable == 'morada') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY morada DESC ";
            } else {
                $queryInstituicao .= "ORDER BY morada ASC ";
            }
        }

        if ($variable == 'distrito') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY distrito DESC ";
            } else {
                $queryInstituicao .= "ORDER BY distrito ASC ";
            }
        }

        if ($variable == 'concelho') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY concelho DESC ";
            } else {
                $queryInstituicao .= "ORDER BY concelho ASC ";
            }
        }

        if ($variable == 'freguesia') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY freguesia DESC ";
            } else {
                $queryInstituicao .= "ORDER BY freguesia ASC ";
            }
        }

        if ($variable == 'email') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY email DESC ";
            } else {
                $queryInstituicao .= "ORDER BY email ASC ";
            }
        }

        if ($variable == 'bio') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY bio DESC ";
            } else {
                $queryInstituicao .= "ORDER BY bio ASC ";
            }
        }

        if ($variable == 'nomerep') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY nome_representante DESC ";
            } else {
                $queryInstituicao .= "ORDER BY nome_representante ASC ";
            }
        }

        if ($variable == 'emailrep') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY email_representante DESC ";
            } else {
                $queryInstituicao .= "ORDER BY email_representante ASC ";
            }
        }

        if ($variable == 'website') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY website DESC ";
            } else {
                $queryInstituicao .= "ORDER BY website ASC ";
            }
        }

        return free_query($queryInstituicao);
    }

    function adminInst($order, $variable){
        $queryInstituicao = "SELECT id, nome_instituicao, telefone, morada, distrito, concelho, freguesia,
                        email, bio, nome_representante, email_representante, foto, website
                        FROM Instituicao ";

        if ($variable == 'nome') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY nome_instituicao DESC ";
            } else {
                $queryInstituicao .= "ORDER BY nome_instituicao ASC ";
            }
        }

        if ($variable == 'tel') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY telefone DESC ";
            } else {
                $queryInstituicao .= "ORDER BY telefone ASC ";
            }
        }

        if ($variable == 'morada') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY morada DESC ";
            } else {
                $queryInstituicao .= "ORDER BY morada ASC ";
            }
        }

        if ($variable == 'distrito') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY distrito DESC ";
            } else {
                $queryInstituicao .= "ORDER BY distrito ASC ";
            }
        }

        if ($variable == 'concelho') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY concelho DESC ";
            } else {
                $queryInstituicao .= "ORDER BY concelho ASC ";
            }
        }

        if ($variable == 'freguesia') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY freguesia DESC ";
            } else {
                $queryInstituicao .= "ORDER BY freguesia ASC ";
            }
        }

        if ($variable == 'email') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY email DESC ";
            } else {
                $queryInstituicao .= "ORDER BY email ASC ";
            }
        }

        if ($variable == 'bio') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY bio DESC ";
            } else {
                $queryInstituicao .= "ORDER BY bio ASC ";
            }
        }

        if ($variable == 'nomerep') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY nome_representante DESC ";
            } else {
                $queryInstituicao .= "ORDER BY nome_representante ASC ";
            }
        }

        if ($variable == 'emailrep') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY email_representante DESC ";
            } else {
                $queryInstituicao .= "ORDER BY email_representante ASC ";
            }
        }

        if ($variable == 'website') {
            if ($order == 'desc') {
                $queryInstituicao .= "ORDER BY website DESC ";
            } else {
                $queryInstituicao .= "ORDER BY website ASC ";
            }
        }

        return free_query($queryInstituicao);
    }

?>