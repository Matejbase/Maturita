<?php
    session_start();
    $id_session = session_id();
    //echo "ID session = $id_session<br />";
    
    if (empty($_SESSION['user'])) {
        echo "User neexistuje ";
        echo "<a href=\"./formular_prihlaseni.html\">Přihlásit se</a>";
    }
    else {    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>    
    <h1>Welcome</h1>    
    <?php
        //echo "User: " . $_SESSION['user'] . "<br />";
        echo "User vytvořen: " . $_SESSION['user'] . "<br />";
        }
    ?>
</body>
</html>