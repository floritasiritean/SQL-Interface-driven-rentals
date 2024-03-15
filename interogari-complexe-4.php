<?php
include("connection.php");

// Obține parametrii din cerere
$dataInceput = isset($_GET['dataInceput']) ? $_GET['dataInceput'] : null;
$dataSfarsit = isset($_GET['dataSfarsit']) ? $_GET['dataSfarsit'] : null;

// Construiește interogarea SQL
$query = "
    SELECT C.Nume, C.Prenume
    FROM Client C
    WHERE C.ClientID IN (
        SELECT DISTINCT R.ClientID
        FROM Rezervare R
        WHERE R.DataInceput BETWEEN ? AND ?
        OR R.DataSfarsit BETWEEN ? AND ?
    );
";

// Setează parametrii pentru interogare
$params = array($dataInceput, $dataSfarsit, $dataInceput, $dataSfarsit);

// Execută interogarea
$result = sqlsrv_query($conn, $query, $params);

if ($result === false) {
    // Verifică dacă există erori în interogare
    header('Content-Type: application/json');
    echo json_encode(array("error" => sqlsrv_errors()));
} else {
    // Extrage rezultatele într-un array asociativ
    $clientsInInterval = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $clientsInInterval[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($clientsInInterval);
}

// Eliberează resursa de rezultate și închide conexiunea
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
