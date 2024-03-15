<?php
include("connection.php");

$query = "
SELECT LocatieInchiriere.Strada, LocatieInchiriere.Oras, LocatieInchiriere.CodPostal, LocatieInchiriere.Telefon, LocatieInchiriere.Email,
Masina.NrImatriculare, Masina.Marca, Masina.Model, Masina.Culoare, Masina.AnFabricatie, Masina.Stare, Masina.TipMasina, Masina.PretZi
FROM LocatieInchiriere
JOIN Masina ON LocatieInchiriere.LocatieInchiriereID = Masina.LocatieInchiriereID;
";

$result = sqlsrv_query($conn, $query);

if ($result === false) {
    header('Content-Type: application/json');
    echo json_encode(array("error" => sqlsrv_errors()));
} else {
    $carsList = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $carsList[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($carsList);
}

sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
