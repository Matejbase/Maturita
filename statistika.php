<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistika uchazečů</title>
    <link rel="stylesheet" href="styles.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>


    <nav>
        <ul>
            <li><a href="prihlaseni.html">Přihlášení</a></li>
            <li><a href="statistika.php">Statistika</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
        </ul>
    </nav>

    <!-- Hlavní obsah -->
    <div class="background-container">
        <div class="stats-container">
            <h1 id="totalApplicants" style="color: #658DB2;">Celkový počet uchazečů: </h3>
            <h2 id="topObor" style="color: #658DB2;">Nejžádanější obor: </h2>

            <h2 style="color: #658DB2;">Počet uchazečů podle oboru</h2>
            <canvas id="ChartObory" style="color: #658DB2;"></canvas>

            <h1 style="color: #658DB2;">TOP 10 škol</h1>
            <canvas id="ChartSkoly" style="color: #658DB2;"></canvas>
        </div>
    </div>

    <!-- Skripty pro grafy -->
    <script src="Total.js"></script>
    <script src="ChartObory.js"></script>
    <script src="ChartSkoly.js"></script>

</body>
</html>
