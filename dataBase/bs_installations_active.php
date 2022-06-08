<?php
//ajouter des type de pistes
global $wpdb;
$table_name = $wpdb->prefix . "bs_installations_active";

//supprimer la table "bs_pistes" s'il existe avant.
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);

//ajouter la table
$sql = "CREATE TABLE  $table_name(
        id_ins mediumint(9),
        date_ins date,
        UNIQUE KEY id (id_ins)
    )";
$wpdb->query($sql);