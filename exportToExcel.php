<?php
$requiredPermission = 'admin';
require_once('permission_load.php');
require_once('permission_check.php');

        require_once('database.php');
        
        if (isset($_POST["export_excel"])) {

                $SQL = "SELECT * FROM uchazec_obor";
                $result = mysqli_query($connect, $SQL);

                if (mysqli_num_rows($result) > 0) {
                    $output = '
                        <table border="1">
                            <tr>
                                <th>iduchazec</th>
                                <th>obor</th>
                            </tr>
                    ';

                    while ($row = mysqli_fetch_array($result)) {
                        $output .= '
                            <tr>
                                <td>'.$row["uchazec_id"].'</td>
                                <td>'.$row["obor_id"].'</td>
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
                else{
                    echo"nikdo není zapsaný.";
                }
            }
        
        
        $connect->close();
    ?>
