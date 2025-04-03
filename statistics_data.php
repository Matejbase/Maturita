<?php
require_once('database.php');

$data = array();

header('Content-Type: application/json');

// Seznam oborů
$obory = array(
    "Technické lyceum", "Mechanik elektrotechnik", "Elektromechanik pro zařízení a přístroje",
    "Elektrikář", "Informační technologie", "Elektrotechnika", "Průmyslová ekologie",
    "Ekonomika a podnikání", "Sociální činnost – Sociálněsprávní činnost"
);

// Dotaz pro každý obor a získání počtu uchazečů
foreach ($obory as $nazev_oboru) {
    $stmt = $connect->prepare("SELECT COUNT(*) AS pocet 
                                        FROM uchazec_obor 
                                        JOIN obor ON uchazec_obor.obor_id = obor.id 
                                        WHERE obor.nazev = ?
                                    ");
    $stmt->bind_param("s", $nazev_oboru);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $data['obory'][$nazev_oboru] = $row['pocet'];
    $stmt->close();
};



// Celkový počet uchazečů
$stmt = $connect->prepare("SELECT COUNT(*) AS pocet_cel FROM uchazec");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$data['total'] = $row['pocet_cel'];
$stmt->close();



// TOP 10 škol podle počtu uchazečů
$stmt = $connect->prepare("SELECT skola.nazev AS skola, COUNT(*) AS pocet_uchazecu 
                                    FROM uchazec 
                                    JOIN skola ON uchazec.skola_id = skola.id 
                                    GROUP BY skola.nazev 
                                    ORDER BY pocet_uchazecu DESC 
                                    LIMIT 10
                                ");
$stmt->execute();
$result = $stmt->get_result();
$data['skoly'] = array();

while ($row = $result->fetch_assoc()) {
    $data['skoly'][$row['skola']] = $row['pocet_uchazecu'];
};
$stmt->close();



// Nejoblíbenější obor (ten s nejvíce uchazeči)
$stmt = $connect->prepare("SELECT obor.nazev AS obor, COUNT(*) AS pocet 
                                    FROM uchazec_obor 
                                    JOIN obor ON uchazec_obor.obor_id = obor.id 
                                    GROUP BY obor.nazev 
                                    ORDER BY pocet DESC 
                                    LIMIT 1
                                ");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$data['obor'] = $row['obor'];
$stmt->close();



// Přenos dat do JavaScriptu ve formátu JSON
echo json_encode($data);
?>
