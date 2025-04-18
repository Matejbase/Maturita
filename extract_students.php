<?php
require_once('database.php');

$stmt = $connect->prepare("SELECT id, username, class FROM user WHERE permission = 'student'");
$stmt->execute();
$result = $stmt->get_result();

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
