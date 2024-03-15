function getClientsWithSpending() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayClientsWithSpending(response);
            } else {
                console.error("Error fetching clients with spending.");
            }
        }
    };

    xhr.open("GET", "interogari-simple-6.php", true);
    xhr.send();
}

function displayClientsWithSpending(clientDetails) {
    var resultContainer = document.getElementById("result-6");

    if (clientDetails && clientDetails.length > 0) {
        var html = "<ul>";
        for (var i = 0; i < clientDetails.length; i++) {
            var client = clientDetails[i];
            html += "<li>Client ID: " + client.ClientID + "</li>" +
                    "<li>Name: " + client.Nume + " " + client.Prenume + "</li>" +
                    "<li>Total Spending: " + client.SumaCheltuita + "</li><br>";
        }
        html += "</ul>";
        resultContainer.innerHTML = html;
    } else {
        resultContainer.innerHTML = "No clients found with spending.";
    }
}
