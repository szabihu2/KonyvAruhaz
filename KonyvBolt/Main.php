<?php 
//mufajok.php betöltése
include_once('backend/mufajok.php');

//lapozo.php betöltése
include_once('backend/lapozo.php');

//ujKonyvek.php betöltése
include_once('backend/ujKonyvek.php');

//legolcsobbKonyvek.php betöltése
include_once('backend/legolcsobbKonyvek.php');

//legtobbOldalSzam.php betöltése
include_once('backend/legtobbOldalSzam.php');

?>
<!DOCTYPE html>
<html lang="hu">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Főoldal</title>

<meta name="keywords" content="Használt könyv bolt" />
<meta name="description" content="Használt könyv bolt" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
<!-- Oldal keret eleje -->
<div id="templatemo_container">
    <!-- Navigációs sáv eleje -->
	<div id="templatemo_menu">
    	<ul>
            <div class="register">
            <li><a href="regisztracio.php">Regisztráció</a></li>
            <li><a href="login.php">Bejelentkezés</a></li>
            </div>
            
            <li><a href="Main.php" class="current">Főoldal</a></li>
            <li><form method="post"><input type="search" class="searchbar" id="kifejezes" name="kifejezes">
            </form>
    
            </li>
            
    	</ul>
    </div> <!-- Navigációs sáv vége -->

    <!-- Fejléc eleje -->
    <div id="templatemo_header">
    	<div id="templatemo_special_offers">
        	<?php print $olcsoKonyvek ?>
        </div>
        
        <div id="templatemo_new_books">
        	<?php print $ujKonyvek ?>
        </div>
    </div> <!-- Fejléc vége -->

    <!-- Fő tartalom eleje -->
    <div id="templatemo_content">
    	<!-- Bal oldali tartalom eleje -->
        <div id="templatemo_content_left">
        	<div class="templatemo_content_left_section">
            	<h1>Műfajok</h1>
                <?php  print $mufajok ?> 
            </div>
			<div class="templatemo_content_left_section">
            	<h1>Legtöbb oldalú könyvek</h1>
                <?php print $legtobbOldal ?>
            </div>
        </div> <!-- Bal oldali tartalom vége -->
        
            <!-- Jobb oldali tartalom eleje -->
            	<div id="mainContentContainer">
                <!--a backend/mainPageAdat.php-t átlakaítottam úgy, hogy egy json fájlt egy végpontot állítson elő, és azt olvasom be ide a js/mainPageAdat.js fájllal, így tisztább és átláthatóbb lesz a kód, mert az eredeti változatban teljesen elvesztem, annyit kellett átadni venni a fájlok között. Egyszerűbb lesz json kimeneteket végpontokat előállítani és azt js-el beolvasni a megfelelő helyre. 
                A backend/konyvReszletAdat.php állítja elő Neked az egy szem kiválsztott könyv adataiból a json fájlt, ezzel azt kell tenned, hogy módosítod a lekérdezést, hogy minden adata lekérdezésre kerüljön a könyvnek. A másik pedig a js/mainPageAdat.js függvényben ahol beolvasásra és össze állításra kerül az adat, ott a template literalal fűzd össze az adatokat, nyilván oda nem kell a részletek gomb, ha egy vissza a főoldlra gomb kell majd-->
                </div>
                
            <div class="cleaner_with_height">&nbsp;</div>

            <!-- Jobb oldali tartalom vége -->

            <!-- Lapozó tartalom eleje -->
            <nav class="page_turner">
                
                <ul>
                <?php print $lapozo ?>
                </ul>

            </nav>
            <!-- Lapozó tartalom vége -->

    </div> <!-- Fő tartalom vége -->
    

    <!-- Lábjegyzék eleje -->
    <div id="templatemo_footer">
    
	       <a href="Main.php">Főoldal</a> | <a href="#kifejezes">Keresés</a> <br>
            Copyright © 2024 <strong>Használt Könyv Center</strong>
    </div> 
    <!-- Lábjegyzék vége -->

</div><!-- Oldal keret vége -->

<!-- reszletekKereses.js meghívása -->
<script src="js/reszletekKereses.js"></script>
<!-- mainPageAdat.js meghívása -->
<script src="js/mainPageAdat.js"></script>
</body>
</html>