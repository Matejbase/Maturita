<?php
$requiredPermission = ['admin', 'student'];
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
            <li><a href="statistics.php">Statistika</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
                
            <?php if (isset($_SESSION['user'])): ?>
                <li>Uživatel: <?php echo htmlspecialchars($_SESSION['user']); ?></li> <!-- Zobrazíme uživatelské jméno -->
                <li><a href="logout.php">Odhlásit se</a></li>
            <?php else: ?>
                <li><a href="login_form.php">Přihlášení</a></li>
            <?php endif; ?>
        </ul>
    </nav>

<div class="background-container">
    <div class="table-container">
        <form class="button-export" action="exportToExcel.php" method="post" target="responseFrame">   
            <input type="submit" name="export_excel" value="Exportovat">
        </form> 
        <iframe name="responseFrame" style="width: 100%; height: 60px; border: none;"></iframe>
        <table class="table">
            <tr>
                <th>ID uchazeče</th>
                <th>Školy</th>
                <th>Oboru</th>
            </tr>
            <?php
            require_once('database.php');

           
            $stmt = $connect->prepare("SELECT uchazec.id AS uchazec_id, skola.nazev AS skola_nazev, obor.nazev AS obor_nazev
                                        FROM uchazec
                                        LEFT JOIN skola ON uchazec.skola_id = skola.id
                                        LEFT JOIN uchazec_obor ON uchazec.id = uchazec_obor.uchazec_id
                                        LEFT JOIN obor ON uchazec_obor.obor_id = obor.id
                                        ORDER BY uchazec.id DESC");
            $stmt->execute();
            $result = $stmt->get_result();

      
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["uchazec_id"]."</td>";  
                    echo "<td>".$row["skola_nazev"]."</td>";  
                    echo "<td>".$row["obor_nazev"]."</td>";  
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
