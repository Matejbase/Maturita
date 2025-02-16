<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once('database.php');
        
        if (isset($_POST["export_excel"])) {

                $SQL = "SELECT * FROM uchazec";
                $result = mysqli_query($connect, $SQL);

                if (mysqli_num_rows($result) > 0) {
                    $output = '
                        <table border="1">
                            <tr>
                                <th>iduchazec</th>
                                <th>skola</th>
                                <th>obor</th>
                            </tr>
                    ';

                    while ($row = mysqli_fetch_array($result)) {
                        $output .= '
                            <tr>
                                <td>'.$row["iduchazec"].'</td>
                                <td>'.$row["skola"].'</td>
                                <td>'.$row["obor"].'</td>
                            </tr>
                        ';
                    }
                    $output .= '</table>';

                    // Odeslání správných hlaviček pro Excel soubor
                    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
                    header('Content-Disposition: attachment; filename="download.xls"');
                    header('Pragma: no-cache');
                    header('Expires: 0');

                    echo $output;
                }
            }
        
        
        $connect->close();
    ?>


</body>
</html>