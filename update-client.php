<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientID = $_POST["clientID"];
    $firstName = $_POST["updateFirstName"];
    $lastName = $_POST["updateLastName"];
    $cnp = $_POST["updateCNP"];
    $street = $_POST["updateStreet"];
    $number = $_POST["updateNumber"];
    $city = $_POST["updateCity"];
    $county = $_POST["updateCounty"];
    $sex = $_POST["updateSex"];
    $birthdate = date('Y-m-d', strtotime($_POST["updateBirthdate"]));
    $phone = $_POST["updatePhone"];
    $password = $_POST["updatePassword"];
    $email = $_POST["updateEmail"];

    $checkQuery = "SELECT * FROM Client WHERE ClientID = $clientID";
    $checkResult = sqlsrv_query($conn, $checkQuery);

    if ($checkResult) {
        $rowCount = sqlsrv_has_rows($checkResult);

        if ($rowCount) {
            $query = "UPDATE Client SET Nume = '$lastName', Prenume = '$firstName', CNP = '$cnp', Strada = '$street', Numar = '$number', Oras = '$city', Judet = '$county', Sex = '$sex', DataNastere = '$birthdate', Telefon = '$phone', Parola = '$password', Email = '$email' WHERE ClientID = $clientID";
            $result = sqlsrv_query($conn, $query);

            if ($result) {
                echo "Client actualizat cu succes!";
            } else {
                echo "Eroare la actualizarea clientului: " . print_r(sqlsrv_errors(), true);
            }
        } else {
            echo "Client cu ClientID $clientID nu există.";
        }
    } else {
        echo "Eroare la interogare: " . print_r(sqlsrv_errors(), true);
    }
} else {
    echo "Cerere nevalidă.";
}
?>
