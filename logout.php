<?php
session_start(); 

session_unset();

session_destroy();

echo "Byli jste odhlášeni";
header("Location: singboard.html");
exit();
?>