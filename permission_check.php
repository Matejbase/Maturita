<?php
// session_start(); 

function hasAnyPermission($requiredPermissions) {
    if (!isset($_SESSION['permissions'])) {
        return false;
    }

    foreach ($requiredPermissions as $perm) {
        if (in_array($perm, $_SESSION['permissions'])) {
            return true;
        }
    }

    return false;
}

// kontrola oprávnění
if (isset($requiredPermission) && !hasAnyPermission($requiredPermission)) {
    //header("Location: no-access.php"); // Přesměrování na stránku s chybou
    echo "Nemáte oprávnění k přístupu na tuto stránku.";
    exit;
}
?>
