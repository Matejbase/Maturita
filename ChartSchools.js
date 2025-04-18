fetch('statistics_data.php')
    .then(response => response.json())
    .then(data => {
        const labels = Object.keys(data.skoly);
        const values = Object.values(data.skoly);

        // Generování barev pro jednotlivé sloupce
        const colors = labels.map((_, i) => {
            const baseColors = [
                'rgba(255, 99, 99, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 230, 86, 0.5)',
                'rgba(75, 192, 91, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 64, 239, 0.5)'
            ];
            return baseColors[i % baseColors.length];
        });

        const ctx = document.getElementById('ChartSchools').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Počet uchazečů',
                    data: values,
                    backgroundColor: colors,
                    borderColor: colors.map(c => c.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Skrytí legendy v grafu
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        display: false // Skrytí popisků na ose X
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: value => Number.isInteger(value) ? value : null
                        }
                    }
                }
            }
        });

        // Vytvoření vlastní legendy
        const legendContainer = document.getElementById('schoolsLegend');
        labels.forEach((label, index) => {
            const legendItem = document.createElement('div');
            legendItem.className = 'legend-item';

            const colorBox = document.createElement('div');
            colorBox.className = 'legend-color';
            colorBox.style.backgroundColor = colors[index];

            const text = document.createTextNode(label);

            legendItem.appendChild(colorBox);
            legendItem.appendChild(text);
            legendContainer.appendChild(legendItem);
        });
    });
