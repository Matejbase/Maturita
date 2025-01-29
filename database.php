<?php
  $host = "localhost";
  $user = "root";
  $passwd = "";
  $db = "mydb";
        
  $connect = new mysqli($host, $user, $passwd, $db) or die("Spojení se nezdařilo");
  $connect->set_charset("UTF8") or die("Kódování NEnastaveno");

?>