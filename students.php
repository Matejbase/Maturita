<?php
require_once('database.php');
require_once('generate_paswd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['class'])) {

        $name = trim($_POST['username']);
        $class = trim($_POST['class']);

        if (!preg_match("/^[a-z]+\.[a-z]+@purkynka\.cz$/", $name)) {
            echo "Uživatelské jméno musí být ve formátu prijmeni.jmeno@purkynka.cz.";
            exit();
        }

        $select = $connect->prepare("SELECT * FROM user WHERE username = ?");
        $select->bind_param("s", $name);
        $select->execute();
        $result = $select->get_result();

        if ($result->num_rows > 0) {
            echo "Tento student je už zapsaný.";
            exit();
        }

        // Generuj heslo
        $password = generatePassword(8);
        $passwordHash = password_hash($password, PASSWORD_BCRYPT); 

        // Zkontroluj unikátnost hashe
        $passwordCheck = $connect->prepare("SELECT id FROM user WHERE password = ?");
        $passwordCheck->bind_param("s", $passwordHash);
        $passwordCheck->execute();
        $passwordResult = $passwordCheck->get_result();

        while ($passwordResult->num_rows > 0) {
            $password = generatePassword(8);
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $passwordCheck->execute();
            $passwordResult = $passwordCheck->get_result();
        }

        // Ulož do databáze
        $stmt = $connect->prepare("INSERT INTO user(username, class, password, permission) VALUES(?, ?, ?, 'student')");
        $stmt->bind_param("sss", $name, $class, $passwordHash);

        if ($stmt->execute()) {
            echo "Zapsání studenta " . $name . "s heslem: " . $password. "  proběhlo úspěšně.";

            // Odeslání e-mailu
            $to = "spravce@skola.cz"; // změň na cílový e-mail administrátora
            $subject = "Nový student zapsán";
            $message = "Byl úspěšně zapsán nový student.\n\n"
                     . "Uživatelské jméno: $name\n"
                     . "Třída: $class\n"
                     . "Heslo: $password\n";
            $headers = "From: noreply@purkynka.cz";

            if (mail($to, $subject, $message, $headers)) {
                echo " E-mail s informacemi byl odeslán.";
            } else {
                echo " Nepodařilo se odeslat e-mail.";
            }

            exit();
        } else {
            echo "Chyba při zápisu: " . $stmt->error;
        }

    } else {
        echo "Všechna pole musí být vyplněna!";
        exit();
    }
}
?>
