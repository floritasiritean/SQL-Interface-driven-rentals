function getClientsInCity() {
    var oras = 'Radauti'; // Setează orașul, poți modifica această valoare în funcție de cerințele tale

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayClients(response);
            } else {
                console.error("Error fetching clients in city.");
            }
        }
    };

    xhr.open("GET", "interogari-complexe-1.php?oras=" + encodeURIComponent(oras), true);
    xhr.send();
}

function displayClients(clients) {
    var resultContainer = document.getElementById("result");

    if (clients && clients.length > 0) {
        var html = "<ul>";
        for (var i = 0; i < clients.length; i++) {
            var client = clients[i];
            html += "<li>Name: " + client.Nume + " " + client.Prenume + "</li>";
        }
        html += "</ul>";
        resultContainer.innerHTML = html;
    } else {
        resultContainer.innerHTML = "No clients found in the city.";
    }
}
