<?php
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['class'])) {

        $name = trim($_POST['username']);
        //$lastname = trim($_POST['prijmeni']);
        $class = trim($_POST['class']);

        // Kontrola formátu uživatelského jména (email)
        if (!preg_match("/^[a-z]+\.[a-z]+@purkynka\.cz$/", $name)) {
            echo "Uživatelské jméno musí být ve formátu prijmeni.jmeno@purkynka.cz.";
            exit();
        }

        // Kontrola, zda uživatelské jméno již existuje
        $select = $connect->prepare("SELECT * FROM user WHERE username = ?");
        $select->bind_param("s", $name);
        $select->execute();
        $result = $select->get_result();

        if ($result->num_rows > 0) {
            echo "Tento student je už zapsaný.";
            exit();
        }

       
        require_once('generate_paswd.php');
        $passwordHash = password_hash($password, PASSWORD_BCRYPT); 

       
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

        
        $stmt = $connect->prepare("INSERT INTO user(username, class, password, permission) VALUES(?, ?, ?, 'student')");
        $stmt->bind_param("sss", $name, $class, $passwordHash);

        if ($stmt->execute()) {
            echo "Zapsání studenta " . $name . " s heslem " . $password . " proběhlo úspěšně.";
            exit();
        } 
        
        else {
            echo "Chyba při zápisu: " . $stmt->error;
        }

    } 
    else {
        echo "Všechna pole musí být vyplněna!";
        exit();
    }
}

?>
