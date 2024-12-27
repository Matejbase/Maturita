<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="topnav">
        <a href="rozcestnik.html">Menu</a> 
    </div>
    <center>
    <h2>Náhled:</h2>

    <table class="table" border="5">
            <tr>
                <th>id uchazeče</th>
                <th>škola</th>
                <th>obor</th>
            </tr>
            <?php
            $host = "localhost";
            $user = "root";
            $passwd = "";
            $db = "mydb";

            $connect = new mysqli($host, $user, $passwd, $db) or die("Spojení se nezdařilo");
            $connect->set_charset("UTF8") or die("Kódování NEnastaveno");

            
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