

<?php
        require_once('database.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['jmeno']) && !empty($_POST['prijmeni']) && !empty($_POST['trida'])) {

            $name = $_POST['jmeno'];
            $lastname = $_POST['prijmeni'];
            $class = $_POST['trida'];

            $select = $connect->prepare("SELECT * FROM students WHERE name = ? AND lastname = ?");
            $select->bind_param("ss", $name, $lastname);
            $select->execute();
            $result = $select->get_result();

            if ($result->num_rows > 0) {
                echo "Tento student je už zapsaný.";
                exit();
            }

            $stmt = $connect->prepare("INSERT INTO students(name, lastname, class) VALUES(?, ?, ?)");
            $stmt->bind_param("sss", $name, $lastname, $class);

            if ($stmt->execute()) {
                echo "Zapsání proběhlo úspěšně.";
                //$_SESSION['']
                //header("Location:formular_studenti.html");
                exit();
            } 

            else{
                echo "Chyba při zápisu." . $stmt->error;;
            }
        }
    
    else
    {
        echo "Všechna pole musí být vyplněna!";
        exit();
    }
}
    ?>
    


