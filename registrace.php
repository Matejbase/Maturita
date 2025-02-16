<?php
    session_start();
    $id_session = session_id();
    echo "ID Session = $id_session<br />";
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <h1>Registrace</h1>
    <form method="GET" class="inputs">
        Jmémo: <input name="jmeno"><br>
        Heslo: <input name="heslo" type="password">
        <input type="submit" value="Zaregistrovat">
    </form>
    <?php
        require_once('database.php');
        
        if(isset($_GET['jmeno'])){
            $name = $_GET['jmeno'];
            $psswd = $_GET['heslo'];
            $psswd = iconv('UTF-8', 'UTF-16LE', $psswd);
            $psswdHash = hash('md4', $psswd);
            $psswdHash = strtoupper($psswdHash);
        
            //$stmt = $connect->prepare("INSERT INTO users(name, password) VALUES(?, ?)");
            //$stmt->bind_param("ss", $name, $psswdHash);

            $select = $connect->prepare("SELECT * FROM users WHERE name = ?");
            $select->bind_param("s", $name);
            $select->execute();
            $result = $select->get_result();
            
            if ($result->num_rows > 0) {
                echo "Uživatel již existuje.";
                exit();
            }
            
            if ($stmt->execute()) {

                $stmt = $connect->prepare("INSERT INTO users(name, password) VALUES(?, ?)");
                $stmt->bind_param("ss", $name, $psswdHash);

                echo "Registrace proběhla úspěšně!";
                //$_SESSION['']
                header("rozcestnik.html");
                exit();
            } 
            
            else {
                echo "Chyba při registraci. Uživatel může již existovat.";
            }
        }
        //header("Location: rozcestnik.html");
    ?>
</body>
</html>