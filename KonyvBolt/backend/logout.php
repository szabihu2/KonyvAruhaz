<?php 
//Először elindítunk egy sessiont, ami lehetővé teszi az adatok átmeneti tárolását az egymást követő kérések között.
session_start();

//ellenörzi hogy be van e jelentkezve a felhasználó.
//ha be van akkor le állítja a sessiont és elírányit a bejelentkezési felülethez(login.php).
if(isset($_SESSION['user_id']))
{
    session_unset();
            session_destroy();
    header("location: ../login.php");
}

