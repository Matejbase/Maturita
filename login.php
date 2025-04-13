<?php
session_start();
require_once('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'], $_POST['password'])) {
    $name = trim($_POST['username']);
    $psswd = $_POST['password'];

    if (!preg_match("/^[a-z]+\.[a-z]+@purkynka\.cz$/", $name)) {
        echo "<span style='color: #ffffff; height: 60px;'>Uživatelské jméno musí být ve formátu prijmeni.jmeno@purkynka.cz.</span>";
        exit();
    }

    $stmt = $connect->prepare("SELECT id, password FROM user WHERE username=?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($psswd, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = $name;

        echo "Přihlášeno: " . $_SESSION['user'] . "<br />";
        //header("Location: singboard.html");
        exit();
    } 
    else {
        echo "Špatné jméno nebo heslo";
    }


    $result->free();
    $stmt->close();
}


$connect->close();
?>
