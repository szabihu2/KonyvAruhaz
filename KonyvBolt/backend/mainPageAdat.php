<?php 
//Először importálják a konfigurációs fájlt, amely tartalmazza az adatbázis kapcsolódási információkat. 
//Emellett betöltjük a lapozó és műfajok fájlokat is.
require_once "config.php";
include_once('lapozo.php');
include_once('mufajok.php');

//A kód megvizsgálja, hogy érkeztek-e POST kérések a rendező és a kifejezés mezőkből, majd ezeket változókba menti.
//Ezek a változók fogják tartalmazni a keresési feltételeket.

$rendezo = (isset($_POST["rendezo"])) ? $_POST["rendezo"] : "";
$kifejezes = (isset($_POST["kifejezes"])) ? $_POST["kifejezes"] : "";

//A keresési feltételek alapján létrehozzuk az SQL lekérdezést, amely a könyveket keresi a megadott cím vagy szerző alapján.
//A lekérdezés szűri a keresést a megadott kifejezésekre, és az eredményeket a megadott sorrendben és limitben adja vissza.

$sql = "SELECT konyv.*,mufajok.mufajNev FROM konyv LEFT JOIN mufajok ON konyv.mufaj = mufajok.mufajId where (
            KonyvCim LIKE '%{$kifejezes}%'
            OR szerzo LIKE '%{$kifejezes}%'
        )
        ORDER BY konyvCim ASC
        LIMIT {$honnan}, {$mennyit}";
        $eredmeny = mysqli_query($conn, $sql);
        //A kapcsolat ellenörzése.
        //var_dump($eredmeny);

//A lekérdezést végrehajtjuk az adatbázison, majd az eredményeket feldolgozzuk.
//Ha nincs találat, akkor hibaüzenetet írunk ki.
//Ellenkező esetben összegyűjtjük a könyvek adatait egy tömbbe, amelyet később átalakítunk JSON formátumba.

        if(@mysqli_num_rows($eredmeny) < 1) {
            $response = [
                'error' => true,
                'message' => 'Nincs találat a rendszerben!'
            ];
        } else {
            $books = [];
            while ($sor = mysqli_fetch_assoc($eredmeny)) {
                $books[] = [
                    'konyvCim' => $sor['konyvCim'],
                    'szerzo' => $sor['szerzo'],
                    'leiras' => $sor['leiras'],
                    'ar' => $sor['ar'],
                    'konyvId' => $sor['konyvId']

                    
                ];
            }
        
            $response = [
                'error' => false,
                'books' => $books
            ];
        }
        
        // JSON kimenet generálása.
        echo json_encode($response);

        

