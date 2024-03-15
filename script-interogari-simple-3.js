function getMostExpensiveReservation() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayReservationDetails(response);
            } else {
                console.error("Error fetching the most expensive reservation.");
            }
        }
    };

    xhr.open("GET", "interogari-simple-3.php", true);
    xhr.send();
}

function displayReservationDetails(reservation) {
    var resultContainer = document.getElementById("result-3");

    var html = "<p>Reservation ID: " + reservation.RezervareID + "</p>" +
               "<p>Start Date: " + reservation.DataInceput + "</p>" +
               "<p>End Date: " + reservation.DataSfarsit + "</p>" +
               "<p>Total Price: " + reservation.Pret + "</p>" +
               "<p>Car: " + reservation.Marca + " " + reservation.Model + " (" + reservation.NrImatriculare + ")</p>";

    resultContainer.innerHTML = html;
}

