<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <div class="topnav">
        <a href="rozcestnik.html">Menu</a> 
    </div>
    
    <?php
        require_once('database.php');
        
        $skola = $_GET['skola'];
        $obor = $_GET['obor'];
        
        
        if (empty($skola) || empty($obor)) {
            echo "Neplatný vstup";
        } 
        
        else {
            $stmt = $connect->prepare("INSERT INTO uchazec (skola, obor) VALUES (?, ?)");
            $stmt->bind_param("ss", $skola, $obor);
            
            if ($stmt->execute()) {
                echo "Data pro tabulku 'uchazec' byla úspěšně uložena.<br>";
            } 
            else {
                echo "Chyba při ukládání dat do tabulky 'uchazec': " . $stmt->error . "<br>";
            }
        }
       
        
        
        $connect->close();
    ?>
    </center>
</body>
</html>
