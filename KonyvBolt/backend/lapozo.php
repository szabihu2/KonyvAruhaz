<?php
//A kapcsolat.php meghívása.
require_once("kapcsolat.php");
//Első lépésként lekérjük az összes könyvet az adatbázisból, beleértve a műfajukat is.
//Ehhez egy összetett SQL lekérdezést alkalmazunk, ahol a "konyv" táblát összekapcsoljuk a "mufajok" táblával a műfajazonosító alapján.
$sql = "SELECT konyv.*,mufajok.mufajNev FROM konyv LEFT JOIN mufajok ON konyv.mufaj = mufajok.mufajId";

//változó ami lekérdezi a kapcsolati változót valamint az adatbázis változót
$eredmeny = mysqli_query($conn, $sql);

$osszes = mysqli_num_rows($eredmeny);
//Kapcsolat ellenörzése.
//var_dump($osszes);

//A lapozó előkészítése:
//Először megírjuk, hogy hány oldalra lesz szükség a könyvek listájának megjelenítéséhez.
//Ehhez a könyvek számát osztjuk a lapozás egy oldalán megjelenítendő könyvek számával.
//A ceil függvény segítségével az eredményt felfelé kerekítjük, így biztosítva, hogy ne maradjon ki könyv az oldalak közül.
$mennyit = 4;
$lapok = ceil($osszes / $mennyit);
$aktualis = 1;

//Aktuális oldal meghatározása:
//Az aktuális oldal változót beállítja a GET paraméter alapján.
//Ha a "oldal" paraméter értéke kisebb mint 1, akkor az aktuális oldal értékét 1-nek állítja be.
//Ha nagyobb, mint a rendelkezésre álló oldalak száma, akkor az utolsó oldal értékét veszi fel.
//Ellenkező esetben az aktuális oldal értékét a GET paraméter alapján állítja be.

if(isset($_GET['oldal']))
{
    if($_GET['oldal'] < 0)
    {
        $aktualis = 1;
        
    }else if ($_GET['oldal'] > $lapok){
        $aktualis = $lapok;
    }
    else{
        $aktualis = $_GET['oldal'];
    }
}

$honnan = ($aktualis -1) * $mennyit;

$lapozo = "";
//Oldal számok
$lapozo .= ($aktualis != 1)? "<a href=\"?oldal=1\">Első</a> | " :"Első |";
$lapozo .= ($aktualis > 1 && $aktualis <= $lapok)? "<a href=\"?oldal=".($aktualis - 1)."\">Előző</a> | ": "Előző |";
for ($oldal=1; $oldal <= $lapok ; $oldal++) { 
   $lapozo .= ($aktualis != $oldal) ? "<a href=\"?oldal={$oldal}\">{$oldal}</a> | " : $oldal ." | ";
}

$lapozo .=  ($aktualis > 0 && $aktualis < $lapok)? "<a href=\"?oldal=".($aktualis + 1)."\">Következő</a> | " :" Következő |";
$lapozo .= ($aktualis != $lapok)? "<a href=\"?oldal={$oldal}\">Utolsó</a>":"Utolsó";
$lapozo .= "";


?>