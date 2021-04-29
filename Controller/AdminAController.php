<?php
    
    include "../Model/Model.php";

    $show_acoes = $_REQUEST['show_acoes'];

    if ($show_acoes) {

        $instituicao = $_REQUEST['instituicao'];
        $titulo = $_REQUEST['titulo'];
        $distrito = $_REQUEST['distrito'];
        $concelho = $_REQUEST['concelho'];
        $freguesia = $_REQUEST['freguesia'];
        $area_interesse = $_REQUEST['area'];
        $populacao_alvo = $_REQUEST['populacao'];
        $funcao = $_REQUEST['funcao'];
        $numvagas = $_REQUEST['numvagas'];
        $data = $_REQUEST['data'];
        $ativa = $_REQUEST['ativa'];
        $order = $_REQUEST['order'];
        $variable = $_REQUEST['variable'];
        
        if ($instituicao or $titulo or $distrito or $concelho or $freguesia or $area_interesse or $populacao_alvo or $funcao
        or $numvagas or $data or $ativa){
    
            $resultAcao = adminA($instituicao, $titulo, $distrito, $concelho, $freguesia, $area_interesse, $populacao_alvo, $funcao, $numvagas, $disponibilidade_dia, $ativa, $order, $variable);
    
            
        } else {
            
            $resultAcao = adminAF($order, $variable);
            
        }
        
        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-green w3-pale-green w3-small resultado'>";
        echo "<p>Encontrou ".count($resultAcao)." resultado(s) para a pesquisa.</p>";
        echo "</div>";
    
        
        if (count($resultAcao) > 0) {
    
            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='todosVol'>
                <tr class='w3-green w3-tiny'>";
                    if ($order == 'desc') {
                        $ordericon = "<i class='fas fa-sort-down'></i>";
                        $othero = 'asc';
                    } else {
                        $ordericon = "<i class='fas fa-sort-up'></i>";
                        $othero = 'desc';
                    }

                    if ($variable == 'instituicao') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('instituicao').")'>Instituição $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('instituicao').")'>Instituição</th>";
                    }

                    if ($variable == 'titulo') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('titulo').")'>Titulo Ação $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('titulo').")'>Titulo Ação</th>";
                    }

                    if ($variable == 'distrito') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('distrito').")'>Distrito $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('distrito').")'>Distrito</th>";
                    }

                    if ($variable == 'concelho') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('concelho').")'>Concelho $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('concelho').")'>Concelho</th>";
                    }

                    if ($variable == 'freguesia') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('freguesia').")'>Freguesia $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('freguesia').")'>Freguesia</th>";
                    }

                    if ($variable == 'funcao') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('funcao').")'>Função $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('funcao').")'>Função</th>";
                    }

                    if ($variable == 'area') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('area').")'>Área interesse $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('area').")'>Área interesse</th>";
                    }

                    if ($variable == 'populacao') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('populacao').")'>População alvo $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('populacao').")'>População alvo</th>";
                    }

                    if ($variable == 'numvagas') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('numvagas').")'>Num. vagas $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('numvagas').")'>Num. vagas</th>";
                    }

                    if ($variable == 'dia') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('dia').")'>Dia $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('dia').")'>Dia</th>";
                    }

                    if ($variable == 'hora') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('hora').")'>Hora $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('hora').")'>Hora</th>";
                    }

                    if ($variable == 'duracao') {
                        echo "<th onclick='showAcoes(".json_encode($othero).", ".json_encode('duracao').")'>Duração $ordericon</th>";
                    } else {
                        echo "<th onclick='showAcoes(".json_encode('asc').", ".json_encode('duracao').")'>Duração</th>";
                    }

                    echo "<th>Ativa/Inativa</th>";
                    
            echo "</tr>";
            
            foreach ($resultAcao as $row){
                echo "
                <tr>
                    <td>".$row['nome_instituicao']."</td>
                    <td>".$row['titulo']."</td>
                    <td>".$row['distrito']."</td>
                    <td>".$row['concelho']."</td>
                    <td>".$row['freguesia']."</td>
                    <td>".$row['funcao']."</td>
                    <td>".$row['area_interesse']."</td>
                    <td>".$row['populacao_alvo']."</td>
                    <td>".$row['num_vagas']."</td>
                    <td>".$row['dia']."</td>
                    <td>".$row['hora']."</td>
                    <td>".$row['duracao']."</td>
                    <td>".$row['ativa']."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }
    }

    function adminA($instituicao, $titulo, $distrito, $concelho, $freguesia, $area_interesse, $populacao_alvo, $funcao, $numvagas, $disponibilidade_dia, $ativa, $order, $variable){
        
        $queryAcao = "SELECT I.id, I.nome_instituicao, A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao ";

        if (!empty($instituicao)){
            $queryAcao .= "AND I.nome_instituicao LIKE '".$instituicao."%' ";
        }

        if (!empty($titulo)) {
            $queryAcao .= "AND A.titulo LIKE '".$titulo."%' ";
        }

        if (!empty($distrito)) {
            $queryAcao .= "AND A.distrito = '".$distrito."' ";
        }

        if (!empty($concelho)) {
            $queryAcao .= "AND A.concelho = '".$concelho."' ";
        }

        if (!empty($freguesia)) {
            $queryAcao .= "AND A.freguesia = '".$freguesia."' ";
        }

        if (!empty($area_interesse)) {
            $queryAcao .= "AND A.area_interesse = '".$area_interesse."' ";
        }

        if (!empty($populacao_alvo)) {
            $queryAcao .= "AND A.populacao_alvo = '".$populacao_alvo."' ";
        }

        if (!empty($funcao)) {
            $queryAcao .= "AND A.funcao = '".$funcao."' ";
        }

        if (!empty($numvagas)) {
            
            if ($numvagas == "0 a 10"){
                $queryAcao .= "AND A.num_vagas >= 0 AND A.num_vagas <= 10 ";
            }
            if ($numvagas == "11 a 20"){
                $queryAcao .= "AND A.num_vagas >= 11 AND A.num_vagas <= 20 ";
            }
            if ($numvagas == "21 a 30"){
                $queryAcao .= "AND A.num_vagas >= 21 AND A.num_vagas <= 30 ";
            }
            if ($numvagas == "31 a 40"){
                $queryAcao .= "AND A.num_vagas >= 31 AND A.num_vagas <= 40 ";
            }
            if ($numvagas == "41 a 50"){
                $queryAcao .= "AND A.num_vagas >= 41 AND A.num_vagas <= 50 ";
            }
            if ($numvagas == "51 a 60"){
                $queryAcao .= "AND A.num_vagas >= 51 AND A.num_vagas <= 60 ";
            }
            if ($numvagas == "61 a 70"){
                $queryAcao .= "AND A.num_vagas >= 61 AND A.num_vagas <= 70 ";
            }
            if ($numvagas == "71 a 80"){
                $queryAcao .= "AND A.num_vagas >= 71 AND A.num_vagas <= 80 ";
            }
            if ($numvagas == "81+"){
                $queryAcao .= "AND A.num_vagas >= 81 ";
            }
            
        }

        if (!empty($disponibilidade_dia)) {

            $queryAcao .= "AND A.dia = '".$disponibilidade_dia."' ";
        }

        if (!empty($ativa)) {

            $hoje = date("Y-m-d");

            if ($ativa == 'Ativa') {
                $queryAcao .= "AND A.dia > '".$hoje."' ";
            } else {
                $queryAcao .= "AND A.dia < '".$hoje."' ";
            }

        }

        if ($variable == 'instituicao') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY I.nome_instituicao DESC ";
            } else {
                $queryAcao .= "ORDER BY I.nome_instituicao ASC ";
            }
        }

        if ($variable == 'titulo') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.titulo DESC ";
            } else {
                $queryAcao .= "ORDER BY A.titulo ASC ";
            }
        }

        if ($variable == 'distrito') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.distrito DESC ";
            } else {
                $queryAcao .= "ORDER BY A.distrito ASC ";
            }
        }

        if ($variable == 'concelho') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.concelho DESC ";
            } else {
                $queryAcao .= "ORDER BY A.concelho ASC ";
            }
        }

        if ($variable == 'freguesia') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.freguesia DESC ";
            } else {
                $queryAcao .= "ORDER BY A.freguesia ASC ";
            }
        }

        if ($variable == 'funcao') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.funcao DESC ";
            } else {
                $queryAcao .= "ORDER BY A.funcao ASC ";
            }
        }

        if ($variable == 'area') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.area_interesse DESC ";
            } else {
                $queryAcao .= "ORDER BY A.area_interesse ASC ";
            }
        }

        if ($variable == 'populacao') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.populacao_alvo DESC ";
            } else {
                $queryAcao .= "ORDER BY A.populacao_alvo ASC ";
            }
        }

        if ($variable == 'numvagas') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.num_vagas DESC ";
            } else {
                $queryAcao .= "ORDER BY A.num_vagas ASC ";
            }
        }

        if ($variable == 'dia') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.dia DESC ";
            } else {
                $queryAcao .= "ORDER BY A.dia ASC ";
            }
        }

        if ($variable == 'hora') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.hora DESC ";
            } else {
                $queryAcao .= "ORDER BY A.hora ASC ";
            }
        }

        if ($variable == 'duracao') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.duracao DESC ";
            } else {
                $queryAcao .= "ORDER BY A.duracao ASC ";
            }
        }

        $acaof = free_query($queryAcao);

        $result = array();
        
        while ($acao = $acaof->fetch_assoc()){
            $hoje = date("Y-m-d");
            if ($acao['dia'] > $hoje) {
                $acao['ativa'] = "Ativa";
            } else {
                $acao['ativa'] = "Inativa";
            }

            array_push($result, $acao);
        }

        return $result;

    }

    function adminAF($order, $variable) {
        
        $queryAcao = "SELECT I.id, I.nome_instituicao, A.id_acao, A.titulo, A.distrito,
                        A.concelho, A.freguesia, A.funcao, A.area_interesse, A.populacao_alvo,
                        A.num_vagas, A.dia, A.hora, A.duracao
                        FROM Instituicao I, Acao A
                        WHERE I.id = A.id_instituicao ";
        
        if ($variable == 'instituicao') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY I.nome_instituicao DESC ";
            } else {
                $queryAcao .= "ORDER BY I.nome_instituicao ASC ";
            }
        }

        if ($variable == 'titulo') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.titulo DESC ";
            } else {
                $queryAcao .= "ORDER BY A.titulo ASC ";
            }
        }

        if ($variable == 'distrito') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.distrito DESC ";
            } else {
                $queryAcao .= "ORDER BY A.distrito ASC ";
            }
        }

        if ($variable == 'concelho') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.concelho DESC ";
            } else {
                $queryAcao .= "ORDER BY A.concelho ASC ";
            }
        }

        if ($variable == 'freguesia') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.freguesia DESC ";
            } else {
                $queryAcao .= "ORDER BY A.freguesia ASC ";
            }
        }

        if ($variable == 'funcao') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.funcao DESC ";
            } else {
                $queryAcao .= "ORDER BY A.funcao ASC ";
            }
        }

        if ($variable == 'area') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.area_interesse DESC ";
            } else {
                $queryAcao .= "ORDER BY A.area_interesse ASC ";
            }
        }

        if ($variable == 'populacao') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.populacao_alvo DESC ";
            } else {
                $queryAcao .= "ORDER BY A.populacao_alvo ASC ";
            }
        }

        if ($variable == 'numvagas') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.num_vagas DESC ";
            } else {
                $queryAcao .= "ORDER BY A.num_vagas ASC ";
            }
        }

        if ($variable == 'dia') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.dia DESC ";
            } else {
                $queryAcao .= "ORDER BY A.dia ASC ";
            }
        }

        if ($variable == 'hora') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.hora DESC ";
            } else {
                $queryAcao .= "ORDER BY A.hora ASC ";
            }
        }

        if ($variable == 'duracao') {
            if ($order == 'desc') {
                $queryAcao .= "ORDER BY A.duracao DESC ";
            } else {
                $queryAcao .= "ORDER BY A.duracao ASC ";
            }
        }
        
        $acaof = free_query($queryAcao);

        $result = array();
        
        while ($acao = $acaof->fetch_assoc()){
            $hoje = date("Y-m-d");
            if ($acao['dia'] > $hoje) {
                $acao['ativa'] = "Ativa";
            } else {
                $acao['ativa'] = "Inativa";
            }

            array_push($result, $acao);
        }

        return $result;
    }

?>