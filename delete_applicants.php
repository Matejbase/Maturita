<?php
$requiredPermission = ['admin', 'student'];
require_once('permission_load.php');
require_once('permission_check.php');
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_a_id'])) {
    $delete_a_id = $_POST['delete_a_id']; // např. [1, 2, 3]

    $placeholders = implode(',', array_fill(0, count($delete_a_id), '?'));
    $types = str_repeat('i', count($delete_a_id));


    // 1. Smazání z uchazec_obor
    $stmt = $connect->prepare("DELETE FROM uchazec_obor WHERE uchazec_id IN ($placeholders)");
    $stmt->bind_param($types, ...$delete_a_id);
    $stmt->execute();

    // 2. Smazání z uchazec
    $stmt = $connect->prepare("DELETE FROM uchazec WHERE id IN ($placeholders)");
    $stmt->bind_param($types, ...$delete_a_id);
    $stmt->execute();

  
    $stmt = $connect->prepare("DELETE FROM skola 
                                        WHERE id NOT IN (
                                            SELECT DISTINCT skola_id 
                                            FROM uchazec 
                                            WHERE skola_id IS NOT NULL
                                        )");
    $stmt->execute();

 

    //header('Location: form_applicants.php');
    exit();
    
} 
else {
    echo "Nebyli vybráni žádní uchazeči k odstranění.";
}
?>

