
<?php
$con = new mysqli("localhost", "root", "", "moteur_de_recherche_db");


$sql = "SELECT id_filiere, nom_filiere FROM filiere";

$result = mysqli_query($con,$sql);

$filiere_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $id_fil = $row['id_filiere'];
    $nom_fil = $row['nom_filiere'];
    

    $filiere_arr[] = array("id" => $id_fil, "nom" => $nom_fil);
}

// encoding array to json format
echo json_encode($filiere_arr);

?>