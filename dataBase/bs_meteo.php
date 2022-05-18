<?php
//ajouter des type de meteo
global $wpdb;
$table_name = $wpdb->prefix . "bs_meteo";

//supprimer la table "bs_meteo" s'il existe avant.
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);

//ajouter la table
$sql = "CREATE TABLE  $table_name(
        id_met mediumint(9) NOT NULL ,
        etat_met VARCHAR(30),
        UNIQUE KEY id (id_met)                                                                                                                                                                                                   
    )";
$wpdb->query($sql);


//table pour ajouter les état des meteo
$meteoArray = array(
    "0"=>"veuillez sélectionner",
    "1"=>"Pluie",
    "2"=>"Neige",
    "3"=>"Nuageux",
    "4"=>"Brouillard",
    "5"=>"Peu nuageux",
    "6"=>"Nuageux avec éclaircies",
    "7"=>"Brouillard très bas",
    "8"=>"Soleil",
    "9"=>"Indéterminée"
);

foreach ($meteoArray as $key => $etat){
    $wpdb->insert($table_name, array('id_met' => $key, 'etat_met' => $etat));
}