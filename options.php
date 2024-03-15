<?php
include("connection.php");

$aniiDeFabricatie = array();

$query = "SELECT DISTINCT AnFabricatie FROM Masina";
$result = sqlsrv_query($conn, $query);

if ($result) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        // Convertiți la șir pentru a asigura corecta conversie JSON
        $aniiDeFabricatie[] = (string)$row['AnFabricatie'];
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Eroare la interogare: " . print_r(sqlsrv_errors(), true)));
    exit;
}

echo json_encode($aniiDeFabricatie);
exit;

console.log($aniiDeFabricatie);
sqlsrv_close($conn);
?>