<?php
$conn = new mysqli("localhost", "root", "", "moteur_de_recherche_db");

$msg = '';

if(isset($_POST['upload'])){
    $image = $_FILES['image']['name'];

    $path = "images/".$image;

    $sql = $conn->query("INSERT INTO actualite (image_path) VALUES ('$path')");

    if($sql) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path );

        $msg = "Succès";

    }
     else{
         $msg = "Echec";
     }

}
$result = $conn->query("SELECT * FROM actualite")
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title> Ajouter Actualité </title>
</head>
<body>

<div class="container-fluid">
    <div class="row justify-content-center mb-2">
       <div class="col-lg-10">
       <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
         <?php
         $i = 0;
         foreach($result as $row){
             $actives = '';
             if($i == 0){
                 $actives = 'active';
             }

         ?>


        <li data-target="#demo" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
        <?php $i++; } ?>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">

        <?php
         $i = 0;
         foreach($result as $row){
             $actives = '';
             if($i == 0){
                 $actives = 'active';
             }

         ?>

        <div class="carousel-item <?= $actives; ?>">
            <img src="<?= $row['image_path']; ?>" width="100%" height="400">
        </div>
        <?php $i++; } ?>

        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
        </a>

        </div>
            
        </div>
    </div>
      <!--************************ Formulaire************************************** -->
    <div class="row justify-content-center">
        <div class="col-lg-4 bg-dark rounded px-4">
        <h4 class="text-center text-light p-1"> Séléctionnez une image  </h4>
         <form method="post" action="#" enctype="multipart/form-data">
            
            <div class="form-group">
                <input type="file" class="form-control p-2" name="image" required>
            </div>

            <div class="form-group">
                <input type="submit" name="upload" value ="Upload Image" class="btn btn-warning btn-block">
            </div>

            <div class="form-group">
             <h5 class="text-center text-light"> <?= $msg; ?></h5>
            </div>
         </form>
        </div>
    </div>
      <!--********************************************************************** -->
</div>



<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>