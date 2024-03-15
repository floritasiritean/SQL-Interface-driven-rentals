function getClientsInInterval() {
    var dataInceput = document.getElementById("dataInceput").value;
    var dataSfarsit = document.getElementById("dataSfarsit").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayClients(response);
            } else {
                console.error("Error fetching clients in interval.");
            }
        }
    };

    xhr.open("GET", "interogari-complexe-4.php?dataInceput=" + dataInceput + "&dataSfarsit=" + dataSfarsit, true);
    xhr.send();
}

function displayClients(clients) {
    var resultContainer = document.getElementById("result-4");

    if (clients && clients.length > 0) {
        var html = "<ul>";
        for (var i = 0; i < clients.length; i++) {
            var client = clients[i];
            html += "<li>" + client.Nume + " " + client.Prenume + "</li>";
        }
        html += "</ul>";
        resultContainer.innerHTML = html;
    } else {
        resultContainer.innerHTML = "No clients found in the specified interval.";
    }
}
