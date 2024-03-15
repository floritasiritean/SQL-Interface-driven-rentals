<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $anFabricatie = isset($_GET["AnFabricatie"]) ? $_GET["AnFabricatie"] : null;

    // Verificăm dacă $anFabricatie este setat și este un an valid
    if ($anFabricatie && is_numeric($anFabricatie) && $anFabricatie >= 1990 && $anFabricatie <= date("Y")) {
        include("connection.php");

        $query = "SELECT TOP 1 MasinaID, NrImatriculare, Marca, Model, PretZi
          FROM Masina
          WHERE AnFabricatie = $anFabricatie
          ORDER BY PretZi ASC";

        $result = sqlsrv_query($conn, $query);

        if ($result) {
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

            if ($row) {
                echo "<p>Cea mai ieftina mașină din anul $anFabricatie:</p>";
                echo "<p>MasinaID: " . $row['MasinaID'] . "</p>";
                echo "<p>NrImatriculare: " . $row['NrImatriculare'] . "</p>";
                echo "<p>Marca: " . $row['Marca'] . "</p>";
                echo "<p>Model: " . $row['Model'] . "</p>";
                echo "<p>PretZi: " . $row['PretZi'] . "</p>";
            } else {
                echo "<p>Nu există mașini în anul $anFabricatie.</p>";
            }
        } else {
            echo "<p>Eroare la interogare: " . print_r(sqlsrv_errors(), true) . "</p>";
        }

        sqlsrv_close($conn);
    } else {
        echo "Anul de fabricație nu este valid. Asigură-te că este numeric și se află în intervalul 2000 - " . date("Y") . ".";
    }
} else {
    echo "Cerere nevalidă.";
}
?>
