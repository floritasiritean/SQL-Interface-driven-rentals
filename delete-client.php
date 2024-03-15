<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deleteClientID = $_POST["deleteClientID"];

    $checkQuery = "SELECT * FROM Client WHERE ClientID = $deleteClientID";
    $checkResult = sqlsrv_query($conn, $checkQuery);

    if ($checkResult) {
        $rowCount = sqlsrv_has_rows($checkResult);

        if ($rowCount) {
            $query = "DELETE FROM Client WHERE ClientID = $deleteClientID";
            $result = sqlsrv_query($conn, $query);

            if ($result) {
                echo "Client șters cu succes!";
            } else {
                echo "Eroare la ștergerea clientului: " . print_r(sqlsrv_errors(), true);
            }
        } else {
            echo "Client cu ClientID $deleteClientID nu există.";
        }
    } else {
        echo "Eroare la interogare: " . print_r(sqlsrv_errors(), true);
    }
} else {
    echo "Cerere nevalidă.";
}
?>
