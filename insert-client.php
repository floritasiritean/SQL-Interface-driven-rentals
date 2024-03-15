<?php

// Conectați-vă la baza de date folosind connection.php
include("connection.php");

// Verificați dacă s-au primit datele prin POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preluați valorile din cererea POST
    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
    $cnp = isset($_POST["cnp"]) ? $_POST["cnp"] : "";
    $street = isset($_POST["street"]) ? $_POST["street"] : "";
    $number = isset($_POST["number"]) ? $_POST["number"] : "";
    $city = isset($_POST["city"]) ? $_POST["city"] : "";
    $county = isset($_POST["county"]) ? $_POST["county"] : "";
    $sex = isset($_POST["sex"]) ? $_POST["sex"] : "";
    
    // Adjust formatul datei de naștere
    $rawBirthdate = isset($_POST["birthdate"]) ? $_POST["birthdate"] : "";
    $birthdate = date("Y-m-d", strtotime($rawBirthdate));

    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";

    // Adăugați condițiile pentru celelalte câmpuri
    if (!$firstName || !$lastName || !$cnp || !$street || !$number || !$city || !$county || !$sex || !$birthdate || !$phone || !$password || !$email) {
        echo "Completați toate câmpurile.";
        exit; // Ieșiți din script dacă există câmpuri necompletate
    }

    // Restul codului pentru inserarea în baza de date
    $query = "INSERT INTO Client (Nume, Prenume, CNP, Strada, Numar, Oras, Judet, Sex, DataNastere, Telefon, Parola, Email) VALUES ('$lastName', '$firstName', '$cnp', '$street', '$number', '$city', '$county', '$sex', '$birthdate', '$phone', '$password', '$email')";

    $result = sqlsrv_query($conn, $query);

    if ($result) {
        echo "Client adăugat cu succes!";
    } else {
        echo "Eroare la adăugarea clientului: " . print_r(sqlsrv_errors(), true);
    }
} else {
    echo "Cerere nevalidă.";
}

?>
