<?php

// Conectați-vă la baza de date folosind connection.php
include("connection.php");

// Verificați dacă s-au primit datele prin POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preluați valorile din cererea POST
    $accesoryName = $_POST["accesoryName"];
    $accesoryPrice = $_POST["accesoryPrice"];

    // Folosiți aceste valori pentru a insera în baza de date
    $query = "INSERT INTO Accesoriu (NumeAccesoriu, PretZi) VALUES ('$accesoryName', '$accesoryPrice')";

    // Executați interogarea
    $result = sqlsrv_query($conn, $query);

    if ($result) {
        echo "Accesoriu adăugat cu succes!";
    } else {
        echo "Eroare la adăugarea accesoriului: " . print_r(sqlsrv_errors(), true);
    }
} else {
    echo "Cerere nevalidă.";
}

?>
