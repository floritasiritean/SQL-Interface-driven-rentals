function getSharedCars() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayCars(response);
            } else {
                console.error("Error fetching shared cars.");
            }
        }
    };

    xhr.open("GET", "interogari-complexe-2.php", true);
    xhr.send();
}

function displayCars(cars) {
    var resultContainer = document.getElementById("result-2");

    if (cars && cars.length > 0) {
        var html = "<ul>";
        for (var i = 0; i < cars.length; i++) {
            var car = cars[i];
            html += "<li>Car ID: " + car.MasinaID + "</li>" +
                    "<li>License Plate: " + car.NrImatriculare + "</li>" +
                    "<li>Brand: " + car.Marca + "</li>" +
                    "<li>Model: " + car.Model + "</li><br>";
        }
        html += "</ul>";
        resultContainer.innerHTML = html;
    } else {
        resultContainer.innerHTML = "No shared cars found.";
    }
}
