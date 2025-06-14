<?php
$requiredPermission = ['admin'];
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    <meta charset="UTF-8">
    <title>Zápis</title>

</head>
<body>


    <nav>
        <ul>
            <!-- Bez omezení -->
            <li><a href="statistics.php">Statistika</a></li>
<<<<<<< HEAD

            <!-- Pro adminy i studenty -->
            <?php if (hasAnyPermission(['admin', 'student'])): ?>
                <li><a href="form_applicants.php">Formulář</a></li>
                <li><a href="exportPrint.php">Export</a></li>
            <?php endif; ?>

            <!-- Jen pro adminy -->
           <?php if (hasAnyPermission(['admin'])): ?>
                <li><a href="form_students.php">Přidat/Smazat studenta</a></li>
                <li><a href="fields.php">Obory</a></li>
            <?php endif; ?>

            <!-- Přihlášení / Odhlášení -->
=======
           
            
>>>>>>> 197841bc2d3b463cc5ebd9a11950d23af502aead
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="#" class="user">Uživatel: <?php echo htmlspecialchars($_SESSION['user']); ?></a></li>
                <li><a href="logout.php">Odhlásit se</a></li>
            <?php else: ?>
                <li><a href="login_form.php">Přihlášení</a></li>
            <?php endif; ?>
        </ul>
    </nav>



<div class="background-container">

    <div class="inputs">
        <form class="login-form" method="POST" action="students.php" target="responseFrame">
            
            <label for="username">Uživatelské jméno:</label>
            <input type="text" id="username" name="username" required>

            <label for="trida">Třída:</label>
            <input type="text" id="trida" name="class" required>

            <button type="submit">Zapsat</button>
            <iframe name="responseFrame" style="width: 100%; height: 40px; border: none;"></iframe>
        </form>
    </div>

    <div class="table-container">
        <form method="POST" action="delete_students.php" target="responseFrame">
        <button type="submit" class="delete-button">Smazat označené</button>
        
       
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Uživatelské jméno</th>
                    <th>Třída</th>
                    <th>Označit</th>
                </tr>
                <?php
                require_once('database.php');

                $stmt = $connect->prepare("SELECT id, username, class FROM user WHERE permission = 'student'");
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".htmlspecialchars($row["id"])."</td>";
                        echo "<td>".htmlspecialchars($row["username"])."</td>";
                        echo "<td>".htmlspecialchars($row["class"])."</td>";
                        echo "<td><input type='checkbox' name='delete_id[]' value='".$row["id"]."'></td>";
                        echo "</tr>";
                    }
                } 
                else {
                    echo "<tr><td colspan='3'>Žádný student není zapsaný.</td></tr>";
                }
                ?>
            </table>

        </form>
    </div>

</div>





</body>
</html>
    