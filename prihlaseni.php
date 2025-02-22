<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    <meta charset="UTF-8">
    <title>Prihlášení</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="rozcestnik.html">Rozcestník</a></li>
            <li><a href="#">Přihlášení</a></li>
            <li><a href="#">Statistika</a></li>
            <li><a href="#">Počet uchazečů o obor</a></li>
            <li><a href="#">Formulář</a></li>
            <li><a href="#">Export</a></li>
        </ul>
    </nav>
    <div class="login-container">
        <form class="login-form" action="prihlaseni.php" method="POST">
            <label for="username">Uživatelské jméno:</label>
            <input type="text" id="username" name="jmeno" required>
            <label for="password">Heslo:</label>
            <input type="password" id="password" name="heslo" required>
            <button type="submit">Přihlásit se</button>
        </form>
    </div>
    <?php

    session_start();
    $id_session = session_id();
    //echo "ID session = $id_session<br />";

        require_once('database.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jmeno'], $_POST['heslo'])) {
            $name = trim($_POST['jmeno']);
            $psswd = $_POST['heslo'];
            
            $psswd = iconv('UTF-8', 'UTF-16LE', $psswd);
            $psswdHash = hash('md4', $psswd);
            $psswdHash = strtoupper($psswdHash);

            //echo $name." ".$psswdHash;
            
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
