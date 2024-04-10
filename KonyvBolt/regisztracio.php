<?php 
//Először elindítunk egy sessiont, ami lehetővé teszi az adatok átmeneti tárolását az egymást követő kérések között.
session_start();
//Ellenörzi hogy a felhasználó be van e jelentkezve
if(isset($_SESSION['user_id']))
{
    header("location:LoggedInMain.php");
}
?>
<!-- head.php betöltése -->
<?php include_once "head.php"; ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>
                Regisztráció
            </header>
            <form action="#" enctype="multipart/form-data" autocomplete="off" name="registrationForm">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>Vezetéknév:</label>
                        <input type="text" placeholder="Vezetéknév" name="lname" id="" required>
                    </div>
                    <div class="field input">
                        <label>Keresztnév:</label>
                        <input type="text" placeholder="Keresztnév" name="fname" id="" required>
                    </div>
                    
                </div>
                    <div class="field input">
                        <label>E-mail:</label>
                        <input type="email" name="email" placeholder="E-mail cím" name="email" id="" required>
                    </div>
                    <div class="field input">
                        <label>Jelszó:</label>
                        <input type="password" name="password" placeholder="Jelszó" name="password" id="" required><i class="fas fa-eye"></i>
                    </div>
                    <div class="field input">
                        <label>Jelszó megerősítése:</label>
                        <input type="password" name="passwordagain" placeholder="Jelszó" name="passwordagain" id="" required><i class="fas fa-eye"></i>
                    </div>
                    
                    <div class="field button">
                        <input type="submit" value="Tovább a főoldalra">
                    </div>
                
            </form>
            <div class="link">Ha már van regisztrációja lépjen be: <a href="login.php">Belépés</a></div>
        </section>

    </div>

    <script src="js/pass-show-hide.js"></script>
    <script src="js/regisztracio.js"></script>
</body>

</html>