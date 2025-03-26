fetch('statistika_data.php')
    .then(response => response.json())
    .then(data => {

        if (data.total !== undefined && data.obor !== undefined) {
            document.getElementById("totalApplicants").textContent = 
                "Celkový počet uchazečů: " + data.total;

            document.getElementById("topObor").textContent = 
                "Nejžádanější obor: " + data.obor;
        } 
        else {
            console.error('Chybí požadovaná data.');
        }
    })
    .catch(error => console.error('Chyba při načítání dat:', error));
