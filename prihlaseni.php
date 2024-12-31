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
    <title>Document</title>
</head>
<body>
    
 
    <?php
        $host = "localhost";
        $user = "root";
        $passwd = "";
        $db = "mydb";
       
        $connect = new mysqli($host, $user, $passwd, $db) or die("Spojení se nezdařilo");
        $connect->set_charset("UTF8") or die("Kódování NEnastaveno");
        
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
        $connect->close();
        
    ?>

        //<a href="rozcestnik.html"><input type="button" value="Na Hlavní "></a>

</body>
</html>