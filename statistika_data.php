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

// Uchazeči celkově
$stmt = $connect->prepare("SELECT COUNT(*) AS pocet_cel FROM uchazec");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$data['total'] = $row['pocet_cel'];
$stmt->close();

// TOP 10 škol
$stmt = $connect->prepare("SELECT skola, COUNT(*) AS pocet_uchazecu 
                                        FROM uchazec 
                                        GROUP BY skola 
                                        ORDER BY pocet_uchazecu DESC 
                                        LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
$data['skoly'] = array();

while ($row = $result->fetch_assoc()) {
    $data['skoly'][$row['skola']] = $row['pocet_uchazecu'];
}
$stmt->close();

// Top obor
$stmt = $connect->prepare("SELECT obor, COUNT(*) AS pocet
                            FROM uchazec
                            GROUP BY obor
                            ORDER BY pocet DESC
                            LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$data['obor'] = $row['obor'];  
$stmt->close();


// Přenos dat do JavaScriptu ve formátu JSON
echo json_encode($data);
?>
