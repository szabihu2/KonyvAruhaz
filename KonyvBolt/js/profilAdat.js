(function () {
    document.addEventListener('DOMContentLoaded', function () {
      // Eseménykezelők itt
      fetchJsonData();
    });
  })();
  
  function fetchJsonData() {
    fetch('http://localhost/KonyvBolt/backend/profilAdat.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
    })
      .then(response => response.json())
      .then(data => {
        let profilTartalom = document.getElementById('profilTartalom');
  
        if (data.error) {
          console.error('Hiba a JSON adatok lekérése során:', data.error);
          return;
        }
  
        // Először hozz létre egy üres stringet a tartalomhoz
        let contentHTML = '';
  
        data.profil.forEach(sor => {
          contentHTML += `
            <div id="templatemo_content_right">
            <h1>Profil</h1>
            
            <ul>
                <h2>Profil Adatok</h2>
                <li>Vezetéknév: ${sor.lname}</li>
                <li>Keresztnév:${sor.fname}</li>
                <li>E-mail:${sor.email}</li>
                <li>Jelszó:${sor.password}</li>
            </ul>
            </div>
          `;
        });
        
        // Az összefűzött HTML hozzáadása a konténerhez
        profilTartalom.innerHTML = contentHTML;
      })
      .catch(error => {
        console.error('Hiba a JSON adatok lekérése során:', error);
      });
  }

  function fetchDetails(user_id) {
    fetch(`http://localhost/KonyvBolt/backend/profilAdat.php?user_id=${user_id}`)
    .then(response => response.json())
      .then(data => {
        if (data.error) {
          console.error('Hiba a részletek lekérése során:', data.message);
        } else {
          let profilTartalom = document.getElementById('profilTartalom');
          
          if (profilTartalom) {
            // Kicseréljük az oldal tartalmát az új adatokra
            profilTartalom.innerHTML = `
            <div id="templatemo_content_right">
            <h1>Profil</h1>
            
            <ul>
                <h2>Profil Adatok</h2>
                <li>Vezetéknév: ${data.sor.lname}</li>
                <li>Keresztnév:${data.sor.fname}</li>
                <li>E-mail:${data.sor.email}</li>
                <li>Jelszó:${data.sor.password}</li>
            </ul>
            </div>
            `;
          } else {
            console.error('Nem található profilTartalom elem.');
          }
        }
      })
      .catch(error => {
        console.error('Hiba a részletek lekérése során:', error);
      });
  }