<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->
<?php
    ob_start();
    session_start();

    if ($_SESSION['loggedtype'] != "admin") {
        header("Location: LoginA.php");
    }
?>
<!DOCTYPE html>
<html>
<title>Administradores</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/AdminI.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/DCF.js"></script>


<body>
    <div id="Div">
        <br>
        <h1 class="w3-center" id="informacoesP">Informações Sobre:</h1>
        <div id="Options">
            <div id="voluntarioDiv">
                <a href="AdminV.php"><i class="fa fa-male" id="voluntarioIcon"></i></a>
                <h5 id="voluntarioP">Voluntários</p>
            </div>
            <div id="instituicaoDiv">
                <a href="AdminI.php"><i class="fa fa-building" id="instituicaoIcon"></i></a>
                <h5 id="instituicaoP">Instituições</p>
            </div>
            <div id="acaoDiv">
                <a href="AdminA.php"><i class="fa fa-hands-helping" id="acaoIcon"></i></a>
                <h5 id="acaoP">Ações</p>
            </div>
        </div>
        <!--
        <form action="admin.php" method="post" id="procura" class="w3-container">
            <input class="w3-input w3-border w3-light-grey"type="text" name="search" placeholder="Digite algo: Concelho/Freguesia/Idade/Nome"/>
            <input id="botao" type="submit" value= "PROCURAR"/>
        </form>-->
    </div>

    <div class="w3-container w3-small">
        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method="post" id="filtrar">
                <div id="esq">
                    <label><b>Nome</b></label>
                    <input type="text" class="w3-input" name="nome" placeholder="Nome" name="nome"/>
                    <br>
                    <label><b>Distrito:</b></label>
                    <select class="w3-input" name="distrito" id="distrito" size="1">
                        <option value="" disabled selected>Selecione o seu Distrito:</option>
                    </select> 
                    <br>
                    <label><b>Concelho:</b></label>
                    <select class="w3-input" name="concelho" id="concelho" size="1">
                        <option value="" disabled selected>Selecione o seu Concelho:</option>
                    </select> 
                </div>
                <div id="dir">
                    <label><b>Email</b></label>
                    <input type="text" class="w3-input" name="email" placeholder="Email" name="email"/>
                    <br>
                    <label><b>Freguesia:</b></label>
                    <select class="w3-input" name="freguesia" id="freguesia" size="1">
                        <option value="" disabled selected>Selecione a sua Freguesia:</option>
                    </select> 
                </div>
                <input class="w3-button" id="procura" type="submit" value="Procura"/>
            </form>
</div>

<?php
    include "openconn.php";

    if (!empty($_POST)){

        $primeiro = 0;

        $queryInstituicao = "SELECT id, nome_instituicao, telefone, morada, distrito, concelho, freguesia,
                        email, bio, nome_representante, email_representante, foto, website
                        FROM Instituicao ";

        if (!empty($_POST['nome'])){
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE nome_instituicao = '".$_POST['nome']."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND nome_instituicao = '".$_POST['nome']."' ";
            }
        }

        if (!empty($_POST['email'])) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE email = '".$_POST['email']."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND email = '".$_POST['email']."' ";
            }
        }

        if (!empty($_POST['distrito'])) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE distrito = '".$_POST['distrito']."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND distrito = '".$_POST['distrito']."' ";
            }
        }

        if (!empty($_POST['concelho'])) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE concelho = '".$_POST['concelho']."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND concelho = '".$_POST['concelho']."' ";
            }
        }

        if (!empty($_POST['freguesia'])) {
            if ($primeiro == 0){
                $queryInstituicao .= "WHERE freguesia = '".$_POST['freguesia']."' ";
                $primeiro = 1;
            } else {
                $queryInstituicao .= "AND freguesia = '".$_POST['freguesia']."' ";
            }
        }

        $queryInstituicao .= "ORDER BY nome_instituicao ";
        
    } else {
        $queryInstituicao = "SELECT id, nome_instituicao, telefone, morada, distrito, concelho, freguesia,
                        email, bio, nome_representante, email_representante, foto, website
                        FROM Instituicao
                        ORDER BY nome_instituicao;";
    }

    $resultInstituicao = $conn->query($queryInstituicao);

    if (!($resultInstituicao)) {
        echo "Erro: search failed" . mysqli_error($conn);
    }       
    
    echo "<div class='w3-panel w3-topbar w3-bottombar w3-border-blue w3-pale-blue w3-small resultado'>";
    echo "<p>Encontrou ".($resultInstituicao->num_rows)." resultado(s) para a pesquisa.</p>";
    echo "</div>";

    if ($resultInstituicao->num_rows > 0) {

        echo "<table class='w3-table w3-striped w3-small w3-hoverable' id='todosVol'>
            <tr class='w3-blue'>
                <th>Nome</th>
                <th>Tel.</th>
                <th>Morada</th>
                <th>Distrito</th>
                <th>Concelho</th>
                <th>Freguesia</th>
                <th>Email</th>
                <th>Bio</th>
                <th>Nome Rep.</th>
                <th>Email Rep.</th>
                <th>Website</th>
            </tr>";
        
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
    
?>

</body>
