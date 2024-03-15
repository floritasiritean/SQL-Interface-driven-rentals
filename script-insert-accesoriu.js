function addAccesory() {
    var accesoryName = document.getElementById("accesoryName").value;
    var accesoryPrice = document.getElementById("accesoryPrice").value;

    // Verificare dacă ambele câmpuri sunt completate
    if (!accesoryName || !accesoryPrice) {
        alert("Completați toate câmpurile.");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
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
    xhr.open("POST", "insert-accesoriu.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("accesoryName=" + encodeURIComponent(accesoryName) + "&accesoryPrice=" + encodeURIComponent(accesoryPrice));
}

document.getElementById("accesoryForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Previne comportamentul implicit de trimitere a formularului
    addAccesory();
});

