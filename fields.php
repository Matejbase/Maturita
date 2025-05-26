<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat obor</title>
</head>
<body>
    <div class="background-container">

    <div class="inputs">
        <form class="login-form" method="POST" action="add_field.php" target="responseFrame">
            

            <label for="naze">Název oboru:</label>
            <input type="text" id="trida" name="name" required>

            <button type="submit">Zapsat</button>
            <iframe name="responseFrame" style="width: 100%; height: 40px; border: none;"></iframe>
        </form>
    </div>

    
</div>
    <div class="table-container">
        <form method="POST" action="remove_field.php" target="responseFrame">
        <button type="submit" class="delete-button">Smazat označené</button>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Název oboru</th>
                </tr>
                <?php
                require_once('database.php');

                $stmt = $connect->prepare("SELECT * FROM obor");
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".htmlspecialchars($row["id"])."</td>";
                        echo "<td>".htmlspecialchars($row["nazev"])."</td>";  
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

</body>
</html>