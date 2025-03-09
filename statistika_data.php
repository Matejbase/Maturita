<?php
require_once('database.php');

// Pole pro uchování výsledků
$data = array();

// Definice oborů pro dotaz
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

    // Přidání počtu uchazečů pro tento obor do pole
    $data[$nazev_oboru] = $row['pocet'];

    $stmt->close();
}

// Přenos dat do JavaScriptu ve formátu JSON
$json_data = json_encode($data);
?>