<?php

    include "../Model/Model.php";

    $show_todos_utilizadores = $_REQUEST['show_todos_utilizadores'];

    if ($show_todos_utilizadores) {

        $id = $_REQUEST['id'];
        $nome = $_REQUEST['nome'];
        $distrito = $_REQUEST['distrito'];
        $concelho = $_REQUEST['concelho'];
        $freguesia = $_REQUEST['freguesia'];
        $tipo = $_REQUEST['tipo'];

        $todos = todosUtilizadores($id, $nome, $distrito, $concelho, $freguesia, $tipo);

        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultado'>";
        echo "<p>Encontrou ".(count($todos))." resultado(s) para a pesquisa.</p>";
        echo "</div>";

        if (count($todos) > 0) {

            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='todosVol'>
                <tr class='w3-blue'>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Distrito</th>
                    <th>Concelho</th>
                    <th>Freguesia</th>
                    <th>Tipo</th>
                </tr>";
            
            foreach ($todos as $user) {
                echo "
                <tr>
                    <td>".$user[0]."</td>
                    <td>".$user[1]."</td>
                    <td>".$user[2]."</td>
                    <td>".$user[3]."</td>
                    <td>".$user[4]."</td>
                    <td>".$user[5]."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }
    }

    $show_todos_convites = $_REQUEST['show_todos_convites'];

    if ($show_todos_convites) {

        $con_voluntario = $_REQUEST['con_voluntario'];
        $con_instituicao = $_REQUEST['con_instituicao'];
        $con_acao = $_REQUEST['con_acao'];
        $con_estado = $_REQUEST['con_estado'];
        $con_data = $_REQUEST['con_data'];

        $convites = todosConvites($con_voluntario, $con_instituicao, $con_acao, $con_estado, $con_data);

        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultadoco'>";
        echo "<p>Encontrou ".(count($convites))." resultado(s) para a pesquisa.</p>";
        echo "</div>";

        if (count($convites) > 0) {

            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='convitesT'>
                <tr class='w3-blue'>
                    <th>Voluntário</th>
                    <th>Instituição</th>
                    <th>Ação</th>
                    <th>Estado</th>
                    <th>Data</th>
                </tr>";
            
            foreach ($convites as $convite) {
                echo "
                <tr>
                    <td>".$convite[0]."</td>
                    <td>".$convite[1]."</td>
                    <td>".$convite[2]."</td>
                    <td>".$convite[3]."</td>
                    <td>".$convite[4]."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }
    }

    $show_todas_candidaturas = $_REQUEST['show_todas_candidaturas'];

    if ($show_todas_candidaturas) {

        $can_voluntario = $_REQUEST['can_voluntario'];
        $can_instituicao = $_REQUEST['can_instituicao'];
        $can_acao = $_REQUEST['can_acao'];
        $can_estado = $_REQUEST['can_estado'];
        $can_data = $_REQUEST['can_data'];

        $candidaturas = todasCandidaturas($can_voluntario, $can_instituicao, $can_acao, $can_estado, $can_data);

        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultadoca'>";
        echo "<p>Encontrou ".(count($candidaturas))." resultado(s) para a pesquisa.</p>";
        echo "</div>";

        if (count($candidaturas) > 0) {

            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='candidaturasT'>
                <tr class='w3-blue'>
                    <th>Voluntário</th>
                    <th>Instituição</th>
                    <th>Ação</th>
                    <th>Estado</th>
                    <th>Data</th>
                </tr>";
            
            foreach ($candidaturas as $candidatura) {
                echo "
                <tr>
                    <td>".$candidatura[0]."</td>
                    <td>".$candidatura[1]."</td>
                    <td>".$candidatura[2]."</td>
                    <td>".$candidatura[3]."</td>
                    <td>".$candidatura[4]."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }
    }

    $show_todas_participacoes = $_REQUEST['show_todas_participacoes'];

    if ($show_todas_participacoes) {

        $par_voluntario = $_REQUEST['par_voluntario'];
        $par_instituicao = $_REQUEST['par_instituicao'];
        $par_acao = $_REQUEST['par_acao'];

        $participacoes = todasParticipacoes($par_voluntario, $par_instituicao, $par_acao);

        echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultp'>";
        echo "<p>Encontrou ".(count($participacoes))." resultado(s) para a pesquisa.</p>";
        echo "</div>";

        if (count($participacoes) > 0) {

            echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='participacoesT'>
                <tr class='w3-blue'>
                    <th>Voluntário</th>
                    <th>Instituição</th>
                    <th>Ação</th>
                </tr>";
            
            foreach ($participacoes as $participacao) {
                echo "
                <tr>
                    <td>".$participacao[0]."</td>
                    <td>".$participacao[1]."</td>
                    <td>".$participacao[2]."</td>
                </tr>
                ";
            }
            echo "</table><br><br><br>";
        }
    }

    function todosUtilizadores($id, $nome, $distrito, $concelho, $freguesia, $tipo) {
        $acoes = all_acoes();
        $voluntarios = all_voluntarios();
        $instituicoes = all_instituicoes();

        $all = array();

        while ($acoesr = $acoes->fetch_assoc()) {
            $acaoa = array();
            $acaoa[0] = $acoesr['id_acao'];
            $acaoa[1] = $acoesr['titulo'];
            $acaoa[2] = $acoesr['distrito'];
            $acaoa[3] = $acoesr['concelho'];
            $acaoa[4] = $acoesr['freguesia'];
            $acaoa[5] = 'Ação';

            array_push($all, $acaoa);
        }

        while ($volr = $voluntarios->fetch_assoc()) {
            $vola = array();
            $vola[0] = $volr['id'];
            $vola[1] = $volr['nome_voluntario'];
            $vola[2] = $volr['distrito'];
            $vola[3] = $volr['concelho'];
            $vola[4] = $volr['freguesia'];
            $vola[5] = 'Voluntário';

            array_push($all, $vola);
        }

        while ($insr = $instituicoes->fetch_assoc()) {
            $insa = array();
            $insa[0] = $insr['id'];
            $insa[1] = $insr['nome_instituicao'];
            $insa[2] = $insr['distrito'];
            $insa[3] = $insr['concelho'];
            $insa[4] = $insr['freguesia'];
            $insa[5] = 'Instituição';

            array_push($all, $insa);
        }

        if ($id != "") {
            $limit = count($all);
            for ($a = 0; $a < $limit; $a++) {
                if ($all[$a][0] != $id) {
                    unset($all[$a]);
                }
            }
            $all = array_values($all);
        }

        if ($nome != "") {
            $limit = count($all);
            for ($b = 0; $b < $limit; $b++) {
                if ($all[$b][1] != $nome) {
                    unset($all[$b]);
                }
            }
            $all = array_values($all);
        }

        if ($distrito != "") {
            $limit = count($all);
            for ($c = 0; $c < $limit; $c++) {
                if ($all[$c][2] != $distrito) {
                    unset($all[$c]);
                }
            }
            $all = array_values($all);
        }

        if ($concelho != "") {
            $limit = count($all);
            for ($d = 0; $d < $limit; $d++) {
                if ($all[$d][3] != $concelho) {
                    unset($all[$d]);
                }
            }
            $all = array_values($all);
        }

        if ($freguesia != "") {
            $limit = count($all);
            for ($e = 0; $e < $limit; $e++) {
                if ($all[$e][4] != $freguesia) {
                    unset($all[$e]);
                }
            }
            $all = array_values($all);
        }
        
        if ($tipo != "") {
            $limit = count($all);
            for ($h = 0; $h < $limit; $h++) {
                if ($all[$h][5] != $tipo) {
                    unset($all[$h]);
                }
            }
            $all = array_values($all);
        }

        usort($all, "compareF");

        return $all;
    }

    function compareF($x, $y){   
        return $X[1] - $y[1];
    }

    function todosConvites($voluntario, $instituicao, $acao, $estado, $data) {
        $convites = query_convites();

        $final = array();
        while ($convr = $convites->fetch_assoc()) {
            $convite = array();

            $nomevol = nome_voluntario($convr['id_voluntario']);
            if ($nv = $nomevol->fetch_array()) {
                $convite[0] = $nv[1];
            }
            $nomeins = nome_instituicao($convr['id_instituicao']);
            if ($ni = $nomeins->fetch_array()) {
                $convite[1] = $ni[1];
            }
            $nomeac = nome_acao($convr['id_acao']);
            if ($na = $nomeac->fetch_array()) {
                $convite[2] = $na[1];
            }
            $convite[3] = $convr['estado'];
            $convite[4] = $convr['data_convite'];

            array_push($final, $convite);
        }

        if ($voluntario != "") {
            $limit = count($final);
            for ($a = 0; $a < $limit; $a++) {
                if ($final[$a][0] != $voluntario) {
                    unset($final[$a]);
                }
            }
            $final = array_values($final);
        }

        if ($instituicao != "") {
            $limit = count($final);
            for ($b = 0; $b < $limit; $b++) {
                echo $final[$b][1];
                echo $instituicao;
                if ($final[$b][1] != $instituicao) {
                    unset($final[$b]);
                }
            }
            $final = array_values($final);
        }

        if ($acao != "") {
            $limit = count($final);
            for ($c = 0; $c < $limit; $c++) {
                if ($final[$c][2] != $acao) {
                    unset($final[$c]);
                }
            }
            $final = array_values($final);
        }

        if ($estado != "") {
            $limit = count($final);
            for ($d = 0; $d < $limit; $d++) {
                if ($final[$d][3] != $estado) {
                    unset($final[$d]);
                }
            }
            $final = array_values($final);
        }

        if ($data != "") {
            $limit = count($final);
            for ($e = 0; $e < $limit; $e++) {
                if ($final[$e][4] != $data) {
                    unset($final[$e]);
                }
            }
            $final = array_values($final);
        }

        return $final;
    }

    function todasCandidaturas($voluntario, $instituicao, $acao, $estado, $data) {
        $candidaturas = query_candidaturas();

        $final = array();
        while ($canr = $candidaturas->fetch_assoc()) {
            $candidatura = array();

            $nomevol = nome_voluntario($canr['id_voluntario']);
            if ($nv = $nomevol->fetch_array()) {
                $candidatura[0] = $nv[1];
            }
            $nomeins = nome_instituicao($canr['id_instituicao']);
            if ($ni = $nomeins->fetch_array()) {
                $candidatura[1] = $ni[1];
            }
            $nomeac = nome_acao($canr['id_acao']);
            if ($na = $nomeac->fetch_array()) {
                $candidatura[2] = $na[1];
            }
            $candidatura[3] = $canr['estado'];
            $candidatura[4] = $canr['data_candidatura'];

            array_push($final, $candidatura);
        }

        if ($voluntario != "") {
            $limit = count($final);
            for ($a = 0; $a < $limit; $a++) {
                if ($final[$a][0] != $voluntario) {
                    unset($final[$a]);
                }
            }
            $final = array_values($final);
        }

        if ($instituicao != "") {
            $limit = count($final);
            for ($b = 0; $b < $limit; $b++) {
                echo $final[$b][1];
                echo $instituicao;
                if ($final[$b][1] != $instituicao) {
                    unset($final[$b]);
                }
            }
            $final = array_values($final);
        }

        if ($acao != "") {
            $limit = count($final);
            for ($c = 0; $c < $limit; $c++) {
                if ($final[$c][2] != $acao) {
                    unset($final[$c]);
                }
            }
            $final = array_values($final);
        }

        if ($estado != "") {
            $limit = count($final);
            for ($d = 0; $d < $limit; $d++) {
                if ($final[$d][3] != $estado) {
                    unset($final[$d]);
                }
            }
            $final = array_values($final);
        }

        if ($data != "") {
            $limit = count($final);
            for ($e = 0; $e < $limit; $e++) {
                if ($final[$e][4] != $data) {
                    unset($final[$e]);
                }
            }
            $final = array_values($final);
        }

        return $final;

    }

    function todasParticipacoes($voluntario, $instituicao, $acao) {
        $participacoes = query_participacoes();

        $final = array();
        while ($part = $participacoes->fetch_assoc()) {
            $participacao = array();

            $nomevol = nome_voluntario($part['id_voluntario']);
            if ($nv = $nomevol->fetch_array()) {
                $participacao[0] = $nv[1];
            }
            $nomeins = nome_instituicao($part['id_instituicao']);
            if ($ni = $nomeins->fetch_array()) {
                $participacao[1] = $ni[1];
            }
            $nomeac = nome_acao($part['id_acao']);
            if ($na = $nomeac->fetch_array()) {
                $participacao[2] = $na[1];
            }

            array_push($final, $participacao);
        }

        if ($voluntario != "") {
            $limit = count($final);
            for ($a = 0; $a < $limit; $a++) {
                if ($final[$a][0] != $voluntario) {
                    unset($final[$a]);
                }
            }
            $final = array_values($final);
        }

        if ($instituicao != "") {
            $limit = count($final);
            for ($b = 0; $b < $limit; $b++) {
                echo $final[$b][1];
                echo $instituicao;
                if ($final[$b][1] != $instituicao) {
                    unset($final[$b]);
                }
            }
            $final = array_values($final);
        }

        if ($acao != "") {
            $limit = count($final);
            for ($c = 0; $c < $limit; $c++) {
                if ($final[$c][2] != $acao) {
                    unset($final[$c]);
                }
            }
            $final = array_values($final);
        }

        return $final;
    }
?>