fetch('statistika_data.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById("totalApplicants").textContent = 
                "Celkový počet uchazečů: " + data.total;
            })