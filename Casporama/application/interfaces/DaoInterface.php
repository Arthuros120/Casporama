<?php

/* 

    DaoInterface permet de définir les méthodes utiliser par les différents modèles DAO

*/
interface DaoInterface {
    /*
    
        Cette fonction permet de récupérer les données d'une table et de les exporter
        en fonction d'un filtre donnée

    */
    function getData($id,$table,$filter) : ?string;

    /*
    
        Cette fonction permet d'ajouter des données d'un fichier donnée dans une table donnée.

    */
    function addData($file, $table);
}


/* 

    Cette fonction crée un fichier dans le dossier error permettant de crée des logs,
    de plus elle retourne l'erreur. Elle vérifie également qu'il y moins de 6 fichier
    dans le dossier permettant ainsi de ne pas surcharger le serveur.

*/
function errorFile($err, $table) : String
{

    $files = glob("./upload/DaoFile/error/" ."*");
    if ($files && count($files) >= 6) {
        array_map('unlink', glob("./upload/DaoFile/error/*.txt"));
    }

    $time = date("Y-m-d-G:i:s", time());
    $timeName = substr($time, 0, -3);
    $errorFile = fopen("./upload/DaoFile/error/$table" . "_" ."$timeName.txt", "a");
    if (gettype($err) == "array") {
        $msg = "DataBase Error : ";
        foreach ($err as $i) {
            $msg .= $i." ";
        }
    } else {
        $msg = $err;
    }
    fwrite($errorFile, $time." : ".$msg."\n");
    fclose($errorFile);
    
    return $err;
}

<<<<<<< HEAD
/*

    Retourne l'id du produit donné

*/

function getProductId(ProductEntity $product) {
=======
function getProductId(ProductEntity $product)
{
>>>>>>> refs/remotes/origin/main

    return $product->getId();

}

<<<<<<< HEAD
/*

    Retourne l'id du variant donné

*/


function getVariantId(StockEntity $variant) {
=======
function getVariantId(StockEntity $variant)
{
>>>>>>> refs/remotes/origin/main

    return $variant->getId();

}
