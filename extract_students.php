<?php
require_once('database.php');

$SQL = "SELECT id, username, class FROM user where permission = 'student'";
$result = $connect->query($SQL);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>id</th><th>Uživatelské jméno</th><th>Třída</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>"; 
        echo "<td>" . $row["class"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} 
else {
    echo "Žádný student není zapsaný.";
}
?>
