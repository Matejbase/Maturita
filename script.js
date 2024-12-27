window.onload = function() {
    // select data list with id 'skoly'
    var skoly = document.getElementById('skoly')
    // insert sample options
    // load json data from local json file
    fetch('adresar_JMK_20102023.json')
        .then(response => response.json())
        .then(data => {
            // iterate through the data and create options
            data["JMK_20102023"].forEach(item => {
                var option = document.createElement('option')
                option.value = item["Plný název"]
                skoly.appendChild(option)
            })
        })
        .catch(error => {
            console.error('Error:', error)
        })
}