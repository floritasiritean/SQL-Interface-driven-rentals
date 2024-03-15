function deleteClient() {
    var deleteClientID = document.getElementById("deleteClientID").value;

    if (!deleteClientID) {
        alert("Completați ID-ul clientului.");
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
    xhr.open("POST", "delete-client.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("deleteClientID=" + encodeURIComponent(deleteClientID));
}
