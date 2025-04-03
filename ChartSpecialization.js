fetch('statistics_data.php')
    .then(response => response.json())
    .then(data => {
       
        
        var labels = Object.keys(data.obory);
        var values = Object.values(data.obory);

        // Konfigurace grafu
        var ctx = document.getElementById('ChartSpecialization').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, 
                    datasets: [{
                        label: 'Počet uchazečů',
                        data: values, 
                        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'], 
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
                                    stepSize: 1, 
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
    })
  
