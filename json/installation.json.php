<?php
require("../../../../wp-config.php");
require("../class/Installation.class.php");
header('Content-Type: application/json');

$ins = new Installation();

$dateBefore = strtotime($_POST["date_ins"]);
$insAddDB = array(
    'id_ins' => $_POST['last_id_ins'],
    'date_ins' => date("Y-m-d", $dateBefore),
);
$insDellTout = array(
    'id_ins' => 0,
    'date_ins' => date("Y-m-d", $dateBefore),
);


if ($_POST['ch'] != "checked") {
    $ins->desactive($insAddDB);
    $ins->desactive($insDellTout);
}else
    $ins ->active($insAddDB);

echo json_encode($insAddDB);