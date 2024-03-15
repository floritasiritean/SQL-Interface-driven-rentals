<?php
include("connection.php");

// Construiește interogarea SQL
$query = "
    SELECT M.MasinaID, M.NrImatriculare, M.Marca, M.Model
    FROM Masina M
    WHERE M.MasinaID NOT IN (
        SELECT DISTINCT R.MasinaID
        FROM Rezervare R
        JOIN Client C ON R.ClientID = C.ClientID
        WHERE DATEDIFF(MONTH, C.DataNastere, GETDATE()) < 420
    )
    AND M.MasinaID IN (
        SELECT DISTINCT R.MasinaID
        FROM Rezervare R
    );
";

// Execută interogarea
$result = sqlsrv_query($conn, $query);

if ($result === false) {
    // Verifică dacă există erori în interogare
    header('Content-Type: application/json');
    echo json_encode(array("error" => sqlsrv_errors()));
} else {
    // Extrage rezultatele într-un array asociativ
    $carsNotReservedByYoungClients = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $carsNotReservedByYoungClients[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($carsNotReservedByYoungClients);
}

// Eliberează resursa de rezultate și închide conexiunea
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
