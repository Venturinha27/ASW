<?php

    function TerminarSessao() {
        unset ($_SESSION['loggedtype']);
        unset ($_SESSION['logged']);
        unset ($_SESSION['loggedid']);
        unset ($_SESSION['opentype']);
        unset ($_SESSION['open']);
        unset ($_SESSION['openid']);
    }

    function SelfOpen() {
        $_SESSION['opentype'] = $_SESSION['loggedtype'];
        $_SESSION['open'] = $_SESSION['logged'];
        $_SESSION['openid'] = $_SESSION['loggedid'];
    }

?>