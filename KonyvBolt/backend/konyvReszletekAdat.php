<?php
//config.php betöltése
require_once "config.php";
//Először ellenőrizzük hogy a HTTP GET kérésben van-e "konyvId" nevű paraméter. Ha van, 
//akkor elkezdi a feldolgozást, különben hibát jelez vissza.
if (isset($_GET['konyvId'])) 
{
    //változó feltöltése a konyvId adatával
    $konyvId = $_GET['konyvId'];
    //Ha van "konyvId" paraméter, akkor a kód előkészíti a SQL lekérdezést a "konyv" táblából, 
    //beleértve az összes olyan adatot, amelyek az adott könyvhöz kapcsolódnak, például a műfaját. 
    //A LEFT JOIN segítségével összekapcsolja a "mufajok" táblát a "konyv" táblával a műfajazonosító alapján.
    $sql = "SELECT konyv.*,mufajok.mufajNev FROM konyv LEFT JOIN mufajok ON konyv.mufaj = mufajok.mufajId WHERE konyvId = ?";
    //kapcsolat és adatok előkészítése.
    $stmt = mysqli_prepare($conn, $sql);
    //ha előkészült a kapcsolati és adatbázis változó akkor fusson le a folyamat.

    // Ha a lekérdezés sikeresen lefutott (nem volt hiba), 
    //a kód beállítja a válasz "error" mezőjét hamisra, 
    //majd a lekért könyvadatokat a "book" mezőbe helyezi a válaszban. 
    //Ha hiba történt a lekérdezés során, akkor a válaszban "error" értéke igaz lesz, 
    //és a "message" mezőben le lesz írva a hibaüzenet.
    if ($stmt) {

        mysqli_stmt_bind_param($stmt, "i", $konyvId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $response['error'] = false;
            $response['book'] = mysqli_fetch_assoc($result);
        } else {
            $response['error'] = true;
            $response['message'] = "Hiba a lekérdezés során: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        $response['error'] = true;
        $response['message'] = "Hiba a lekérdezés előkészítése során: " . mysqli_error($conn);
    }
} 
else 
{
    $response['error'] = true;
    $response['message'] = "Hiányzó konyvId paraméter.";
}
//A json_encode függvény segítségével átalakítjuk a válaszobjektumot JSON formátummá, majd ezt a JSON-t elküldi a kliensnek.
echo json_encode($response);
?>
