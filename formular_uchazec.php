<?php
$requiredPermission = ['student', 'admin'];
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    
    <meta charset="UTF-8">
    <title>Formulář</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="statistics.php">Statistika</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
                
            <?php if (isset($_SESSION['user'])): ?>
                <li>Uživatel: <?php echo htmlspecialchars($_SESSION['user']); ?></li> <!-- Zobrazíme uživatelské jméno -->
                <li><a href="logout.php">Odhlásit se</a></li>
            <?php else: ?>
                <li><a href="login_form.php">Přihlášení</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="background-container">
        <form class="login-form" action="entry.php" method="POST" target="responseFrame">
            <iframe name="responseFrame" style="width: 100%; height: 40px; border: none;"></iframe>
            
            <label for="skola">Z jaké školy jde:</label>
            <input id="skola" list="skoly" name="school">
            <datalist id="skoly"></datalist>

            <p style="color: #ffffff;">O jaký obor má zájem:</p>

            <!-- Ujistíme se, že checkboxy mají správný name atribut -->
            <label><input type="checkbox" name="specialization[]" value="Technické lyceum"> Technické lyceum</label><br>
            <label><input type="checkbox" name="specialization[]" value="Mechanik elektrotechnik"> Mechanik elektrotechnik</label><br>
            <label><input type="checkbox" name="specialization[]" value="Elektromechanik pro zařízení a přístroje"> Elektromechanik pro zařízení a přístroje</label><br>
            <label><input type="checkbox" name="specialization[]" value="Elektrikář"> Elektrikář</label><br>
            <label><input type="checkbox" name="specialization[]" value="Informační technologie"> Informační technologie</label><br>
            <label><input type="checkbox" name="specialization[]" value="Elektrotechnika"> Elektrotechnika</label><br>
            <label><input type="checkbox" name="specialization[]" value="Průmyslová ekologie"> Průmyslová ekologie</label><br>
            <label><input type="checkbox" name="specialization[]" value="Ekonomika a podnikání"> Ekonomika a podnikání</label><br>
            <label><input type="checkbox" name="specialization[]" value="Sociální činnost – Sociálněsprávní činnost"> Sociální činnost – Sociálněsprávní činnost</label><br>

            <p style="color: #ffffff;">Pohlaví:</p>
            <label><input type="radio" name="sex" value="Muž">Muž</label><br>
            <label><input type="radio" name="sex" value="Žena">Žena</label><br>
            <label><input type="radio" name="sex" value="Jiné">Jiné</label><br>
            <button type="submit">Uložit</button>
        </form>
    </div>

    <script src="schools.js"></script>
</body>
</html>