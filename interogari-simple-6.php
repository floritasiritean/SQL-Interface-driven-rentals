<?php
include("connection.php");

$query = "
    SELECT C.ClientID, C.Nume, C.Prenume, COALESCE(SUM(R.Pret), 0) AS SumaCheltuita
    FROM Client C
    LEFT JOIN Rezervare R ON C.ClientID = R.ClientID
    GROUP BY C.ClientID, C.Nume, C.Prenume;
";

$result = sqlsrv_query($conn, $query);

if ($result === false) {
    // Verifică dacă există erori în interogare
    header('Content-Type: application/json');
    echo json_encode(array("error" => sqlsrv_errors()));
} else {
    // Extrage rezultatele într-un array asociativ
    $clientDetails = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $clientDetails[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($clientDetails);
}

// Eliberează resursa de rezultate și închide conexiunea
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
