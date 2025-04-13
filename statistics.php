<?php
session_start();
?>
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
            <li><a href="statistics.php">Statistika</a></li>
            <li><a href="formular_uchazec.php">Formulář</a></li>
            <li><a href="exportPrint.php">Export</a></li>
            <li><a href="formular_studenti.php">Přidat/Smazat studenta</a></li>
                
            <?php if (isset($_SESSION['user'])): ?>
                <li>Uživatel: <?php echo htmlspecialchars($_SESSION['user']); ?></li> <!-- Zobrazíme uživatelské jméno -->
                <li><a href="logout.php">Odhlásit se</a></li>
            <?php else: ?>
                <li><a href="login_form.php">Přihlášení</a></li>
            <?php endif; ?>
            </ul>
    </nav>

    
    <!-- Skripty pro grafy -->
    <script src="total.js"></script>
    <script src="ChartSpecialization.js"></script>
    <script src="ChartSchools.js"></script>
    <!-- Hlavní obsah -->
    <div class="background-container">
        <div class="stats-container">
            <h1 id="totalApplicants" style="color: #658DB2;">Celkový počet uchazečů: </h3>
            <h2 id="topSpecialization" style="color: #658DB2;">Nejžádanější obor: </h2>

            <h2 style="color: #658DB2;">Počet uchazečů podle oboru</h2>
            <canvas id="ChartSpecialization" style="color: #658DB2;"></canvas>

            <h1 style="color: #658DB2;">TOP 10 škol</h1>
            <canvas id="ChartSchools" style="color: #658DB2;"></canvas>
        </div>
    </div>


</body>
</html>