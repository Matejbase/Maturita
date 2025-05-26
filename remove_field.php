<?php
$requiredPermission = ['admin'];
require_once('permission_load.php');
require_once('permission_check.php');
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    
    $ids = implode(',', array_fill(0, count($delete_id), '?'));
    $types = str_repeat('i', count($delete_id));

    $stmt = $connect->prepare("DELETE FROM obor WHERE id IN ($ids)");
    $stmt->bind_param($types, ...$delete_id);

    if ($stmt->execute()) {
        //header('Location: form_students.php'); // přesměrování zpět na seznam
        exit();
    } 
    else {
        echo "Chyba při mazání: " . $stmt->error;
    }
} 
else {
    echo "Nebyli vybráni žádní studenti k odstranění.";
}
?>
