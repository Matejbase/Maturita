<?php
session_start();
$id_session = session_id();
//echo "ID session = $id_session<br />";

    require_once('database.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jmeno'], $_POST['heslo'])) {
        $name = trim($_POST['jmeno']);
        $psswd = $_POST['heslo'];
        
        if (!preg_match("/^[a-z]+\.[a-z]+@purkynka\.cz$/", $name)) {
            echo "<span style='color: #ffffff; height: 60px;'>Uživatelské jméno musí být ve formátu prijmeni.jmeno@purkynka.cz.";
            exit();
        }
        
        $psswdHash = password_hash($password, PASSWORD_BCRYPT);

        //echo $name." ".$psswdHash;
        
        $stmt = $connect->prepare("SELECT id FROM users Where name=? AND password=?");
        $stmt->bind_param("ss", $name, $psswdHash);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    
        
        if ($result->num_rows > 0) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = $name;

            require_once('permission_load.php');

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


