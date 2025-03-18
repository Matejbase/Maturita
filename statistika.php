<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    <meta charset="UTF-8">
    <title>Statistika</title>

    <!-- Zahrnutí Chart.js knihovny -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body>
    <div class="bg-image">
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
    </div>
    <center>
        <h2>Počet uchazečů podle oboru</h2>

        <!-- Div pro zobrazení grafu -->
        <canvas id="myChart" width="400" height="400"></canvas>

        <?php
        // Příprava dat (můžete zde načítat data z databáze)
        require_once('statistika_data.php')
        ?>

        <script>
            // Přenos PHP dat do JavaScriptu
            
            var labels = <?php echo json_encode(array_keys($data)); ?>;
            var values = <?php echo json_encode(array_values($data)); ?>;

            // Vytvoření grafu pomocí Chart.js
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar', // Typ grafu: koláčový graf
                data: {
                    labels: labels, // Popisky pro jednotlivé části (obory)
                    datasets: [{
                        label: 'Počet uchazečů',
                        data: values, // Počet uchazečů pro každý obor
                        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'], // Barvy pro jednotlivé části
                        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'], // Barva okraje
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false, // Graf se přizpůsobí velikosti obrazovky
                        position: 'top', // Pozice legendy (může být 'top', 'left', 'bottom', 'right')
                        scales: {
                            y: {
                                beginAtZero: true, // Osa Y začíná od nuly
                                ticks: {
                                    stepSize: 1, // Nastaví krok osy Y na 1 (pouze celá čísla)
                                    callback: function(value) {
                                        if (Number.isInteger(value)) {
                                            return value; // Zobrazí pouze celá čísla
                                        }
                                        return null; // Skryje desetinná čísla
                                    }
                                }
                            }
                        }
                    
                }
            });
        </script>
    </center>
</body>
</html>
