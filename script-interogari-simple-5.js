function getReservationDetails() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                display(response);
            } else {
                console.error("Error fetching reservation details.");
            }
        }
    };

    xhr.open("GET", "interogari-simple-5.php", true);
    xhr.send();
}

function display(reservations) {
    var resultContainer = document.getElementById("result-5");

    if (reservations && reservations.length > 0) {
        var html = "<ul>";
        for (var i = 0; i < reservations.length; i++) {
            var reservation = reservations[i];
            html += "<li>Reservation ID: " + reservation.RezervareID + "</li>" +
                    "<li>Start Date: " + reservation.DataInceput + "</li>" +
                    "<li>End Date: " + reservation.DataSfarsit + "</li>" +
                    "<li>Total Price: " + reservation.Pret + "</li>" +
                    "<li>Car: " + reservation.Marca + " " + reservation.Model + " (" + reservation.NrImatriculare + ")</li>" +
                    "<li>Employee: " + reservation.NumeAngajat + " " + reservation.PrenumeAngajat + "</li><br>";
        }
        html += "</ul>";
        resultContainer.innerHTML = html;
    } else {
        resultContainer.innerHTML = "No reservations found.";
    }
}
