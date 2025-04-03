
<?php
        require_once('database.php');
        
        
        $skola = trim($_POST['school']);  
        $obor = trim($_POST['specialization']);    
        $pohlavi = trim($_POST['sex']); 
        
        
        if (empty($skola) || empty($obor) || empty($pohlavi)) {
            echo "Neplatný vstup. Prosím zadejte všechny informace.<br>";
        } 
        else {
            
            $stmt = $connect->prepare("SELECT id FROM skola WHERE nazev = ?");
            $stmt->bind_param("s", $skola);
            $stmt->execute();
            $result = $stmt->get_result();

            
            if ($result->num_rows == 0) {
                $stmt = $connect->prepare("INSERT INTO skola (nazev) VALUES (?)");
                $stmt->bind_param("s", $skola);
                if (!$stmt->execute()) {
                    echo "Chyba při přidávání školy: " . $stmt->error . "<br>";
                    exit;
                }
                
                $skola_id = $connect->insert_id;
            }
             else {
                $row = $result->fetch_assoc();
                $skola_id = $row['id'];
            }

         
            $stmt = $connect->prepare("SELECT id FROM obor WHERE nazev = ?");
            $stmt->bind_param("s", $obor);
            $stmt->execute();
            $result = $stmt->get_result();

          
            if ($result->num_rows == 0) {
                echo "Obor s názvem '$obor' neexistuje v databázi.<br>";
                exit;
            } 
            else {
                
                $row = $result->fetch_assoc();
                $obor_id = $row['id'];
            }


            $stmt = $connect->prepare("INSERT INTO uchazec (pohlavi, skola_id) VALUES (?, ?)");
            $stmt->bind_param("si", $pohlavi, $skola_id);
            if (!$stmt->execute()) {
                echo "Chyba při přidávání uchazeče: " . $stmt->error . "<br>";
                exit;
            }
            
       
            $uchazec_id = $connect->insert_id;

           
            $stmt = $connect->prepare("INSERT INTO uchazec_obor (uchazec_id, obor_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $uchazec_id, $obor_id);
            if ($stmt->execute()) {
                echo "Data byla úspěšně uložena.<br>";
            } else {
                echo "Chyba při přiřazování oboru uchazeči: " . $stmt->error . "<br>";
            }
        }
       
        $connect->close();
    ?>
