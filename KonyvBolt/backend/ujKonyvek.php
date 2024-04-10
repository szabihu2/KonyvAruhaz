<?php 
//config.php betöltése.
require_once "config.php";
//SQL lekérdezés
$sql = "SELECT * FROM konyv ORDER BY kiadasEv DESC LIMIT 2";
$eredmeny = mysqli_query($conn, $sql);

if(@mysqli_num_rows($eredmeny) < 1){
    $ujKonyvek = "<li>
                <h2>Nincs találat a rendszerben!</h2>
                </li>\n";}
                else
                {
                    //adatok összefűzése
                    $ujKonyvek = "";
                    while ($sor = mysqli_fetch_assoc($eredmeny)) 
                    {
                        $ujKonyvek .= "
                        
                       <ul><li>{$sor['konyvCim']}</ul>
                        
                        \n";
                    }
                }
?>
