<?php
include 'api.php';
//www.fineblock.eu/api/demande/totalTfbk
//www.fineblock.eu/api/demande/userInfos/:id(6,7)

//www.monsite.fr/api/formations/:categorie (PHP. JS)
//www.monsite.fr/formation/:id (6, 7)

try{
    if(!empty($_GET['demande'])){
        $url = explode ("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));
        switch($url[0]){
            case "users":
                    getUsers();
            break;

            default: throw new Exception ("La demande n'est pas valide");
        }
    } else{
        throw new Exception ("Problème de récupération de données. ");
    }
} catch(Exception $e){
    $erreur = [
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];

    print_r($erreur);
}