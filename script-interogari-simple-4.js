function getClientsWithReservations() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayClients(response);
            } else {
                console.error("Error fetching clients with reservations.");
            }
        }
    };

    xhr.open("GET", "interogari-simple-4.php", true);
    xhr.send();
}

function displayClients(clients) {
    var resultContainer = document.getElementById("result-4");

    var html = "<table><tr><th>Client ID</th><th>Nume</th><th>Prenume</th><th>Numar Rezervari</th></tr>";

    clients.forEach(function (client) {
        html += "<tr><td>" + client.ClientID + "</td><td>" + client.Nume + "</td><td>" + client.Prenume + "</td><td>" + client.NumarRezervari + "</td></tr>";
    });

    html += "</table>";

    resultContainer.innerHTML = html;
}
