<?php
//ajouter des type de meteo
global $wpdb;
$table_name = $wpdb->prefix . "bs_bulletin";

//supprimer la table "bs_meteo" s'il existe avant.
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);

//ajouter la table
$sql = "CREATE TABLE  $table_name(
        id_bul mediumint(9) NOT NULL AUTO_INCREMENT,
        heure_bul TIME(1),
        date_bul DATE,
        temperature_bul INT,
        id_met mediumint(9),
        id_pst mediumint(9),
        id_nge mediumint(9),
        id_web mediumint(9),
        texte_bul varchar(255) DEFAULT NULL,
        UNIQUE KEY id (id_bul)                                                                                                                                                                                                   
    )";
$wpdb->query($sql);

//table pour ajouter les valure des webcam
$webcamArray = array(
    array(1=> "1", "13:50:00", "2022-01-26", "5", "4", "3","2","1", ""),


);

foreach ($webcamArray as $key => $value) {
    $wpdb->insert($table_name, array('id_bul' => $value[1], 'heure_bul' => $value[2],'date_bul' => $value[3],'temperature_bul' => $value[4],'id_met' => $value[5], 'id_pst' => $value[6], 'id_nge' =>$value[7], 'id_web' => $value[8], 'texte_bul' => $value[9]));
}

