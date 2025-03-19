<?php
require_once('database.php');


$data = array();

header('Content-Type: application/json');

$obory = array(
    "Technické lyceum", "Mechanik elektrotechnik", "Elektromechanik pro zařízení a přístroje",
    "Elektrikář", "Informační technologie", "Elektrotechnika", "Průmyslová ekologie",
    "Ekonomika a podnikání", "Sociální činnost – Sociálněsprávní činnost"
);

// Dotaz pro každý obor a získání počtu uchazečů
foreach ($obory as $nazev_oboru) {
    $stmt = $connect->prepare("SELECT COUNT(*) AS pocet FROM uchazec WHERE obor = ?");
    $stmt->bind_param("s", $nazev_oboru);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $data['obory'][$nazev_oboru] = $row['pocet'];
    $stmt->close();
}


//uchazeci celkově
    $stmt = $connect->prepare("SELECT COUNT(*) AS pocet_cel FROM uchazec");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $data['total'] = $row['pocet_cel']; 
    $stmt->close();



//top 10 škol - udělat






// Přenos dat do JavaScriptu ve formátu JSON
echo json_encode($data);
?>
