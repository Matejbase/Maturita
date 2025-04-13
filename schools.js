
var skoly = document.getElementById('skoly');
fetch('adresar_JMK_20102023.json')
    .then(response => response.json())
    .then(data => {
        
        data["JMK_20102023"].forEach(item => {
            var option = document.createElement('option');
            option.value = item["Plný název"];
            skoly.appendChild(option);
        })
    })
    .catch(error => {
        console.error('Error:', error);
    });
