<?php
require_once('database.php');

$SQL = "SELECT * FROM students";
$result = $connect->query($SQL);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Jméno</th><th>Příjmení</th><th>Třída</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>"; 
        echo "<td>" . $row["class"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} 
else {
    echo "Žádný student není zapsaný.";
}
?>
