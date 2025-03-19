<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistika uchazečů</title>
    <link rel="stylesheet" href="styles.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="bg-image">
        <nav>
            <ul>
                <li><a href="prihlaseni.html">Přihlášení</a></li>
                <li><a href="statistika.php">Statistika</a></li>
                <li><a href="formular_uchazec.php">Formulář</a></li>
                <li><a href="exportPrint.php">Export</a></li>
                <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
            </ul>
        </nav>
    </div>



    <h3 id="totalApplicants">Celkový počet uchazečů: <?php echo $total; ?></h3>
    <script src="Total.js"></script>


    <!-- Odkaz na náš JavaScript soubor -->
    <script src="Chart1.js"></script>
    <center>
        <h2>Počet uchazečů podle oboru</h2>
        <canvas id="myChart" width="400" height="400"></canvas>
    </center>

</body>
</html>
