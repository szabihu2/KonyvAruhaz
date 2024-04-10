<?php
//egy változót hozunk létre amit a mySQL szerverre kapcsolásra használunk
$conn = @mysqli_connect("localhost", "root", "", "bookshop");

//kapcsolat ellenörzése
/*if($conn){
    echo "kapcsolat rendben";
}else{
    echo "error";
}*/

//Ez a függvény egy SQL lekérdezést futtat a MySQL adatbázison keresztül. 
//A SET NAMES utf8 lekérdezés itt azért van használva, hogy beállítsa az adatbázis karakterkódolását UTF-8-ra.

@mysqli_query($conn, "SET NAMES utf8");

