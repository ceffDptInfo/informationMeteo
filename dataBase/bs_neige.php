<?php
//ajouter des type de meteo
global $wpdb;
$table_name = $wpdb->prefix . "bs_neige";

//supprimer la table "bs_meteo" s'il existe avant.
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);

//ajouter la table
$sql = "CREATE TABLE  $table_name(
        id_nge mediumint(9) NOT NULL ,
        etat_nge VARCHAR(30),
        UNIQUE KEY id (id_nge)                                                                                                                                                                                                   
    )";
$wpdb->query($sql);


$neigeArray = array(
    "0"=>"veuillez sélectionner",
    "1"=>"Mouillé",
    "2"=>"Fin",
    "3"=>"Poudreux",
    "6"=>"Dure",
    "7"=>"Carton",
    "8"=>"Insuffisant",
    "9"=>"Indéterminé",
    "10"=>"Bon à praticable",
    "11"=>"Praticable à bon",
    "12"=>"Neige de printemps ",
    "13"=>"Poudreux / Dure"
);

foreach ($neigeArray as $key => $etat){
    $wpdb->insert($table_name, array('id_nge' => $key, 'etat_nge' => $etat));
}
