<?php
//Először elindítunk egy sessiont, ami lehetővé teszi az adatok átmeneti tárolását az egymást követő kérések között.
session_start();
// a config.php betöltése
include_once "config.php";

$email = mysqli_real_escape_string($conn, $_POST['email']);
$writtenpass = mysqli_real_escape_string($conn, $_POST['password']);

$sql = "SELECT * FROM Felhasznalok WHERE email = '{$email}'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);

if ($row) {
    $hashedPassword = $row['password'];
    
    // jelszó ellenőrzés
    if (password_verify($writtenpass, $hashedPassword)) {
        
        $_SESSION['user_id'] = $row['user_id'];
        echo "success";
    } else {
        echo "Helytelen jelszót adott meg!";
    }
} else {
    // ha nincs ilyen felhasználó
    echo "Helytelen bejelentkezési adatok!";
}

