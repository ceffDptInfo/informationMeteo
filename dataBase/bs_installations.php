<?php
//ajouter des type de meteo
global $wpdb;
$table_name = $wpdb->prefix . "bs_installations";

//supprimer la table "bs_meteo" s'il existe avant.
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);

//ajouter la table
$sql = "CREATE TABLE  $table_name(
        id_ins mediumint(9) NOT NULL,
        nom_ins VARCHAR(30),
        UNIQUE KEY id (id_ins)                                                                                                                                                                                                   
    )";
$wpdb->query($sql);

$installationsArray = array(
//    "0"=>"Toutes les installations",
    "1"=>"Sava 1",
    "2"=>"Sava 2",
    "3"=>"Plan-Marmet",
    "4"=>"Petit-Marmet",
    "5"=>"Les Pointes",
    "6"=>"Chasseral",
    "7"=>"Le Rumont",
    "8"=>"Le Fornel",

);

foreach ($installationsArray as $key => $nom){
    $wpdb->insert($table_name, array('id_ins' => $key, 'nom_ins' => $nom));
}
