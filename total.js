fetch('statistics_data.php')
    .then(response => response.json())
    .then(data => {

        if (data.total !== undefined && data.obor !== undefined) {
            document.getElementById("totalApplicants").innerHTML = 
                "Celkový počet uchazečů: <span style='color: #FAB400;'>" + data.total + "</span>";

            document.getElementById("topSpecialization").innerHTML = 
                "Nejžádanější obor: <span style='color: #FAB400;'>" + data.obor + "</span>";
        } 
        else {
            console.error('Chybí požadovaná data.');
        }
    })
    .catch(error => console.error('Chyba při načítání dat:', error));
