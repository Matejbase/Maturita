<?php
$requiredPermission = 'student';
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


    <nav>
        <ul>
            <li><a href="login.html">Přihlášení</a></li>
            <li><a href="statistics.php">Statistika</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
            <li><a href="logout.php">odhlásit se</a></li>
        </ul>
    </nav>


    <div class="form-container">

        <form class="form-form" action="entry.php" method="POST" target="responseFrame">
            <label for="skola">Z jaké školy jde:</label>
            <input id="skola" list="skoly" name="school">
            <datalist id="skoly"></datalist>
            <label for="obor">O jaký obor má zájem:</label>
            <input id="obor" list="obory" name="specialization">
            <datalist id="obory">
            <option value="Technické lyceum">
            <option value="Mechanik elektrotechnik">
            <option value="Elektromechanik pro zařízení a přístroje">
            <option value="Elektrikář">
            <option value="Informační technologie">
            <option value="Elektrotechnika">
            <option value="Průmyslová ekologie">
            <option value="Ekonomika a podnikání">
            <option value="Sociální činnost – Sociálněsprávní činnost">
            </datalist>
            <label>Pohlaví:</label>
            <input name="sex">
            <button type="submit" class="button-3" role="button" value="Zapsat">Uložit</button>
        </form>
        <iframe name="responseFrame" style="width: 100%; height: 40px; border: none;"></iframe>

        <script src="schools.js"></script>
    </div>
</body>
</html>