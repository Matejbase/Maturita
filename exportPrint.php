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
    <title>Export - Náhled</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="login.html">Přihlášení</a></li>
            <li><a href="statistics.php">Statistika</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
        </ul>
    </nav>

<div class="background-container">
    <div class="table-container">
        <form class="button-export" action="exportToExcel.php" method="post">   
            <input type="submit" name="export_excel" value="Exportovat">
        </form> 

        <table class="table">
            <tr>
                <th>ID uchazeče</th>
                <th>ID školy</th>
                <th>ID oboru</th>
            </tr>
            <?php
            require_once('database.php');

            // Úprava SQL dotazu na vybrání ID uchazeče, školy a oboru
            $SQL = "
                SELECT uchazec.id AS uchazec_id, uchazec.skola_id, uchazec_obor.obor_id
                FROM uchazec
                LEFT JOIN uchazec_obor ON uchazec.id = uchazec_obor.uchazec_id
            ";

            $result = $connect->query($SQL);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["uchazec_id"]."</td>";  // Zobrazení ID uchazeče
                    echo "<td>".$row["skola_id"]."</td>";  // Zobrazení ID školy
                    echo "<td>".$row["obor_id"]."</td>";  // Zobrazení ID oboru
                    echo "</tr>";
                }
            }
            ?>
        </table>

        <!-- Informace o pomocných tabulkách -->
        <div class="info">
        <p><strong>Upozornění:</strong> V exportu budou zahrnuty také pomocné tabulky (např. školy a obory) s jejich ID. Tyto tabulky nejsou zobrazeny v náhledu, ale v exportu budou k dispozici pro lepší přehlednost.</p>
            <p>Například pro ID školy <strong>1</strong> se jedná o školu "Škola A" a pro ID oboru <strong>2</strong> to bude "Technické lyceum". V exportovaném souboru budou tyto názvy uvedeny, aby bylo možné ID správně interpretovat.</p>
        </div>


    </div>
</div>

</body>
</html>
