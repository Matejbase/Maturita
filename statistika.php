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

    <script src="Total.js"></script>
    <h3 id="totalApplicants">Celkový počet uchazečů: </h3>
    <h3 id="topObor">Nejžádanější obor: </h3>

        <h2>Počet uchazečů podle oboru</h2>
        <canvas id="ChartObory" width="400" height="400"></canvas>
        <script src="ChartObory.js"></script>

    

        <h2>TOP 10 škol</h2>
        <canvas id="ChartSkoly" width="400" height="400"></canvas>
        <script src="ChartSkoly.js"></script>
      

</body>
</html>
