document.getElementById("updateClientForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Previne comportamentul implicit de trimitere a formularului
    updateClient();
});

function updateClient() {
    var clientID = document.getElementById("idClient").value;
    var updateFirstName = document.getElementById("updateFirstName").value;
    var updateLastName = document.getElementById("updateLastName").value;
    var updateCNP = document.getElementById("updateCNP").value;
    var updateStreet = document.getElementById("updateStreet").value;
    var updateNumber = document.getElementById("updateNumber").value;
    var updateCity = document.getElementById("updateCity").value;
    var updateCounty = document.getElementById("updateCounty").value;
    var updateSex = document.getElementById("updateSex").value;
    var updateBirthdate = document.getElementById("updateBirthdate").value;
    var updatePhone = document.getElementById("updatePhone").value;
    var updatePassword = document.getElementById("updatePassword").value;
    var updateEmail = document.getElementById("updateEmail").value;

    if (!clientID || !updateFirstName || !updateLastName || !updateCNP || !updateStreet || !updateNumber || !updateCity || !updateCounty || !updateSex || !updateBirthdate || !updatePhone || !updatePassword || !updateEmail) {
        alert("Completați toate câmpurile.");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response) {
                    alert(response);
                } else {
                    console.error("Răspunsul serverului este gol.");
                }
            } else {
                console.error(xhr.statusText);
            }
        }
    };
    xhr.open("POST", "update-client.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("clientID=" + encodeURIComponent(clientID) + "&updateFirstName=" + encodeURIComponent(updateFirstName) + "&updateLastName=" + encodeURIComponent(updateLastName)
        + "&updateCNP=" + encodeURIComponent(updateCNP) + "&updateStreet=" + encodeURIComponent(updateStreet) + "&updateNumber=" + encodeURIComponent(updateNumber)
        + "&updateCity=" + encodeURIComponent(updateCity) + "&updateCounty=" + encodeURIComponent(updateCounty) + "&updateSex=" + encodeURIComponent(updateSex)
        + "&updateBirthdate=" + encodeURIComponent(updateBirthdate) + "&updatePhone=" + encodeURIComponent(updatePhone) + "&updatePassword=" + encodeURIComponent(updatePassword)
        + "&updateEmail=" + encodeURIComponent(updateEmail));
}
