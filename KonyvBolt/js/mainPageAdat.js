(function () {
  document.addEventListener('DOMContentLoaded', function () {
    // Eseménykezelők itt
    fetchJsonData();
  });
})();

function fetchJsonData() {
  fetch('http://localhost/KonyvBolt/backend/mainPageAdat.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
  })
    .then(response => response.json())
    .then(data => {
      let mainContentContainer = document.getElementById('mainContentContainer');

      if (data.error) {
        console.error('Hiba a JSON adatok lekérése során:', data.error);
        return;
      }

      // Először hozz létre egy üres stringet a tartalomhoz
      let contentHTML = '';

      data.books.forEach(sor => {
        contentHTML += `
          <div id="templatemo_content_right">
            <div class="templatemo_product_box">
              <h1>${sor.konyvCim} <span>(${sor.szerzo})</span></h1>
              <img src="images/templatemo_image_01.jpg" alt="image" id="kepPadding"/>
              <p>${sor.leiras}</p>
              <div class="product_info">
                
                <h3>${sor.ar} Ft</h3>
                <form method="post" class="formR">
                  <input type="hidden" value="${sor.konyvId}" class="konyvId" name="konyvId">
                  <div class="detail_button" id="reszletek_${sor.konyvId}" name="reszletek">
                    <a href="#" id="btnPost" onclick="fetchDetails(${sor.konyvId})">Részletek</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        `;
      });

      // Az összefűzött HTML hozzáadása a konténerhez
      mainContentContainer.innerHTML = contentHTML;
    })
    .catch(error => {
      console.error('Hiba a JSON adatok lekérése során:', error);
    });
}
//Részletek beolvasása
function fetchDetails(konyvId) {
  fetch(`http://localhost/KonyvBolt/backend/konyvReszletekAdat.php?konyvId=${konyvId}`)
  .then(response => response.json())
    .then(data => {
      if (data.error) {
        console.error('Hiba a részletek lekérése során:', data.message);
      } else {
        let mainContentContainer = document.getElementById('mainContentContainer');
       
        if (mainContentContainer) {
          // Kicseréljük az oldal tartalmát az új adatokra
          mainContentContainer.innerHTML = `
            <div id="templatemo_content_right" >
                
                  <h1>${data.book.konyvCim} <span>(${data.book.szerzo})</span> <span>(${data.book.kiadasEv})</span></h1>
                  
                  <div class="reszletek">
                  <h2>${data.book.mufajNev}</h2>
                  <h2>${data.book.leiras}</h2>
                  
                  <img src="images/templatemo_image_01.jpg" alt="image" />
                  
                  <div class="product_info">
                  <h2>${data.book.oldalSzam} oldal</h2>
                  <h2>A könyv állapota: ${data.book.konyvAllapot}</h2>
                  <h3>${data.book.ar} Ft</h3>
                  <form method="post" class="formR">
                    <input type="hidden" value="${data.book.konyvId}" class="konyvId" name="konyvId">
                    <div class="buy_now_button" id="reszletek_${data.book.konyvId}" name="reszletek">
                      
                    </div>
                  </form>
                  </div>
                  
                </div>

            </div>
          `;
        } else {
          console.error('Nem található mainContentContainer elem.');
        }
      }
    })
    .catch(error => {
      console.error('Hiba a részletek lekérése során:', error);
    });
}
