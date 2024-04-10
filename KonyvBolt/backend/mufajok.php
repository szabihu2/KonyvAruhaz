<?php
//Először elindítunk egy sessiont, ami lehetővé teszi az adatok átmeneti tárolását az egymást követő kérések között.
session_start();
//config.php betöltése
require_once "config.php";
//SQL lekérdezés
$sql = "SELECT mufajNev FROM mufajok";

//változó ami lekérdezi a kapcsolati változót valamint az adatbázis változót
$eredmeny = mysqli_query($conn, $sql);
//A lekérdezést végrehajtjuk az adatbázison, majd az eredményeket feldolgozzuk.
//Ha nincs találat, akkor hibaüzenetet írunk ki.
//Ellenkező esetben összegyűjtjük a könyvek adatait egy tömbbe, amelyet később átalakítunk JSON formátumba.

if(@mysqli_num_rows($eredmeny) < 1){
    $mufajok = "<li>
                <h2>Nincs találat a rendszerben!</h2>
                </li>\n";}
                else
                {
                    //adatok összefűzése
                    $mufajok = "";
                    while ($sor = mysqli_fetch_assoc($eredmeny)) 
                    {
                        $mufajok .= "
                        
                       <ul><li> <form method=\"post\" id=\"rendezo\"><a href='#'>{$sor['mufajNev']}</a></form> </li></ul>
                        
                        \n";
                    }
                }
?>
