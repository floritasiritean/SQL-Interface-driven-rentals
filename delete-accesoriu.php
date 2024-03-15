<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accesoriuID = $_POST["accesoriuID"];

    $checkQuery = "SELECT * FROM Accesoriu WHERE AccesoriuID = $accesoriuID";
    $checkResult = sqlsrv_query($conn, $checkQuery);

    if ($checkResult) {
        $rowCount = sqlsrv_has_rows($checkResult);

        if ($rowCount) {
            $query = "DELETE FROM Accesoriu WHERE AccesoriuID = $accesoriuID";
            $result = sqlsrv_query($conn, $query);

            if ($result) {
                echo "Accesoriu șters cu succes!";
            } else {
                echo "Eroare la ștergerea accesoriului: " . print_r(sqlsrv_errors(), true);
            }
        } else {
            echo "Accesoriu cu AccesoriuID $accesoriuID nu există.";
        }
    } else {
        echo "Eroare la interogare: " . print_r(sqlsrv_errors(), true);
    }
} else {
    echo "Cerere nevalidă.";
}
?>
