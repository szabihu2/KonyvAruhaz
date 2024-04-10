function senduser_id(event) {
    event.preventDefault();
    
    let user_id = document.getElementById("user_id").value;
    // let mufajId = document.getElementById("mufajId").value;
    //console.log('user_id : ', user_id);
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/KonyvBolt/backend/konyvReszletekAdat.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Felkészítjük az adatokat az elküldésre
    let data = "user_id=" + encodeURIComponent(user_id);

    // Kérés elküldése
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("HTTP státusz: " + xhr.status);
                let responseData = xhr.responseText;
                console.log("Kapott adat:", responseData);
                window.location.href = "backend/konyvReszletekAdat.php?user_id=" + user_id;

                
            } else {
                console.error("Error during AJAX request. HTTP státusz: " + xhr.status);
            }
        }
    };

    // Kérés elküldése
    xhr.send(data);
}

