<?php
    try {
        $con = new PDO('mysql:host=localhost;dbname=moteur_de_recherche_db;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    }

    $req = $con->prepare("SELECT * from document  LEFT JOIN filiere ON document.id_filiere = filiere.id_filiere  ");
    $req->execute();

    $document_arr = array();

    while( $row = $req->fetch() ){

        $row['nom_filiere'] = $row['id_filiere'] == NULL ? "-----" : $row['nom_filiere'] ;
        //$row['nom_filiere'] = "zineb";

        $document_arr[] = array("id" => $row['id'] , "nom" => $row['nom'],
                                "auteur" => $row['auteur'] ,  'nom_filiere'  => $row['nom_filiere'],
                                "module" => $row['module'] , 'genre' => $row['genre'],
                                'niveau' => $row['niveau'] , 'date_upload' => $row['date_upload'] );
    }


    // encoding array to json format
    echo json_encode($document_arr);
    
                
?>