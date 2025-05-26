<?php
$requiredPermission = ['admin'];
require_once('permission_load.php');
require_once('permission_check.php');
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {

    $nazev = $_POST['name'];

    $stmt = $connect->prepare("INSERT INTO obor (nazev) VALUES(?)");
    $stmt->bind_param("s", $nazev);

        if ($stmt->execute()) {
            echo "Zapsání oboru " . $nazev . " proběhlo úspěšně.";
            exit();
        } 
        
        else {
            echo "Chyba při zápisu: " . $stmt->error;
        }
    
} 

else {
    echo "Chyba při zápisu.";
}


?>