<?php
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['jmeno']) && !empty($_POST['trida'])) {

        $name = trim($_POST['jmeno']);
        //$lastname = trim($_POST['prijmeni']);
        $class = trim($_POST['trida']);

        // Kontrola formátu uživatelského jména (email)
        if (!preg_match("/^[a-z]+\.[a-z]+@purkynka\.cz$/", $name)) {
            echo "<span style='color: #ffffff;'>Uživatelské jméno musí být ve formátu prijmeni.jmeno@purkynka.cz.";
            exit();
        }

        // Kontrola, zda uživatelské jméno již existuje
        $select = $connect->prepare("SELECT * FROM users WHERE username = ?");
        $select->bind_param("s", $name);
        $select->execute();
        $result = $select->get_result();

        if ($result->num_rows > 0) {
            echo "Tento student je už zapsaný.";
            exit();
        }

       
        require_once('generate_paswd.php');
        $passwordHash = password_hash($password, PASSWORD_BCRYPT); 

       
        $passwordCheck = $connect->prepare("SELECT id FROM users WHERE password = ?");
        $passwordCheck->bind_param("s", $passwordHash);
        $passwordCheck->execute();
        $passwordResult = $passwordCheck->get_result();

        
        while ($passwordResult->num_rows > 0) {
            
            $password = generateCustomPassword(8);
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $passwordCheck->execute();
            $passwordResult = $passwordCheck->get_result();
        }

        
        $stmt = $connect->prepare("INSERT INTO users(username, class, password, permission) VALUES(?, ?, ?, 'student')");
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
