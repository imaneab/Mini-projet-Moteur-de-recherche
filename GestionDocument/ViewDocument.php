<?php
    $con = new PDO("mysql:host=localhost;dbname=moteur_de_recherche_db", "root", "");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $stat = $con->prepare("select * from document where id = ?");
        $stat->bindParam(1, $id);
        $stat->execute();
        $row = $stat->fetch();
        if($row['genre'] == "application/pdf"){
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="'.$row['nom'].'"');
            
        } else {
            header('Content-Disposition: attachment; filename="'.$row['nom'].'"');
        }
        echo $row['document'];
    }

    echo "error";

    
?>