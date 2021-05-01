<?php
    $id = $_REQUEST['id'];
    $nome = $_REQUEST['nome'];
    $tipo = $_REQUEST['tipo'];

    if ($id or $nome or $tipo) {
        echo $id;
        echo $nome;
        echo $tipo;
    } else {
        echo "E-mail enviado! Confirme o seu e-mail.";
    }
    

?>