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

    <table class="table" border="5">
            <tr>
                <th>obor</th>
                <th>počet</th>
            </tr>
    <?php
        $host = "localhost";
        $user = "root";
        $passwd = "";
        $db = "mydb";

        $connect = new mysqli($host, $user, $passwd, $db);
        if ($connect->connect_error) {
            die("Spojení se nezdařilo: " . $connect->connect_error);
        }
        $connect->set_charset("UTF8");
        
        $obory = array(
            "Technické lyceum", "Mechanik elektrotechnik",
            "Elektromechanik pro zařízení a přístroje", "Elektrikář",
            "Informační technologie", "Elektrotechnika",
            "Průmyslová ekologie", "Ekonomika a podnikání", 
            "Sociální činnost – Sociálněsprávní činnost"
        );
        
        

        foreach ($obory as $nazev_oboru) {
            $SQL = "SELECT COUNT(*) AS pocet FROM uchazec WHERE obor = '$nazev_oboru'";
            
            $result = mysqli_query($connect, $SQL);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$nazev_oboru."</td>";
                    echo "<td>".$row["pocet"]."</td>";
                    echo "</tr>";
                }
        }
    }



        $connect->close();
    ?>
    </center>
</body>
</html>
