<?php
//session_start();

function hasPermission($permission) {
    return isset($_SESSION['permissions']) && in_array($permission, $_SESSION['permissions']);
}

// Zkontroluj, zda je definováno požadované oprávnění
if (isset($requiredPermission) && !hasPermission($requiredPermission)) {
    //header("Location: no-access.php"); // Přesměrování na stránku s chybou
    echo"nemáte oprávnění.";
    exit;
}
?>
