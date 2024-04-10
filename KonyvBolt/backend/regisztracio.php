<?php
//Először elindítunk egy sessiont, ami lehetővé teszi az adatok átmeneti tárolását az egymást követő kérések között.
session_start();
//config.php betöltése.
include_once "config.php";

//Itt a $_POST tömbből kinyerjük az űrlapról érkező adatokat, és ezeket külön változókba mentjük el. 
//A mysqli_real_escape_string() függvényt használja annak érdekében, 
//hogy megvédje az adatbázist az SQL injection támadásoktól.
$fname = mysqli_real_escape_string($conn, $_POST['fname']); //Keresztnév
$lname = mysqli_real_escape_string($conn, $_POST['lname']); //Családnév
$email = mysqli_real_escape_string($conn, $_POST['email']); //E-mail
$passwordrow = mysqli_real_escape_string($conn, $_POST['password']); //Jelszó
$passwordagain = mysqli_real_escape_string($conn, $_POST['passwordagain']); //Jelszó újra

/**vissza is kell tudni fejteni belépésnél, így önmagában nem fog engedni újra belépni*/
$password = password_hash($passwordrow, PASSWORD_DEFAULT);
//Csak akkor indul el a függvény ha minden mezőben van adat, valamint  
if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && $password != $passwordagain)
{
    // e-mail cím érvényes formátumának ellenőrzése
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        // ellenőrizzük, hogy létezik-e már ez a mail cím
        $sql = mysqli_query($conn, "SELECT email FROM Felhasznalok WHERE email = '{$email}'");
        
        if($sql !== false && mysqli_num_rows($sql) > 0)
        {
            echo "$email - már létező e-mail cím!";
        }
        else
        {
            // adatok beszúrása
            $sql2 = mysqli_query($conn, "INSERT INTO Felhasznalok (fname, lname, email, password)
            VALUES ('{$fname}', '{$lname}', '{$email}', '{$password}')");

            if($sql2)
            {
                $sql3 = mysqli_query($conn, "SELECT * FROM Felhasznalok WHERE email = '{$email}'");

                if($sql3 !== false && mysqli_num_rows($sql3) > 0)
                {
                    $row = mysqli_fetch_assoc($sql3);
                    $_SESSION['user_id'] = $row['user_id'];
                    echo "success";
                }
            }
            else
            {
                echo "Valami hiba történt!";
            }
        }
    }
    else
    {
        echo "Az e-mail cím érvénytelen!";
    }
}
else
{
    echo "Minden mezőt ki kell töltenie vagy a jelszavak nem egyeznek!";
}

