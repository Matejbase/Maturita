<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Počet uchazečů</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="prihlaseni.html">Přihlášení</a></li>
            <li><a href="statistika.php">Statistika</a></li>
            <li><a href="vypis.php">Počet uchazečů o obor</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportToExcel.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
        </ul>
    </nav>


    <center>
        <table class="table" border="5">
                <tr>
                    <th>obor</th>
                    <th>počet</th>
                </tr>



        <?php
            require_once('database.php');

            
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
