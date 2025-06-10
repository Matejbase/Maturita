<?php
$requiredPermission = ['admin', 'student'];
require_once('permission_load.php');
require_once('permission_check.php');
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    
    <meta charset="UTF-8">
    <title>Export</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="statistics.php">Statistika</a></li>
            <li><a href="form_applicants.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="form_students.php">Přidat/Smazat studenta</a></li>
            <li><a href="fields.php">Obory</a></li>
                
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="#" class="user">Uživatel: <?php echo htmlspecialchars($_SESSION['user']); ?></a></li>
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
        <form method="POST" action="delete_applicants.php" target="responseFrame">
        <button type="submit" class="delete-button">Smazat označené</button>
            <table class="table">
                <tr>
                    <th>ID uchazeče</th>
                    <th>Škola</th>
                    <th>Obor</th>
                    <th>Označit</th>
                </tr>
                <?php
                require_once('database.php');

                $stmt = $connect->prepare("SELECT DISTINCT uchazec.id AS uchazec_id, skola.nazev AS skola_nazev, obor.nazev AS obor_nazev
                                            FROM uchazec
                                            LEFT JOIN skola ON uchazec.skola_id = skola.id
                                            LEFT JOIN uchazec_obor ON uchazec.id = uchazec_obor.uchazec_id
                                            LEFT JOIN obor ON uchazec_obor.obor_id = obor.id
                                            ORDER BY uchazec.id DESC");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["uchazec_id"]."</td>";  
                        echo "<td>".$row["skola_nazev"]."</td>";  
                        echo "<td>".$row["obor_nazev"]."</td>";
                        echo "<td><input type='checkbox' name='delete_a_id[]' value='".$row["uchazec_id"]."'></td>";  
                        echo "</tr>";
                    }
                }
                else {
                    echo "<tr><td colspan='3'>Žádný uchazeč není zapsaný.</td></tr>";
                }
                ?>
            </table>
        </form>
    </div>
</div>

</body>
</html>
