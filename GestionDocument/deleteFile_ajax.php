<?php

    try {
        $con = new PDO('mysql:host=localhost;dbname=moteur_de_recherche_db;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    }

    $id = $_POST['id'];

    $req0 = $con->prepare('SELECT nom FROM document WHERE id = :id');
    $req0->bindParam(':id', $id);
    $req0->execute();

    $req = $con->prepare('DELETE FROM document WHERE id = :id');
    $req->bindParam(':id', $id);
    $req->execute();

    $count = $req->rowCount();

    if($count == 1){

        $base_directory = '../documents/';
        $row = $req0->fetch();

        if (file_exists($base_directory. $row['nom'])){

            if(unlink($base_directory. $row['nom'])){
                echo "Le document a été bien supprimé de la BD et du local.";
            }
        } 
        else{
            echo "Le document est supprimé de la BD !";
        }

    } else {
        echo "Réessayez plus tard, le document n'a pas été supprimé !";
    }
?>