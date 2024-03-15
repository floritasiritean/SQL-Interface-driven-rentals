<?php
include("connection.php");

$query = "
    SELECT TOP 1 R.RezervareID, CONVERT(VARCHAR(10), R.DataInceput, 120) AS DataInceput,
           CONVERT(VARCHAR(10), R.DataSfarsit, 120) AS DataSfarsit, R.Pret,
           M.NrImatriculare, M.Marca, M.Model
    FROM Rezervare R
    JOIN Masina M ON R.MasinaID = M.MasinaID
    ORDER BY R.Pret DESC;
";

$result = sqlsrv_query($conn, $query);

if ($result) {
    $reservationDetails = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

    if ($reservationDetails) {
        header('Content-Type: application/json');
        echo json_encode($reservationDetails);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("error" => "No reservation found."));
    }

    sqlsrv_free_stmt($result);
} else {
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Database query error: " . print_r(sqlsrv_errors(), true)));
}

sqlsrv_close($conn);
?>

