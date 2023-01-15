<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mikromarket</title>
        <link rel="icon" type="image/x-icon" href="/templejt/assets/favicon.ico" />
        <link href="/templejt/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="/templejt/assets/favicon.ico" style="width:50px;">&nbsp;Mikromarket Prodavnica</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="Dodaj.php">Dodaj proizvod</a></li>
                        <li class="nav-item"><a class="nav-link" href="Izbrisi.php">Izbriši proizvod</a></li>
                        <li class="nav-item"><a class="nav-link" href="Azuriraj.php">Ažuriraj</a></li>
                        <li class="nav-item"><a class="nav-link active" href="Izlistaj.php">Izlistaj proizvode</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <?php 
            try{ 

                $pdo = new PDO("mysql:host=localhost;dbname=mikromarket;charset=utf8","root","");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Konekcija uspesna <br><br>";

                $sql1="DROP PROCEDURE IF EXISTS sadrzaj_korpe";
                $sql2="CREATE PROCEDURE sadrzaj_korpe()
                BEGIN
                    SELECT * FROM korpa;
                    END;";
                $pdo->exec($sql1);
                $pdo->exec($sql2);
                echo "Procedura uspesno kreirana<br><br><br>";

                echo "<b>Sadrzaj Vase korpe:</b><br>";
                $sql="CALL sadrzaj_korpe()";
                $result=$pdo->query($sql);//ovime izvrsavamo upit i spisak stavljamo u promenljivu $result, koja je tipa niz
                foreach($result as $row) {
                    echo "<i>Ime proizvoda:</i> " . $row['ime_proizvoda'] . " , " . "<i>Kolicina:</i> " . $row['kolicina'] . " , " .
                    "<i>Cena:</i> " . $row['cena'] . "din.<br>";
                }
                  

            }catch(PDOException $e){
                $e->getMessage();
            }
            
            ?>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="templejt/js/scripts.js"></script>
    </body>
</html>