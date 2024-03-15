<?php
include("connection.php");

// Construiește interogarea SQL
$query = "
    SELECT C.Nume, C.Prenume
    FROM Client C
    WHERE C.ClientID IN (
        SELECT R.ClientID
        FROM Rezervare R
        JOIN Masina M ON R.MasinaID = M.MasinaID
        JOIN RezervareAccesoriu AR ON R.RezervareID = AR.RezervareID
        JOIN LocatieInchiriere L ON M.LocatieInchiriereID = L.LocatieInchiriereID
        WHERE L.Oras = 'Radauti'
        GROUP BY R.ClientID
        HAVING COUNT(DISTINCT R.RezervareID) > 0
        AND COUNT(DISTINCT AR.AccesoriuID) > 0
        AND NOT EXISTS (
            SELECT 1
            FROM Rezervare
            WHERE ClientID = R.ClientID AND Stare = 'Anulata'
        )
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
    $clientsInCity = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $clientsInCity[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($clientsInCity);
}

// Eliberează resursa de rezultate și închide conexiunea
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>

