<?php 
//config.php betöltése
require_once "config.php";
//Első lépésként lekérjük az összes könyvet az adatbázisból majd elrendezzük az eredményt az "oldalszam" mező csökenő sorrendjében.
$sql = "SELECT * FROM konyv ORDER BY oldalSzam DESC LIMIT 10";

//változó ami lekérdezi a kapcsolati változót valamint az adatbázis változót
$eredmeny = mysqli_query($conn, $sql);
$szam = 1;
//A lekérdezést végrehajtjuk az adatbázison, majd az eredményeket feldolgozzuk.
//Ha nincs találat, akkor hibaüzenetet írunk ki.
//Ellenkező esetben összegyűjtjük a könyvek adatait egy tömbbe, amelyet később átalakítunk JSON formátumba.

if(@mysqli_num_rows($eredmeny) < 1){
    $legtobbOldal = "<li>
                <h2>Nincs találat a rendszerben!</h2>
                </li>\n";}
                else
                {
                    //adatok összefűzése
                    $legtobbOldal = "";
                    while ($sor = mysqli_fetch_assoc($eredmeny)) 
                    {
                        $legtobbOldal .= "
                        
                       <ul><li id=\"legtobbOldal\"><b>{$szam}.</b> {$sor['konyvCim']}</li></ul>
                        
                        \n";
                        $szam++;
                    }
                }
?>
