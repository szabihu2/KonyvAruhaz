function sendkonyvId(event) {
    event.preventDefault();
    
    let konyvId = document.getElementById("konyvId").value;
    // let mufajId = document.getElementById("mufajId").value;
    //console.log('konyvId : ', konyvId);
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/KonyvBolt/backend/konyvReszletekAdat.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Felkészítjük az adatokat az elküldésre
    let data = "konyvId=" + encodeURIComponent(konyvId);

    // Kérés elküldése
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("HTTP státusz: " + xhr.status);
                let responseData = xhr.responseText;
                console.log("Kapott adat:", responseData);
                window.location.href = "backend/konyvReszletekAdat.php?konyvId=" + konyvId;

                
            } else {
                console.error("Error during AJAX request. HTTP státusz: " + xhr.status);
            }
        }
    };

    // Kérés elküldése
    xhr.send(data);
}

