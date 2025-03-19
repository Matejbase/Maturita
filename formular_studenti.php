

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
    <h1>Přihlášení na DOD</h1>
    <form class="inputs" method="POST" action="studenti.php" target="responseFrame">
        Uživatelské jmeno: <input name="jmeno"><br>
        Trida: <input name="trida"><br>
        <input type="submit" value="Zapsat">
    </form>

    <form class="inputs" method="POST" action="vypis_studentu.php" target="responseFrame">
        <input type="submit" value="vypsat oprávněné uživatele">
    </form>

    <iframe name="responseFrame" style="width: 100%; height: 200px; border: none;"></iframe>


</body>
</html>
    