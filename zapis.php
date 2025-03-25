<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                echo "<span style='color: #ffffff;'>Data pro tabulku 'uchazec' byla úspěšně uložena.";
            } 
            else {
                echo "<span style='color:rgb(255, 0, 0);'>Chyba při ukládání dat do tabulky 'uchazec': " . $stmt->error;
            }
        }
       
        $connect->close();
    ?>
</body>
</html>
