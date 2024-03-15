function getCarsForRent() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayCars(response);
            } else {
                console.error("Error fetching cars for rent.");
            }
        }
    };

    xhr.open("GET", "interogari-simple-7.php", true);
    xhr.send();
}

function displayCars(carList) {
    var resultContainer = document.getElementById("result-7");

    if (carList && carList.length > 0) {
        var html = "<ul>";
        for (var i = 0; i < carList.length; i++) {
            var car = carList[i];
            html += "<li>Street: " + car.Strada + "</li>" +
                    "<li>City: " + car.Oras + "</li>" +
                    "<li>Postal Code: " + car.CodPostal + "</li>" +
                    "<li>Phone: " + car.Telefon + "</li>" +
                    "<li>Email: " + car.Email + "</li>" +
                    "<li>License Plate: " + car.NrImatriculare + "</li>" +
                    "<li>Brand: " + car.Marca + "</li>" +
                    "<li>Model: " + car.Model + "</li>" +
                    "<li>Color: " + car.Culoare + "</li>" +
                    "<li>Year: " + car.AnFabricatie + "</li>" +
                    "<li>Status: " + car.Stare + "</li>" +
                    "<li>Car Type: " + car.TipMasina + "</li>" +
                    "<li>Price per Day: " + car.PretZi + "</li><br>";
        }
        html += "</ul>";
        resultContainer.innerHTML = html;
    } else {
        resultContainer.innerHTML = "No cars available for rent.";
    }
}
