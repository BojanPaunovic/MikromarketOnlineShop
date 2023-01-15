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
                        <li class="nav-item"><a class="nav-link active" href="Izbrisi.php">Izbriši proizvod</a></li>
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
        <input type="submit" value="Izbrisi" name="izbrisi">
        
        <div class="container">
            <?php 
            try{ 

                $pdo = new PDO("mysql:host=localhost;dbname=mikromarket;charset=utf8","root","");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Konekcija uspesna <br><br>";

                $sql="DELETE FROM korpa WHERE ime_proizvoda=:ime_proizvoda";
                $stmt=$pdo->prepare($sql);      
                $stmt->bindParam(":ime_proizvoda",$ime_proizvoda);

                if(isset($_POST['izbrisi'])){
                    $ime_proizvoda=$_POST['ime_proizvoda'];         
                    if($ime_proizvoda !== ""){
                        if(strlen($ime_proizvoda) < 2){
                            echo "<br>Ime proizvoda mora sadrzati najmanje 2 karaktera.";
                        }
                        else{
                            $stmt->execute();
                            echo "Proizvod uspesno izbrisan iz korpe.<br>";
                        }
                    }
                    else{
                        echo "<br>Morate uneti minimum 2 karaktera za ime proizvoda.";
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