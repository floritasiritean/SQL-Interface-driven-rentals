<?php
include("connection.php");

$query = "
    SELECT R.RezervareID, CONVERT(VARCHAR(10), R.DataInceput, 120) AS DataInceput,
    CONVERT(VARCHAR(10), R.DataSfarsit, 120) AS DataSfarsit, R.Pret,
           M.NrImatriculare, M.Marca, M.Model,
           A.Nume AS NumeAngajat, A.Prenume AS PrenumeAngajat
    FROM Rezervare R
    JOIN Masina M ON R.MasinaID = M.MasinaID
    JOIN Angajat A ON R.AngajatID = A.AngajatID;
";

$result = sqlsrv_query($conn, $query);

if ($result === false) {
    // Verifică dacă există erori în interogare
    header('Content-Type: application/json');
    echo json_encode(array("error" => sqlsrv_errors()));
} else {
    // Extrage rezultatele într-un array asociativ
    $reservationDetails = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $reservationDetails[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($reservationDetails);
}

// Eliberează resursa de rezultate și închide conexiunea
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
