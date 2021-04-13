
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
    

    if (!empty($_POST)){

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $distrito = $_POST['distrito'];
        $concelho = $_POST['concelho'];
        $freguesia = $_POST['freguesia'];

        include "../Controller/AdminIController.php";
        
        
        $resultInstituicao = adminInstPost($nome,$email,$distrito,$concelho,$freguesia); 
        
    } else {
        $resultInstituicao = adminInst();
        
    }

    /*$resultInstituicao = $conn->query($queryInstituicao);

        
    
    
    
    
    
    
    /* ta certo daqui pa baixo*/ 
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
