<?php
function generateCustomPassword($length) {
    // Možné znaky pro generované heslo
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $password = '';
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, strlen($characters) - 1)];
    }
    
    return $password;
}

$password = generateCustomPassword(8); 
//echo "Generované heslo: " . $password;
?>