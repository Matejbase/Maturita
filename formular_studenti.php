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
            <li><a href="prihlaseni.html">Přihlášení</a></li>
            <li><a href="statistika.php">Statistika</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
        </ul>
    </nav>

    <div class="background-container">
        <form class="login-form" method="POST" action="studenti.php" target="responseFrame">
            <iframe name="responseFrame" style="width: 100%; height: 40px; border: none;"></iframe>
            
            <label for="jmeno">Uživatelské jméno:</label>
            <input type="text" id="jmeno" name="jmeno" required>

            <label for="trida">Třída:</label>
            <input type="text" id="trida" name="trida" required>

            <button type="submit" style="margin-bottom: 10px;">Zapsat</button>
        </form>
        
        <form class="button-form" method="POST" action="vypis_studentu.php" target="responseFrame">
            <button type="submit">Vypsat oprávněné uživatele</button>
        </form>
    </div>
</body>
</html>