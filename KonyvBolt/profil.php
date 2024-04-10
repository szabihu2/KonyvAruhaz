<?php
//ujKonyvek.php meghívása
include_once('backend/ujKonyvek.php');

//legolcsobbKonyvek.php meghívása
include_once('backend/legolcsobbKonyvek.php');

//legtobbOldalSzam.php meghívása
include_once('backend/legtobbOldalSzam.php');

//mufajok.php meghívása
include_once('backend/mufajok.php');

?><!DOCTYPE html>
<html lang="hu">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Profil</title>

<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!-- Oldal keret eleje -->
<div id="templatemo_container">
    <!-- navigációs sáv eleje -->
	<div id="templatemo_menu">
    	<ul>
            <li><a href="LoggedInMain.php" class="current">Főoldal</a></li>
            <li><a href="hirdetes.php">Hirdetés</a></li>
            <div class="register">
            <li><a href="backend/logout.php">Kilépés</a></li>
            </div>
    	</ul>
    </div> <!-- navigációs sáv vége -->

    <!-- fejléc eleje -->
    <div id="templatemo_header">
    	<div id="templatemo_special_offers">
        	<?php print $olcsoKonyvek ?>
			
        </div>
        
        <div id="templatemo_new_books">
        	<?php print $ujKonyvek ?>
            
        </div>
    </div> <!-- fejléc vége -->

    <!-- Fő tartalom eleje -->
    <div id="templatemo_content">

    	<!-- Bal oldali tartalom eleje -->
        <div id="templatemo_content_left">
        	<div class="templatemo_content_left_section">
            	<h1>Műfajok</h1>
                <?php print $mufajok ?> 
            </div>
			<div class="templatemo_content_left_section">
            	<h1>Legtöbb oldalú könyvek</h1>
                <?php print $legtobbOldal ?>
            </div>           
        </div> <!-- Bal oldali tartalom vége -->

        <!-- Jobb oldali tartalom eleje -->
        
        	<div id="profilTartalom"></div>
              
         <!-- Bal oldali tartalom vége -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- Fő tartalom vége -->
    
    <!-- Lábjegyzék eleje -->
    <div id="templatemo_footer">
    
        <a href="LoggedInMain.php">Főoldal</a> <br>
        Copyright © 2024 <strong>Használt Könyv Center</strong>
    </div>
 <!-- Lábjegyzék vége --> 

</div> <!-- Oldal keret vége -->
<script src="js/profilAdat.js"></script>

<!-- 
Book Store Template 
http://www.templatemo.com/preview/templatemo_086_book_store 
-->
</body>
</html>