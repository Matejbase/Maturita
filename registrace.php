<?php
    session_start();
    $id_session = session_id();
    //echo "ID Session = $id_session<br />";
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
    <form method="POST" class="inputs" action="registrace.php">
        Jmémo: <input name="jmeno"><br>
        Heslo: <input name="heslo" type="password">
        <input type="submit" value="Zaregistrovat">
    </form>
</body>
</html>

    <?php
        require_once('database.php');
        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jmeno'], $_POST['heslo'])){
            $name = trim($_POST['jmeno']);
            $psswd = $_POST['heslo'];

            $psswd = iconv('UTF-8', 'UTF-16LE', $psswd);
            $psswdHash = hash('md4', $psswd);
            $psswdHash = strtoupper($psswdHash);
        
            //$stmt = $connect->prepare("INSERT INTO users(name, password) VALUES(?, ?)");
            //$stmt->bind_param("ss", $name, $psswdHash);

            $select = $connect->prepare("SELECT * FROM users WHERE name = ?");
            if (!$select) {
                echo "Chyba při přípravě dotazu: " . $connect->error;
                exit();
            }

            $select->bind_param("s", $name);
            $select->execute();
            $result = $select->get_result();
            
            if ($result->num_rows > 0) {
                echo "Uživatel již existuje.";
                $select->close();
                $connect->close();
                exit();
            }
            $select->close();

            
            $stmt = $connect->prepare("INSERT INTO users(name, password) VALUES(?, ?)");
            if (!$stmt) {
                echo "Chyba při přípravě dotazu: " . $connect->error;
                exit();
            }

            $stmt->bind_param("ss", $name, $psswdHash);

            if ($stmt->execute()) {
                echo "Registrace proběhla úspěšně!";
                //$_SESSION['']
                $stmt->close();
                $connect->close();
                header("Location: rozcestnik.html");
                exit();
            } 
            
            else {
                echo "Chyba při registraci. Uživatel může již existovat.";
            }

            $stmt->close();

        }
        $connect->close();
        //header("Location: rozcestnik.html");
    ?>