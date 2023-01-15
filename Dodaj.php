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
                        <li class="nav-item"><a class="nav-link active" href="Dodaj.php">Dodaj proizvod</a></li>
                        <li class="nav-item"><a class="nav-link" href="Izbrisi.php">Izbriši proizvod</a></li>
                        <li class="nav-item"><a class="nav-link" href="Azuriraj.php">Ažuriraj</a></li>
                        <li class="nav-item"><a class="nav-link" href="Izlistaj.php">Izlistaj proizvode</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <br>
        <!--Forma-->
        <form action="" method="POST">
            <label for="ime_proizvoda">
                <span>Naziv proizvoda:</span>
                <input type="text" name="ime_proizvoda">
            </label>
            <label for="kolicina">
                <span>Cena:</span>
                <input type="text" name="cena">
            </label>
            <label for="cena">
                <span>Kolicina:</span>
                <input type="text" name="kolicina">
            </label>
            <input type="submit" value="Dodaj" name="dodaj">
       </form>
        
        <div class="container">
            <?php 
            try{ 

                $pdo = new PDO("mysql:host=localhost;dbname=mikromarket;charset=utf8","root","");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Konekcija uspesna <br><br>";

                $sql="INSERT INTO korpa(ime_proizvoda,kolicina,cena) VALUES(:ime_proizvoda, :kolicina, :cena)";
                $stmt=$pdo->prepare($sql);

                $stmt->bindParam(":ime_proizvoda",$ime_proizvoda);
                $stmt->bindParam(":kolicina",$kolicina);
                $stmt->bindParam(":cena",$cena);

                if(isset($_POST['dodaj'])){
                    $ime_proizvoda=$_POST['ime_proizvoda'];
                    $kolicina=$_POST['kolicina'];
                    $cena=$_POST['cena'];

                    if($ime_proizvoda!="" && $kolicina!="" && $cena!=""){
                        if(strlen($ime_proizvoda)<2){
                            echo "<br>Ime proizvoda mora sadrzati najmanje 2 karaktera.";
                        }
                        else if(!ctype_digit($cena) || !ctype_digit($kolicina))
                        {
                            echo "<br>Cena i kolicina moraju biti izrazeni iskljucivo brojevima.";
                        }
                        elseif(($cena)<1){
                            echo "<br>Cena mora biti veca od 0 dinara.";
                        }
                        else if(($kolicina)<1){
                            echo "<br>Morate uneti kolicinu vecu od nula.";
                        }
                        else
                        {
                            $stmt->execute();
                            echo "<br>Proizvod uspesno dodat u korpu.";
                        }
                    }
                    else{
                        echo "<br>Morate popuniti sva polja.";
                    }

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