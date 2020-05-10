
<?php

    $module_arr = array();
    $niveau_id = $_POST['niveau_id'];
    $filiere_id = $_POST['filiere_id'];

    if($niveau_id == 1 ){
        $module_arr[] = array("id" => "Electrostatique", "nom" => "Electrostatique");
        $module_arr[] = array("id" => "Magnetostatique", "nom" => "Magnetostatique");
        $module_arr[] = array("id" => "Algebre1", "nom" => "Algebre1");
        $module_arr[] = array("id" => "Analyse1", "nom" => "Analyse1");
        $module_arr[] = array("id" => "TEC", "nom" => "TEC");
        $module_arr[] = array("id" => "Electrocinetique", "nom" => "Electrocinetique");
        $module_arr[] = array("id" => "Anglais", "nom" => "Anglais");
    }

    if($niveau_id == 2 ){
        $module_arr[] = array("id" => "Atomistique", "nom" => "Atomistique");
        $module_arr[] = array("id" => "Probabilités", "nom" => "Probabilités");
        $module_arr[] = array("id" => "Algebre3", "nom" => "Algebre3");
        $module_arr[] = array("id" => "Analyse3", "nom" => "Analyse3");
        $module_arr[] = array("id" => "Analyse4", "nom" => "Analyse4");
        $module_arr[] = array("id" => "TEC", "nom" => "TEC");
        $module_arr[] = array("id" => "Anglais", "nom" => "Anglais");
    }
    
    if($niveau_id == 4 && $filiere_id == 1){

        $module_arr[] = array("id" => "PHP", "nom" => "PHP");
        $module_arr[] = array("id" => "JAVA Swing", "nom" => "JAVA Swing");
        $module_arr[] = array("id" => "C#", "nom" => "C#");
        $module_arr[] = array("id" => "DOTNET", "nom" => "DOTNET");
        $module_arr[] = array("id" => "MiniProjet", "nom" => "MiniProjet");
        $module_arr[] = array("id" => "Oracle", "nom" => "Oracle");
        $module_arr[] = array("id" => "Linux", "nom" => "Linux");

    }

    if($niveau_id == 3 && $filiere_id == 1){

        $module_arr[] = array("id" => "UML", "nom" => "UML");
        $module_arr[] = array("id" => "JAVA", "nom" => "JAVA");
        $module_arr[] = array("id" => "Javascript", "nom" => "Javascript");
        $module_arr[] = array("id" => "HTML", "nom" => "HTML");
        $module_arr[] = array("id" => "MiniProjet", "nom" => "MiniProjet");
        $module_arr[] = array("id" => "Merise", "nom" => "Merise");
        $module_arr[] = array("id" => "Linux", "nom" => "Linux");

    }
        


    
    // encoding array to json format
    echo json_encode($module_arr);

?>