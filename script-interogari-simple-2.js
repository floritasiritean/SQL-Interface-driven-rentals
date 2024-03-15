// Funcție pentru a încărca dinamic opțiunile pentru anii de fabricație
function loadYears() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);

                if ("error" in response) {
                    console.error(response.error);
                    return;
                }

                var years = response;
                console.log(years);

                var selectElement = document.getElementById("AnFabricatie");

                // Adaugă opțiunile la lista de selecție
                years.forEach(function (year) {
                    var option = document.createElement("option");
                    option.value = year;
                    option.text = year;
                    selectElement.add(option);
                });
            } else {
                console.error("Eroare la solicitarea opțiunilor pentru ani de fabricație.");
            }
        }
    };

    xhr.open("GET", "options-2.php", true);
    xhr.send();
}

// Apelare funcție la încărcarea paginii
window.onload = function () {
    loadYears();
};

// Funcție pentru a obține cea mai ieftina mașină
function getMostCheapCar() {
    var selectedYear = document.getElementById("AnFabricatie").value;

    if (!selectedYear) {
        alert("Selectați un an de fabricație.");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                document.getElementById("result-2").innerHTML = response;
            } else {
                console.error("Eroare la solicitarea celei mai ieftine mașini.");
            }
        }
    };

    // Folosește selectedYear în URL pentru a face solicitarea personalizată
    xhr.open("GET", "interogari-simple-2.php?AnFabricatie=" + encodeURIComponent(selectedYear), true);
    xhr.send();
}


