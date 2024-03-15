<?php
include("connection.php");

// Construiește interogarea SQL
$query = "
    SELECT M.MasinaID, M.NrImatriculare, M.Marca, M.Model
    FROM Masina M
    WHERE M.MasinaID IN (
        SELECT R1.MasinaID
        FROM Rezervare R1, Rezervare R2
        WHERE R1.MasinaID = R2.MasinaID
        AND R1.ClientID <> R2.ClientID
        AND R1.DataInceput BETWEEN '06-02-2023' AND '08-02-2023' 
        AND R2.DataSfarsit BETWEEN '06-02-2023' AND '08-02-2023' 
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
    $cars = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $cars[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($cars);
}

// Eliberează resursa de rezultate și închide conexiunea
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>

