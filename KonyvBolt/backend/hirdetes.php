<?php
//Először elindítunk egy sessiont, ami lehetővé teszi az adatok átmeneti tárolását az egymást követő kérések között.
session_start();
//config.php betöltése
include_once "config.php";
//Itt a $_POST tömbből kinyerjük az űrlapról érkező adatokat, és ezeket külön változókba mentjük el. 
//A mysqli_real_escape_string() függvényt használja annak érdekében, 
//hogy megvédje az adatbázist az SQL injection támadásoktól.
$konyvCim = mysqli_real_escape_string($conn, $_POST['konyvCim']);
$kiadasDatum = mysqli_real_escape_string($conn, $_POST['kiadasDatum']);
$szerzo = mysqli_real_escape_string($conn, $_POST['szerzo']);
$oldalSzam = mysqli_real_escape_string($conn, $_POST['oldalSzam']);
$mufaj = mysqli_real_escape_string($conn, $_POST['mufaj']);
$ar = mysqli_real_escape_string($conn, $_POST['ar']);
$leiras = mysqli_real_escape_string($conn, $_POST['leiras']);
$konyvAllapot = mysqli_real_escape_string($conn, $_POST['konyvAllapot']);
//A mysqli_query függvény segítségével végrehajtjuk az INSERT lekérdezést. Ez a sor fogja elvégezni az adatok mentését az adatbázisba.
$sql1 = mysqli_query($conn, "INSERT INTO Konyv (konyvCim,kiadasDatum,oldalSzam,ar,leiras,konyvAllapot)
Values('{$konyvCim}','{$kiadasDatum}','{$oldalSzam}','{$ar}'),'{$leiras}','{$konyvAllapot}' ");

$sql2 mysqli_query($conn, "INSERT INTO szerzok (szerzoNev) VALUES ('{$szerzo}')");

$sql3 mysqli_query($conn, "INSERT INTO mufajok (mufajNev) VALUES ('{$mufaj}')");
