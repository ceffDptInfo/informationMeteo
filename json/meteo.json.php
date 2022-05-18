<?php

require("../../../../wp-config.php");
require("../class/BulletinMeteo.class.php");
header('Content-Type: application/json');


$bul = new BulletinMeteo();

$dateBefore = strtotime($_POST["date_bul"]);
$bulAddDB = array (
    'heure_bul' => $_POST["heure_bul"],
    'date_bul' => date("Y-m-d", $dateBefore),
    'temperature_bul' => $_POST["temperature_bul"],
    'id_met' => $_POST["id_met"] ,
    'id_pst' => $_POST["id_pst"] ,
    'id_nge' => $_POST["id_nge"] ,
    'id_web' => $_POST["id_web"] ,
    'texte_bul' => $_POST["texte_bul"],
);
$bul->add($bulAddDB);

//echo json_encode($bulAddDB);