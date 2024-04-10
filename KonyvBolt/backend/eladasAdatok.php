<?php 
//Először elindítunk egy sessiont, ami lehetővé teszi az adatok átmeneti tárolását az egymást követő kérések között.
session_start();
//config.php betöltése
require_once "config.php";

//változó létrehozása amibe feltöltjük a szükséges lekérendő adatokat az adatbázisból
$sql = "SELECT * FROM Konyv";

//változó ami lekérdezi a kapcsolati változót valamint az adatbázis változót
$eredmeny = mysqli_query($conn, $sql);

//A lekérdezést végrehajtjuk az adatbázison, majd az eredményeket feldolgozzuk.
//Ha nincs találat, akkor hibaüzenetet írunk ki.
//Ellenkező esetben összegyűjtjük a könyvek adatait egy tömbbe, amelyet később átalakítunk JSON formátumba.

            if(@mysqli_num_rows($eredmeny) < 1)
            {
                //változó létre hozása
                $konyvAdatok = "<li>
                            <h2>Nincs találat a rendszerben!</h2>
                            </li>\n";
            }
            else
            {
                //adatok összefűzése
                $konyvAdatok = "";
                while ($sor = mysqli_fetch_assoc($eredmeny)) 
                {
                    $konyvAdatok .= "
                    <h1>{$sor['konyvCim']} <span>{$sor['szerzo']}</span></h1>
                    
                    <ul>
                        <li>{$sor['kiadasDatum']}</li>
                        <li>{$sor['oldalSzam']}}</li>
                        <li>{$sor['mufaj']}</li>
                    </ul>
                    <h2>{$sor['ar']}</h2>
                    
                    <p>{$sor['leiras']}</p>

                    <p>{{$sor['konyvAllapot']}</p>\n";
                }
            }
