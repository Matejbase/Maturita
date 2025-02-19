<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Přihlášení</h1>
    <form class="inputs" method="POST">
        jmeno: <input name="jmeno"><br>
        Prijmeni: <input name="prijmeni"><br>
        Trida: <input name="trida"><br>
        <input type="submit" value="Přihlásit se">
    </form>
    
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
                header("rozcestnik.html");
                exit();
            } 

            else{
                echo "Chyba při zápisu.";
            }
        }
    
    else
    {
        echo "Všechna pole musí být vyplněna!";
        exit();
    }
}
    ?>
    <form>
    <input type="button">
    </form>
</body>
</html>