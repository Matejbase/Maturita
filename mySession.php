<?php
    session_start();
    $id_session = session_id();
    //echo "ID session = $id_session<br />";
    if (empty($_SESSION['user'])) {
        echo "User neexistuje ";
        echo "<a href=\"./formular_prihlaseni.html\">Přihlásit se</a>";
    }
    else {    
        //echo "User: " . $_SESSION['user'] . "<br />";
        echo "User vytvořen: " . $_SESSION['user'] . "<br />";
        }
    ?>

