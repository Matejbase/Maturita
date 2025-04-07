<?php
$requiredPermission = 'admin';
require_once('permission_load.php');
require_once('permission_check.php');
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    <meta charset="UTF-8">
    <title>Formulář</title>

</head>
<body>

<div class="bg-image">
        <nav>
            <ul>
                <li><a href="login.html">Přihlášení</a></li>
                <li><a href="statistics.php">Statistika</a></li>
                <li><a href="formular_uchazec.php">Formulář</a></li>
                <li><a href="exportPrint.php">Export</a></li>
                <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
            </ul>
        </nav>
    </div>

    <h1>Přihlášení na DOD</h1>
    <form class="inputs" method="POST" action="students.php" target="responseFrame">
        Uživatelské jmeno: <input name="username"><br>
        Trida: <input name="class"><br>
        <input type="submit" value="Zapsat">
    </form>
    <iframe name="responseFrame" style="width: 100%; height: 200px; border: none;"></iframe>

    <div class="table_students">
    <?php
    
        require_once('extract_students.php');
    
    ?>

   </div>
</body>
</html>
    