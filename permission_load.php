<?php
session_start();
require_once('database.php');

if (!isset($_SESSION['user_id'])) {
    die("Nejste přihlášen.");
}

// Načtení oprávnění z databáze
$stmt = $connect->prepare("SELECT permissions FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $_SESSION['permissions'] = explode(",", $user['permissions']);
} else {
    die("Chyba při načítání oprávnění.");
}

$stmt->close();


?>
