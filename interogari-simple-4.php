<?php
include("connection.php");

$query = "
    SELECT C.ClientID, C.Nume, C.Prenume, COUNT(R.RezervareID) AS NumarRezervari
    FROM Client C
    LEFT JOIN Rezervare R ON C.ClientID = R.ClientID
    GROUP BY C.ClientID, C.Nume, C.Prenume;
";

$result = sqlsrv_query($conn, $query);

if ($result) {
    $clients = array();

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $clients[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($clients);
} else {
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Database query error: " . print_r(sqlsrv_errors(), true)));
}

sqlsrv_close($conn);
?>
