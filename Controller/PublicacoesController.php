<?php
    
    

    function Show_Data(){
        
        include_once "../Model/Model.php";
        
        $publicacoes= publicacoes();
        $resultado="<div id='BodyDiv'>";
        
        if ($publicacoes->num_rows > 0) {
            // output data of each row
            
            while($row = $publicacoes->fetch_assoc()) {
              //$resultado.= "id: " . $row["id"]. " - Dono: " . $row["dono"]. "descricao: " . $row["descricao"]. "<br>";
              //$resultado.= "<div class='pubpar'>"  . $row["dono"]. "</div> <div class='divnome_par'> Gonçalo </div> <div class='divcom_par'>Jota e Joana</div> <div class='divtext_par'>"   . $row["descricao"]. "</div>";
              $tipo_utilizador =tipo_utilizador_query($row["dono"]);
              if ( $rowt=$tipo_utilizador->fetch_assoc()){
                if ($rowt['tipo']=="voluntario"){
                  $utilizador=query_voluntario($row["dono"]);
                  if  ( $rowu=$utilizador->fetch_assoc()){
                    $nome_utilizador= $rowu['nome_voluntario'];
                    $foto= $rowu['foto'];
                  }
                }
                if ($rowt['tipo']=="instituicao"){
                  $utilizador=query_instituicao($row["dono"]);
                  if  ( $rowu=$utilizador->fetch_assoc()){
                    $nome_utilizador= $rowu['nome_instituicao'];
                    $foto= $rowu['foto'];
                  }
                }

              }
              
              
              $resultado.= "<div id='pubs'><div class='pubpar'><img src='../Images/slide2.jpg'>
              <div class='divnome_par'><img src='../$foto' class='w3-circle' id='avatar'>
                              <h6>" . $nome_utilizador. "</h6></div>
              <div class='divcom_par'><p>Com: Programa Agora Nós e Padeira de Aljubarrota</p>
            </div><hr><div class='divtext_par'><p>"  . $row["descricao"]. "</p></div></div></div>";
            }
          } else {
            $resultado .= "<p class='erro'> Não existem Publicações disponíveis </p>";
            
          }

        $resultado.="</div>";
        
        return $resultado;
    }

    function insert_Publicacao($id, $dono, $imagem, $descricao){

      $inserir_pub = inserir_publicacao($id, $dono, $imagem, $descricao);
      
      if ($inserir_pub == TRUE){
        header("Location: Publicacoes.php");
      }
    }

    function inserir_identificados($id_publicacao, $participante){

      $inserir_ident = participa_publicacao($id_publicacao, $participante);
      

    }
      
    
?>  




