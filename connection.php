<?php

$serverName = "DESKTOP-81R8V5O\SQLEXPRESS";
$database = "Firma";
$uid = "";
$pass = "";

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);

if (!$conn) {
    die("Connection failed. Error details: " . print_r(sqlsrv_errors(), true));
} 

?>
