<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Přihlášení</h1>
    <form class="inputs" method="GET">
        jmeno: <input name="jmeno"><br>
        Prijmeni: <input name="prijmeni"><br>
        Trida: <input name="trida"><br>
        <input type="submit" value="Přihlásit se">
    </form>
    <input type="button" value="Zobrazit zapsané studenty" onclick="">
    <?php

        require_once('database.php');

        $name = $_GET['jmeno'];
        $lastname = $_GET['prijmeni'];
        $class = $_GET['trida'];

        $select = $connect->prepare("SELECT * FROM students WHERE name = ? AND lastname = ?");
        $select->bind_param("ss", $name, $lastname);
        $select->execute();
        $result = $select->get_result();

        if ($result->num_rows > 0) {
            echo "Tento student je už zapsaný.";
            exit();
        }

        if ($stmt->execute()) {

            $stmt = $connect->prepare("INSERT INTO students(name, lastname, class) VALUES(?, ?, ?)");
            $stmt->bind_param("ss", $name, $lastname, $class);

            echo "Zapsání proběhlo úspěšně.";
            //$_SESSION['']
            header("rozcestnik.html");
            exit();
        } 

    ?>
</body>
</html>