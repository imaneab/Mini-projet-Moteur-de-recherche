<?php
    try {
        $con = new PDO('mysql:host=localhost;dbname=moteur_de_recherche_db;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    }

    $req = $con->prepare("SELECT * from document INNER JOIN filiere ON document.id_filiere = filiere.id_filiere ");
    $req->execute();
   
                
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

    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-lg-9 bg-dark rounded px-4 my-5">
                <h2 class="text-center text-light p-4"> Documents disponibles sur la plateforme </h2>
            </div>
        </div>

        <div class="row justify-content-center" >
            <div class="col-lg-12 my-5">
                <table class="table table-bordered">
                    <tr class="table-warning">
                        <th class="text-center">N°</th>
                        <th class="text-center">Statut</th>
                        <th class="text-center">Auteur</th>
                        <th class="text-center">Année</th>
                        <th class="text-center">Filiere</th>
                        <th class="text-center">Module</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Document</th>
                    </tr>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <script type="text/javascript">

        $(document).ready(function(){

            loadFiles();

            $("tbody").on('click', '.btn', function(){
                var id = $(this).attr('id');
                var td_nom = $("tbody").children().eq(1).children().eq(8).children().eq(0).html();
                var res = confirm('Vous voulez vraiment supprimé le document "' + td_nom +'" ?');
                if(res){

                    $.ajax({
                        type: 'post',
                        url: 'deleteFile_ajax.php',
                        data: {id:id},
                        success:function(response){
                            loadFiles();
                            alert(response);
                        }
                    });
                } 
            });

            function loadFiles(){
    
                $.ajax({
                    url: 'getList_ajax.php',
                    type: 'post',
                    dataType: 'json',
                    success:function(response){
                        
                        $("#tbody").empty();
                        var len = response.length;
                        for( var i = 0; i<len; i++){

                            var id = response[i]['id'];
                            var nom = response[i]['nom'];
                            var auteur = response[i]['auteur'];
                            var nom_filiere = response[i]['nom_filiere'];
                            var modulee = response[i]['module'];
                            var genre = response[i]['genre'];
                            var date_upload = response[i]['date_upload'];
                            var niveau = response[i]['niveau'];

                            if(genre == "application/pdf"){
                                genre = "PDF";
                            } else {
                                genre = "WORD";
                            }
                            
                            $("#tbody").append(
                                "<tr><td>" + (i+1) + "</td>"
                                + "<td><button id='" + id + "' type='submit' class='btn btn-danger'>Supprimer</button></td>"
                                + "<td>" + auteur + "</td>"
                                + "<td>" + niveau + "</td>"
                                + "<td>" + nom_filiere + "</td>"
                                + "<td>" + modulee + "</td>"
                                + "<td>" + genre + "</td>"
                                + "<td>" + date_upload + "</td>"
                                + "<td id='ouf' class='td_nom'><a id='zineb' href='ViewDocument.php?id=" + id + "' target='_blank'>" + nom + "</a></td></tr>")
                        }
                    }
                });
            }
            

    });
    </script>
    

</body>
</html>