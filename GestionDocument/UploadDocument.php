<?php
    try {
        $con = new PDO('mysql:host=localhost;dbname=moteur_de_recherche_db;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    }
    $msg = null;
    $extensions_autorisees = array('doc', 'docx', 'pdf');

    if(isset($_POST['btn'])){
        
        $infosfichier = pathinfo($_FILES['myFile']['name']);
        $extension_upload = $infosfichier['extension'];
        
        if (in_array($extension_upload, $extensions_autorisees)){

            if($_FILES['myFile']['size'] <= 3000000){ //taille maximalle = 3MB
            
                $genre = $_FILES['myFile']['type'];
                $nom = $_FILES['myFile']['name'];
                $path = "../documents/".$nom;
                $document = file_get_contents($_FILES['myFile']['tmp_name']);
                $auteur = "admin";
                $id_filiere = $_POST["filiere"];
                $module = $_POST['module'];
                $niveau = $_POST['niveau'];

                if($id_filiere == 0){
                    $req = $con->prepare("INSERT INTO document(nom, auteur, date_upload, genre, niveau, module, path, document) values(:nom, :auteur, now(), :genre, :niveau, :module, :path, :document)");
                    
                } else {
                    $req = $con->prepare("INSERT INTO document(nom, auteur, date_upload, genre, niveau, id_filiere, module, path, document) values(:nom, :auteur, now(), :genre, :niveau, :id_filiere, :module, :path, :document)");
                    
                    $req->bindParam(':id_filiere', $id_filiere);
                }
            
                $req->bindParam(':nom', $nom);
                $req->bindParam(':auteur', $auteur);
                $req->bindParam(':genre', $genre);
                $req->bindParam(':niveau', $niveau);
                $req->bindParam(':module', $module);
                $req->bindParam(':path', $path);
                $req->bindParam(':document', $document, PDO::PARAM_LOB);
                $req->execute();
                
                if($req) {

                    move_uploaded_file($_FILES['myFile']['tmp_name'], $path );
                    $msg = "Succès";
            
                } else{
                    $msg = "Echec";
                }
            } else {
                $msg = "taille très grande !";
            }
        } else {
            $msg = "Entrez un fichier valide";
        }
    }
    
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

    <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>

   <!--************************ Formulaire************************************** -->
   <div class="row justify-content-center" >
        <div class="col-lg-6 bg-dark rounded px-4 my-5">
        <h3 class="text-center text-light p-4"> Séléctionnez un fichier </h3>
        <form method="post" action="#" enctype="multipart/form-data">

            <div>  
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-light">Année : </label>
                    <div class="col-md-9">
                        <select class="form-control" name="niveau" id="niveau" required>
                        <option value="" selected>-- Séléctionnez un niveau --</option>
                            <option value="1">1ère Année</option>
                            <option value="2">2ème Année</option>
                            <option value="3">3ème Année</option>
                            <option value="4">4ème Année</option>
                            <option value="5">5ème Année</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-light">Filiere : </label>
                    <div class="col-md-9">
                        <select class="form-control" name="filiere" id="filiere" required>
                            <option value="" selected>-- Séléctionnez une filière --</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-light">Module : </label>
                    <div class="col-md-9">
                        <select class="form-control" name="module" id="module" required>
                            <option value="" selected>-- Séléctionnez un module --</option>                            
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-light">Document:</label>
                    <div class="col-md-9">
                        <input type="file" class="form-control pb-4" name="myFile" required>
                    </div>
                </div>


            </div>

            <div class="form-group">
                <input type="submit" name="btn" value ="Upload File" class="btn btn-warning btn-block my-4">
            </div>

            <div class="form-group">
             <h5 class="text-center text-light"> <?= $msg; ?></h5>
            </div>
         </form>
        </div>
    </div>
      <!--********************************************************************** -->

    <script type="text/javascript">
        $(document).ready(function(){

            function updateModule(){

                var filiere_id = $('#filiere').val();
                var niveau_id = $("#niveau").val();
                $("#module").empty();
                $("#module").append("<option value='' selected>-- Séléctionnez un module --</option>");
                $.ajax({
                    url: 'getModule_ajax.php',
                    type: 'post',
                    data: {niveau_id:niveau_id, filiere_id:filiere_id},
                    dataType: 'json',
                    success:function(response){
                        var len = response.length;
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var nom = response[i]['nom'];
                            
                            $("#module").append("<option value='"+id+"'>"+nom+"</option>");
                        }
                    }
                });
            }

            $("#niveau").change(function(){

                var niveau_id = $(this).val();
                $("#filiere").empty();

                if(niveau_id == 1 || niveau_id == 2){

                    $("#filiere").append("<option value='0'>Pas de filière</option>");
                  
                } else {

                    $("#filiere").append("<option value='' selected>-- Séléctionnez une filière --</option>");

                    $.ajax({
                        url: 'getFiliere_ajax.php',
                        type: 'post',
                        dataType: 'json',
                        success:function(response){

                            var len = response.length;
                            for( var i = 0; i<len; i++){
                                var id = response[i]['id'];
                                var nom = response[i]['nom'];
                                
                                $("#filiere").append("<option value='"+id+"'>"+nom+"</option>");

                            }
                        }
                    });
                }
                
            });

            $("#filiere").change(function(){

                updateModule();

            });

            $("#niveau").change(function(){

                updateModule();

            });

        });
    </script>
</body>
</html>