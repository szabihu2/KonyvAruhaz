<?php 
//config.php betöltése
require_once "config.php";

//SQL lekérdezés a felhasznalok táblából
$sql = "SELECT * FROM felhasznalok ";
        $eredmeny = mysqli_query($conn, $sql);
        //Kapcsolat ellenörzés
        //var_dump($eredmeny);
        
        //A lekérdezés eredményének megfelelően létrehozzuk a választ egy asszociatív tömb formájában.
        //Ha nincs találat a "(@mysqli_num_rows($eredmeny) < 1)" feltételben, akkor hibaüzenetet ad vissza.
        
        if(@mysqli_num_rows($eredmeny) < 1) 
        {
            $response = [
                'error' => true,
                'message' => 'Nincs találat a rendszerben!'
            ];
        } 
        //A mysqli_fetch_assoc() függvénnyel minden egyes rekordot egy asszociatív tömbként olvasunk ki,
        //majd ezeket a tömböket egy $profil tömbbe gyűjtjük.
        else 
        {
            $profil = [];
            while ($sor = mysqli_fetch_assoc($eredmeny)) {
                $profil[] = [
                    'fname' => $sor['fname'],
                    'lname' => $sor['lname'],
                    'email' => $sor['email'],
                    'password' => $sor['password'],
                    'user_id' => $sor['user_id'],
                    
                ];
            }
            
            $response = [
                'error' => false,
                'profil' => $profil
            ];
        }
        
        // JSON kimenet generálása
        echo json_encode($response);

        

