<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accessoryID = $_POST["accessoryID"];
    $newAccessoryName = $_POST["newAccessoryName"];
    $newAccessoryPrice = $_POST["newAccessoryPrice"];

    $checkQuery = "SELECT * FROM Accesoriu WHERE AccesoriuID = $accessoryID";
    $checkResult = sqlsrv_query($conn, $checkQuery);

    if ($checkResult) {
        $rowCount = sqlsrv_has_rows($checkResult);

        if ($rowCount) {
            $query = "UPDATE Accesoriu SET NumeAccesoriu = '$newAccessoryName', PretZi = $newAccessoryPrice WHERE AccesoriuID = $accessoryID";
            $result = sqlsrv_query($conn, $query);

            if ($result) {
                echo "Accesoriu actualizat cu succes!";
            } else {
                echo "Eroare la actualizarea accesoriului: " . print_r(sqlsrv_errors(), true);
            }
        } else {
            echo "Accesoriu cu AccesoriuID $accessoryID nu există.";
        }
    } else {
        echo "Eroare la interogare: " . print_r(sqlsrv_errors(), true);
    }
} else {
    echo "Cerere nevalidă.";
}
?>
