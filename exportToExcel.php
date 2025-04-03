<?php
$requiredPermission = 'admin';
require_once('permission_load.php');
require_once('permission_check.php');

require_once('database.php');

if (isset($_POST["export_excel"])) {

    // Dotaz na uchazeče, školy a obory
    $stmt = $connect->prepare("
        SELECT uchazec.id as uchazec_id, uchazec.skola_id, uchazec_obor.obor_id,
               skola.nazev as skola_nazev, obor.nazev as obor_nazev
        FROM uchazec    
        JOIN uchazec_obor ON uchazec.id = uchazec_obor.uchazec_id
        JOIN skola ON uchazec.skola_id = skola.id
        JOIN obor ON uchazec_obor.obor_id = obor.id
    ");
    $stmt->execute();
    $result = $stmt->get_result();

    // hlavní tabulka pro export
    $output = '
        <table border="1">
            <tr>
                <th>id_uchazec</th>
                <th>id_skola</th>
                <th>skola_nazev</th>
                <th>id_obor</th>
                <th>obor_nazev</th>
            </tr>
    ';
    while ($row = $result->fetch_assoc()) {
        $output .= '
            <tr>
                <td>'.$row["uchazec_id"].'</td>
                <td>'.$row["skola_id"].'</td>
                <td>'.$row["skola_nazev"].'</td>
                <td>'.$row["obor_id"].'</td>
                <td>'.$row["obor_nazev"].'</td>
            </tr>
        ';
    }
    $output .= '</table>';




    // Tabulka pro školy - seřazeno podle ID
    $output .= '
        <h2>Tabulka Školy (seřazeno podle ID)</h2>
        <table border="1">
            <tr>
                <th>Škola ID</th>
                <th>Škola Název</th>
            </tr>
    ';
    // Dotaz na školy (seřazeno podle ID)
    $stmt_skola = $connect->prepare("SELECT id, nazev FROM skola ORDER BY id ASC");
    $stmt_skola->execute();
    $result_skola = $stmt_skola->get_result();

    while ($row_skola = $result_skola->fetch_assoc()) {
        $output .= '
            <tr>
                <td>'.$row_skola["id"].'</td>
                <td>'.$row_skola["nazev"].'</td>
            </tr>
        ';
    }
    $output .= '</table>';



    // Tabulka pro obory - seřazeno podle ID
    $output .= '
        <h2>Tabulka Obory (seřazeno podle ID)</h2>
        <table border="1">
            <tr>
                <th>Obor ID</th>
                <th>Obor Název</th>
            </tr>
    ';
    // Dotaz na obory (seřazeno podle ID)
    $stmt_obor = $connect->prepare("SELECT id, nazev FROM obor ORDER BY id ASC");
    $stmt_obor->execute();
    $result_obor = $stmt_obor->get_result();

    while ($row_obor = $result_obor->fetch_assoc()) {
        $output .= '
            <tr>
                <td>'.$row_obor["id"].'</td>
                <td>'.$row_obor["nazev"].'</td>
            </tr>
        ';
    }
    $output .= '</table>';

  


    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    header('Content-Disposition: attachment; filename="export_dat.xls"');
    header('Pragma: no-cache');
    header('Expires: 0');


    // Vypíše výstup (vytvořený HTML kód)
    echo $output;

    // Zavření připojení k databázi
    $connect->close();
}
?>
