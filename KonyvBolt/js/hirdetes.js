const form = document.querySelector('hirdetesForm'),
continueBtn = form.querySelector('button input'),
errorText = form.querySelector('.error-txt');

 form.onsubmit = (e) => {
    e.preventDefault();
 }


 continueBtn.onclick = ()=>{
    //Ajax
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/hirdetes.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                
                if(data == "success"){
                    location.href = "LoggedInMain.php"
                }else{
                    errorText.textContent = data;
                    console.log(data);
                    errorText.style.display = "block";               
                }
            }
        }
    }
    //az adatokat el kell küldenünk az ajaxon keresztül a PHP-nek
    let formData = new FormData(form);
    for (let pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    xhr.send(formData);
    }
