<?php

    session_start();
    ob_start();

    /* ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE); */
    
    $show_publicacoes = $_REQUEST['show_publicacoes'];

    if ($show_publicacoes) {
      echo Show_Publicacoes();
    }

    function Show_Publicacoes(){
        
        include_once "../Model/Model.php";
        
        $publicacoes = publicacoes();
        $resultado = "";

        $seguindoArray = array();

        $seguindo = seguindo_user($_SESSION['loggedid']);

        while ($segue = $seguindo->fetch_assoc()) {
            array_push($seguindoArray, $segue['seguido']);
        }
        
        if ($publicacoes->num_rows > 0) {
            
            while ($row = $publicacoes->fetch_assoc()) {

              if (in_array($row['dono'], $seguindoArray) or $row['dono'] == $_SESSION['loggedid']) {

                  $tipo_utilizador = tipo_utilizador_query($row["dono"]);
                  if ($rowt = $tipo_utilizador->fetch_assoc()){
                    if ($rowt['tipo'] == "voluntario"){
                      $utilizador = query_voluntario($row["dono"]);
                      if ($rowu = $utilizador->fetch_assoc()){
                        $nome_utilizador = $rowu['nome_voluntario'];
                        $foto = $rowu['foto'];
                      }
                    }
                    if ($rowt['tipo'] == "instituicao") {
                      $utilizador = query_instituicao($row["dono"]);
                      if  ($rowu = $utilizador->fetch_assoc()) {
                        $nome_utilizador = $rowu['nome_instituicao'];
                        $foto = $rowu['foto'];
                      }
                    }
                  }
                  
                  
                  
                  $resultado.= "<div id='pubs'><div class='pubpar'><img src='../".$row["imagem"]."'>
                  <div class='divnome_par'><img src='../$foto' class='w3-circle' id='avatar'>
                                  <h6>" . $nome_utilizador. "</h6></div>";
                  /* <div class='divcom_par'><p>Com: </p>
                  </div> */
                  $resultado.= "<br><hr><div class='divtext_par'><p>"  . $row["descricao"]. "</p></div></div></div>";

              }   
            }

            if ($resultado == "") {
              $resultado .= "<p class='erro w3-center'> Não existem publicações disponíveis. Siga utilizadores para ver as suas publicações. </p>";
            }
          } else {
            $resultado .= "<p class='erro w3-center'> Não existem publicações disponíveis. Siga utilizadores para ver as suas publicações. </p>";
          }
        
        return $resultado;
    }

    $show_publicacoes_perfil = $_REQUEST['show_publicacoes_perfil'];

    if ($show_publicacoes_perfil) {
      echo Show_Publicacoes_Perfil();
    }

    function Show_Publicacoes_Perfil() {
        include_once "../Model/Model.php";
          
        $publicacoes = publicacoes();
        $resultado = "";
        
        if ($publicacoes->num_rows > 0) {
            
            while ($row = $publicacoes->fetch_assoc()) {

              if ($row['dono'] == $_SESSION['openid']) {

                  $tipo_utilizador = tipo_utilizador_query($row["dono"]);
                  if ($rowt = $tipo_utilizador->fetch_assoc()){
                    if ($rowt['tipo'] == "voluntario"){
                      $utilizador = query_voluntario($row["dono"]);
                      if ($rowu = $utilizador->fetch_assoc()){
                        $nome_utilizador = $rowu['nome_voluntario'];
                        $foto = $rowu['foto'];
                      }
                    }
                    if ($rowt['tipo'] == "instituicao") {
                      $utilizador = query_instituicao($row["dono"]);
                      if  ($rowu = $utilizador->fetch_assoc()) {
                        $nome_utilizador = $rowu['nome_instituicao'];
                        $foto = $rowu['foto'];
                      }
                    }
                  }
                  
                  $resultado.= "<div id='pubs'><div class='pubpar'><img src='../".$row["imagem"]."'>
                  <div class='divnome_par'><img src='../$foto' class='w3-circle' id='avatar'>
                                  <h6>" . $nome_utilizador. "</h6></div>";
                  /* <div class='divcom_par'><p>Com: </p>
                  </div> */
                  $resultado.= "<hr><div class='divtext_par'><p>"  . $row["descricao"]. "</p></div></div></div>";

              }   
            }

            if ($resultado == "") {
              $resultado .= "<p class='w3-center'> Ainda não publicou. </p>";
            }
          } else {
            $resultado .= "<p class='w3-center'> Ainda não publicou. </p>";
          }
        
        return $resultado;
    }

    if ($_POST['descricao']) {

      include_once "../Model/Model.php";

      $descricao = $_POST['descricao'];
      $loggedid = $_SESSION['loggedid'];

      include_once "InputPhotoController.php";

      $imagem = test_photo();

      if (substr($imagem,0,6) == "Images") {

        $inserir_pub = inserir_publicacao($loggedid, $imagem, $descricao);

        echo "Inseriu.";

      } else {

        echo $imagem;

      }
    }

    /* $create_publicacao = $_REQUEST['create_publicacao'];

    if ($create_publicacao) {
      $com = $_REQUEST['com'];
      $descricao = $_REQUEST['descricao'];

      echo insert_Publicacao($com, $descricao);
    } */

    /* function insert_Publicacao($com, $descricao){

        $loggedid = $_SESSION['loggedid'];

        require_once "../View/Publicacoes.php";

        $imagem = get_image_pub();

        if (substr($avatar,0,6) == "Images") {

          $inserir_pub = inserir_publicacao($loggedid, $imagem, $descricao);

          return "Inseriu.";

        } else {

          return $imagem;

        }
      
    } */

    /* function inserir_identificados($id_publicacao, $participante){

      $inserir_ident = participa_publicacao($id_publicacao, $participante);
      

    } */
      
    
?>  




