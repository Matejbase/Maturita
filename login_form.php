<?php
session_start();

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
    <title>Prihlášení</title>
</head>
<body>
    

    <div class="background-container">
        <div class="login-container">
            <form class="login-form" action="login.php" method="POST">
                <label for="username">Uživatelské jméno:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Heslo:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Přihlásit se</button>
            </form>
            
            <div class="info">
                <p>Pro přístup k administraci se přihlaste svým uživatelským jménem a heslem.<br>Pokud nemáte účet, kontaktujte správce systému.</p>
            </div>

            

        </div>
    </div>
