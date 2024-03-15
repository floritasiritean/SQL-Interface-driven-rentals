function addClient() {
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var cnp = document.getElementById("cnp").value;
    var street = document.getElementById("street").value;
    var number = document.getElementById("number").value;
    var city = document.getElementById("city").value;
    var county = document.getElementById("county").value;
    var sex = document.getElementById("sex").value;
    var birthdate = document.getElementById("birthdate").value;
    var phone = document.getElementById("phone").value;
    var password = document.getElementById("password").value;
    var email = document.getElementById("email").value;

    // Adăugați condițiile pentru celelalte câmpuri
    if (!firstName || !lastName || !cnp || !street || !number || !city || !county || !sex || !birthdate || !phone || !password || !email) {
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
    xhr.open("POST", "insert-client.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("firstName=" + encodeURIComponent(firstName) + "&lastName=" + encodeURIComponent(lastName) + "&cnp=" + encodeURIComponent(cnp) +
        "&street=" + encodeURIComponent(street) + "&number=" + encodeURIComponent(number) + "&city=" + encodeURIComponent(city) +
        "&county=" + encodeURIComponent(county) + "&sex=" + encodeURIComponent(sex) + "&birthdate=" + encodeURIComponent(birthdate) +
        "&phone=" + encodeURIComponent(phone) + "&password=" + encodeURIComponent(password) + "&email=" + encodeURIComponent(email));
}

document.getElementById("clientForm").addEventListener("submit", function (event) {
    event.preventDefault();
    addClient();
});
