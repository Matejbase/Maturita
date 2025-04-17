<?php
session_start();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    <meta charset="UTF-8">
    <title>Prihlášení</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="statistics.php">Statistika</a></li>
            <li><a href="form_applicants.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="form_students.php">Přidat/Smazat studenta</a></li>
                
            <?php if (isset($_SESSION['user'])): ?>
                <li>Uživatel: <?php echo htmlspecialchars($_SESSION['user']); ?></li> <!-- Zobrazíme uživatelské jméno -->
                <li><a href="logout.php">Odhlásit se</a></li>
            <?php else: ?>
                <li><a href="login_form.php">Přihlášení</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    

    <div class="background-container">
        <div class="login-container">
            <form class="login-form" action="login.php" method="POST" target="responseFrame">
                <label for="username">Uživatelské jméno:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Heslo:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Přihlásit se</button>
            </form>
            
            <div class="info">
                <p>Pro přístup k administraci se přihlaste svým uživatelským jménem a heslem.<br>Pokud nemáte účet, kontaktujte správce systému.</p>
            </div>

            <iframe name="responseFrame" style="width: 100%; height: 60px; border: none; margin-top: 20px;"></iframe>

        </div>
    </div>
