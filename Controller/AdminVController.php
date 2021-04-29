<?php

    include "../Model/Model.php";

    $show_voluntarios = $_REQUEST['show_voluntarios'];

    if ($show_voluntarios) {

        $nome = $_REQUEST['nome'];
        $email = $_REQUEST['email'];
        $idade = $_REQUEST['idade'];
        $distrito = $_REQUEST['distrito'];
        $concelho = $_REQUEST['concelho'];
        $freguesia = $_REQUEST['freguesia'];
        $genero = $_REQUEST['genero'];
        $carta = $_REQUEST['carta'];
        $covid = $_REQUEST['covid'];
        $area_interesse = $_REQUEST['area'];
        $populacao_alvo = $_REQUEST['populacao'];
        $disponibilidade_dia = $_REQUEST['dia'];
        $disponibilidade_hora = $_REQUEST['hora'];
        $disponibilidade_duracao = $_REQUEST['duracao'];
        $order = $_REQUEST['order'];
        $variable = $_REQUEST['variable'];

        if ($nome or $email or $idade or $distrito or $concelho or $freguesia or $genero or $carta or $covid
        or $area_interesse or $populacao_alvo or $disponibilidade_dia or $disponibilidade_hora or $disponibilidade_duracao){
    
            $resultVoluntario = adminVolPost($nome, $email, $idade, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $area_interesse, $populacao_alvo, $disponibilidade_dia, $disponibilidade_hora, $disponibilidade_duracao, $order, $variable);
    
        } else {
            
            $resultVoluntario = adminVol($order, $variable);
            
        }
        
        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-red w3-pale-red w3-small resultado'>";
        echo "<p>Encontrou ".($resultVoluntario->num_rows)." resultado(s) para a pesquisa.</p>";
        echo "</div>";
    
        if ($resultVoluntario->num_rows > 0) {
    
            echo "<table class='w3-table w3-striped w3-tiny w3-hoverable w3-middle' id='todosVol'>
                <tr class='w3-red'>";
                    if ($order == 'desc') {
                        $ordericon = "<i class='fas fa-sort-down'></i>";
                        $othero = 'asc';
                    } else {
                        $ordericon = "<i class='fas fa-sort-up'></i>";
                        $othero = 'desc';
                    }

                    if ($variable == 'nome') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('nome').")'>Nome $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('nome').")'>Nome</th>";
                    }

                    if ($variable == 'bio') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('bio').")'>Bio $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('bio').")'>Bio</th>";
                    }

                    if ($variable == 'nascimento') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('nascimento').")'>Data Nascimento $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('nascimento').")'>Data Nascimento</th>";
                    }
                    
                    if ($variable == 'genero') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('genero').")'>Género $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('genero').")'>Género</th>";
                    }

                    if ($variable == 'distrito') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('distrito').")'>Distrito $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('distrito').")'>Distrito</th>";
                    }
                    if ($variable == 'concelho') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('concelho').")'>Concelho $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('concelho').")'>Concelho</th>";
                    }

                    if ($variable == 'freguesia') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('freguesia').")'>Freguesia $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('freguesia').")'>Freguesia</th>";
                    }

                    if ($variable == 'tel') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('tel').")'>Tel. $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('tel').")'>Tel.</th>";
                    }
                    
                    if ($variable == 'cc') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('cc').")'>CC $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('cc').")'>CC</th>";
                    }
                    
                    if ($variable == 'carta') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('carta').")'>Carta C. $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('carta').")'>Carta C.</th>";
                    }

                    if ($variable == 'covid') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('covid').")'>Covid $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('covid').")'>Covid</th>";
                    }

                    if ($variable == 'email') {
                        echo "<th onclick='showVoluntarios(".json_encode($othero).", ".json_encode('email').")'>Email $ordericon</th>";
                    } else {
                        echo "<th onclick='showVoluntarios(".json_encode('asc').", ".json_encode('email').")'>Email</th>";
                    }
                    
                    echo "<th>Áreas Interesse</th>
                    <th>População Alvo</th>
                    <th>Disponibilidade</th>";
            echo "</tr>";
            
            while ($row = $resultVoluntario->fetch_assoc()){
                echo "
                <tr>
                    <td><p>".$row['nome_voluntario']."</p></td>
                    <td><p>".$row['bio']."</p></td>
                    <td><p>".$row['data_nascimento']."</p></td>
                    <td><p>".$row['genero']."</p></td>
                    <td><p>".$row['distrito']."</p></td>
                    <td><p>".$row['concelho']."</p></td>
                    <td><p>".$row['freguesia']."</p></td>
                    <td><p>".$row['telefone']."</p></td>
                    <td><p>".$row['cc']."</p></td>
                    <td><p>".$row['carta_c']."</p></td>
                    <td><p>".$row['covid']."</p></td>
                    <td><p>".$row['email']."</p></td>";
    
                    $resultArea = AreaVolAdmin($row['id']);         
    
                    echo "<td>";
                    if ($resultArea->num_rows > 0) {
                        while ($rowA = $resultArea->fetch_assoc()){
                            echo "<p>" . $rowA['area'] . "</p>";
                        }
                    }
                    echo "</td>";
    
                    $resultPopulacao = PopulacaoVolAdmin($row['id']);          
    
                    echo "<td>";
                    if ($resultPopulacao->num_rows > 0) {
                        while ($rowP = $resultPopulacao->fetch_assoc()){
                            echo "<p>" . $rowP['populacao_alvo'] . "</p>";
                        }
                    }
                    echo "</td>";
    
                    $resultDispo = DispoVolAdmin($row['id']);    
    
                    echo "<td>";
                    if ($resultDispo->num_rows > 0) {
                        while ($rowD = $resultDispo->fetch_assoc()){
                            echo "<p>" . $rowD['dia'] . ", às ". $rowD['hora'] .", durante ". $rowD['duracao'] ." horas.</p>";
                        }
                    }
                    echo "</td>";
    
                echo "</tr>
                ";
            }
            echo "</table>";
        }
    }

    function adminVolPost($nome, $email, $idade, $distrito, $concelho, $freguesia, $genero, $carta, $covid, $area_interesse, $populacao_alvo, $disponibilidade_dia, $disponibilidade_hora, $disponibilidade_duracao, $order, $variable) {

        $primeiro = 0;

        $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                            , distrito, freguesia, telefone, cc, carta_c, covid, email
                            FROM Voluntario ";

        if (!empty($nome)){
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE nome_voluntario LIKE '".$nome."%' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND nome_voluntario LIKE '".$nome."%' ";
            }
        }

        if (!empty($email)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE email LIKE '".$email."%' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND email LIKE '".$email."%' ";
            }
        }

        if (!empty($idade)) {
            
            if ($idade == "10 aos 20") {
                $time1 = strtotime("-10 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-20 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "21 aos 30") {
                $time1 = strtotime("-20 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-30 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "31 aos 40") {
                $time1 = strtotime("-30 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-40 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "41 aos 50") {
                $time1 = strtotime("-40 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-50 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "51 aos 60") {
                $time1 = strtotime("-50 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-60 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "61 aos 70") {
                $time1 = strtotime("-60 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-70 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "71 aos 80") {
                $time1 = strtotime("-70 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-80 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($idade == "81+") {
                $time1 = strtotime("-80 years", time());
                $date1 = date("Y-m-d", $time1);
                $time2 = strtotime("-150 years", time());
                $date2 = date("Y-m-d", $time2);
            }
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND (data_nascimento BETWEEN '".$date2."' AND '".$date1."') ";
            }
        }

        if (!empty($distrito)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE distrito = '".$distrito."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND distrito = '".$distrito."' ";
            }
        }

        if (!empty($concelho)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE concelho = '".$concelho."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND concelho = '".$concelho."' ";
            }
        }

        if (!empty($freguesia)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE freguesia = '".$freguesia."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND freguesia = '".$freguesia."' ";
            }
        }

        if (!empty($genero)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE genero = '".$genero."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND genero = '".$genero."' ";
            }
        }

        if (!empty($carta)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE carta_c = '".$carta."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND carta_c = '".$carta."' ";
            }
        }

        if (!empty($covid)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE covid = '".$covid."' ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND covid = '".$covid."' ";
            }
        }

        if (!empty($area_interesse)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Area
                                    WHERE area = '".$area_interesse."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Area
                                    WHERE area = '".$area_interesse."') ";
            }
        }

        if (!empty($populacao_alvo)) {
            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Populacao_Alvo
                                    WHERE populacao_alvo = '".$populacao_alvo."') ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Populacao_Alvo
                                    WHERE populacao_alvo = '".$populacao_alvo."') ";
            }
        }

        if (!empty($disponibilidade_dia) and 
        !empty($disponibilidade_hora) and
        !empty($disponibilidade_duracao)) {

            $intervalo = intval($disponibilidade_hora) + intval($disponibilidade_duracao);

            if ($primeiro == 0){
                $queryVoluntario .= "WHERE id IN (SELECT id_voluntario
                                    FROM Voluntario_Disponibilidade
                                    WHERE dia = '".$disponibilidade_dia."'
                                        AND hora >= ".$disponibilidade_hora."
                                        AND hora <= ".$intervalo.") ";
                $primeiro = 1;
            } else {
                $queryVoluntario .= "AND id IN (SELECT id_voluntario
                                    FROM Voluntario_Disponibilidade
                                    WHERE dia = '".$disponibilidade_dia."'
                                        AND hora >= ".$disponibilidade_hora."
                                        AND hora <= ".$intervalo.") ";
            }
        }

        if ($variable == 'nome') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY nome_voluntario DESC ";
            } else {
                $queryVoluntario .= "ORDER BY nome_voluntario ASC ";
            }
        }

        if ($variable == 'bio') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY bio DESC ";
            } else {
                $queryVoluntario .= "ORDER BY bio ASC ";
            }
        }

        if ($variable == 'nascimento') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY data_nascimento DESC ";
            } else {
                $queryVoluntario .= "ORDER BY data_nascimento ASC ";
            }
        }

        if ($variable == 'genero') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY genero DESC ";
            } else {
                $queryVoluntario .= "ORDER BY genero ASC ";
            }
        }

        if ($variable == 'distrito') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY distrito DESC ";
            } else {
                $queryVoluntario .= "ORDER BY distrito ASC ";
            }
        }
        if ($variable == 'concelho') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY concelho DESC ";
            } else {
                $queryVoluntario .= "ORDER BY concelho ASC ";
            }
        }

        if ($variable == 'freguesia') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY freguesia DESC ";
            } else {
                $queryVoluntario .= "ORDER BY freguesia ASC ";
            }
        }

        if ($variable == 'tel') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY telefone DESC ";
            } else {
                $queryVoluntario .= "ORDER BY telefone ASC ";
            }
        }

        if ($variable == 'cc') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY cc DESC ";
            } else {
                $queryVoluntario .= "ORDER BY cc ASC ";
            }
        }

        if ($variable == 'carta') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY carta_C DESC ";
            } else {
                $queryVoluntario .= "ORDER BY carta_C ASC ";
            }
        }

        if ($variable == 'covid') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY covid DESC ";
            } else {
                $queryVoluntario .= "ORDER BY covid ASC ";
            }
        }

        if ($variable == 'email') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY email DESC ";
            } else {
                $queryVoluntario .= "ORDER BY email ASC ";
            }
        }

        return free_query($queryVoluntario);
        
    }

    function adminVol($order, $variable) {

        $queryVoluntario = "SELECT id, nome_voluntario, bio, data_nascimento, genero, concelho
                    , distrito, freguesia, telefone, cc, carta_c, covid, email
                    FROM Voluntario ";

        if ($variable == 'nome') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY nome_voluntario DESC ";
            } else {
                $queryVoluntario .= "ORDER BY nome_voluntario ASC ";
            }
        }

        if ($variable == 'bio') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY bio DESC ";
            } else {
                $queryVoluntario .= "ORDER BY bio ASC ";
            }
        }

        if ($variable == 'nascimento') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY data_nascimento DESC ";
            } else {
                $queryVoluntario .= "ORDER BY data_nascimento ASC ";
            }
        }

        if ($variable == 'genero') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY genero DESC ";
            } else {
                $queryVoluntario .= "ORDER BY genero ASC ";
            }
        }

        if ($variable == 'distrito') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY distrito DESC ";
            } else {
                $queryVoluntario .= "ORDER BY distrito ASC ";
            }
        }
        if ($variable == 'concelho') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY concelho DESC ";
            } else {
                $queryVoluntario .= "ORDER BY concelho ASC ";
            }
        }

        if ($variable == 'freguesia') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY freguesia DESC ";
            } else {
                $queryVoluntario .= "ORDER BY freguesia ASC ";
            }
        }

        if ($variable == 'tel') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY telefone DESC ";
            } else {
                $queryVoluntario .= "ORDER BY telefone ASC ";
            }
        }

        if ($variable == 'cc') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY cc DESC ";
            } else {
                $queryVoluntario .= "ORDER BY cc ASC ";
            }
        }

        if ($variable == 'carta') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY carta_C DESC ";
            } else {
                $queryVoluntario .= "ORDER BY carta_C ASC ";
            }
        }

        if ($variable == 'covid') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY covid DESC ";
            } else {
                $queryVoluntario .= "ORDER BY covid ASC ";
            }
        }

        if ($variable == 'email') {
            if ($order == 'desc') {
                $queryVoluntario .= "ORDER BY email DESC ";
            } else {
                $queryVoluntario .= "ORDER BY email ASC ";
            }
        }
        
        return free_query($queryVoluntario);

    }

    function AreaVolAdmin($id) {
        return areas_voluntario($id);
    }

    function PopulacaoVolAdmin($id) {
        return populacao_voluntario($id);
    }

    function DispoVolAdmin($id) {
        return disponibilidade_voluntario($id);
    }
    

?>