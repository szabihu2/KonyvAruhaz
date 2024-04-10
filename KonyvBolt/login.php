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
        <section class="form login">
            <header>
                Bejelentkezés
            </header>
            <form action="#">
                <div class="error-txt">Hiba üzenet!</div>
                
                    <div class="field input">
                        <label>E-mail:</label>
                        <input type="email" placeholder="E-mail cím" name="email" id="">
                    </div>
                    <div class="field input">
                        <label>Jelszó:</label>
                        <input type="password" placeholder="Jelszó" name="password" id="">
                        <i class="fas fa-eye"></i>
                    </div>
                    
                    <div class="field button">
                        <input type="submit" value="Tovább a főoldalra">
                    </div>
                
            </form>
            <div class="link">Ha még nincs regisztrációja: <a href="regisztracio.php">Regisztráció</a></div>
        </section>

    </div>
    <script src="js/pass-show-hide.js"></script>
    <script src="js/login.js"></script>
</body>

</html>