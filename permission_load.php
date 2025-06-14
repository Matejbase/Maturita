<?php
session_start();
require_once('database.php');

if (!isset($_SESSION['user_id'])) {
    echo '<div style="color:red; padding:1em; border:1px solid red; background:#fee;">';
    echo 'Nemáte oprávnění zobrazit tuto stránku.';
    echo '</div>';
    exit;
}

//echo "ID uživatele v session: " . $_SESSION['user_id'] . "<br>";

$user_id = $_SESSION['user_id']; 

// Načtení oprávnění z databáze
$stmt = $connect->prepare("SELECT permission FROM user WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($user) {
    if (!empty($user['permission'])) {
        
        $_SESSION['permissions'] = explode(",", $user['permission']);
        
    } 
    else {
        echo "Uživatel nemá žádná oprávnění.<br>";
    }
} 
else {
    die("Chyba při načítání oprávnění. Uživatel ID: $user_id nebyl nalezen.");
}

?>
