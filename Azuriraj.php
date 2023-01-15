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
                        <li class="nav-item"><a class="nav-link active" href="Azuriraj.php">Ažuriraj</a></li>
                        <li class="nav-item"><a class="nav-link" href="Izlistaj.php">Izlistaj proizvode</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!--Forma 1-->
    <form action="" method="GET">
        <span><b>Pronadji proizvod koji zelis da izmenis:</b></span><br>
        <label for="ime_proizvoda">
            <span>Naziv proizvoda:</span>
            <input type="text" name="ime_proizvoda">
        </label>
        <input type="submit" value="Pronadji" name="pronadji">
        <br><br>
    </form>
        
        <!--Forma 2-->
    <form action="" method="POST">
        <span><b>Unesi novu kolicinu i cenu za taj proizvod:</b></span><br>
        <label for="kolicina">
            <span>Kolicina:</span>
            <input type="text" name="kolicina">
        </label>
        <label for="cena">
            <span>Cena:</span>
            <input type="text" name="cena">
        </label>
        <input type="submit" value="Azuriraj" name="azuriraj">
    </form>

        <div class="container">
            <?php 
            try{
             $pdo = new PDO("mysql:host=localhost;dbname=mikromarket;charset=utf8","root","");
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             echo "<br>Konekcija uspesna <br><br>";

            $pdo->beginTransaction();

            $sql1="SELECT ime_proizvoda, kolicina, cena FROM korpa WHERE ime_proizvoda=:ime_proizvoda";
            $stmt1=$pdo->prepare($sql1);
            $stmt1->bindParam(":ime_proizvoda", $ime_proizvoda);

            if(isset($_GET['pronadji']))
            {
                $ime_proizvoda=$_GET['ime_proizvoda'];

                if($ime_proizvoda!="") {
                    if (ctype_digit($ime_proizvoda)) {
                        echo "Ime proizvoda ne sme da sadrzi samo brojeve.";
                    }else{
                        $stmt1->execute();
                        echo "Proizvod koji zelite da izmenite jeste '$ime_proizvoda'.";
                    }
                } else{
                    echo "Morate popuniti polje za ime proizvoda.";
                }
            }
            
            $sql2="UPDATE korpa SET cena=:cena,kolicina=:kolicina WHERE ime_proizvoda=:ime_proizvoda";
            $stmt2=$pdo->prepare($sql2);
            $stmt2->bindParam(":cena",$cena);
            $stmt2->bindParam(":ime_proizvoda",$ime_proizvoda);
            $stmt2->bindParam(":kolicina",$kolicina);


            if(isset($_POST['azuriraj']))
            {
                $kolicina=$_POST['kolicina'];
                $cena=$_POST['cena'];

                if(!empty($kolicina) && !empty($cena)){
                    if(filter_var($kolicina,FILTER_VALIDATE_INT) === FALSE)
                    {
                        echo "Morate uneti celobrojne vrednosti za kolicinu.";
                    }else if(filter_var($cena,FILTER_VALIDATE_INT) === FALSE){
                        echo "Morate uneti celobrojne vrednosti za cenu.";
                    }
                    else{
                        $stmt2->execute();
                        echo "<br>Uspesno izmenjena kolicina i cena za $ime_proizvoda.";
                    }
                } else{
                    echo "Morate uneti vrednosti za kolicinu.";
                }
            
            }
            
            $pdo->commit();

        }catch(PDOException $e){
            $e->getMessage();
            $pdo->rollBack();
        }
    
            ?>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="templejt/js/scripts.js"></script>
    </body>
</html>