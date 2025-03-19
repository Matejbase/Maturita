// Vybere HTML element s id 'skoly'
var skoly = document.getElementById('skoly');

// Načteme JSON data z externího souboru 'adresar_JMK_20102023.json'
fetch('adresar_JMK_20102023.json')
    // Pokud je odpověď úspěšná, převede ji na JSON objekt
    .then(response => response.json())
    // Jakmile máme JSON data, iterujeme přes každou položku v poli 'JMK_20102023'
    .then(data => {
        // Iteruje přes každý záznam ve 'JMK_20102023' (jednotlivé školy)
        data["JMK_20102023"].forEach(item => {
            // Vytvoří novou možnost (option) pro seznam
            var option = document.createElement('option');
            
            // Nastaví hodnotu této možnosti na název školy z dat
            option.value = item["Plný název"];
            
            // Přidá tuto novou možnost do <select> elementu s id 'skoly'
            skoly.appendChild(option);
        })
    })
    // Pokud dojde k chybě při načítání souboru nebo zpracování, vypíše se chyba do konzole
    .catch(error => {
        console.error('Error:', error);
    });
