<?php
$requiredPermission = 'student';
require_once('permission_load.php');
require_once('permission_check.php');
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="login.html">Přihlášení</a></li>
            <li><a href="statistics.php">Statistika</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
            <li><a href="logout.php">odhlásit se</a></li>
        </ul>
    </nav>


    <center>
    <h2>Náhled:</h2>

    <table class="table" border="5">
            <tr>
                <th>id uchazeče</th>
                <th>obor</th>
            </tr>
            <?php
            
            require_once('database.php');

            $SQL = "SELECT * FROM uchazec_obor";
            $result = $connect->query($SQL);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["uchazec_id"]."</td>";
                    echo "<td>".$row["obor_id"]."</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <form action="exportToExcel.php" method="post">   
        <input class="button-3" type="submit" name="export_excel" value="Exportovat"><br>
        </form> 
    </center>
</body>
</html>