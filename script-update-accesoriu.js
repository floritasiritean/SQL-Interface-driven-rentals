document.getElementById("updateAccessoryForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Previne comportamentul implicit de trimitere a formularului
    updateAccessory();
});

function updateAccessory() {
    var accessoryID = document.getElementById("idAccessory").value;
    var newAccessoryName = document.getElementById("newAccessoryName").value;
    var newAccessoryPrice = document.getElementById("newAccessoryPrice").value;

    if (!accessoryID || !newAccessoryName || !newAccessoryPrice) {
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
    xhr.open("POST", "update-accesoriu.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("accessoryID=" + encodeURIComponent(accessoryID) + "&newAccessoryName=" + encodeURIComponent(newAccessoryName) + "&newAccessoryPrice=" + encodeURIComponent(newAccessoryPrice));
}

