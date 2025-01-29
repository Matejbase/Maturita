<?php

    session_start();
    $id_session = session_id();
    echo "ID session = $id_session<br />";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1>Přihlášení</h1>
    <form method="GET">
        jmeno: <input name="jmeno"><br>
        Heslo: <input name="heslo"><br>
        <input type="submit" value="Přihlásit">
    </form>
</head>
<body>
    
 
    <?php
        require_once('database.php');

        if(isset($_GET['jmeno'])){
            $name = $_GET['jmeno'];
            $psswd = $_GET['heslo'];
            $psswd = iconv('UTF-8', 'UTF-16LE', $psswd);
            $psswdHash = hash('md4', $psswd);
            $psswdHash = strtoupper($psswdHash);

            echo $name." ".$psswdHash;
            
            $stmt = $connect->prepare("SELECT name FROM users Where name=? AND password=?");
            $stmt->bind_param("ss", $name, $psswdHash);

            $stmt->execute();
            $result = $stmt->get_result();
        
            
            if ($result->num_rows > 0) {
                $_SESSION['user'] = $name;
                echo "Příhlášeno: " . $_SESSION['user'] . "<br />";
                header("Location: rozcestnik.html");

            }
            else {
                echo "Špatné jméno nebo heslo";
                //header("Location: formular_prihlaseni.html");
            }
        
        $result->free();
        $stmt->close();
        }
        
        $connect->close();
        
    ?>

        

</body>
</html>