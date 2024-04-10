<?php 
//config.php betöltése
require_once "config.php";
//Első lépésként lekérjük az összes könyvet az adatbázisból majd elrendezzük az eredményt az "ar" mező növekvő sorrendjében.
$sql = "SELECT * FROM konyv ORDER BY ar ASC LIMIT 2";

//változó ami lekérdezi a kapcsolati változót valamint az adatbázis változót
$eredmeny = mysqli_query($conn, $sql);

//A lekérdezést végrehajtjuk az adatbázison, majd az eredményeket feldolgozzuk.
//Ha nincs találat, akkor hibaüzenetet írunk ki.
//Ellenkező esetben összegyűjtjük a könyvek adatait egy tömbbe, amelyet később átalakítunk JSON formátumba.

if(@mysqli_num_rows($eredmeny) < 1){
    $olcsoKonyvek = "<li>
                <h2>Nincs találat a rendszerben!</h2>
                </li>\n";}
                else
                {
                    //adatok összefűzése
                    $olcsoKonyvek = "";
                    while ($sor = mysqli_fetch_assoc($eredmeny)) 
                    {
                        $olcsoKonyvek .= "
                        
                       <ul><li>{$sor['konyvCim']}</ul>
                        
                        \n";
                    }
                }
?>
