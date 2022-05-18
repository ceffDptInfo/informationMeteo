<?php
require("../../../../wp-config.php");
require("../class/Webcam.class.php");
header('Content-Type: application/json');

$web = new Webcam();

$id_webRa = $_POST["id_webRa"];
$act = $_POST['chWeb'];
$id_webCh = $_POST["id_webCh"];

$web->modificationdef($id_webRa);

if ($act == "checked"){
    $web->modificationAct($id_webCh);
}else{
    $web->modificationDesAct($id_webCh);
}



//echo json_encode($id_webRa);
