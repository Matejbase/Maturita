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
            <li><a href="prihlaseni.html">Přihlášení</a></li>
            <li><a href="statistika.php">Statistika</a></li>
            <li><a href="vypis.php">Počet uchazečů o obor</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportToExcel.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
        </ul>
    </nav>


    <center>
    <h2>Náhled:</h2>

    <table class="table" border="5">
            <tr>
                <th>id uchazeče</th>
                <th>škola</th>
                <th>obor</th>
            </tr>
            <?php
            
            require_once('database.php');

            $SQL = "SELECT * FROM uchazec";
            $result = $connect->query($SQL);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["iduchazec"]."</td>";
                    echo "<td>".$row["skola"]."</td>";
                    echo "<td>".$row["obor"]."</td>";
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