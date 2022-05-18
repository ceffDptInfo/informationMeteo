<?php
//ajouter des type de meteo
global $wpdb;
$table_name = $wpdb->prefix . "bs_webcam";

//supprimer la table "bs_meteo" s'il existe avant.
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);

//ajouter la table
$sql = "CREATE TABLE  $table_name(
        id_web mediumint(9) NOT NULL AUTO_INCREMENT,
        url_web VARCHAR(255) DEFAULT NULL,    
        nom_web varchar(30) DEFAULT NULL,
        act_web tinyint(1),
        def_web tinyint(1),
        UNIQUE KEY id (id_web)                                                                                                                                                                                                   
    )";
$wpdb->query($sql);


//table pour ajouter les valure des webcam
$webcamArray = array(
array(1=> "1", "https://www.chasseral-snow.ch/photo/camera.jpg", "Plan-Marmet", 1, 1),
array(1=> "4", "https://www.chasseral-snow.ch/photo/pts-4.jpg", "Val-de-Ruz", 1, 0),
array(1=> "6", "https://www.chasseral-snow.ch/photo/pts-1.jpg", "Piste des Pointes", 1, 0),
array(1=> "7", "https://www.chasseral-snow.ch/photo/pts-3.jpg", "Les Savagnières", 1, 0),
array(1=> "8", "https://www.chasseral-snow.ch/photo/pts-2.jpg", "Haut Plan-Marmet", 1, 0)


);

foreach ($webcamArray as $key => $value) {
    $wpdb->insert($table_name, array('id_web' => $value[1], 'url_web' => $value[2],'nom_web' => $value[3],'act_web' => $value[4],'def_web' => $value[5]));
}
